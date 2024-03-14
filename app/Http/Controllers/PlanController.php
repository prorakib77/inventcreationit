<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plans = Plan::all();
        $plans->load('planItems');
        return view('backend.plan.index', compact('plans'));
        ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.plan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'plan_name' => 'required',
            'plan_description' => 'required|max:30',
            'plan_price' => 'required',
            'plan_items' => 'required',
        ]);

        $plan = Plan::create($request->all());

        foreach ($request->plan_items as $plan_item) {
            $plan->planItems()->create([
                'plan_id' => $plan->id,
                'plan_item_name' => $plan_item,
            ]);
        }

        return redirect()->route('plans.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Plan $plan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plan $plan)
    {
        return view('backend.plan.edit', compact('plan'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plan $plan)
    {
        $request->validate([
            'plan_name' => 'required',
            'plan_price' => 'required',
            'plan_items' => 'required',
        ]);

        DB::beginTransaction();

        try {

            $plan->update($request->all());

            $plan->planItems()->delete();

            foreach ($request->plan_items as $plan_item) {
                $plan->planItems()->create([
                    'plan_id' => $plan->id,
                    'plan_item_name' => $plan_item,
                ]);
            }


            DB::commit();

            return redirect()->route('plans.index')->with('success', 'Plan updated successfully');
        } catch (\Exception $e) {

            /**
             * Rollback transaction on error
             */
            DB::rollBack();

            info('Plan Update Failed: ' . $e->getMessage());

            return redirect()->back()->withErrors($e->getMessage());
        } catch (\Exception $e) {

            info('Plan Update Failed: ' . $e->getMessage());

            return redirect()->back()->withInput()->withErrors(['unexpected_error' => 'Unexpected error occurred while updating plan']);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan $plan)
    {
        $plan->planItems()->delete();
        $plan->delete();
        return redirect()->route('plans.index');
    }
}
