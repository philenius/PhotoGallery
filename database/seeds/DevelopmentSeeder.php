<?php

use Illuminate\Database\Seeder;

class DevelopmentSeeder extends Seeder
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
        DB::table('photos')->insert([
        	[ 'title' => 'Xiang Lin Si Temple', 'location' => 'Melaka', 'author' => 'Philipp', 'subject_id' => 1, 'file_name_original' => 'IMG_0016.jpg' ],
        	[ 'title' => 'Sultan Abdul Samad Building', 'location' => 'Kuala Lumpur', 'author' => 'Philipp', 'subject_id' => 3, 'file_name_original' => 'IMG_0137.jpg' ],
        ]);
    }
}
