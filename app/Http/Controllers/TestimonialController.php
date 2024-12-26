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
        // Validate the incoming data
        $request->validate([
            'name' => 'required|string|max:255',
            'comment' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);
    
        // Create a new testimonial
        Testimonial::create([
            'name' => $request->name,
            'comment' => $request->comment,
            'rating' => $request->rating,
        ]);
    
        // Redirect to testimonials.index route with a HotToast notification
        return redirect()->route('testimonials.index')
                         ->with('toast', 'Testimoni berhasil dikirim! Terima kasih atas feedback Anda.');
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
        // Validate the incoming data for updates
        $request->validate([
            'name' => 'required|string|max:255',
            'comment' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);
        
        // Update the testimonial
        $testimonial->update([
            'name' => $request->name,
            'comment' => $request->comment,
            'rating' => $request->rating,
        ]);

        // Redirect back to the admin testimonials page with a HotToast notification
        return redirect()->route('admin.testimonials.index')
                         ->with('toast', 'Testimonial berhasil diperbarui!');
    }

    public function destroy(Testimonial $testimonial)
    {
        // Delete the testimonial
        $testimonial->delete();
    
        // Redirect back to the admin testimonials page with a HotToast notification
        return redirect()->route('admin.testimonials.index')
                         ->with('toast', 'Testimonial berhasil dihapus!');
    }
}
