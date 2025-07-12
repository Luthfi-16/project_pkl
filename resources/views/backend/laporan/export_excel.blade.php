@if($jenis == 'pengeluaran' || $jenis == 'pemasukkan')
    <table border="1">
        <thead>
            <tr>
                <th>#</th>
                <th>Jenis</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach($transaksi as $data)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $data->jenis }}</td>
                <td>Rp. {{ number_format($data->jumlah, '0','.','.') }}</td>
                <td>{{ $data->keterangan }}</td>
                <td>{{ $data->tanggal->format('d M Y') }}</td>
            </tr>
            @endforeach
            <tr>
                <th>Saldo Kas : </th>
                <td colspan="6" style="text-align: center">Rp. {{ number_format($saldoKas, '0', '.', '.') }}</td>
            </tr>
        </tbody>
    </table>
@elseif($jenis == 'kas')
    <table border="1">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Status</th>
                <th>Minggu Ke</th>
                <th>Bulan</th>
                <th>Jumlah</th>
                <th>Tanggal Bayar</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach($kas as $data)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $data->users->name ?? '-' }}</td>
                <td>{{ $data->status }}</td>
                <td>{{ $data->minggu_ke }}</td>
                <td>{{\Carbon\Carbon::create()->month($data->bulan)->translatedFormat('F')}}</td>
                <td>Rp. {{ number_format($data->jumlah, '0','.','.') }}</td>
                <td>{{ $data->tanggal_bayar->format('d M Y') }}</td>
            </tr>
            @endforeach
            <tr>
                <th>Saldo Kas : </th>
                <td colspan="6" style="text-align: center">Rp. {{ number_format($saldoKas, '0', '.', '.') }}</td>
            </tr>
            <tr>
                <th>Saldo Tunggakan :</th>
                <td colspan="6" style="text-align: center">Rp. {{ number_format($saldoNunggak, '0', '.', '.') }}</td>
            </tr>
        </tbody>
    </table>
@endif
