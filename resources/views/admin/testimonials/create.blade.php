<!-- resources/views/testimonials/create.blade.php -->
@extends('layouts.app')

@section('title', 'Tambah Testimonial')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-blue-800 mb-6">Tambah Testimonial</h1>

    <form action="{{ route('admin.testimonials.store') }}" method="POST" class="bg-white shadow-md rounded-lg p-6">
        @csrf

        <!-- Nama -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-medium mb-2">Nama</label>
            <input type="text" name="name" id="name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <!-- Komentar -->
        <div class="mb-4">
            <label for="comment" class="block text-gray-700 font-medium mb-2">Komentar</label>
            <textarea name="comment" id="comment" rows="4" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
        </div>

        <!-- Rating -->
        <div class="mb-4">
            <label for="rating" class="block text-gray-700 font-medium mb-2">Rating</label>
            <input type="number" name="rating" id="rating" min="1" max="5" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <!-- Tombol Aksi -->
        <div class="flex justify-end space-x-4">
            <a href="{{ route('admin.testimonials.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition duration-200">
                Batal
            </a>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200">
                Simpan Testimonial
            </button>
        </div>
    </form>
</div>
@endsection
