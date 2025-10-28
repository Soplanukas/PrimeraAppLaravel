<?php

namespace App\Http\Controllers;

use App\Models\Venue;
use App\Http\Requests\StoreVenueRequest;
use App\Http\Requests\UpdateVenueRequest;
use Illuminate\Http\Request;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Venue::with(['events'])
        ->where('venue_max_capacity', '>', $request->input(('capacity')))
        ->orWhere('venue_status', false)
        ->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVenueRequest $request)
    {
        return Venue::create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(Venue $venue)
    {
        return response()->json([
            'success' => true, 
            'venue' => $venue->load('events'),
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVenueRequest $request, Venue $venue)
    {
        if($venue->update($request->validated())) {
            return response()->json(['success' => true, 'venue' => $venue], 200);
        }
        return response()->json(['success' => false], 500);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venue $venue)
    {
        if($venue->delete()) {
            return response()->json(['success' => true], 200);
        }
        return response()->json(['success' => false], 500);
    }
}
