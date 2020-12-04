<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $users = [
            [Role::EERSTELIJNSMEDEWERKERS],
            [Role::TWEEDELIJNSMEDEWERKERS],
            [Role::ADMIN],
            [Role::USER],

        ];
        foreach ($users as $user) {
            DB::table('roles')->insert([
                'naam' => $user[0],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
