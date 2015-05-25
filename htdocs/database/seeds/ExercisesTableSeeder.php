<?php

use Illuminate\Database\Seeder;
use App\Exercise;

class ExercisesTableSeeder extends Seeder {

    public function run() {
        DB::table('exercises')->delete();
        DB::statement('ALTER TABLE exercises AUTO_INCREMENT=1');


        DB::insert('insert into exercises (question, tips, start_code, expected_result, makerId, language) value (?, ?, ?, ?, ?, ?)', [
            'Print \'Hello, world\'.',
            'Submit the answer',
            'print("Hello, world")',
            '^[Hh]ello[,]? [Ww]orld$',
            1,
            'python']);

        DB::insert('insert into exercises (question, tips, start_code, expected_result, makerId, language) value (?, ?, ?, ?, ?, ?)', [
            'Print \'Hello, \'*your name*.',
            'What is your name?',
            'print("")',
            '[hH]ello, [A-Za-z]+',
            1,
            'python'
        ]);

        DB::insert('insert into exercises (question, tips, start_code, expected_result, makerId, language) value (?, ?, ?, ?, ?, ?)', [
            'Using multiple variables.',
            'Take the sentence \'All work and no play makes Jack a dull boy\' and store each word in a seperate variable. Print the sentence on a single line.',
            '"All work and no play makes Jack a dull boy"',
            'All work and no play makes Jack a dull boy',
             2,
            'python'
        ]);

        DB::insert('insert into exercises (question, tips, start_code, expected_result, makerId, language) value (?, ?, ?, ?, ?, ?)', [
            'Add parenthesis to the expression 6 * 1 - 2 to change its value (?, ?, ?, ?, ?, ?) from 4 to -6.',
            'Learn your basic maths!',
            'result = 6 * 1 - 2
print(result)',
            '-6',
            2,
            'python'
        ]);

        DB::insert('insert into exercises (question, tips, start_code, expected_result, makerId, language) value (?, ?, ?, ?, ?, ?)', [
            'Create a function nine_dots(), using the function three_dots().',
            'You can concatenate string with the \'+\'-operator.',
            'def three_dots():
    value (?, ?, ?, ?, ?, ?) = "..."
    return value (?, ?, ?, ?, ?, ?)

print(nine_dots())',
            '^\.\.\.\.\.\.\.\.\.$',
            3,
            'python'
        ]);

        DB::insert('insert into exercises (question, tips, start_code, expected_result, makerId, language) value (?, ?, ?, ?, ?, ?)', [
            'Fill in the body of the function definition for cat_5_times so that it will print the string, s, 5 times',
            'Meow Meow',
            'def cat_5_times(s):
    <fill in your code here>',
            '([A-Za-z0-9]+\n){5}',
            3,
            'python'
        ]);

        DB::insert('insert into exercises (question, tips, start_code, expected_result, makerId, language) value (?, ?, ?, ?, ?, ?)', [
            'Wrap this code in a function called compare(x, y). Call it with a first value (?, ?, ?, ?, ?, ?) that is larger than the second value (?, ?, ?, ?, ?, ?).',
            'x < x+1',
            'if x < y:
    print x, "is less than", y
elif x > y:
    print x, "is greater than", y
else:
    print x, "and", y, "are equal"',
            '[0-9]+ is greater than [0-9]+',
            4,
            'python'
        ]);

        DB::insert('insert into exercises (question, tips, start_code, expected_result, makerId, language) value (?, ?, ?, ?, ?, ?)', [
            'What is the answer to the ultimate question of life, the universe and everything?',
            'It is not 24.',
            'the_answer =
print(the_answer)',
            '42',
            4,
            'python'
        ]);

        DB::insert('insert into exercises (question, tips, start_code, expected_result, makerId, language) value (?, ?, ?, ?, ?, ?)', [
            'Given Fibonacci\'s row, what is the number with index 20',
            'As computer scientists, the first element has index = 0.',
            'number =
print(number)',
            '6765',
            4,
            'python'
        ]);

        DB::insert('insert into exercises (question, tips, start_code, expected_result, makerId, language) value (?, ?, ?, ?, ?, ?)', [
            'Draw a spyrograph using turtles.',
            'Build a function capable of drawing a circle with an arbitrary color and diameter. Call that function repeatedly to draw the spyrograph.',
            'import turtle
alex = turtle.Turtle()
screen = alex.getscreen()
screen.setup(750,750)
alex.speed(0)
def draw_track(r, color):
    i = 0
    while i < 50:
        alex.pencolor(color)
        alex.circle(r)
        alex.right(360/49)
        alex.forward(5)
        i = i + 1
colors = ["green","purple","magenta","blue","yellow","orange","red"]
for color in colors:
    if color == "green":
        r = 140
        draw_track(r, color)
    if color == "purple":
        r = 120
        draw_track(r, color)
    if color == "magenta":
        r = 100
        draw_track(r, color)
    if color == "blue":
        r = 80
        draw_track(r, color)
    if color == "yellow":
        r = 60
        draw_track(r, color)
    if color == "orange":
        r = 40
        draw_track(r, color)
    if color == "red":
        r = 20
        draw_track(r, color)
',
            '*',
            2,
            'python']);
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
        DB::insert('insert into exercises (question, tips, start_code, expected_result, makerId, language) value (?, ?, ?, ?, ?, ?)', [
            'Introduce yourself with C++ classes',
            'Use the C++ reference to learn more about classes',
            '#include<iostream>
class Myclass {
  private:
  	int myint;
  public:
  	Myclass(const int& i){myint = i;};
  	int getInt() {return myint;};
};

int main() {
  	Myclass mc(10);
    std::cout << mc.getInt();
}',
            '*',
            3,
            'cpp'
        ]);

        DB::insert('insert into exercises (question, tips, start_code, expected_result, makerId, language) value (?, ?, ?, ?, ?, ?)', [
            'Convert the following C++ code into Python',
            'You should first learn both languages...',
            '#include <iostream>

int main(){
  std::cout << "Get Rekt..." << std::endl;
}',
            '^Get Rekt...$',
            3,
            'python'
        ]);

        DB::insert('insert into exercises (question, tips, start_code, expected_result, makerId, language) value (?, ?, ?, ?, ?, ?)', [
            'Convert the following Python code to C++',
            'You should first learn both languages...',
            'sum = 0
for i in range(10)
    sum = sum + i
print(i)',
            '^45$',
            3,
            'cpp'
        ]);

    }
}
