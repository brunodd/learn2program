<?php

use Illuminate\Database\Seeder;
use App\Exercise;

class ExercisesTableSeeder extends Seeder {

    public function run() {
        DB::table('exercises')->delete();
        DB::statement('ALTER TABLE exercises AUTO_INCREMENT=1');


        Exercise::create(['question' => 'aaa', 'tips' => 'aaa', 'start_code' => '
name = ""
print("Hello, " + name)', 'expected_result' => 'A', 'serieId' => 1]);
        Exercise::create(['question' => 'bbb', 'tips' => 'bbb', 'start_code' => '
import turtle

alex = turtle.Turtle()
alex.speed(0)

def draw_track(r, color):
    i = 0
    while i < 50:
        alex.circle(r)
        alex.right(360/49)
        alex.forward(5)
        alex.pencolor(color)
        i = i + 1

colors = ["green","purple","magenta","blue","yellow","orange","red"]

for color in colors:        #draws the set of disks using to the draw_track function, adjusting the radius of each set of circles depending on the respective colors.
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
', 'expected_result' => 'B', 'serieId' => 2]);
        Exercise::create(['question' => 'ccc', 'tips' => 'ccc', 'start_code' => '3', 'expected_result' => 'C', 'serieId' => 3]);
    }
}
