<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    {{-- Stok Menipis --}}
    @foreach($stokMenipis as $item)
        <div class="bg-red-50 rounded-xl shadow p-5 flex flex-col items-center hover:-translate-y-1 hover:shadow-lg transition">
            <img src="https://cdn-icons-png.flaticon.com/512/564/564619.png" alt="stok-menipis" class="w-12 h-12 mb-2">
            <div class="font-semibold">{{ $item->nama_barang }}</div>
            <p class="text-red-700 text-sm mt-1 text-center">Stok menipis ({{ $item->qty_akhir }})</p>
        </div>
    @endforeach
    {{-- Stok Terbanyak --}}
    @foreach($stokTerbanyak as $item)
        <div class="bg-green-50 rounded-xl shadow p-5 flex flex-col items-center hover:-translate-y-1 hover:shadow-lg transition">
            {{-- Icon: Award/Trophy --}}
            <img src="https://cdn-icons-png.flaticon.com/512/1828/1828884.png" alt="stok-terbanyak" class="w-12 h-12 mb-2">
            <div class="font-semibold">{{ $item->nama_barang }}</div>
            <p class="text-green-700 text-sm mt-1 text-center">Stok terbanyak ({{ $item->qty_akhir }})</p>
        </div>
    @endforeach

    {{-- Baru Ditambahkan --}}
    @foreach($baruDitambahkan as $item)
        <div class="bg-blue-50 rounded-xl shadow p-5 flex flex-col items-center hover:-translate-y-1 hover:shadow-lg transition">
            {{-- Icon: New/Plus/Star --}}
            <img src="https://cdn-icons-png.flaticon.com/512/992/992651.png" alt="baru-ditambahkan" class="w-12 h-12 mb-2">
            <div class="font-semibold">{{ $item->nama_barang }}</div>
            <p class="text-blue-700 text-sm mt-1 text-center">Baru ditambahkan ({{ $item->created_at->format('d M Y') }})</p>
        </div>
    @endforeach

    {{-- Banyak Digunakan --}}
    @foreach($banyakDigunakan as $item)
        <div class="bg-yellow-50 rounded-xl shadow p-5 flex flex-col items-center hover:-translate-y-1 hover:shadow-lg transition">
            <img src="https://cdn-icons-png.flaticon.com/512/3514/3514491.png" alt="banyak-digunakan" class="w-12 h-12 mb-2">
            <div class="font-semibold">
                {{ $item->barang?->nama_barang ?? $item->kode_barang }}
            </div>
            <p class="text-yellow-700 text-sm mt-1 text-center">
                Banyak digunakan ({{ $item->total_keluar }} keluar, 30 hari)
            </p>
        </div>
    @endforeach

    {{-- Fast Moving Mingguan --}}
    @foreach($fastMovingMingguan as $item)
        <div class="bg-yellow-100 rounded-xl shadow p-5 flex flex-col items-center hover:-translate-y-1 hover:shadow-lg transition">
            <img src="https://cdn-icons-png.flaticon.com/512/1055/1055644.png" alt="fast-moving" class="w-12 h-12 mb-2">
            <div class="font-semibold">{{ $item->barang?->nama_barang ?? $item->kode_barang }}</div>
            <p class="text-yellow-700 text-sm mt-1 text-center">
                Fast Moving ({{ $item->total_transaksi }} transaksi keluar, 7 hari)
            </p>
        </div>
    @endforeach

    {{-- Fast Moving Bulanan --}}
    @foreach($fastMovingBulanan as $item)
        <div class="bg-green-100 rounded-xl shadow p-5 flex flex-col items-center hover:-translate-y-1 hover:shadow-lg transition">
            <img src="https://cdn-icons-png.flaticon.com/512/1055/1055644.png" alt="fast-moving" class="w-12 h-12 mb-2">
            <div class="font-semibold">{{ $item->barang?->nama_barang ?? $item->kode_barang }}</div>
            <p class="text-green-700 text-sm mt-1 text-center">
                Fast Moving ({{ $item->total_transaksi }} transaksi keluar, 30 hari)
            </p>
        </div>
    @endforeach

    {{-- Fast Moving Tahunan --}}
    @foreach($fastMovingTahunan as $item)
        <div class="bg-green-200 rounded-xl shadow p-5 flex flex-col items-center hover:-translate-y-1 hover:shadow-lg transition">
            <img src="https://cdn-icons-png.flaticon.com/512/1055/1055644.png" alt="fast-moving" class="w-12 h-12 mb-2">
            <div class="font-semibold">{{ $item->barang?->nama_barang ?? $item->kode_barang }}</div>
            <p class="text-green-700 text-sm mt-1 text-center">
                Fast Moving ({{ $item->total_transaksi }} transaksi keluar, 1 tahun)
            </p>
        </div>
    @endforeach

    {{-- Slow Moving --}}
    @foreach($slowMoving as $item)
        <div class="bg-blue-100 rounded-xl shadow p-5 flex flex-col items-center hover:-translate-y-1 hover:shadow-lg transition">
            <img src="https://cdn-icons-png.flaticon.com/512/942/942748.png" alt="slow-moving" class="w-12 h-12 mb-2">
            <div class="font-semibold">{{ $item->barang?->nama_barang ?? $item->kode_barang }}</div>
            <p class="text-blue-700 text-sm mt-1 text-center">
                Slow Moving ({{ $item->total_transaksi }} transaksi keluar, 120 hari)
            </p>
        </div>
    @endforeach

    {{-- Dead Stock --}}
    @foreach($deadStock as $item)
        <div class="bg-gray-200 rounded-xl shadow p-5 flex flex-col items-center hover:-translate-y-1 hover:shadow-lg transition">
            <img src="https://cdn-icons-png.flaticon.com/512/565/565547.png" alt="dead-stock" class="w-12 h-12 mb-2">
            <div class="font-semibold">{{ $item->nama_barang }}</div>
            <p class="text-gray-700 text-sm mt-1 text-center">
                Dead Stock (tidak pernah keluar, 1 tahun)
            </p>
        </div>
    @endforeach
</div>