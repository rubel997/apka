<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Region;
use App\Services\RoleService;
use App\Street;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    protected $street;
    protected $region;

    /**
     * Create a new controller instance.
     *
     * @param Street $street
     * @param Region $region
     */
    public function __construct(Street $street, Region $region) {
        $this->middleware('guest');

        $this->street = $street;
        $this->region = $region;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create(array $data) {
        if (!empty($data['street'])) {
            $this->street = $this->street->where('name', $data['street'])->first();
            if (empty($this->street)) {
                $this->street = Street::create(['name' => $data['street']]);
            }
            $this->street = $this->street->toArray();
        }

        if (!empty($data['region'])) {
            $this->region = $this->region->where('name', $data['region'])->first();
            if (empty($this->region)) {
                $this->region = Region::create(['name' => $data['region']]);
            }
            $this->region = $this->region->toArray();
        }

        return User::create([
            'name' => array_get($data, 'name'),
            'last_name' => array_get($data, 'last_name'),
            'email' => array_get($data, 'email'),
            'password' => Hash::make(array_get($data, 'password')),
            'role' => RoleService::CLIENT,
            'phone_number' => array_get($data, 'phone_number'),
            'street_id' => array_get($this->street, 'id'),
            'region_id' => array_get($this->region, 'id'),
            'house_number' => array_get($data, 'house_number'),
        ]);
    }
}
