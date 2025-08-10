<form method="GET" action="{{ route('kategori-items.index') }}">
    <input type="text" name="kode" value="{{ request('kode') }}" placeholder="Filter Kode">
    <input type="text" name="nama" value="{{ request('nama') }}" placeholder="Filter Nama">
    <button type="submit">Filter</button>
</form>

<table>
    <thead>
        <tr>
            <th>Kode</th>
            <th>Nama</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($kategori as $kat)
        <tr>
            <td>{{ $kat->kode }}</td>
            <td>{{ $kat->nama }}</td>
            <td>
                <a href="{{ route('kategori-items.show', $kat->id) }}">View</a> |
                <a href="{{ route('kategori-items.edit', $kat->id) }}">Edit</a> |
                <form action="{{ route('kategori-items.destroy', $kat->id) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Yakin hapus?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $kategori->links() }}
