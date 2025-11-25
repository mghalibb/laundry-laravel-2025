<?php

namespace App\Http\Controllers;

use App\Models\TransOrder;
use App\Models\TransLaundryPickup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class PickupController extends Controller
{
    public function index()
    {
        $transactions = TransOrder::with(['customer', 'details', 'pickup'])->latest()->get();

        return view('pickups.index', compact('transactions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_order' => 'required|exists:trans_order,id',
            'order_pay' => 'required|numeric|min:0',
            'order_change' => 'required|numeric',
        ]);

        DB::transaction(function () use ($request) {
            $order = TransOrder::findOrFail($request->id_order);

            if ($request->order_pay < $order->total_price) {
                throw new \Exception("Uang pembayaran kurang!");
            }

            $order->update([
                'order_status' => '1',
                'order_pay' => $request->order_pay,
                'order_change' => $request->order_change,
            ]);

            TransLaundryPickup::create([
                'id_order' => $order->id,
                'id_customer' => $order->id_customer,
                'pickup_date' => Carbon::now(),
                'notes' => $request->notes ?? 'Pesanan selesai & diambil.',
            ]);
        });

        Alert::success('Success', 'Laundry berhasil diambil & Status diperbarui!!');
        return redirect()->route('pickups.index');
    }
}
