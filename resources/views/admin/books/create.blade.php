<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tambah Buku Baru') }}
            </h2>
            <a href="{{ route('admin.books.index') }}" class="text-sm text-gray-600 hover:text-gray-900 transition">
                &larr; Kembali ke Daftar
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100">
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

                    <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label for="title"
                                    class="block text-xs font-bold text-gray-700 uppercase tracking-widest mb-2">Judul
                                    Buku</label>
                                <input type="text" name="title" id="title" value="{{ old('title') }}"
                                    placeholder="Masukkan Judul Lengkap Buku"
                                    class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm @error('title') border-red-500 @enderror">
                            </div>

                            <div>
                                <label for="author"
                                    class="block text-xs font-bold text-gray-700 uppercase tracking-widest mb-2">Penulis</label>
                                <input type="text" name="author" id="author" value="{{ old('author') }}"
                                    placeholder="Nama Penulis"
                                    class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                            </div>

                            <div>
                                <label for="publisher"
                                    class="block text-xs font-bold text-gray-700 uppercase tracking-widest mb-2">Penerbit</label>
                                <input type="text" name="publisher" id="publisher" value="{{ old('publisher') }}"
                                    placeholder="Nama Penerbit"
                                    class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                            </div>

                            <div>
                                <label for="isbn"
                                    class="block text-xs font-bold text-gray-700 uppercase tracking-widest mb-2">ISBN</label>
                                <input type="number" name="isbn" id="isbn" value="{{ old('isbn') }}"
                                    placeholder="Contoh: 9781234567"
                                    class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="year_published"
                                        class="block text-xs font-bold text-gray-700 uppercase tracking-widest mb-2">Tahun</label>
                                    <input type="number" name="year_published" id="year_published"
                                        value="{{ old('year_published') }}" placeholder="2024"
                                        class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                                </div>
                                <div>
                                    <label for="stock"
                                        class="block text-xs font-bold text-gray-700 uppercase tracking-widest mb-2">Stok</label>
                                    <input type="number" name="stock" id="stock" value="{{ old('stock') }}"
                                        placeholder="0"
                                        class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                                </div>
                            </div>

                            <div class="md:col-span-2 bg-gray-50 p-6 rounded-xl border-2 border-dashed border-gray-200">
                                <label
                                    class="block text-xs font-bold text-gray-700 uppercase tracking-widest mb-4">Upload
                                    Cover Buku</label>

                                <div class="flex items-center space-x-6">

                                    <div class="flex-1">
                                        <input accept="image/png, image/jpeg, image/jpg" type="file"
                                            name="cover_image" accept=".jpg,.png,.jpeg"
                                            class="block w-full text-sm text-gray-500
                                            file:mr-4 file:py-2 file:px-4
                                            file:rounded-full file:border-0
                                            file:text-sm file:font-semibold
                                            file:bg-blue-50 file:text-blue-700
                                            hover:file:bg-blue-100 transition shadow-sm
                                        " />
                                        <p class="mt-2 text-[11px] text-gray-400 italic">Format: JPG, PNG, JPEG (Maks.
                                            2MB). Wajib diisi untuk buku baru.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-10 flex justify-end">
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-10 rounded-lg shadow-lg shadow-blue-200 transition-all active:scale-95">
                                Tambah Buku Baru
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>