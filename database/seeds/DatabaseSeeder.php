<?php

use App\Role;
use App\User;
use App\Models\Level;
use App\Models\Staff;
use App\Models\Result;
use App\Models\Stream;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        User::truncate();
        Stream::truncate();
        Staff::truncate();
        Student::truncate();
        Level::truncate();
        Subject::truncate();
        Result::truncate();
        // DB::table('user_role')->truncate();

        $userno = 200;
        $staffno = 30;
        $studentno = 170;
        $result = 10000;
        $streamno = 30;
        $levelno = 8;
        $subj = 14;
        // $this->call(UsersTableSeeder::class);
        $this->call(LaratrustSeeder::class);

        factory(User::class, $userno)->create();
        factory(Stream::class, $streamno)->create();
        factory(Staff::class, $staffno)->create();
        factory(Student::class, $studentno)->create();
        factory(Level::class, $levelno)->create();
        factory(Subject::class, $subj)->create();
        factory(Result::class, $result)->create();
        
        Staff::all()->each(
            function($staff){
                $streams = Stream::all()->random(mt_rand(1,2))->pluck('id');
                $staff->streams()->attach($streams);
            }
        );

        Stream::all()->each(
            function($stream){
                $levels = Level::all()->random(mt_rand(1,2))->pluck('id');
                $stream->levels()->attach($levels);
            }
        );
        
        Level::all()->each(
            function ($level) {
                $subject = Subject::all()->pluck('id');
                $level->subjects()->attach($subject);
            }
        );

        Staff::all()->each(
            function($staff){
                $subject = Subject::all()->random(mt_rand(1,2))->pluck('id');
                $staff->subjects()->attach($subject);
            }
        );

        User::has('staff')->each(
            function($user){
                $roles = Role::whereName('staff')->first();
                if ($user->id >= 5) {
                    $user->roles()->attach($roles);
                }
                
            }
        );

        User::has('student')->each(
            function($user){
                $roles = Role::whereName('student')->first();
                if ($user->id >= 5) {
                    $user->roles()->attach($roles);
                }
                
            }
        );
    }
}
