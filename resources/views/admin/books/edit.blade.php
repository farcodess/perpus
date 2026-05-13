<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Buku: ') }} {{ $book->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                <div class="p-8">
                    
                   
                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700">
                            <ul class="mt-2 list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-widest mb-2">Judul Buku</label>
                                <input type="text" name="title" value="{{ old('title', $book->title) }}" 
                                    class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-widest mb-2">Penulis</label>
                                <input type="text" name="author" value="{{ old('author', $book->author) }}"
                                    class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-widest mb-2">Penerbit</label>
                                <input type="text" name="publisher" value="{{ old('publisher', $book->publisher) }}"
                                    class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-widest mb-2">ISBN</label>
                                <input type="text" name="isbn" value="{{ old('isbn', $book->isbn) }}"
                                    class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-widest mb-2">Tahun</label>
                                    <input type="number" name="year_published" value="{{ old('year_published', $book->year_published) }}"
                                        class="w-full border-gray-300 rounded-lg">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-widest mb-2">Stok</label>
                                    <input type="number" name="stock" value="{{ old('stock', $book->stock) }}"
                                        class="w-full border-gray-300 rounded-lg">
                                </div>
                            </div>

                            <div class="md:col-span-2 bg-gray-50 p-6 rounded-xl border-2 border-dashed border-gray-200">
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-widest mb-4">Cover Buku</label>
                                
                                <div class="flex items-center space-x-6">
                                    @if($book->cover_image)
                                    <div class="shrink-0 text-center">
                                        <span class="block text-[10px] text-gray-400 mb-2 uppercase tracking-tighter">Cover Sekarang</span>
                                        <img class="h-32 w-24 object-cover rounded-lg shadow-md border-2 border-white" 
                                             src="{{ asset('storage/' . $book->cover_image) }}" 
                                             alt="Cover Buku">
                                    </div>
                                    @endif

                                    <div class="flex-1">
                                        <input type="file" name="cover_image" accept=".jpg,.png,.jpeg"
                                            class="block w-full text-sm text-gray-500
                                            file:mr-4 file:py-2 file:px-4
                                            file:rounded-full file:border-0
                                            file:text-sm file:font-semibold
                                            file:bg-blue-50 file:text-blue-700
                                            hover:file:bg-blue-100 transition shadow-sm
                                        "/>
                                        <p class="mt-2 text-[11px] text-gray-400 italic">Format: JPG, PNG, JPEG (Maks. 2MB). Biarkan kosong jika tidak ingin ganti cover.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-10 flex justify-end gap-3">
                            <a href="{{ route('admin.books.index') }}" class="px-6 py-3 text-sm font-bold text-gray-500 hover:text-gray-700 transition">Batal</a>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-10 rounded-lg shadow-lg shadow-blue-200 transition active:scale-95">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>