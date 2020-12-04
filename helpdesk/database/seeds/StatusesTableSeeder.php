<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Status;


class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run(){

        $statusses = [
            [Status::EERSTELIJN, 'ticket wacht op een eerstelijns medewerker'],
            [Status::EERSTELIJN_TOEGEWEZEN, 'ticket is toegewezen aan een eerstelijns medewerker'],
            [Status::TWEEDELIJN, 'ticket op een tweedelijns medewerker'],
            [Status::TWEEDELIJN_TOEGEWEZEN, 'ticket is toegewezen aan een tweedelijns medewerker'],
            [Status::AFGEHANDELD, 'ticket is afgehandeld'],
        ];
        foreach ($statusses as $status) {
            DB::table('statuses')->insert([
                'name' => $status[0],
                'description' => $status[1],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

}
