<?php

namespace App\Http\Controllers;

use App\Models\TransOrder;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->startOfMonth()->format('Y-m-d'));

        // $transactions = TransOrder::with(['customer', 'user'])
        //                 ->whereDate('order_date', '>=', $startDate)
        //                 ->whereDate('order_date', '<=', $endDate)
        //                 ->latest()
        //                 ->get();
        $transactions = TransOrder::with(['customer', 'user', 'details.service'])
                        ->whereDate('order_date', '>=', $startDate)
                        ->whereDate('order_date', '<=', $endDate)
                        ->where('order_status', '1') 
                        ->latest()
                        ->get();

        $totalIncome = $transactions->sum('total_price');
        return view('reports.index', compact('transactions', 'startDate', 'endDate', 'totalIncome'));
    }

    public function print(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // $transactions = TransOrder::with(['customer', 'user'])
        //                 ->whereDate('order_date', '>=', $startDate)
        //                 ->whereDate('order_date', '<=', $endDate)
        //                 ->latest()
        //                 ->get();
        $transactions = TransOrder::with(['customer', 'user', 'details.service'])
                        ->whereDate('order_date', '>=', $startDate)
                        ->whereDate('order_date', '<=', $endDate)
                        ->where('order_status', '1')
                        ->latest()
                        ->get();

        $totalIncome = $transactions->sum('total_price');

        $leader = User::whereHas('level', function($query) {
            $query->where('nama_level', 'Leader')
                  ->orWhere('nama_level', 'Pimpinan')
                  ->orWhere('nama_level', 'Owner');
        })->first();

        return view('reports.print', compact(
            'transactions',
            'startDate',
            'endDate',
            'totalIncome',
            'leader'
        ));
    }
}
