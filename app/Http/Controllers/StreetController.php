<?php

namespace App\Http\Controllers;

use App\Http\Requests\StreetRequest;
use App\Region;
use App\Street;

class StreetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Street $streets
     * @return \Illuminate\Http\Response
     */
    public function index(Street $streets) {
        $streets = $streets->get();

        return view('streets.index', compact('streets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Region $regions
     * @return \Illuminate\Http\Response
     */
    public function create(Region $regions) {
        $regions = $regions->get();

        return view('streets.create', compact('regions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StreetRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StreetRequest $request) {
        $validated = $request->validated();

        Street::create(array_filter($validated));

        session()->flash('status', ['type' => 'success', 'message' => 'Ulica utworzona']);

        return redirect()->route('street.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Street $street
     * @return \Illuminate\Http\Response
     */
    public function show(Street $street) {
        return view('streets.show', compact('street'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Street $street
     * @param Region $regions
     * @return \Illuminate\Http\Response
     */
    public function edit(Street $street, Region $regions) {
        $regions = $regions->get();

        return view('streets.edit', compact('street', 'regions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StreetRequest $request
     * @param  \App\Street $street
     * @return \Illuminate\Http\Response
     */
    public function update(StreetRequest $request, Street $street) {
        $validated = $request->validated();

        $street->update(array_filter($validated));

        session()->flash('status', ['type' => 'success', 'message' => 'Ulica zaktualizowana']);

        return redirect()->route('street.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Street $street
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Street $street) {
        $street->delete();
        session()->flash('status', ['type' => 'success', 'message' => 'Ulica usunięta']);

        return redirect()->route('street.index');
    }
}
