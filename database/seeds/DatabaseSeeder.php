<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(GroupsTableSeeder::class);
        $this->command->info('Groups table seeded!');

        $this->call(UsersTableSeeder::class);
        $this->command->info('Users table seeded!');

        Model::reguard();
    }
}

class GroupsTableSeeder extends Seeder
{
    public function run()
    {
	DB::table('groups')->insert([
	    [ 
		'name' => 'adminUser',   
		'created_at' => \Carbon\Carbon::now()->toDateTimeString(),   
		'updated_at' => \Carbon\Carbon::now()->toDateTimeString()   
	    ],
	    [ 
		'name' => 'regularUser', 
		'created_at' => \Carbon\Carbon::now()->toDateTimeString(),   
		'updated_at' => \Carbon\Carbon::now()->toDateTimeString()   
	    ]
	]);
    }
}

class UsersTableSeeder extends Seeder
{
    public function run()
    {
	DB::table('users')->insert([
	    [
		'name' => 'adminUser',
		'password' => 'supersecret1',
		'created_at' => \Carbon\Carbon::now()->toDateTimeString(),   
		'updated_at' => \Carbon\Carbon::now()->toDateTimeString()   
    	    ],
	    [
		'name' => 'regularUser',
		'password' => 'secret1',
		'created_at' => \Carbon\Carbon::now()->toDateTimeString(),   
		'updated_at' => \Carbon\Carbon::now()->toDateTimeString()   
	    ]
	]);
    }
}
