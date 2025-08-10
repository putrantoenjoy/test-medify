<h2>Kategori: {{ $kategori->nama }} ({{ $kategori->kode }})</h2>

<h3>Daftar Items</h3>
<ul>
    @foreach($kategori->masterItems as $item)
        <li>{{ $item->nama }} (Kode: {{ $item->kode }})</li>
    @endforeach
</ul>

<a href="{{ route('kategori-items.index') }}">Kembali ke daftar</a>
