<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;
use App\Models\ServicePackItem;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.service.index', [
            'services' => Service::all(),
            // 'items' => ServicePackItem::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.service.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'service_name' => 'required|max:255',
            // 'service_slug' => 'required|max:255',
            'service_description' => 'required',
            'service_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'package_name.*' => 'required',
            'package_price.*' => 'required|numeric',
        ]);

        if ($request->hasFile('service_image')) {

            $manager = new ImageManager(new Driver());
            $new_name = $request->service_name . "." . $request->file('service_image')->getClientOriginalExtension();
            $img = $manager->read($request->file('service_image'));
            $img->toJpeg(80)->save(base_path('public/storage/services/' . $new_name));

            $slug = Str::slug($request->service_name);


            $service = Service::create([
                'service_name' => $request->service_name,
                'service_slug' => $slug,
                'service_description' => $request->service_description,
                'service_image' => $new_name,
            ]);

            foreach ($request->package_name as $key => $package_name) {
                $service->ServicePackItems()->create([
                    'service_id' => $service->id,
                    'package_name' => $package_name,
                    'package_price' => $request->package_price[$key]
                ]);
            }
        }

        return redirect()->route('service.index')->with('success', 'Service created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        return view('backend.service.edit',compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        //
    }
}
