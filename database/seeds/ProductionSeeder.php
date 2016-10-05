<?php

use Illuminate\Database\Seeder;

class ProductionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('photo_subjects')->insert([
			[ 'subject' => 'Landscape' ],
			[ 'subject' => 'Building' ],
			[ 'subject' => 'People' ],
			[ 'subject' => 'Other' ],
        ]);
    }
}
