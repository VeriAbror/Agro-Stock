<!-- filepath: resources/views/livewire/card-stock.blade.php -->
<div class="p-4 space-y-6">
    {{-- Filter --}}
    <div class="flex flex-wrap gap-4 items-end">
        <div class="relative">
            <label for="kode_barang" class="block text-sm font-medium text-gray-700">Kode Barang</label>
            <input list="kodeBarangList" id="kode_barang" wire:model="kode_barang"
                class="border border-gray-300 rounded px-3 py-2 w-40 focus:outline-none focus:ring-2 focus:ring-[#52C4D5]"
                placeholder="Kode Barang" autocomplete="off">
            <datalist id="kodeBarangList">
                @foreach ($kodeBarangMutasi as $kode)
                    <option value="{{ $kode }}">{{ $kode }}</option>
                @endforeach
            </datalist>
        </div>
        <div>
            <label for="nama_barang" class="block text-sm font-medium text-gray-700">Nama Barang</label>
            <input type="text" id="nama_barang" wire:model="nama_barang"
                class="border border-gray-300 rounded px-3 py-2 w-48 bg-gray-100 focus:outline-none"
                placeholder="Nama Barang" readonly>
        </div>
        <div>
            <label for="periode_awal" class="block text-sm font-medium text-gray-700">Periode Awal</label>
            <input type="date" id="periode_awal" wire:model="periode_awal"
                class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#52C4D5]">
        </div>
        <div>
            <label for="periode_akhir" class="block text-sm font-medium text-gray-700">Periode Akhir</label>
            <input type="date" id="periode_akhir" wire:model="periode_akhir"
                class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#52C4D5]">
        </div>
        <div>
            <button wire:click="generateCardStock"
                class="bg-green-500 hover:bg-green-600 text-white font-semibold px-4 py-2 rounded shadow">
                Generate Card Stock
            </button>
        </div>
    </div>

    {{-- Message --}}
    @if (session()->has('message'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded shadow">
            {{ session('message') }}
        </div>
    @endif

    {{-- Tabel Rekap Header --}}
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border rounded shadow mt-4">
            <thead>
                <tr class="bg-[#52C4D5] text-sm font-semibold text-white uppercase">
                    <th class="px-4 py-2">No</th>
                    <th class="px-4 py-2">Kode</th>
                    <th class="px-4 py-2">Nama</th>
                    <th class="px-4 py-2">Satuan</th>
                    <th class="px-4 py-2">Awal</th>
                    <th class="px-4 py-2">IN</th>
                    <th class="px-4 py-2">OUT</th>
                    <th class="px-4 py-2">RETURN</th>
                    <th class="px-4 py-2">Pemakaian</th>
                    <th class="px-4 py-2">Akhir</th>
                    <th class="px-4 py-2">Periode</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @php $no = 1; @endphp
                @forelse ($card_stocks as $item)
                    <tr class="border-t hover:bg-cyan-50 transition">
                        <td class="px-4 py-2 text-center">{{ $no++ }}</td>
                        <td class="px-4 py-2">{{ $item->kode_barang }}</td>
                        <td class="px-4 py-2">{{ $item->nama_barang }}</td>
                        <td class="px-4 py-2">{{ $item->satuan }}</td>
                        <td class="px-4 py-2 text-right">{{ number_format($item->qty_periode_awal, 2) }}</td>
                        <td class="px-4 py-2 text-right">{{ number_format($item->total_barang_in, 2) }}</td>
                        <td class="px-4 py-2 text-right">{{ number_format($item->total_barang_out, 2) }}</td>
                        <td class="px-4 py-2 text-right">{{ number_format($item->total_barang_return, 2) }}</td>
                        <td class="px-4 py-2 text-right">{{ number_format($item->total_pemakaian, 2) }}</td>
                        <td class="px-4 py-2 text-right">{{ number_format($item->qty_periode_akhir, 2) }}</td>
                        <td class="px-4 py-2 text-center">
                            {{ $item->periode_awal }} s/d {{ $item->periode_akhir }}
                        </td>
                        <td class="px-4 py-2 flex flex-col gap-1 items-start md:flex-row md:items-center">
                            <button wire:click="lihatDetail('{{ $item->kode_barang }}')"
                                class="text-blue-600 hover:underline flex items-center gap-1">
                                <i class="fas fa-eye"></i>
                                Lihat Detail
                            </button>
                            <a href="{{ route('card-stock.export', [
                                'kode_barang' => $item->kode_barang,
                                'periode_awal' => $item->periode_awal,
                                'periode_akhir' => $item->periode_akhir
                            ]) }}"
                                class="text-green-600 hover:underline flex items-center gap-1"
                                target="_blank"
                            >
                                <i class="fas fa-file-excel"></i>
                                Export
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="12" class="px-4 py-4 text-center text-gray-500">
                            Tidak ada data ditemukan
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Modal Detail Transaksi --}}
    @if ($showModal && $selectedKodeBarang && is_countable($detail_stock) && count($detail_stock) > 0)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40">
            <div class="bg-white rounded-lg w-full max-w-3xl shadow-lg relative">
                <button wire:click="closeModal"
                    class="absolute top-2 right-3 text-gray-600 hover:text-red-500 text-2xl">&times;</button>
                <div class="p-6">
                    <h2 class="text-xl font-bold mb-4">Detail Transaksi Barang: {{ $selectedKodeBarang }}</h2>
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border rounded shadow">
                            <thead class="bg-[#52C4D5]">
                                <tr class="text-sm font-semibold text-white uppercase">
                                    <th class="px-3 py-2">Tanggal</th>
                                    <th class="px-3 py-2 text-right">Qty</th>
                                    <th class="px-3 py-2">Jenis</th>
                                    <th class="px-3 py-2">No Surat</th>
                                    <th class="px-3 py-2">Jenis Surat</th>
                                    <th class="px-3 py-2">Supplier</th>
                                    <th class="px-3 py-2">Keterangan</th>
                                    <th class="px-3 py-2 text-right">Qty Akhir</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm">
                                @foreach ($detail_stock as $detail)
                                    <tr class="border-t hover:bg-gray-50">
                                        <td class="px-3 py-2">
                                            {{ \Carbon\Carbon::parse($detail['tanggal'])->format('d-m-Y') }}
                                        </td>
                                        <td class="px-3 py-2 text-right">
                                            {{ number_format($detail['jumlah_qty'], 2) }}
                                        </td>
                                        <td class="px-3 py-2">{{ $detail['tipe_transaksi'] }}</td>
                                        <td class="px-3 py-2">{{ $detail['no_surat'] }}</td>
                                        <td class="px-3 py-2">{{ $detail['jenis_surat'] }}</td>
                                        <td class="px-3 py-2">{{ $detail['supplier'] }}</td>
                                        <td class="px-3 py-2">{{ $detail['keterangan'] }}</td>
                                        <td class="px-3 py-2 text-right">
                                            {{ number_format($detail['qty_akhir'], 2) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4 flex justify-end">
                        <button wire:click="closeModal" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>