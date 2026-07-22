<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::latest()->paginate(10);
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'image' => 'nullable|image|max:2048',
            'video_link' => 'nullable|url|max:255',
            'alt_text' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('testimonials', 'public');
        }
        $validated['video_link'] = $this->getYoutubeEmbedUrl($validated['video_link'] ?? null);
        Testimonial::create($validated);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial created successfully.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'image' => 'nullable|image|max:2048',
            'video_link' => 'nullable|url|max:255',
            'alt_text' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('testimonials', 'public');
        }

        $validated['video_link'] = $this->getYoutubeEmbedUrl($validated['video_link'] ?? null);

        $testimonial->update($validated);



        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated successfully.');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial deleted successfully.');
    }


    protected function getYoutubeEmbedUrl($url)
    {
        if (!$url) {
            return null;
        }

        // Already an embed URL
        if (str_contains($url, 'youtube.com/embed/')) {
            return $url;
        }

        $videoId = null;

        // https://youtu.be/VIDEO_ID
        if (str_contains($url, 'youtu.be/')) {
            $videoId = explode('?', explode('youtu.be/', $url)[1])[0];
        }

        // https://www.youtube.com/watch?v=VIDEO_ID
        elseif (str_contains($url, 'watch?v=')) {
            parse_str(parse_url($url, PHP_URL_QUERY), $query);
            $videoId = $query['v'] ?? null;
        }

        // https://www.youtube.com/shorts/VIDEO_ID
        elseif (str_contains($url, 'shorts/')) {
            $videoId = explode('?', explode('shorts/', $url)[1])[0];
        }

        return $videoId
            ? "https://www.youtube.com/embed/{$videoId}"
            : $url;
    }
}
