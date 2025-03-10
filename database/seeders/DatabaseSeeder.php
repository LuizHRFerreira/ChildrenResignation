<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Holding;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\File;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;
use App\Models\Crianca;


class DatabaseSeeder extends Seeder
{
    
    public function run(): void
    {
        \DB::table('roles')->insert([
            'name' => 'employee',
            'guard_name' => 'employee'
        ]);

        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);

        DB::table('holding')->insert([
            'name' => "message", 
        ]);        

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'holding_id' => env("APP_ID"),
            'password' => Hash::make('admin')
        ]);

        Permission::firstOrCreate(['name' => 'edit posts']);

        $user = User::find(1);
        $user->assignRole('admin');
        $user->givePermissionTo('edit posts');
    
    }
}
