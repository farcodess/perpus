<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Peminjaman') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-6">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase">Nama Peminjam</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase">Buku</th>
                                <th class="px-4 py-3 text-center text-xs font-bold text-gray-500 uppercase">Tgl Pinjam</th>
                                <th class="px-4 py-3 text-center text-xs font-bold text-gray-500 uppercase">Tgl Kembali</th>
                                <th class="px-4 py-3 text-center text-xs font-bold text-gray-500 uppercase">Tgl Dikembalikan</th>
                                <th class="px-4 py-3 text-center text-xs font-bold text-gray-500 uppercase">Status</th>
                                <th class="px-4 py-3 text-right text-xs font-bold text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($borrowings as $item)
                                @php
                                    $isLate = $item->status == 'borrowed' && now() > $item->due_date;
                                @endphp
                                <tr>
                                    <td class="px-4 py-4 text-sm text-gray-900">{{ $item->user->name }}</td>
                                    <td class="px-4 py-4 text-sm text-gray-900">{{ $item->book->title }}</td>
                                    <td class="px-4 py-4 text-sm text-center text-gray-600">
                                        {{ \Carbon\Carbon::parse($item->borrow_date)->format('d/m/Y') }}
                                    </td>
                                    <td class="px-4 py-4 text-sm text-center {{ $isLate ? 'text-red-600 font-bold' : 'text-gray-600' }}">
                                        {{ \Carbon\Carbon::parse($item->due_date)->format('d/m/Y') }}
                                    </td>
                                    <td class="px-4 py-4 text-sm text-gray-900 text-center">
                                       {{ $item->return_date ? \Carbon\Carbon::parse($item->return_date)->format('d/m/Y') : '-' }}
                                    </td>
                                    <td class="px-4 py-4 text-center">
                                        @if($item->status == 'returned')
                                            <span class="text-xs text-green-600">Selesai</span>
                                        @elseif($isLate)
                                            <span class="text-xs text-red-600 font-bold">Terlambat</span>
                                        @else
                                            <span class="text-xs text-orange-600">Dipinjam</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-4 text-right text-sm font-medium">
                                        <div class="flex justify-end space-x-3">
                                            @if($item->status == 'borrowed')
                                                <form action="{{ route('admin.borrowings.return', $item->id) }}" method="POST">
                                                    @csrf @method('PUT')
                                                    <button type="submit" class="text-green-600 hover:text-green-900">Kembali</button>
                                                </form>
                                            @endif
                                            {{-- <a href="{{ route('admin.borrowings.edit', $item->id) }}" class="text-blue-600 hover:text-blue-900">Edit</a> --}}
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-8 text-center text-gray-500">Data kosong.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $borrowings->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>