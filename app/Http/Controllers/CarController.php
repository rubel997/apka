<?php

namespace App\Http\Controllers;

use App\Car;
use App\Http\Requests\CarRequest;
use App\User;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Car $cars
     * @return \Illuminate\Http\Response
     */
    public function index(Car $cars) {
        $cars = $cars->get();

        return view('cars.index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('cars.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CarRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CarRequest $request) {
        $validated = $request->validated();

        Car::create($validated);

        session()->flash('status', ['type' => 'success', 'message' => 'Samochód utworzony']);

        return redirect()->route('car.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Car $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car) {
        return view('cars.show', compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Car $car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car) {
        return view('cars.edit', compact('car'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CarRequest $request
     * @param  \App\Car $car
     * @return \Illuminate\Http\Response
     */
    public function update(CarRequest $request, Car $car) {
        $validated = $request->validated();

        $car->update($validated);

        session()->flash('status', ['type' => 'success', 'message' => 'Samochód zaktualizowany']);

        return redirect()->route('car.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Car $car
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Car $car) {
        $car->delete();

        session()->flash('status', ['type' => 'success', 'message' => 'Samochód usunięty']);

        return redirect()->route('car.index');
    }

    public function rentCar(Car $car) {
        $car->rent(auth()->user());

        return redirect()->route('car.index');
    }
}
