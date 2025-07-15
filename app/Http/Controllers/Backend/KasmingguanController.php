<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\KasMingguan;
use App\Models\Pembayaran;
use App\Models\User;

class KasmingguanController extends Controller
{
    public function index()
    {
        $kas   = KasMingguan::latest()->get();
        $users = User::all();
        $title = 'Hapus Data Kas!';
        $text  = "Apakah Anda Yakin??";
        confirmDelete($title, $text);

        return view('backend.kas.index', compact('kas', 'users'));
    }
    
    public function show($id)
    {
    $kas = KasMingguan::findOrFail($id);

    $mingguKe = $kas->minggu_ke;
    $bulan = $kas->bulan;
    $userId = $kas->user_id;

    // Ambil semua pembayaran user yang masuk minggu & bulan yang sama
    $pembayarans = Pembayaran::where('user_id', $userId)
        ->whereMonth('tanggal', $bulan)
        ->get()
        ->filter(function ($pembayaran) use ($mingguKe) {
            return ceil(\Carbon\Carbon::parse($pembayaran->tanggal)->day / 7) == $mingguKe;
        });

    // Total jumlah dibayarkan
    $totalJumlah = $pembayarans->sum('jumlah');

    // Ambil daftar tanggal
    $tanggalList = $pembayarans->map(function ($item) {
        $tanggal = \Carbon\Carbon::parse($item->tanggal)->format('d M Y');
        $jumlah  = number_format($item->jumlah, 0, '.', '.');
        return "{$tanggal} (Rp. {$jumlah})";
    });
    

    return view('backend.kas.show', compact('kas', 'totalJumlah', 'tanggalList'));
    }


    public function destroy(string $id)
    {
        $kas = KasMingguan::findOrFail($id);

        // Ambil minggu, bulan, user dari kas mingguan
        $mingguKe = $kas->minggu_ke;
        $bulan = $kas->bulan;
        $userId = $kas->user_id;

        // Cari pembayaran yang sesuai minggu dan bulan
        $pembayarans = Pembayaran::where('user_id', $userId)
            ->whereMonth('tanggal', $bulan)
            ->get()
            ->filter(function ($item) use ($mingguKe) {
                return ceil(\Carbon\Carbon::parse($item->tanggal)->day / 7) == $mingguKe;
            });

        // Hapus semua pembayaran yang cocok
        foreach ($pembayarans as $pembayaran) {
            $pembayaran->delete();
        }

        // Hapus kas mingguan
        $kas->delete();

        toast('Data kas dan pembayaran terkait berhasil dihapus', 'success');
        return redirect()->route('backend.kas.index');
    }

}
