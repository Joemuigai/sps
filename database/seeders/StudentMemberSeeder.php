<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use App\Models\PasswordReset;
use App\Models\StudentMember;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StudentMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $numMembers = 30; // Define the number of student members to seed

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < $numMembers; $i++) {
            $firstName = $faker->firstName();
            $lastName = $faker->lastName();
            $username = strtolower(substr($firstName, 0, 1) . $lastName);
            $email = strtolower($firstName . '.' . $lastName . '@strathmore.edu');

            $user = User::where('username', $username)->first();

            if ($user) {
                continue; // Skip this iteration if the user already exists
            }

            // Create a new user
            $user = new User;
            $user->first_name = $firstName;
            $user->last_name = $lastName;
            $user->username = $username;
            $user->email = $email;
            $user->password = Hash::make('Password@2030.');

            // Assign Role
            $userRole = Role::where('name', 'Student')->first();
            $user->assignRole($userRole);

            // Generate an email password reset token
            $token = Str::random(64);

            // Insert email and token in password resets table
            $passwordResetToken = PasswordReset::where('email', $email)->first();
            if ($passwordResetToken) {
                PasswordReset::where('email', $email)->update([
                    'email' => $email,
                    'token' => $token,
                ]);
            } else {
                PasswordReset::create([
                    'email' => $email,
                    'token' => $token,
                ]);
            }

            $faculties = [
                'SCES',
                'SIMS',
                'SBS',
                'SLS',
                'SI',
                'STH',
                'SHSS'
            ];

            // Save the new user and add to the student members table
            if ($user->save()) {

                $student_member = StudentMember::create([
                    'user_id' => $user->id,
                    'student_id' => $faker->unique()->numberBetween(110000, 399999),
                    'expiry_date' => $faker->date(),
                    'national_id' => $faker->numerify('###############'),
                    'passport_no' => $faker->numerify('###############'),
                    'first_name' => $firstName,
                    'middle_name' => null,
                    'last_name' => $lastName,
                    'email' => strtolower($firstName . '.' . $lastName  . '@strathmore.edu'),
                    'disabled' => $faker->randomElement(['Yes', 'No']),
                    'mobile' => '+2547' . mt_rand(10, 99) . mt_rand(1000000, 9999999),
                    'address' => $faker->address(),
                    'course_faculty' => $faker->randomElement($faculties),
                    'mode_of_study' => $faker->randomElement(['Day', 'Evening']),
                ]);
            }
        }






    }
}
