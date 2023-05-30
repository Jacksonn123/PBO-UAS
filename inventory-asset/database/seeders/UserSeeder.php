<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Indri Renaldi', 
            'email' => 'indrirenaldi@mail.com',
            'password' => Hash::make('140522'),
            'admin_id' => 'A-001',
            'phone_number'=>'0812345678'
        ]);
            
        $role = Role::first();
        
        $user->assignRole([$role->id]);
    }
}
