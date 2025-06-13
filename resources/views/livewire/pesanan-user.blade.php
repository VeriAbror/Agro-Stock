<!-- filepath: resources/views/livewire/pesanan-user.blade.php -->
<div class="p-4 bg-white rounded-lg shadow-md">

    <!-- Notifikasi -->
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('message') }}
        </div>
    @endif

    <!-- Form hanya untuk admin/user -->
    @if (in_array(auth()->user()->role, ['admin', 'user']))
        <form wire:submit.prevent="{{ $editMode ? 'update' : 'store' }}" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <input type="date" class="border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-[#52C4D5] focus:outline-none" placeholder="Tanggal" wire:model="tanggal">
            <div>
                <input
                    list="kode-barang-list"
                    class="border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-[#52C4D5] focus:outline-none w-full"
                    placeholder="Ketik kode atau nama barang"
                    wire:model="kode_barang"
                    autocomplete="off"
                />
                <datalist id="kode-barang-list">
                    @foreach($barang_list as $barang)
                        <option value="{{ $barang->kode_barang }}">{{ $barang->kode_barang }} - {{ $barang->nama_barang }}</option>
                    @endforeach
                </datalist>
            </div>
            <input type="number" min="1" class="border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-[#52C4D5] focus:outline-none" placeholder="Jumlah" wire:model="jumlah_qty">
            <div>
                <label class="block font-semibold mb-1">Satuan</label>
                <input type="text"
                    class="form-input w-full bg-gray-100"
                    wire:model="satuan"
                    readonly>
            </div>
            <select class="border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-[#52C4D5] focus:outline-none" wire:model="tipe_transaksi">
                <option value="">-- Pilih Tipe --</option>
                <option value="IN">IN (Masuk)</option>
                <option value="OUT">OUT (Keluar)</option>
            </select>
            <input type="text" class="border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-[#52C4D5] focus:outline-none" placeholder="Nomor Surat" wire:model="no_surat">
            <input type="text" class="border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-[#52C4D5] focus:outline-none" placeholder="Jenis Surat" wire:model="jenis_surat">
            @if(auth()->user()->role === 'admin')
                <select class="border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-[#52C4D5] focus:outline-none" wire:model="status_surat">
                    <option value="">-- Pilih Status --</option>
                    <option value="PENDING">PENDING</option>
                    <option value="APPROVED">APPROVED</option>
                    <option value="REJECTED">REJECTED</option>
                </select>
            @endif
            <input type="text" class="border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-[#52C4D5] focus:outline-none" placeholder="Supplier" wire:model="supplier">
            <input type="text" class="border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-[#52C4D5] focus:outline-none md:col-span-2" placeholder="Keterangan" wire:model="keterangan">
            <button type="submit" class="bg-{{ $editMode ? 'yellow-500' : 'blue-500' }} text-white px-4 py-2 rounded-md hover:bg-{{ $editMode ? 'yellow-600' : 'blue-600' }} col-span-1">
                {{ $editMode ? 'Update' : 'Tambah' }}
            </button>
        </form>
        <hr class="my-4">
    @endif

    <!-- Fitur Search dan Export -->
    <div class="mb-4 flex flex-col md:flex-row md:items-center md:justify-between gap-2">
        <input type="text" class="w-full md:w-1/2 border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-[#52C4D5] focus:outline-none" placeholder="Cari kode, nama, atau nomor surat..." wire:model.debounce.5ms="search" wire:keyup="$refresh">
        @if (in_array(auth()->user()->role, ['admin', 'petugas_gudang']))
            <a href="{{ route('pesanan-user.export') }}" class="inline-block bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded shadow transition md:ml-2">
                <i class="fas fa-file-excel mr-2"></i>Export Excel
            </a>
        @endif
    </div>

    <!-- Tabel Data -->
    <div wire:poll.5s.keep-alive class="overflow-x-auto">
        <table class="min-w-full border border-gray-200 rounded-lg shadow text-sm">
            <thead>
                <tr class="bg-[#52C4D5] text-white uppercase">
                    <th class="border border-gray-200 px-3 py-2">Tanggal</th>
                    <th class="border border-gray-200 px-3 py-2">Kode</th>
                    <th class="border border-gray-200 px-3 py-2">Nama</th>
                    <th class="border border-gray-200 px-3 py-2 text-right">Jumlah</th>
                    <th class="border border-gray-200 px-3 py-2">Tipe</th>
                    <th class="border border-gray-200 px-3 py-2">Satuan</th>
                    <th class="border border-gray-200 px-3 py-2">Nomor Surat</th>
                    <th class="border border-gray-200 px-3 py-2">Jenis Surat</th>
                    <th class="border border-gray-200 px-3 py-2">Status</th>
                    <th class="border border-gray-200 px-3 py-2">Supplier</th>
                    <th class="border border-gray-200 px-3 py-2">Keterangan</th>
                    <th class="border border-gray-200 px-3 py-2">User</th>
                    @if (in_array(auth()->user()->role, ['admin', 'user']))
                        <th class="border border-gray-200 px-3 py-2">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse ($pesanan_user as $pesanan)
                    <tr class="hover:bg-cyan-50 transition">
                        <td class="border border-gray-200 px-3 py-2">{{ $pesanan->tanggal }}</td>
                        <td class="border border-gray-200 px-3 py-2">{{ $pesanan->kode_barang }}</td>
                        <td class="border border-gray-200 px-3 py-2">{{ $pesanan->nama_barang }}</td>
                        <td class="border border-gray-200 px-3 py-2 text-right">{{ $pesanan->jumlah_qty }}</td>
                        <td class="border border-gray-200 px-3 py-2">{{ $pesanan->tipe_transaksi }}</td>
                        <td class="border border-gray-200 px-3 py-2">{{ $pesanan->satuan }}</td>
                        <td class="border border-gray-200 px-3 py-2">{{ $pesanan->no_surat }}</td>
                        <td class="border border-gray-200 px-3 py-2">{{ $pesanan->jenis_surat }}</td>
                        <td class="border border-gray-200 px-3 py-2">{{ $pesanan->status_surat }}</td>
                        <td class="border border-gray-200 px-3 py-2">{{ $pesanan->supplier }}</td>
                        <td class="border border-gray-200 px-3 py-2">{{ $pesanan->keterangan }}</td>
                        <td class="border border-gray-200 px-3 py-2">{{ $pesanan->user ? $pesanan->user->name : '-' }}</td>
                        @if (in_array(auth()->user()->role, ['admin', 'user']))
                            <td class="border border-gray-200 px-4 py-2">
                                <div class="flex justify-center space-x-2">
                                    <button wire:click="edit({{ $pesanan->id }})" class="bg-yellow-500 text-white px-2 py-1 rounded-md hover:bg-yellow-600">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button  wire:click="delete({{ $pesanan->id }})" class="bg-red-500 text-white px-2 py-1 rounded-md hover:bg-red-600">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="13" class="text-center border border-gray-200 px-3 py-2 text-gray-400">Data tidak ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $pesanan_user->links('pagination::tailwind') }}
    </div>
</div>