<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Informasi Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-sm">
                
                <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $book->title }}</h3>
                <p class="text-sm text-gray-500 mb-6">Kategori: <span class="font-semibold text-blue-600">{{ $book->category->name }}</span></p>

                <div class="grid grid-cols-2 gap-4 border-t pt-4">
                    <div>
                        <p class="text-gray-500 text-sm">Penulis</p>
                        <p class="font-semibold text-gray-800">{{ $book->author }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Penerbit</p>
                        <p class="font-semibold text-gray-800">{{ $book->publisher }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Tahun Terbit</p>
                        <p class="font-semibold text-gray-800">{{ $book->year }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Stok Tersedia</p>
                        <p class="font-semibold text-gray-800">{{ $book->stock }} Unit</p>
                    </div>
                </div>

                <div class="mt-6 border-t pt-4">
                    <p class="text-gray-500 text-sm">Deskripsi Kategori</p>
                    <p class="text-gray-700 italic">{{ $book->category->description ?? 'Tidak ada deskripsi.' }}</p>
                </div>

                <div class="mt-8 flex justify-end">
                    <a href="{{ route('books.index') }}" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700">
                        &larr; Kembali ke Daftar Buku
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>