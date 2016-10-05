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
        	[ 'title' => 'Xiang Lin Si Temple', 'location' => 'Melaka', 'author' => 'Philipp', 'photo_subject_id' => 1, 'file_name_original' => '1.jpeg', 'file_name_compressed' => '1_compressed.jpeg', 'file_name_thumbnail' => '1_thumb.jpeg' ],
        	[ 'title' => 'Sultan Abdul Samad Building', 'location' => 'Kuala Lumpur', 'author' => 'Philipp', 'photo_subject_id' => 3, 'file_name_original' => '2.jpeg', 'file_name_compressed' => '2_compressed.jpeg', 'file_name_thumbnail' => '2_thumb.jpeg' ],
        ]);
    }
}
