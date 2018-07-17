<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegionRequest;
use App\Region;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Region $regions
     * @return \Illuminate\Http\Response
     */
    public function index(Region $regions) {
        $regions = $regions->get();

        return view('regions.index', compact('regions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('regions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RegionRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegionRequest $request) {
        $validated = $request->validated();

        Region::create($validated);

        session()->flash('status', ['type' => 'success', 'message' => 'Region utworzony']);

        return redirect()->route('region.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Region $region
     * @return \Illuminate\Http\Response
     */
    public function show(Region $region) {
        return view('regions.show', compact('region'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Region $region
     * @return \Illuminate\Http\Response
     */
    public function edit(Region $region) {
        return view('regions.edit', compact('region'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RegionRequest $request
     * @param  \App\Region $region
     * @return \Illuminate\Http\Response
     */
    public function update(RegionRequest $request, Region $region) {
        $validated = $request->validated();

        $region->update($validated);

        session()->flash('status', ['type' => 'success', 'message' => 'Region zaktualizowany']);

        return redirect()->route('region.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Region $region
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Region $region) {
        $region->delete();

        session()->flash('status', ['type' => 'success', 'message' => 'Region usunięty']);

        return redirect()->route('region.index');
    }
}
