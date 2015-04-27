<?php

use Illuminate\Database\Seeder;
use App\Exercise;

class ExercisesTableSeeder extends Seeder {

    public function run() {
        DB::table('exercises')->delete();
        DB::statement('ALTER TABLE exercises AUTO_INCREMENT=1');


        Exercise::create([
            'question' => 'Print \'Hello, world\'.',
            'tips' => 'hi
i
am
a
tip
this
is
here
for
testing
?????????????????????????????????????????????????????????????????????????????????????????
a
a
a
a
aa

aa
a
a
a
a
aaa
a
a
a
aa
a
a
a

a
a

a
a
a

aa
a

and
stuff
you
know
what
i
mean
,
right
??????????????????????????????????????????????????????????????????????????????????????????',
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
            'makerId' => 3
        ]);

        Exercise::create([
            'question' => 'Fill in the body of the function definition for cat_n_times so that it will print the string, s, n times',
            'tips' => '',
            'start_code' =>
'def cat_5_times(s):
    <fill in your code here>',
            'expected_result' =>
'[A-Za-z0-9]{5}',
            'makerId' => 3
        ]);

        Exercise::create([
            'question' => 'Wrap this code in a function called compare(x, y). Call it with a first value that is larger than the second value.',
            'tips' => '',
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
