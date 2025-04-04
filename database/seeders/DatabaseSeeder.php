<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Question;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // $user = User::factory()->create([
        //     'name' => 'alex',
        //     'email' => 'test@example.com',
        // ]);



        // User::factory(10)->create();
        $q=new Question();
        $q->question = 'Funciona?';
        $q->answer = 'siiiii!!!';
        $q->user_id = 1;
        $q->save();
    
        
    }
}
