<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CabBookingPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CabBookingPackageController extends Controller
{
    public function index()
    {
        $cabPackages = CabBookingPackage::latest()->paginate(10);
        return view('admin.cab_packages.index', compact('cabPackages'));
    }

    public function create()
    {
        return view('admin.cab_packages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'cab_name'         => 'required|string|max:255',
            'vehicle_type'     => 'required|string|max:255',
            'seating_capacity' => 'required|integer|min:1',
            'price'            => 'required|numeric|min:0',
            'description'      => 'nullable|string',
            'images.*'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords'    => 'nullable|string',
            'meta_tags'        => 'nullable|string',
            'alt_text'         => 'nullable|array'
        ]);

        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('cabs', 'public');
            }
        }

        $slug = CabBookingPackage::generateSlug($request->cab_name);

        CabBookingPackage::create([
            'cab_name'         => $request->cab_name,
            'slug'             => $slug,
            'vehicle_type'     => $request->vehicle_type,
            'seating_capacity' => $request->seating_capacity,
            'price'            => $request->price,
            'description'      => $request->description,
            'images'           => $imagePaths,
            'status'           => $request->has('status'),
            'meta_title'       => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords'    => $request->meta_keywords,
            'meta_tags'        => $request->meta_tags,
            'alt_text'         => $request->input('alt_text') ?? [],
        ]);

        return redirect()->route('admin.cab-packages.index')->with('success', 'Cab booking package created successfully.');
    }

    public function edit($id)
    {
        $cabPackage = CabBookingPackage::findOrFail($id);
        return view('admin.cab_packages.edit', compact('cabPackage'));
    }

    public function update(Request $request, $id)
    {
        $cabPackage = CabBookingPackage::findOrFail($id);

        $request->validate([
            'cab_name'         => 'required|string|max:255',
            'vehicle_type'     => 'required|string|max:255',
            'seating_capacity' => 'required|integer|min:1',
            'price'            => 'required|numeric|min:0',
            'description'      => 'nullable|string',
            'images.*'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords'    => 'nullable|string',
            'meta_tags'        => 'nullable|string',
            'alt_text'         => 'nullable|array'
        ]);

        $imagePaths = $cabPackage->images ?? [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('cabs', 'public');
            }
        }

        $slug = $cabPackage->slug;
        if ($cabPackage->cab_name !== $request->cab_name) {
            $slug = CabBookingPackage::generateSlug($request->cab_name);
        }

        $cabPackage->update([
            'cab_name'         => $request->cab_name,
            'slug'             => $slug,
            'vehicle_type'     => $request->vehicle_type,
            'seating_capacity' => $request->seating_capacity,
            'price'            => $request->price,
            'description'      => $request->description,
            'images'           => $imagePaths,
            'status'           => $request->has('status'),
            'meta_title'       => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords'    => $request->meta_keywords,
            'meta_tags'        => $request->meta_tags,
            'alt_text'         => $request->input('alt_text') ?? [],
        ]);

        return redirect()->route('admin.cab-packages.index')->with('success', 'Cab booking package updated successfully.');
    }

    public function removeImage(Request $request, $id)
    {
        $cabPackage = CabBookingPackage::findOrFail($id);
        $imagePath = $request->image_path;
        $images = $cabPackage->images ?? [];

        if (($key = array_search($imagePath, $images)) !== false) {
            unset($images[$key]);

            if (Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            $altText = $cabPackage->alt_text ?? [];
            if (isset($altText[$imagePath])) {
                unset($altText[$imagePath]);
            }

            $cabPackage->update([
                'images' => array_values($images),
                'alt_text' => $altText
            ]);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Image not found.'], 404);
    }

    public function destroy($id)
    {
        $cabPackage = CabBookingPackage::findOrFail($id);
        if (!empty($cabPackage->images)) {
            foreach ($cabPackage->images as $img) {
                if (Storage::disk('public')->exists($img)) {
                    Storage::disk('public')->delete($img);
                }
            }
        }
        $cabPackage->delete();
        return redirect()->route('admin.cab-packages.index')->with('success', 'Cab booking package deleted successfully.');
    }
}
