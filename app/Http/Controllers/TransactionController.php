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
        $transactions = TransOrder::with(['customer', 'user', 'details.service', 'pickup'])->latest()->get();
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $customers = Customer::all();
        $services = TypeOfService::all();

        $today = Carbon::now()->format('Ymd');
        $lastOrder = TransOrder::whereDate('created_at', Carbon::today())->latest()->first();
        $sequence = $lastOrder ? (int)substr($lastOrder->order_code, -3) + 1 : 1;
        $orderCode = 'TRX-' . $today . '-' . sprintf('%03d', $sequence);

        return view('transactions.add', compact('customers', 'services', 'orderCode'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_customer' => 'required|exists:customer,id',
            'order_code' => 'required|unique:trans_order,order_code',
            'services' => 'required|array',
            'services.*.id_service' => 'required',
            'services.*.qty' => 'required|numeric|min:0.001',
            'tax' => 'nullable|numeric|min:0',
            'admin_fee' => 'nullable|numeric|min:0',
        ]);

        DB::transaction(function () use ($request) {
            $order = TransOrder::create([
                'order_code' => $request->order_code,
                'order_date' => Carbon::now(),
                'id_customer' => $request->id_customer,
                'id_user' => Auth::id(),
                'order_status' => '0',
                'order_pay' => 0,
                'order_change' => 0,
                'tax' => $request->tax ?? 0,
                'admin_fee' => $request->admin_fee ?? 0,
            ]);

            foreach ($request->services as $item) {
                $serviceDB = TypeOfService::find($item['id_service']);
                $subtotal = $serviceDB->price * $item['qty'];

                TransOrderDetail::create([
                    'id_order' => $order->id,
                    'id_service' => $item['id_service'],
                    'qty' => $item['qty'],
                    'subtotal' => $subtotal,
                    'notes' => $item['notes'] ?? null,
                ]);
            }
        });

        Alert::success('Success', 'Transaksi Berhasil Dibuat!');
        return redirect()->route('transactions.index');
    }

    public function show($id)
    {
        $transaction = TransOrder::with(['customer', 'details.service', 'user'])->findOrFail($id);
        return view('transactions.show', compact('transaction'));
    }
}
