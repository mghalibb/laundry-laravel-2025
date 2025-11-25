<?php

namespace App\Http\Controllers;

use App\Models\TransOrder;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->startOfMonth()->format('Y-m-d'));

        $transactions = TransOrder::with(['customer', 'user'])->whereDate('order_date', '>=',$startDate)->whereDate('order_date', '<=', $endDate)->latest()->get();

        $totalIncome = $transactions->sum('total_price');
        return view('reports.index', compact('transactions', 'startDate', 'endDate', 'totalIncome'));
    }
    public function print(Request $request)

    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $transactions = TransOrder::with(['customer', 'user'])->whereDate('order_date', '>=',$startDate)->whereDate('order_date', '<=', $endDate)->latest()->get();

        $totalIncome = $transactions->sum('total_price');
        return view('reports.print', compact('transactions', 'startDate', 'endDate', 'totalIncome'));
    }
}
