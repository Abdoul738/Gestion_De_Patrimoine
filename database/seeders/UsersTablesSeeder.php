<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
// use App\User;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'    => 'Abdoul Nana',
            'email'    => 'faycalnana1@gmail.com',
            'password'   =>  Hash::make('password'),
        ]);
    }
}