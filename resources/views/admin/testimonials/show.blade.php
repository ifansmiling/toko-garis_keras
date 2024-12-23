<!-- resources/views/testimonials/show.blade.php -->
@extends('layouts.app')

@section('title', 'Detail Testimonial')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-blue-800 mb-6">Detail Testimonial</h1>

    <div class="bg-white shadow-md rounded-lg p-6">
        <p><strong>Nama:</strong> {{ $testimonial->name }}</p>
        <p><strong>Komentar:</strong> {{ $testimonial->comment }}</p>
        <p><strong>Rating:</strong> {{ $testimonial->rating }} / 5</p>
    </div>

    <div class="mt-6">
        <a href="{{ route('admin.testimonials.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition duration-200">
            Kembali ke Daftar Testimonial
        </a>
    </div>
</div>
@endsection
