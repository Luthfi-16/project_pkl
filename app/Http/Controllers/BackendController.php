<?php
namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Transaksikas;
use App\Models\User;

class BackendController extends Controller
{
    public function index()
    {
        $totalUser = User::count();

        $totalPemasukkan   = TransaksiKas::where('jenis', 'pemasukkan')->sum('jumlah');
        $totalPengeluaran = TransaksiKas::where('jenis', 'pengeluaran')->sum('jumlah');

        $totalPembayaran = Pembayaran::sum('jumlah');
        $saldoKas        = $totalPembayaran + $totalPemasukkan - $totalPengeluaran;

        return view('backend.index', compact(
            'totalUser',
            'totalPemasukkan',
            'totalPengeluaran',
            'totalPembayaran',
            'saldoKas'
        ));

    }
}
