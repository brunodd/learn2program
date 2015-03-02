<?php

use Illuminate\Database\Seeder;
use App\User;

class TypesTableSeeder extends Seeder {

    public function run() {
        DB::table('types')->delete();

    }
}
