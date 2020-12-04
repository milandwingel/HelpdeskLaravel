<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $users = [
            ['administrator1', 'klant1@gmail.com', 'klant1', Role::ADMIN],
            ['eerstelijnsmedewerkers1', 'eerstelijnsmedewerkers1@gmail.com', 'klant2', Role::EERSTELIJNSMEDEWERKERS],
            ['eerstelijnsmedewerkers2', 'eerstelijnsmedewerkers2@gmail.com', 'klant3', Role::EERSTELIJNSMEDEWERKERS],
            ['tweedelijnsmedewerkers1', 'tweedelijnsmedewerkers1@gmail.com', 'klant4', Role::TWEEDELIJNSMEDEWERKERS],
            ['tweedelijnsmedewerkers2', 'tweedelijnsmedewerkers2@gmail.com', 'klant5', Role::TWEEDELIJNSMEDEWERKERS],
            ['user1', 'user1@gmail.com', 'user1', Role::USER],
            ['user2', 'user2@gmail.com', 'user2', Role::USER]
        ];
        $role_ids = DB::table('roles')->pluck('id', 'naam');
        foreach ($users as $user) {
            DB::table('users')->insert([
                'name' => $user[0],
                'email' => $user[1],
                'email_verified_at' => now(),
                'password' => bcrypt($user[2]),
                'role_id' => $role_ids[$user[3]],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
