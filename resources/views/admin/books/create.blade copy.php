<x-app-layout>
  <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Koleksi Perpustakaan > Tambah Buku Baru') }}
            </h2>
            <a href="{{ route('admin.books.index') }}" class="text-gray-500 hover:text-gray-700 text-sm font-medium">
                &larr; Kembali ke Daftar
            </a>
        </div>
    </x-slot>

    <div>
        <div>


        </div>
    </div>
</x-app-layout>