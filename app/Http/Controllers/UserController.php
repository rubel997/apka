<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Region;
use App\Street;
use App\User;
use Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param User $users
     * @return \Illuminate\Http\Response
     */
    public function index(User $users) {
        $users = $users->get();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Region $regions
     * @return \Illuminate\Http\Response
     */
    public function create(Region $regions) {
        $regions = $regions->get();

        return view('users.create', compact('regions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     * @param Street $street
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request, Street $street) {
        $validated = $request->validated();

        if (!empty($validated['street'])) {
            $validated['street'] = ucfirst($validated['street']);
            $street = $street->where('name', $validated['street'])->first();
            if (empty($street)) {
                $street = Street::create(['name' => $validated['street']]);
            }

            $street = $street->toArray();
            $validated['street_id'] = array_get($street, 'id');
        }

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user = User::create($validated);

        $regionIds = array_get($validated, 'region_ids', []);

        $user->regions()->sync($regionIds);

        session()->flash('status', ['type' => 'success', 'message' => 'Konto utworzone']);

        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user) {
        $regions = $user->regions()->pluck('name')->toArray();

        return view('users.show', compact('user', 'regions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @param Region $regions
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, Region $regions) {
        $regions = $regions->get();
        $regionsIds = $user->regions()->pluck('id')->toArray();

        return view('users.edit', compact('user', 'regions', 'regionsIds'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param User $user
     * @param Street $street
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user, Street $street) {
        $validated = $request->validated();

        if (!empty($validated['street'])) {
            $validated['street'] = ucfirst($validated['street']);
            $street = $street->where('name', $validated['street'])->first();
            if (empty($street)) {
                $street = Street::create(['name' => $validated['street']]);
            }

            $street = $street->toArray();
            $validated['street_id'] = array_get($street, 'id');
        }

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update(array_filter($validated));

        $regionIds = array_get($validated, 'region_ids', []);

        $user->regions()->sync($regionIds);

        session()->flash('status', ['type' => 'success', 'message' => 'Konto zaktualizowane']);

        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(User $user) {
        $user->delete();
        session()->flash('status', ['type' => 'success', 'message' => 'Konto usunięte']);

        return redirect()->route('user.index');
    }
}
