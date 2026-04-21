<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\PlanResource;


class PlanController extends Controller
{
    public function index()
    {
        $user = $this->getUser();
        $user->load('fields.plans.crop');

        $plans = $user->fields->flatMap->plans;

        $grouped = $plans
            ->groupBy('year')
            ->map(fn ($plansOfYear) =>
                $plansOfYear
                    ->groupBy(fn($p)=>$p->field_id.'-'.$p->crop_id)
                    ->map(fn ($group) => new PlanResource($group))
                    ->values()
            );

        return response()->json($grouped);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
