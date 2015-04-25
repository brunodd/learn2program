<?php

use Illuminate\Database\Seeder;
use App\Exercise;

class ExercisesTableSeeder extends Seeder {

    public function run() {
        DB::table('exercises')->delete();
        DB::statement('ALTER TABLE exercises AUTO_INCREMENT=1');


        Exercise::create([
            'question' => 'Print \'Hello, world\'.',
            'tips' => 'Click the button',
            'start_code' =>
                'print("Hello, world")',
            'expected_result' =>
'Hello, world',
            'makerId' => 1]);

        Exercise::create([
            'question' => 'Print \'Hello, \'*your name*.',
            'tips' => '',
            'start_code' => 'print("")',
            'expected_result' => 
'[hH]ello, [A-Za-z]+',
            'makerId' => 1
        ]);

        Exercise::create([
            'question' => 'Using multiple variables.',
            'tips' => 'Take the sentence \'All work and no play makes Jack a dull boy\' and store each word in a seperate variable. Print the sentence on a single line.',
            'start_code' => '"All work and no play makes Jack a dull boy"',
            'expected_result' => 
'All work and no play makes Jack a dull boy',
            'makerId' => 2
        ]);

        Exercise::create([
            'question' => 'Add parenthesis to the expression 6 * 1 - 2 to change its value from 4 to -6.',
            'tips' => 'Learn your basic maths!',
            'start_code' => 
'result = 6 * 1 - 2
print(result)',
            'expected_result' => 
'-6',
            'makerId' => 2
        ]);

        Exercise::create([
            'question' => 'Create a function nine_dots(), using the function three_dots().',
            'tips' => 'You can concatenate string with the \'+\'-operator.',
            'start_code' => 
'def three_dots():
    value = "..."
    return value

print(nine_dots())',
            'expected_result' =>
'.........',
            'makerId' => 2
        ]);

//         Exercise::create([
//             'question' => '',
//             'tips' => '',
//             'start_code' => '',
//             'expected_result' => 
// '',
//             'makerId' => 2
//         ]);

    }
}
