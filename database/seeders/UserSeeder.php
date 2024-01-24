<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $email = config('seeder.superadmin_email') ?? null;
        $password = config('seeder.superadmin_password') ?? null;
        $phone = config('seeder.superadmin_phone', '') ?? null;

        if($email && $password) {
            $user = User::firstOrCreate(
                ['email'=>$email],
                [
                    'name' => 'Superadmin',
                    'surname' => 'Superadmin',
                    'phone' => $phone,
                    'job_title' => 'Superadmin',
                    'password' => Hash::make($password),
                ]);

            $user->assignRole('super-admin');
            $user->assignRole('admin');
        }
    }
}
