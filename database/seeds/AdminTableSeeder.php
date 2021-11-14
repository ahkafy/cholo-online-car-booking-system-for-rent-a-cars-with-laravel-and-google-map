<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('admins')->insert(array(
        	array(
				'name' => "admin",
				'email' => 'admin@gmail.com',
        'phone' => '01713121070',
				'password' => bcrypt('password'),
        	),
        	array(
				'name' => "Kafy",
				'email' => 'ahkafy@gmail.com',
        'phone' => '01716696195',
				'password' => bcrypt('password'),
        	)
        ));

    }
}
