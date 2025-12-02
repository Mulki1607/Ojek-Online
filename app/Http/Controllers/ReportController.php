<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\TopUp;
use App\Models\Withdraw;
use Carbon\Carbon;

class ReportController extends Controller
{
    // Laporan utama
    public function index(Request $request)
    {
        $start = $request->start_date ?? Carbon::now()->startOfMonth()->toDateString();
        $end   = $request->end_date ?? Carbon::now()->endOfMonth()->toDateString();

        // Laporan pendapatan
        $totalPendapatan = Pesanan::whereBetween('created_at', [$start, $end])
            ->where('status', 'completed')
            ->sum('harga');

        // Jumlah order selesai
        $orderCompleted = Pesanan::whereBetween('created_at', [$start, $end])
            ->where('status', 'completed')
            ->count();

        // Total top up
        $totalTopUp = TopUp::whereBetween('created_at', [$start, $end])
            ->sum('amount');

        // Total withdraw
        $totalWithdraw = Withdraw::whereBetween('created_at', [$start, $end])
            ->sum('amount');

        // Kirim data ke view
        return view('reports.index', compact(
            'start',
            'end',
            'totalPendapatan',
            'orderCompleted',
            'totalTopUp',
            'totalWithdraw'
        ));
    }

    // Detail laporan pesanan
    public function pesanan(Request $request)
    {
        $start = $request->start_date ?? Carbon::now()->subMonth()->toDateString();
        $end = $request->end_date ?? Carbon::now()->toDateString();

        $pesanan = Pesanan::whereBetween('created_at', [$start, $end])->get();

        return view('reports.pesanan', compact('pesanan', 'start', 'end'));
    }

    // Detail laporan keuangan (topup + withdraw)
    public function finance(Request $request)
    {
        $start = $request->start_date ?? Carbon::now()->subMonth()->toDateString();
        $end = $request->end_date ?? Carbon::now()->toDateString();

        $topup = TopUp::whereBetween('created_at', [$start, $end])->get();
        $withdraw = Withdraw::whereBetween('created_at', [$start, $end])->get();

        return view('reports.finance', compact('topup', 'withdraw', 'start', 'end'));
    }
}
