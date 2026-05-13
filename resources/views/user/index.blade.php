<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Katalog Perpustakaan') }}
            </h2>
            <div class="flex space-x-4">
                <span class="text-sm text-gray-500">Selamat datang, <strong>{{ Auth::user()->name }}</strong></span>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-6 bg-green-100 border-1-4 border-green-500 text-green-700 px-4 py-3 rounded shadow-sm"
                    role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="mb-6 bg-red-100 border-1-4 border-red-500 text-red-700 px-4 py-3 rounded shadow-sm"
                    role="alert">
                    {{ session('error') }}
                </div>
            @endif
            
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
                @forelse ($books as $book)
                    <div
                        class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow ">

                        <div class="relative aspect-[3/4] bg-gray-200">
                            @if ($book->cover_image)
                                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}"
                                    class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center text-gray-400">
                                    <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <span class="ext-xs uppercase font-semibold">No Cover</span>
                                </div>
                            @endif

                            <div class="absolute top-2 right-2">
                                <span
                                    class="px-2 py-1 text-[10px] font-bold rounded-xl shadow-sm {{ $book->stock > 0 ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                                    Stock: {{ $book->stock }}
                                </span>
                            </div>
                        </div>

                        <div class="p-4">
                            <h3 class="font-bold text-gray-800 text-sm leading-tight truncate mb-1"
                                title="{{ $book->title }}">
                                {{ $book->title }}
                            </h3>
                            <p class="text-xs text-gray-500 mb-4">
                                {{ $book->author }}
                            </p>

                            <div class="flex items-center space-x-2 border-t pt-3">
                                @if ($book->stock > 0)
                                    <form action="{{ route('user.borrowings.store') }}" method="POST" class="w-full">
                                        @csrf
                                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                                        <button type="submit"
                                            class="w-full text-center bg-blue-600 hover:bg-blue-700 text-white py-1.5 rounded-md text-xs font-semibold transition shadow-sm">
                                            Pinjam Buku
                                        </button>
                                    </form>
                                @else
                                    <button disabled
                                        class="w-full text-center bg-gray-100 text-gray-400 py-1.5 rounded-md text-xs font-semibold cursor-not-allowed border border-gray-200">
                                        Habis
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center bg-white rounded-xl border-2 border-dashed">
                        <p class="text-gray-400 italic">Belum ada koleksi buku di database.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
