<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::with('page')->latest()->paginate(15);
        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        $pages = \App\Models\Page::all();
        return view('admin.banners.create', compact('pages'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'nullable|string|max:255',
            'subtitle'    => 'nullable|string|max:255',
            'image'       => 'required|image',
            'page_id'     => 'required|exists:pages,id',
            'button_text' => 'nullable|string|max:255',
            'button_link' => 'nullable|string|max:255',
            'status'      => 'sometimes|boolean',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('banners', 'public');
            $validated['image'] = $path;
        }

        $validated['status'] = $request->has('status') ? 1 : 0;

        Banner::create($validated);
        return redirect()->route('admin.banners.index')->with('success', 'Banner created successfully.');
    }

    public function edit(Banner $banner)
    {
        $pages = \App\Models\Page::all();
        return view('admin.banners.edit', compact('banner', 'pages'));
    }

    public function update(Request $request, Banner $banner)
    {
        $validated = $request->validate([
            'title'       => 'nullable|string|max:255',
            'subtitle'    => 'nullable|string|max:255',
            'image'       => 'nullable|image',
            'page_id'     => 'required|exists:pages,id',
            'button_text' => 'nullable|string|max:255',
            'button_link' => 'nullable|string|max:255',
            'status'      => 'sometimes|boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($banner->image && Storage::disk('public')->exists($banner->image)) {
                Storage::disk('public')->delete($banner->image);
            }
            $path = $request->file('image')->store('banners', 'public');
            $validated['image'] = $path;
        }

        $validated['status'] = $request->has('status') ? 1 : 0;

        $banner->update($validated);
        return redirect()->route('admin.banners.index')->with('success', 'Banner updated successfully.');
    }

    public function destroy(Banner $banner)
    {
        if ($banner->image && Storage::disk('public')->exists($banner->image)) {
            Storage::disk('public')->delete($banner->image);
        }
        $banner->delete();
        return redirect()->route('admin.banners.index')->with('success', 'Banner deleted successfully.');
    }
}
