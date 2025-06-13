<!-- filepath: resources/views/livewire/master-stock.blade.php -->
<div class="p-4 bg-white rounded-lg shadow-md">

    <!-- Notifikasi -->
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('message') }}
        </div>
    @endif

    <!-- Form hanya untuk admin -->
    @if (auth()->user()->role === 'admin')
        <form wire:submit.prevent="{{ $editMode ? 'update' : 'store' }}" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <input type="text" class="border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Kode Barang" wire:model="kode_barang">
            <input type="text" class="border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Nama Barang" wire:model="nama_barang">
            <input type="text" class="border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="F" wire:model="f">
            <input type="text" class="border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Satuan" wire:model="satuan">
            <input type="number" step="0.01" class="border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Qty Awal" wire:model="qty_awal">
            <input type="number" step="0.01" class="border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Qty Akhir" wire:model="qty_akhir">
            <input type="number" step="0.01" class="border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Harga per Satuan" wire:model="satuan_harga">
            <button type="submit" class="bg-{{ $editMode ? 'yellow-500' : 'blue-500' }} text-white px-4 py-2 rounded-md hover:bg-{{ $editMode ? 'yellow-600' : 'blue-600' }}">
                {{ $editMode ? 'Update' : 'Tambah' }}
            </button>
        </form>
        <hr class="my-4">
    @endif

    <!-- Fitur Search, Export & Import -->
    <div class="mb-4 flex flex-col md:flex-row md:items-center md:justify-between gap-2">
        <input type="text" class="w-full md:w-1/2 border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-[#52C4D5] focus:outline-none" placeholder="Cari kode atau nama barang..." wire:model.debounce.5ms="search" wire:keyup="$refresh">
        <div class="flex gap-2 mt-2 md:mt-0">
            @if (in_array(auth()->user()->role, ['admin', 'petugas_gudang']))
                <a href="{{ route('master-stock.export') }}" class="inline-block bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded shadow transition">
                    <i class="fas fa-file-excel mr-2"></i>Export Excel
                </a>
            @endif
            @if (auth()->user()->role === 'admin')
                <form wire:submit.prevent="importExcel" class="flex items-center gap-2" style="display:inline;">
                    <input type="file" wire:model="file" accept=".xlsx,.xls" class="border border-gray-300 rounded-md px-2 py-1" style="width: 240px;">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                        <i class="fas fa-file-import mr-2"></i>Import
                    </button>
                </form>
            @endif
        </div>
    </div>
    @if ($errors->has('file'))
        <div class="text-red-500 text-sm mb-2">{{ $errors->first('file') }}</div>
    @endif

    <!-- Tabel Data -->
    <div wire:poll.5s.keep-alive class="overflow-x-auto">
        <table class="min-w-full border border-gray-200 rounded-lg shadow">
            <thead>
                <tr class="bg-[#52C4D5] text-white text-sm uppercase">
                    <th class="px-4 py-2 border border-gray-200">Kode</th>
                    <th class="px-4 py-2 border border-gray-200">Nama</th>
                    <th class="px-4 py-2 border border-gray-200">F</th>
                    <th class="px-4 py-2 border border-gray-200">Satuan</th>
                    <th class="px-4 py-2 border border-gray-200">Qty Awal</th>
                    <th class="px-4 py-2 border border-gray-200">Qty Akhir</th>
                    <th class="px-4 py-2 border border-gray-200">Harga</th>
                    <th class="px-4 py-2 border border-gray-200">Total</th>
                    @if (auth()->user()->role === 'admin')
                        <th class="px-4 py-2 border border-gray-200">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody class="bg-white text-gray-700">
                @forelse ($data as $item)
                    <tr class="hover:bg-cyan-50 transition">
                        <td class="px-4 py-2 border border-gray-200">{{ $item->kode_barang }}</td>
                        <td class="px-4 py-2 border border-gray-200">{{ $item->nama_barang }}</td>
                        <td class="px-4 py-2 border border-gray-200">{{ $item->f }}</td>
                        <td class="px-4 py-2 border border-gray-200">{{ $item->satuan }}</td>
                        <td class="px-4 py-2 border border-gray-200 text-right">{{ $item->qty_awal }}</td>
                        <td class="px-4 py-2 border border-gray-200 text-right">{{ $item->qty_akhir }}</td>
                        <td class="px-4 py-2 border border-gray-200 text-right">{{ number_format($item->satuan_harga, 2) }}</td>
                        <td class="px-4 py-2 border border-gray-200 text-right">{{ number_format($item->total, 2) }}</td>
                        @if (auth()->user()->role === 'admin')
                            <td class="px-4 py-2 border border-gray-200">
                                <div class="flex justify-center space-x-2">
                                    <button wire:click="edit('{{ $item->kode_barang }}')" class="bg-yellow-400 hover:bg-yellow-500 text-white px-2 py-1 rounded-md transition" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button wire:click="delete('{{ $item->kode_barang }}')" class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded-md transition" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center border border-gray-200 px-4 py-2 text-gray-400">Data tidak ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $data->links('pagination::tailwind') }}
    </div>
</div>