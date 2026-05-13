<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-blue-500">
                    <p class="text-sm text-gray-500 uppercase font-bold">Total Koleksi Buku</p>
                    <p class="text-3xl font-semibold">{{ $totalBook }}</p>
                    <a href="{{ route('admin.books.index') }}" class="text-blue-500 text-xs mt-2 inline-block hover:underline">Lihat Detail →</a>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-yellow-500">
                    <p class="text-sm text-gray-500 uppercase font-bold">Buku Sedang Dipinjam</p>
                    <p class="text-3xl font-semibold">{{ $totalLoans }}</p>
                    <a href="{{ route('admin.index') }}" class="text-yellow-500 text-xs mt-2 inline-block hover:underline">Kelola Transaksi →</a>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-green-500">
                    <p class="text-sm text-gray-500 uppercase font-bold">Total Member</p>
                    <p class="text-3xl font-semibold">{{ \App\Models\User::where('role', 'user')->count() }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>