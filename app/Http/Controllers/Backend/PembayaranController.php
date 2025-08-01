<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\KasMingguan;
use App\Models\Pembayaran;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pembayaran = Pembayaran::latest()->get();
        $users      = User::all();
        $title      = 'Hapus Data Bayar!';
        $text       = "Apakah Anda Yakin??";
        confirmDelete($title, $text);

        return view('backend.pembayaran.index', compact('pembayaran', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('backend.pembayaran.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'jumlah'  => 'required|numeric',
            'tanggal' => 'required|date',
        ]);

        $pembayaran          = new Pembayaran();
        $pembayaran->user_id = $request->user_id;
        $pembayaran->jumlah  = $request->jumlah;
        $pembayaran->tanggal = $request->tanggal;


        $tanggal  = Carbon::parse($request->tanggal);
        $mingguKe = ceil($tanggal->day / 7);
        $bulan    = $tanggal->month;

        $users = User::find($request->user_id);

        // Cek apakah kas mingguan untuk user, minggu, bulan sudah ada
        $kasMingguan = KasMingguan::where('user_id', $request->user_id)
            ->where('minggu_ke', $mingguKe)
            ->where('status', 'lunas','belum')
            ->where('bulan', $bulan)
            ->first();

        if ($kasMingguan && $kasMingguan->status == 'lunas') {
            
            toast("Uangkas minggu ini untuk {$users->name} sudah lunas", 'info');
            return redirect()->route('backend.pembayaran.create');

        }
        

        if ($kasMingguan) {
            // Update jumlah
            $kasMingguan->jumlah += $request->jumlah;

            // Update status jika total sudah 10.000 atau lebih
            $kasMingguan->status = $kasMingguan->jumlah >= 10000 ? 'lunas' : 'belum';

            // Update tanggal bayar terakhir
            $kasMingguan->tanggal_bayar = $tanggal;

            $kasMingguan->save();
        } else {
            // Belum ada, buat baru
            $status = $request->jumlah >= 10000 ? 'lunas' : 'belum';

            KasMingguan::create([
                'user_id'       => $request->user_id,
                'status'        => $status,
                'minggu_ke'     => $mingguKe,
                'bulan'         => $bulan,
                'jumlah'        => $request->jumlah,
                'tanggal_bayar' => $tanggal,
            ]);
        }

        $pembayaran->save();

        toast('Data berhasil ditambah', 'success');
        return redirect()->route('backend.pembayaran.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $users      = User::all();
        return view('backend.pembayaran.edit', compact('pembayaran', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'user_id' => 'required',
            'jumlah'  => 'required|numeric',
            'tanggal' => 'required|date',
        ]);

        // Ambil pembayaran lama (sebelum diedit)
        $pembayaranLama = Pembayaran::findOrFail($id);

        $userIdLama = $pembayaranLama->user_id;
        $tanggalLama = Carbon::parse($pembayaranLama->tanggal);
        $mingguKeLama = ceil($tanggalLama->day / 7);
        $bulanLama = $tanggalLama->month;

        // Hapus dampak pembayaran lama di kas mingguan
        $kasLama = KasMingguan::where('user_id', $userIdLama)
            ->where('minggu_ke', $mingguKeLama)
            ->where('bulan', $bulanLama)
            ->first();

        if ($kasLama) {
            $kasLama->jumlah -= $pembayaranLama->jumlah;

            if ($kasLama->jumlah <= 0) {
                $kasLama->delete(); // Jika tidak ada pembayaran lain, hapus kas
            } else {
                $kasLama->status = $kasLama->jumlah >= 10000 ? 'lunas' : 'belum';
                $kasLama->save();
            }
        }

        // Update pembayaran
        $pembayaranLama->user_id = $request->user_id;
        $pembayaranLama->jumlah  = $request->jumlah;
        $pembayaranLama->tanggal = $request->tanggal;
        $pembayaranLama->save();

        // Hitung minggu & bulan baru
        $tanggalBaru = Carbon::parse($request->tanggal);
        $mingguKeBaru = ceil($tanggalBaru->day / 7);
        $bulanBaru = $tanggalBaru->month;

        // Update / Tambah data ke kas mingguan
        $kasBaru = KasMingguan::where('user_id', $request->user_id)
            ->where('minggu_ke', $mingguKeBaru)
            ->where('bulan', $bulanBaru)
            ->first();

        if ($kasBaru) {
            $kasBaru->jumlah += $request->jumlah;
            $kasBaru->status = $kasBaru->jumlah >= 10000 ? 'lunas' : 'belum';
            $kasBaru->tanggal_bayar = $tanggalBaru;
            $kasBaru->save();
        } else {
            KasMingguan::create([
                'user_id'       => $request->user_id,
                'minggu_ke'     => $mingguKeBaru,
                'bulan'         => $bulanBaru,
                'jumlah'        => $request->jumlah,
                'tanggal_bayar' => $tanggalBaru,
                'status'        => $request->jumlah >= 10000 ? 'lunas' : 'belum',
            ]);
        }

        toast('Data berhasil diedit', 'success');
        return redirect()->route('backend.pembayaran.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        $tanggal  = \Carbon\Carbon::parse($pembayaran->tanggal);
        $mingguKe = ceil($tanggal->day / 7);
        $bulan    = $tanggal->month;
        $userId   = $pembayaran->user_id;

        // Hapus pembayaran
        $pembayaran->delete();

        // Ambil semua pembayaran lain (setelah penghapusan) di minggu+bulan itu
        $pembayarans = Pembayaran::where('user_id', $userId)
            ->whereMonth('tanggal', $bulan)
            ->get()
            ->filter(function ($item) use ($mingguKe) {
                return ceil(\Carbon\Carbon::parse($item->tanggal)->day / 7) == $mingguKe;
            });

        // Cek apakah masih ada pembayaran di minggu itu
        if ($pembayarans->isEmpty()) {
            // Hapus kas_mingguans karena tidak ada pembayaran tersisa
            \App\Models\KasMingguan::where('user_id', $userId)
                ->where('bulan', $bulan)
                ->where('minggu_ke', $mingguKe)
                ->delete();
        } else {
            // Update kas_mingguans: jumlah dan tanggal_bayar terakhir
            $totalJumlah     = $pembayarans->sum('jumlah');
            $tanggalTerakhir = $pembayarans->last()->tanggal;

            $status = $totalJumlah >= 10000 ? 'lunas' : 'belum';

            \App\Models\KasMingguan::where('user_id', $userId)
                ->where('bulan', $bulan)
                ->where('minggu_ke', $mingguKe)
                ->update([
                    'jumlah'        => $totalJumlah,
                    'status'        => $status,
                    'tanggal_bayar' => $tanggalTerakhir,
                ]);
        }

        toast('Data berhasil dihapus', 'success');
        return redirect()->route('backend.pembayaran.index');
    }

}
