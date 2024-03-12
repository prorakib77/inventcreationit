<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\PlanOrder;
use App\Models\Service;
use App\Models\ServicePackItem;
use App\Models\SingleOrder;
use App\Models\Trail;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\File;

class FrontendController extends Controller
{
    public function index()
    {
        $plans = Plan::all();
        $services = Service::all();
        return view('frontend.index', compact('plans', 'services'));
    }

    public function freetrail(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'file' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);


        if ($request->hasFile('file')) {
            $manager = new ImageManager(new Driver());

            $new_name = $request->name . "." . $request->file('file')->getClientOriginalExtension();
            $img = $manager->read($request->file('file'));

            if (!file_exists(public_path(Trail::IMAGE_PATH))) {
                File::makeDirectory(public_path(Trail::IMAGE_PATH), 0777, true);
            }

            $image_path = Trail::IMAGE_PATH . $new_name;
            $img->toJpeg()->save(public_path($image_path));
            Trail::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'file' => $image_path,
            ]);
        }

        return redirect()->back()->with('success', 'Thank you for your interest. We will contact you soon.');
    }


    public function order(ServicePackItem $service_item)
    {
        return view('frontend.order', compact('service_item'));
    }

    public function order_submit(Request $request, ServicePackItem $service_item)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'file_link' => 'required',
            'file' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        if ($request->hasFile('file')) {
            $manager = new ImageManager(new Driver());

            $new_name = $request->name . "." . $request->file('file')->getClientOriginalExtension();
            $img = $manager->read($request->file('file'));

            if (!file_exists(public_path(SingleOrder::IMAGE_PATH))) {
                File::makeDirectory(public_path(SingleOrder::IMAGE_PATH), 0777, true);
            }

            $image_path = SingleOrder::IMAGE_PATH . $new_name;

            $img->toJpeg(80)->save(public_path($image_path));
            SingleOrder::create([
                'service_id' => $service_item->id,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'file' => $image_path,
                'file_link' => $request->file_link,
                'service_name' => $service_item->package_name,
                'service_price' => $service_item->package_price,
            ]);
        }

        return redirect()->route('home')->with('success', 'Thank you for your Order. We will contact you soon.');
    }





// plan order 

public function plan_get(Plan $plans){
    return view('frontend.plan', compact('plans'));
}

public function plan_get_submit(Request $request, Plan $plans){

    $request->validate([
        'name' => 'required',
        'email' => 'required',
        'phone' => 'required',
        'file_link' => 'required',
        'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10240',
    ]);

    if ($request->hasFile('file')) {
        $manager = new ImageManager(new Driver());

        $new_name = $request->name . "." . $request->file('file')->getClientOriginalExtension();
        $img = $manager->read($request->file('file'));

        if (!file_exists(public_path(PlanOrder::IMAGE_PATH))) {
            File::makeDirectory(public_path(PlanOrder::IMAGE_PATH), 0777, true);
        }

        $image_path = PlanOrder::IMAGE_PATH . $new_name;

        $img->toJpeg(80)->save(public_path($image_path));
        PlanOrder::create([
            'plan_id' => $plans->id,
            'plan_type' => $plans->plan_name,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'file' => $image_path,
            'file_link' => $request->file_link,
        ]);
    }

    return redirect()->route('home')->with('success', 'Thank you for your Order. We will contact you soon.');
   

}
// plan order 





// order view 

public function single_order(){
    $orders = SingleOrder::all();
    return view('backend.order.single_order', compact('orders'));
}
public function plan_order(){
    $orders = PlanOrder::all();
    return view('backend.order.plan_order', compact('orders'));
}
public function trail_order(){
    $orders = Trail::all();
    return view('backend.order.trail_order', compact('orders'));
}
// order view 


}
