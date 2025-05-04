<?php

namespace Database\Seeders;

use App\Models\SociaLinkl;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(AreaSeeder::class);
        $this->call(PageSeeder::class);
        $this->call(FooterSeeder::class);
        $this->call(SociaLinklSeeder::class);
    }
}
