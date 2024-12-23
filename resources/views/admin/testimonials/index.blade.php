@extends('layouts.app')

@section('title', 'Daftar Testimonial')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-blue-800 mb-6 text-center">Daftar Testimonial</h1>

    <a href="{{ route('admin.testimonials.create') }}" 
       class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition duration-200 mb-6 inline-flex items-center space-x-2 mx-auto block">
        <i class="fas fa-plus"></i>
        <span>Tambah Testimonial</span>
    </a>

    @if($testimonials->isEmpty())
        <p class="text-center text-gray-500">Belum ada testimonial.</p>
    @else
        <div class="overflow-x-auto shadow-lg rounded-lg mx-auto">
            <table class="w-full text-left bg-white rounded-lg shadow-md">
                <thead class="bg-blue-500 text-white">
                    <tr>
                        <th class="px-6 py-3 text-sm font-medium text-center">No</th>
                        <th class="px-6 py-3 text-sm font-medium text-center">Nama</th>
                        <th class="px-6 py-3 text-sm font-medium text-center">Komentar</th>
                        <th class="px-6 py-3 text-sm font-medium text-center">Rating</th>
                        <th class="px-6 py-3 text-sm font-medium text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($testimonials as $testimonial)
                        <tr class="border-b hover:bg-blue-50">
                            <td class="px-6 py-4 text-sm text-center">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 text-sm text-center">{{ $testimonial->name }}</td>
                            <td class="px-6 py-4 text-sm text-center">{{ $testimonial->comment }}</td>
                            <td class="px-6 py-4 text-sm text-center">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $testimonial->rating ? 'text-yellow-500' : 'text-gray-300' }}"></i>
                                @endfor
                            </td>
                            <td class="px-6 py-4 text-sm text-center flex justify-center items-center space-x-2">
                                <a href="{{ route('admin.testimonials.show', $testimonial->id) }}" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 text-sm">
                                    <i class="fas fa-eye"></i> Lihat
                                </a>
                                <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600 text-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 text-sm" onclick="return confirm('Hapus testimonial ini?')">
                                        <i class="fas fa-trash-alt"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
