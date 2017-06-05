<?php

use App\Models\Interest;
use Illuminate\Database\Seeder;

class InterestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Interest::truncate();

        $interests = ['Dance', 'Travel', 'Arts', 'Sports'];

        foreach ($interests as $interest) {
            Interest::create([
                'name'  =>  $interest
            ]);
        }
    }
}
