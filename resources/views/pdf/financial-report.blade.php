<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; color: #222; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; font-size: 12px; }
        th { background: #f4f4f4; }
        .summary { margin-top: 10px; }
    </style>
</head>
<body>
    <h2>Laporan Keuangan</h2>
    <p>Periode: {{ $start_date }} s/d {{ $end_date }}</p>

    <div class="summary">
        <strong>Total Pemasukan:</strong> Rp {{ number_format($total_income, 0, ',', '.') }}<br>
        <strong>Total Pengeluaran:</strong> Rp {{ number_format($total_expense, 0, ',', '.') }}<br>
        <strong>Total Transaksi:</strong> {{ $total_transactions }}
    </div>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Kategori</th>
                <th>Deskripsi</th>
                <th>Tipe</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $t)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($t->date)->format('d M Y') }}</td>
                    <td>{{ $t->category->name ?? '-' }}</td>
                    <td>{{ $t->description }}</td>
                    <td>{{ ucfirst($t->type) }}</td>
                    <td style="text-align:right;">Rp {{ number_format($t->amount, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
