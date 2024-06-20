<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            SiswaSeeder::class
        ]);
        
        // User::factory(10)->create();
        User::create([
            "uid" => "superadmin",
            "name" => "superadmin",
            "email" => "superadmin@bteam.site",
            "password" => Hash::make("123456"),
            "role_id" => "1",
            "status" => "Aktif",
            "email_verified_at" => Date::now()
        ]);
    }
}
