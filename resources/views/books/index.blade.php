<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Buku Perpustakaan') }}
            </h2>
            <a href="{{ route('books.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                + Tambah Buku
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Form Filter & Pencarian (Bonus) -->
            <div class="bg-white p-6 rounded-lg shadow mb-6">
                <form method="GET" action="{{ route('books.index') }}" class="flex flex-col md:flex-row gap-4">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul atau penulis..." class="border-gray-300 rounded-md shadow-sm w-full md:w-1/2">
                    
                    <select name="category_id" class="border-gray-300 rounded-md shadow-sm w-full md:w-1/3">
                        <option value="">-- Semua Kategori --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>

                    <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700">
                        Cari & Filter
                    </button>
                    @if(request('search') || request('category_id'))
                        <a href="{{ route('books.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500 text-center">
                            Reset
                        </a>
                    @endif
                </form>
            </div>

            <!-- Tabel Daftar Buku -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Judul</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Penulis</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tahun</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Stok</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($books as $book)
                            <tr>
                                <td class="px-6 py-4 font-semibold text-gray-900">{{ $book->title }}</td>
                                <td class="px-6 py-4"><span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">{{ $book->category->name }}</span></td>
                                <td class="px-6 py-4 text-gray-600">{{ $book->author }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $book->year }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $book->stock }}</td>
                                <td class="px-6 py-4 text-center space-x-2">
                                    <a href="{{ route('books.show', $book->id) }}" class="text-green-600 hover:text-green-900 font-bold">Detail</a>
                                    <a href="{{ route('books.edit', $book->id) }}" class="text-indigo-600 hover:text-indigo-900 font-bold">Edit</a>
                                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 font-bold">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">Belum ada data buku.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>