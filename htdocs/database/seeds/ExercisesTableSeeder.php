<?php

use Illuminate\Database\Seeder;
use App\Exercise;

class ExercisesTableSeeder extends Seeder {

    public function run() {
        DB::table('exercises')->delete();
        DB::statement('ALTER TABLE exercises AUTO_INCREMENT=1');


        Exercise::create([
            'question' => 'Print \'Hello, world\'.',
            'tips' => 'Submit the answer',
            'start_code' =>
                'print("Hello, world")',
            'expected_result' =>
'Hello, world',
            'makerId' => 1]);

        Exercise::create([
            'question' => 'Print \'Hello, \'*your name*.',
            'tips' => 'What is your name?',
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
            'makerId' => 3
        ]);

        Exercise::create([
            'question' => 'Fill in the body of the function definition for cat_n_times so that it will print the string, s, n times',
            'tips' => 'Meow Meow',
            'start_code' =>
'def cat_5_times(s):
    <fill in your code here>',
            'expected_result' =>
'[A-Za-z0-9]{5}',
            'makerId' => 3
        ]);

        Exercise::create([
            'question' => 'Wrap this code in a function called compare(x, y). Call it with a first value that is larger than the second value.',
            'tips' => 'x < x+1',
            'start_code' =>
'if x < y:
    print x, "is less than", y
elif x > y:
    print x, "is greater than", y
else:
    print x, "and", y, "are equal"',
            'expected_result' =>
'[0-9]+ is greater than [0-9]+',
            'makerId' => 4
        ]);

        Exercise::create([
            'question' => 'What is the answer to the ultimate question of life, the universe and everything?',
            'tips' => 'It is not 24.',
            'start_code' => 'the_answer =
print(the_answer)',
            'expected_result' =>
'42',
            'makerId' => 4
        ]);

        Exercise::create([
            'question' => 'Given Fibonacci\'s row, what is the number with index 20',
            'tips' => 'As computer scientists, the first element has index = 0.',
            'start_code' => 'number = 
print(number)',
            'expected_result' =>
'6765',
            'makerId' => 4
        ]);

//         Exercise::create([
//             'question' => '',
//             'tips' => '',
//             'start_code' => '',
//             'expected_result' =>
// '',
//             'makerId' => 2
//         ]);

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
