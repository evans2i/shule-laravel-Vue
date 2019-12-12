<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use App\Models\Level;
use App\Models\Staff;
use App\Models\Result;
use App\Models\Stream;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'last_name' => $faker->name,
        'middle_name' => $faker->name,
        'phone' => $faker->numberBetween(1, 100),
        'email' => $faker->unique()->safeEmail,
        'gender' => $faker->randomElement(['male', 'female']),
        'middle_name' => $faker->name,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});
$factory->define(Stream::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->paragraph(),
        'created_at' => $faker->date('Y-m-d H:i:s'),
    ];
});
$factory->define(Staff::class, function (Faker $faker) {

    return [
        'position' => $faker->randomElement([Staff::SUPPORTIVE, Staff::TEACHING]),
        'qualification' => $faker->word,
        'user_id' => User::all()->random()->id,
        'employed_date' => $faker->date('Y-m-d H:i:s'),
        'entered_by_id' => 1,
        'description' => $faker->paragraph(),
        'created_at' => $faker->date('Y-m-d H:i:s'),
    ];
});

$factory->define(Student::class, function (Faker $faker) {
	$staff = User::has('staff')->get()->random();
    $student = User::all()->except($staff->id)->random();
    return [
        'parent_name' => $faker->name,
        'parent_work' => $faker->word,
        'user_id' => $student->id,
        'status' => $faker->randomElement(['active', 'passive']),
        'birth_date' => $faker->date('Y-m-d'),
        'date_registered' => $faker->date('Y-m-d H:i:s'),
        'stream_id' => Stream::all()->random()->id,
        'entered_by_id' => 1,
        'created_at' => $faker->date('Y-m-d H:i:s'),
    ];
});

$factory->define(Level::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->paragraph(),
        'created_at' => $faker->date('Y-m-d H:i:s'),
    ];
});

$factory->define(Subject::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->paragraph(),
        'created_at' => $faker->date('Y-m-d H:i:s'),
    ];
});

$factory->define(Result::class, function (Faker $faker) {
    return [
        'marks' => $faker->numberBetween(0, 100),
        'subject_id' => Subject::all()->random()->id,
        'level_id' => Level::all()->random()->id,
        'student_id' => Student::all()->random()->id,
        'stream_id' => Stream::all()->random()->id,
        'created_at' => $faker->date('Y-m-d H:i:s'),
    ];
});
