<?php
namespace App\Http\Controllers;
use App\Models\Pembayaran;
use App\Models\Transaksikas;

class FrontendController extends Controller
{
    public function index()
    {
        $totalPemasukkan  = TransaksiKas::where('jenis', 'pemasukkan')->sum('jumlah');
        $totalPengeluaran = TransaksiKas::where('jenis', 'pengeluaran')->sum('jumlah');

        $totalPembayaran = Pembayaran::sum('jumlah');
        $saldoKas        = $totalPembayaran + $totalPemasukkan - $totalPengeluaran;

        return view('index', compact(
            'totalPemasukkan',
            'totalPengeluaran',
            'totalPembayaran',
            'saldoKas'
        ));

    }
}
