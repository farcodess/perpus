<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin Perpustakaan',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        User::Create([
            'name' => 'Leon Hanburd',
            'email' => 'leon@gmail.com',
            'password' => Hash::make('leon123'),
            'role' => 'user',
        ]);
     User::Create([
            'name' => 'Natan',
            'email' => 'natan@gmail.com',
            'password' => Hash::make('natan123'),
            'role' => 'user',
        ]);

        $buku1 = Book::create([
            'isbn' => '9786020331607',
            'title' => 'Laskar Pelangi',
            'author' => 'Andrea Hirata',
            'publisher' => 'Bentang Pustaka',
            'year_published' => 2005,
            'stock' => 5,
        ]);

        $buku2 = Book::create([
            'isbn' => '9786020633176',
            'title' => 'Selamat Tinggal',
            'author' => 'Tere Liye',
            'publisher' => 'Gramedia',
            'year_published' => 2020,
            'stock' => 0, 
        ]);

        Borrowing::create([
            'user_id' => '2',
            'book_id' => $buku1->id,
            'borrow_date' => now()->subDays(10),
            'due_date' => now()->subDays(3),
            'status' => 'borrowed',
            'fine_amount' => 0,
        ]);
    }
}
