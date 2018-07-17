<?php

use App\Services\RoleService;
use App\Street;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $street = Street::create(['name' => 'Sienkiewicza']);
        User::create([
            'name' => "Jan",
            'last_name' => 'Kowalski',
            'email' => 'jkowalski@example.com',
            'password' => Hash::make('testowe'),
            'role' => RoleService::ADMINISTRATOR,
            'phone_number' => '+48666666666',
            'street_id' => $street->id,
            'house_number' => '30',
        ]);
        User::create([
            'name' => "Anna",
            'last_name' => 'Nowak',
            'email' => 'anowak@example.com',
            'password' => Hash::make('testowe'),
            'role' => RoleService::DIRECTOR,
            'phone_number' => '+48666666666',
            'street_id' => $street->id,
            'house_number' => '30',
        ]);
        User::create([
            'name' => "Kacper",
            'last_name' => 'Kowalski',
            'email' => 'kkowalski@example.com',
            'password' => Hash::make('testowe'),
            'role' => RoleService::WORKER,
            'phone_number' => '+48666666666',
            'street_id' => $street->id,
            'house_number' => '30',
        ]);
        User::create([
            'name' => "Piotr",
            'last_name' => 'Kowalski',
            'email' => 'pkowalski@example.com',
            'password' => Hash::make('testowe'),
            'role' => RoleService::CLIENT,
            'phone_number' => '+48666666666',
            'street_id' => $street->id,
            'house_number' => '30',
        ]);
    }
}
