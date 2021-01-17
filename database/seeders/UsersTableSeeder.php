<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class UsersTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('users')->insert([
			[
				'iUserId'			=> 1,
				'eUserRole'			=> "Admin",
				'vFirstName'		=> "Admin",
				'vLastName'			=> "Admin",
				'vEmail'			=> "admin@gmail.com",
				'vPhoneNumber'		=> "9876543210",
				'vPassword'			=> bcrypt('qwerty'),
				'tiStatus'			=> 1,
				'dtCreatedAt'		=> date('Y-m-d H:i:s')
			],
			[
				'iUserId'			=> 2,
				'eUserRole'			=> "Admin",
				'vFirstName'		=> "Purvesh",
				'vLastName'			=> "Patel",
				'vEmail'			=> "purvesh@gmail.com",
				'vPhoneNumber'		=> "9722552298",
				'vPassword'			=> bcrypt('qwerty'),
				'tiStatus'			=> 1,
				'dtCreatedAt'		=> date('Y-m-d H:i:s')
			]
		]);
	}
}
