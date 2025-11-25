<?php

namespace App\Http\Controllers;

use App\Models\TransOrder;
use App\Models\TransOrderDetail;
use App\Models\Customer;
use App\Models\TypeOfService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;


class TransactionController extends Controller
{
    public function index()
    {
        $transactions = DB::table('trans_order as o')
        ->join('customer as c', 'c.id', '=', 'o.id_customer')
        ->join('users as u', 'u.id', '=', 'o.id_user')
        ->select(
            'o.id',
            'o.order_code',
            'o.order_date',
            'o.order_status',
            'o.tax',
            'o.admin_fee',
            'c.nama as cutomer_name',
            'u.username as cashier_name'
        )->orderBy('o.created_at', 'DESC')->get();

        foreach ($transactions as $trx) {
            $subtotalJasa = DB::table('trans_order_detail as od')
            ->where('od.id_order', $trx->id)
            ->sum('od.subtotal');

            $total = $subtotalJasa + $trx->tax + $trx->admin_fee;
            $trx->total_calculated = $total;
            $trx->total_items = DB::table('trans_order_detail')
            ->where('id_order', $trx->id)
            ->count();
        }
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $customers = DB::table('customer')->get();
        $services = DB::table('type_of_service')->get();

        $today = Carbon::now()->format('Ymd');
        $lastOrder = DB::table('trans_order')->whereDate('created_at', Carbon::today())->orderBy('id','DESC')->first();

        $sequence = $lastOrder ? (int)substr($lastOrder->order_code, -3) + 1 : 1;
        $orderCode = 'TRX-' . $today . '-' . sprintf('%03d', $sequence);

        return view('transactions.add', compact('customers', 'services', 'orderCode'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_customer' => 'required',
            'order_code' => 'required',
            'services' => 'required|array',
            'tax' => 'nullable|numeric',
            'admin_fee' => 'nullable|numeric',
        ]);

        DB::beginTransaction();

        try {
            $id_order = DB::table('trans_order')->insertGetId([
                'order_code' => $request->order_code,
                'order_date' => Carbon::now(),
                'id_customer' => $request->id_customer,
                'id_user' => Auth::id(),
                'order_status' => '0',
                'order_pay' => 0,
                'order_change' => 0,
                'tax' => $request->tax ?? 0,
                'admin_fee' => $request->admin_fee ?? 0,
                'created_at' => now(),
                'update_at' => now(),
            ]);

            foreach ($request->services as $item) {
                if (!empty($item['id_service']) && !empty($item['qty'])) {
                    $service =DB::table('type_of_service')->where('id', $item['id_service'])->first();

                    if ($service) {
                        $harga = $service->price;
                        $qty = $item['qty'];
                        $subtotal = $harga * $qty;

                        DB::table('trans_order_detail')->insert([
                            'id_order' => $id_order,
                            'id_service' => $item['id_service'],
                            'qty' => $qty,
                            'subtotal' => $subtotal,
                            'notes' => $item['notes'] ?? null,
                            'created_at' => now(),
                            'update_at' => now(),
                        ]);
                    }
                }
            }

            DB::commit();

            Alert::success('Success', 'Transaksi Berhasil Dibuat!');
            return redirect()->route('transactions.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi Kesalahan: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $transaction = DB::table('trans_order as o')
            ->join('customer as c', 'c.id', '=', 'o.id_customer')
            ->join('users as u', 'u.id', '=', 'o.id_user')
            ->select('o.*', 'c.nama as customer_name', 'c.alamat', 'c.tlp', 'u.username as cashier_name')
            ->where('o.id', $id)
            ->first();

        $details = DB::table('trans_order_detail as d')
            ->join('type_of_service as s', 's.id', '=', 'd.id_service')
            ->select('d.*', 's.service_name', 's.price', 's.description')
            ->where('d.id_order', $id)
            ->get();

        $grandTotal = 0;
        foreach($details as $d) {
            $grandTotal += $d->subtotal;
        }
        $grandTotal = $grandTotal + $transaction->tax + $transaction->admin_fee;

        return view('transactions.show', compact('transaction', 'details', 'grandTotal'));
    }
}
