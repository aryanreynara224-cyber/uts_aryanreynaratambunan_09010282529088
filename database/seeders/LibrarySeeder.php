<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Book;

class LibrarySeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat 3 Kategori
        $pemrograman = Category::create([
            'name' => 'Pemrograman',
            'description' => 'Buku-buku tentang pemrograman dan pengkodean web/software.'
        ]);

        $basisData = Category::create([
            'name' => 'Basis Data',
            'description' => 'Buku-buku seputar pengelolaan dan perancangan database.'
        ]);

        $jaringan = Category::create([
            'name' => 'Jaringan Komputer',
            'description' => 'Buku-buku infrastruktur jaringan dan keamanan komputer.'
        ]);

        // 2. Buat 5 Buku
        Book::create([
            'category_id' => $pemrograman->id,
            'title' => 'Pemrograman Web dengan Laravel',
            'author' => 'Budi Santoso',
            'publisher' => 'Informatika',
            'year' => 2023,
            'stock' => 10
        ]);

        Book::create([
            'category_id' => $pemrograman->id,
            'title' => 'Belajar JavaScript Modern',
            'author' => 'Eko Kurniawan',
            'publisher' => 'Andi Publisher',
            'year' => 2022,
            'stock' => 7
        ]);

        Book::create([
            'category_id' => $basisData->id,
            'title' => 'Mastering MySQL & Database Design',
            'author' => 'Rian Hidayat',
            'publisher' => 'Elex Media',
            'year' => 2021,
            'stock' => 5
        ]);

        Book::create([
            'category_id' => $basisData->id,
            'title' => 'Panduan Lengkap PostgreSQL',
            'author' => 'Siti Aminah',
            'publisher' => 'Informatika',
            'year' => 2024,
            'stock' => 12
        ]);

        Book::create([
            'category_id' => $jaringan->id,
            'title' => 'Konfigurasi Jaringan Cisco & Mikrotik',
            'author' => 'Ahmad Pratama',
            'publisher' => 'Lokomedia',
            'year' => 2020,
            'stock' => 4
        ]);
    }
}