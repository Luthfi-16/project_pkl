<?php
namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Transaksikas;
use Auth;

class FrontendController extends Controller
{
    public function index()
    {

        $user = Auth::user();

        $totalPemasukkan  = TransaksiKas::where('jenis', 'pemasukkan')->sum('jumlah');
        $totalPengeluaran = TransaksiKas::where('jenis', 'pengeluaran')->sum('jumlah');

        $totalPembayaran = Pembayaran::sum('jumlah');
        $saldoKas        = $totalPembayaran + $totalPemasukkan - $totalPengeluaran;

        $transaksi = Transaksikas::where('jenis', 'pengeluaran')->get();

        return view('index', compact(
            'totalPemasukkan',
            'totalPengeluaran',
            'totalPembayaran',
            'saldoKas',
            'transaksi'
        ));

    }

    public function profile($id){

        $jumlahUang = Pembayaran::where('user_id', $id)->sum('jumlah');

        return view('profile', compact('jumlahUang'));

    }
}
