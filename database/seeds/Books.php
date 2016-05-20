<?php

use Illuminate\Database\Seeder;
use App\Book;

class Books extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		$faker = Faker\Factory::create(); 
 
        foreach(range(1,30) as $index)
        {
            Book::create([                
                'isbn' => $faker->randomNumber($nbDigits = 7),
                'title'=> $faker->sentence($nbWords = 5),
                'description'=> $faker->paragraph($nbSentences = 3),
                'author'=> $faker->name,
                'publisher'=> $faker->company,
                'amount'=> $faker->randomFloat($nbMaxDecimals = 3, $min = 10, $max = 100) // 48.8932
            ]);
        }

    }
}
