<!-- filepath: resources/views/livewire/mutasi-stock.blade.php -->
<div class="p-4 bg-white rounded-lg shadow-md">

    <!-- Notifikasi -->
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('message') }}
        </div>
    @endif

    @if (auth()->user()->role === 'admin')
        <!-- FORM HANYA UNTUK ADMIN -->
        <form wire:submit.prevent="{{ $editMode ? 'update' : 'store' }}" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700">Kode Barang</label>
                <input list="kodeBarangList" class="border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-[#52C4D5] focus:outline-none w-full" wire:model="kode_barang">
                <datalist id="kodeBarangList">
                    @foreach ($masterStocks as $item)
                        <option value="{{ $item->kode_barang }}">{{ $item->kode_barang }} - {{ $item->nama_barang }}</option>
                    @endforeach
                </datalist>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Barang</label>
                <input list="namaBarangList" class="border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-[#52C4D5] focus:outline-none w-full" wire:model="nama_barang">
                <datalist id="namaBarangList">
                    @foreach ($masterStocks as $item)
                        <option value="{{ $item->nama_barang }}">{{ $item->kode_barang }} - {{ $item->nama_barang }}</option>
                    @endforeach
                </datalist>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Tanggal</label>
                <input type="date" class="border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-[#52C4D5] focus:outline-none w-full" wire:model="tanggal">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">F</label>
                <input list="fList" class="border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-[#52C4D5] focus:outline-none w-full" wire:model="f">
                <datalist id="fList">
                    @foreach ($masterStocks as $item)
                        <option value="{{ $item->f }}">{{ $item->kode_barang }} - {{ $item->nama_barang }}</option>
                    @endforeach
                </datalist>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Satuan</label>
                <input list="satuanList" class="border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-[#52C4D5] focus:outline-none w-full" wire:model="satuan">
                <datalist id="satuanList">
                    @foreach ($masterStocks as $item)
                        <option value="{{ $item->satuan }}">{{ $item->kode_barang }} - {{ $item->nama_barang }}</option>
                    @endforeach
                </datalist>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Qty</label>
                <input type="number" class="border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-[#52C4D5] focus:outline-none w-full" wire:model="jumlah_qty">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Tipe</label>
                <select wire:model="tipe_transaksi" class="border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-[#52C4D5] focus:outline-none w-full">
                    <option value="">-- Tipe --</option>
                    <option value="IN">IN</option>
                    <option value="OUT">OUT</option>
                    <option value="RETURN">RETURN</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">No Surat</label>
                <input type="text" class="border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-[#52C4D5] focus:outline-none w-full" wire:model="no_surat">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Jenis Surat</label>
                <input type="text" class="border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-[#52C4D5] focus:outline-none w-full" wire:model="jenis_surat">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Status Surat</label>
                <select wire:model="status_surat" class="border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-[#52C4D5] focus:outline-none w-full">
                    <option value="">-- Status --</option>
                    <option value="PENDING">PENDING</option>
                    <option value="DISETUJUI">DISETUJUI</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Supplier</label>
                <input type="text" class="border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-[#52C4D5] focus:outline-none w-full" wire:model="supplier">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Keterangan</label>
                <input type="text" class="border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-[#52C4D5] focus:outline-none w-full" wire:model="keterangan">
            </div>
            <div class="flex items-end">
                <button class="bg-{{ $editMode ? 'yellow-500' : 'blue-500' }} text-white px-4 py-2 rounded-md hover:bg-{{ $editMode ? 'yellow-600' : 'blue-600' }}">
                    {{ $editMode ? 'Update' : 'Tambah' }}
                </button>
            </div>
        </form>
    @endif

    <hr class="my-4">

    <!-- Fitur Search -->
    <div class="mb-4 flex flex-col md:flex-row md:items-center md:justify-between gap-2">
        <input type="text" class="w-full md:w-1/2 border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-[#52C4D5] focus:outline-none" placeholder="Cari kode atau nama barang..." wire:model.debounce.5ms="search" wire:keyup="$refresh">
        @if (auth()->user()->role === 'admin')
            <a href="{{ route('mutasi-stock.export') }}" class="inline-block bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded shadow transition md:ml-2">
                <i class="fas fa-file-excel mr-2"></i>Export Excel
            </a>
        @endif
    </div>

    <!-- TABEL UNTUK SEMUA ROLE -->
    <div wire:poll.5s.keep-alive class="overflow-x-auto">
        <table class="min-w-full border border-gray-200 rounded-lg shadow">
            <thead>
                <tr class="bg-[#52C4D5] text-white text-sm uppercase">
                    <th class="px-4 py-2 border border-gray-200">Tanggal</th>
                    <th class="px-4 py-2 border border-gray-200">Kode</th>
                    <th class="px-4 py-2 border border-gray-200">Nama</th>
                    <th class="px-4 py-2 border border-gray-200">Satuan</th>
                    <th class="px-4 py-2 border border-gray-200">Qty</th>
                    <th class="px-4 py-2 border border-gray-200">Tipe</th>
                    <th class="px-4 py-2 border border-gray-200">No Surat</th>
                    <th class="px-4 py-2 border border-gray-200">Jenis</th>
                    <th class="px-4 py-2 border border-gray-200">Status</th>
                    <th class="px-4 py-2 border border-gray-200">Supplier</th>
                    <th class="px-4 py-2 border border-gray-200">Keterangan</th>
                    @if (auth()->user()->role === 'admin')
                        <th class="px-4 py-2 border border-gray-200">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody class="bg-white text-gray-700">
                @foreach ($mutasiStocks as $m)
                    <tr class="hover:bg-cyan-50 transition">
                        <td class="border border-gray-200 px-4 py-2">{{ $m->tanggal }}</td>
                        <td class="border border-gray-200 px-4 py-2">{{ $m->kode_barang }}</td>
                        <td class="border border-gray-200 px-4 py-2">{{ $m->nama_barang }}</td>
                        <td class="border border-gray-200 px-4 py-2">{{ $m->satuan }}</td>
                        <td class="border border-gray-200 px-4 py-2 text-right">{{ $m->jumlah_qty }}</td>
                        <td class="border border-gray-200 px-4 py-2">{{ $m->tipe_transaksi }}</td>
                        <td class="border border-gray-200 px-4 py-2">{{ $m->no_surat }}</td>
                        <td class="border border-gray-200 px-4 py-2">{{ $m->jenis_surat }}</td>
                        <td class="border border-gray-200 px-4 py-2">{{ $m->status_surat }}</td>
                        <td class="border border-gray-200 px-4 py-2">{{ $m->supplier }}</td>
                        <td class="border border-gray-200 px-4 py-2">{{ $m->keterangan }}</td>
                        @if (auth()->user()->role === 'admin')
                            <td class="border border-gray-200 px-4 py-2">
                                <div class="flex justify-center space-x-2">
                                    <button wire:click="edit({{ $m->id }})" class="bg-yellow-500 text-white px-2 py-1 rounded-md hover:bg-yellow-600">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button wire:click="delete({{ $m->id }})" class="bg-red-500 text-white px-2 py-1 rounded-md hover:bg-red-600">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $mutasiStocks->links('pagination::tailwind') }}
    </div>
</div>