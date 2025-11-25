<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransOrder;
use App\Models\Customer;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // dd('BERHASIL MASUK CONTROLLER BARU!'); // tes comtroller
        // $transaksiHariIni = TransOrder::whereDate('order_date', Carbon::today())->count();
        $transaksiHariIni = TransOrder::count();

        // $pendapatanHariIni = TransOrder::whereDate('updated_at', Carbon::today())->where('order_status', 1)->get()->sum('total_price');
        $pendapatanHariIni = TransOrder::where('order_status', '1')->get()->sum('total_price');

        $sedangProses = TransOrder::where('order_status', '0')->count();
        $totalPelanggan = Customer::count();
        $latestTransactions = TransOrder::with('customer')->latest()->take(5)->get();

        return view('index', compact(
            'transaksiHariIni',
            'pendapatanHariIni',
            'sedangProses',
            'totalPelanggan',
            'latestTransactions'
        ));
    }
}
