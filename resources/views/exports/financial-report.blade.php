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
                <td>{{ \Carbon\Carbon::parse($t->date)->format('Y-m-d') }}</td>
                <td>{{ $t->category->name ?? '-' }}</td>
                <td>{{ $t->description }}</td>
                <td>{{ ucfirst($t->type) }}</td>
                <td>{{ $t->amount }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
