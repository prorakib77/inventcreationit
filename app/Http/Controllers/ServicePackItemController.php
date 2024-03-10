<?php

namespace App\Http\Controllers;

use App\Models\ServicePackItem;
use App\Http\Requests\StoreServicePackItemRequest;
use App\Http\Requests\UpdateServicePackItemRequest;

class ServicePackItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServicePackItemRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ServicePackItem $servicePackItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ServicePackItem $servicePackItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServicePackItemRequest $request, ServicePackItem $servicePackItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServicePackItem $servicePackItem)
    {
        //
    }
}
