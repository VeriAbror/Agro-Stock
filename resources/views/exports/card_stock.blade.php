<!-- filepath: resources/views/exports/card_stock.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Export Card Stock</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f8fafc; color: #222; }
        h2 { color: #219ebc; }
        h4 { color: #219ebc; margin-top: 24px; }
        table { border-collapse: collapse; width: 100%; font-size: 12px; margin-bottom: 24px; background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px #0001; }
        th, td { border: 1px solid #b6e0ea; padding: 6px 8px; text-align: left; }
        th { background-color: #52C4D5; color: #fff; font-weight: 600; }
        tr:nth-child(even) { background-color: #e0f7fa; }
        tr:hover { background-color: #b2ebf2; }
        .periode { color: #555; font-size: 13px; margin-bottom: 16px; }
    </style>
</head>
<body>
    <h2>Rekap Card Stock</h2>
    <p class="periode">Periode: <b>{{ $periode_awal }} s/d {{ $periode_akhir }}</b></p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Satuan</th>
                <th>Qty Awal</th>
                <th>Total IN</th>
                <th>Total OUT</th>
                <th>Total RETURN</th>
                <th>Total Pemakaian</th>
                <th>Qty Akhir</th>
                <th>Periode</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach($card_stocks as $card)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $card->kode_barang }}</td>
                    <td>{{ $card->nama_barang }}</td>
                    <td>{{ $card->satuan }}</td>
                    <td>{{ number_format($card->qty_periode_awal, 2) }}</td>
                    <td>{{ number_format($card->total_barang_in, 2) }}</td>
                    <td>{{ number_format($card->total_barang_out, 2) }}</td>
                    <td>{{ number_format($card->total_barang_return, 2) }}</td>
                    <td>{{ number_format($card->total_pemakaian, 2) }}</td>
                    <td>{{ number_format($card->qty_periode_akhir, 2) }}</td>
                    <td>{{ $card->periode_awal }} s/d {{ $card->periode_akhir }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @foreach($card_stocks as $card)
        @if($card->details->isNotEmpty())
            <h4>Detail Transaksi: {{ $card->kode_barang }}</h4>
            <table>
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Qty</th>
                        <th>Jenis</th>
                        <th>No Surat</th>
                        <th>Jenis Surat</th>
                        <th>Supplier</th>
                        <th>Keterangan</th>
                        <th>Qty Akhir</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($card->details as $detail)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($detail->tanggal)->format('d-m-Y') }}</td>
                            <td>{{ number_format($detail->jumlah_qty, 2) }}</td>
                            <td>{{ $detail->tipe_transaksi }}</td>
                            <td>{{ $detail->no_surat }}</td>
                            <td>{{ $detail->jenis_surat }}</td>
                            <td>{{ $detail->supplier }}</td>
                            <td>{{ $detail->keterangan }}</td>
                            <td>{{ number_format($detail->qty_akhir, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    @endforeach
</body>
</html>