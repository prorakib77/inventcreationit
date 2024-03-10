<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServiceRequest;
use App\Models\Service;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ServicePackItem;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Illuminate\Http\RedirectResponse;
use Intervention\Image\Drivers\Gd\Driver;

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
    public function store(StoreServiceRequest $request)
    {
        if ($request->hasFile('service_image')) {
            $manager = new ImageManager(new Driver());

            $new_name = $request->service_name . "." . $request->file('service_image')->getClientOriginalExtension();
            $img = $manager->read($request->file('service_image'));

            if (!file_exists(public_path(Service::IMAGE_PATH))) {
                File::makeDirectory(public_path(Service::IMAGE_PATH), 0777, true);
            }

            $image_path = Service::IMAGE_PATH . $new_name;
            $img->toJpeg(80)->save(public_path($image_path));

            $slug = Str::slug($request->service_name);

            $service = Service::create([
                'service_name' => $request->service_name,
                'service_slug' => $slug,
                'service_description' => $request->service_description,
                'service_image' => $image_path,
            ]);
            
            if ($request->has('package_name')) {
                foreach ($request->package_name as $key => $package_name) {
                    $service->ServicePackItems()->create([
                        'service_id' => $service->id,
                        'package_name' => $package_name,
                        'package_price' => $request->package_price[$key]
                    ]);
                }
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
        return view('backend.service.edit', compact('service'));
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
        if(file_exists($service->service_image)){
            unlink(public_path($service->service_image));
        }
        $service->ServicePackItems()->delete();
        $service->delete();
        return back()->with('success', 'Service deleted successfully');
    }
}
