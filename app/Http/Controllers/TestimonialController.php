<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::all();
        
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function userIndex()
    {
        $testimonials = Testimonial::all();
        
        return view('testimonials.index', compact('testimonials'));
    }
    

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'comment' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);
    
        Testimonial::create([
            'name' => $request->name,
            'comment' => $request->comment,
            'rating' => $request->rating,
        ]);
    
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial berhasil ditambahkan!');
    }

    public function show(Testimonial $testimonial)
{
    return view('admin.testimonials.show', compact('testimonial'));
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'comment' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);
        $testimonial->update([
            'name' => $request->name,
            'comment' => $request->comment,
            'rating' => $request->rating,
        ]);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial berhasil diperbarui!');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
    
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial berhasil dihapus!');
    }
    
}
