<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder {

    public function run() {
        // wipe the table clean before populating
        DB::table('users')->delete();
        DB::statement('ALTER TABLE users AUTO_INCREMENT=1');

        User::create(['username' => 'armin', 'mail' => 'a@a.a', 'pass' => bcrypt('armin'), 'score' => '5',
            'image' => 'user1ProfileImage.jpg', 'info' => 'Armin Halilovic is the driving force.']);
        User::create(['username' => 'bruno', 'mail' => 'b@b.b', 'pass' => bcrypt('bruno'), 'score' => '10',
            'image' => 'user2ProfileImage.jpg', 'info' => 'Bruno De Deken is our main design architect.']);
        User::create(['username' => 'raphael', 'mail' => 'r@r.r', 'pass' => bcrypt('raphael'), 'score' => '0',
            'image' => 'user3ProfileImage.jpg', 'info' => "<h3 class=\"container col-md-9 col-md-offset-1\">Introduction:</h3>
<div class=\"container col-md-9 col-md-offset-1\">Raphael Assa is the database designer. Sometimes he spends his time on useless&nbsp;stuff like listening to some music through his own profile page<img src=\"../../js/tinymce/plugins/emoticons/img/smiley-cool.gif\" alt=\"cool\"><iframe src=\"https://www.youtube.com/embed/QMKWwOe7FL4\" width=\"425\" height=\"350\"></iframe></div>
<div class=\"container col-md-9 col-md-offset-1\">&nbsp;</div>
<h3 class=\"container col-md-9 col-md-offset-1\">Pictures</h3>
<div class=\"container col-md-9 col-md-offset-1\">He also like to look at some pictures from time to time...<img src=\"http://www.bankers-anonymous.com/wp-content/uploads/2013/03/Be-Rational-Get-Real.png\" alt=\"\" width=\"436\" height=\"346\"><br><br></div>
<h3 class=\"container col-md-9 col-md-offset-1\">Final Word</h3>
<div class=\"container col-md-9 col-md-offset-1\">Raphael is a huge supporter of the following working method:
<ol style=\"list-style-type: upper-roman;\">
<li><em>Analyse the nature of the problem</em></li>
<li><em>Analyse the possible solutions &amp; choose the most appropriate one</em></li>
<li><em>Apply the solution &amp; adapt to it</em></li>
<li><em>Re-use the first 3 steps &amp; overcome all problems of humanity</em></li>
</ol>
</div> "]);
        User::create(['username' => 'fouad', 'mail' => 'f@f.f', 'pass' => bcrypt('fouad'), 'score' => '0', 
            'image' => 'user4ProfileImage.jpg', 'info' => 'Fouad is the graphic designer.']);
        User::create(['username' => 'u0', 'mail' => 'u0@x.x', 'pass' => bcrypt('u0'), 'score' => '0']);
        User::create(['username' => 'u1', 'mail' => 'u1@x.x', 'pass' => bcrypt('u1'), 'score' => '0']);
        User::create(['username' => 'u2', 'mail' => 'u2@x.x', 'pass' => bcrypt('u2'), 'score' => '0']);
        User::create(['username' => 'u3', 'mail' => 'u3@x.x', 'pass' => bcrypt('u3'), 'score' => '0']);
        User::create(['username' => 'u4', 'mail' => 'u4@x.x', 'pass' => bcrypt('u4'), 'score' => '0']);
        User::create(['username' => 'u5', 'mail' => 'u5@x.x', 'pass' => bcrypt('u5'), 'score' => '0']);
        User::create(['username' => 'u6', 'mail' => 'u6@x.x', 'pass' => bcrypt('u6'), 'score' => '0']);
        User::create(['username' => 'u7', 'mail' => 'u7@x.x', 'pass' => bcrypt('u7'), 'score' => '0']);
        User::create(['username' => 'u8', 'mail' => 'u8@x.x', 'pass' => bcrypt('u8'), 'score' => '0']);
        User::create(['username' => 'u9', 'mail' => 'u9@x.x', 'pass' => bcrypt('u9'), 'score' => '0']);
        User::create(['username' => 'u10', 'mail' => 'u10@x.x', 'pass' => bcrypt('u0'), 'score' => '0']);
        User::create(['username' => 'u11', 'mail' => 'u11@x.x', 'pass' => bcrypt('u1'), 'score' => '0']);
        User::create(['username' => 'u12', 'mail' => 'u12@x.x', 'pass' => bcrypt('u2'), 'score' => '0']);
        User::create(['username' => 'u13', 'mail' => 'u13@x.x', 'pass' => bcrypt('u3'), 'score' => '0']);
        User::create(['username' => 'u14', 'mail' => 'u14@x.x', 'pass' => bcrypt('u4'), 'score' => '0']);
        User::create(['username' => 'u15', 'mail' => 'u15@x.x', 'pass' => bcrypt('u5'), 'score' => '0']);
        User::create(['username' => 'u16', 'mail' => 'u16@x.x', 'pass' => bcrypt('u6'), 'score' => '0']);
        User::create(['username' => 'u17', 'mail' => 'u17@x.x', 'pass' => bcrypt('u7'), 'score' => '0']);
        User::create(['username' => 'u18', 'mail' => 'u18@x.x', 'pass' => bcrypt('u8'), 'score' => '0']);
        User::create(['username' => 'u19', 'mail' => 'u19@x.x', 'pass' => bcrypt('u9'), 'score' => '0']);
        User::create(['username' => 'u110', 'mail' => 'u110@x.x', 'pass' => bcrypt('u0'), 'score' => '0']);
        User::create(['username' => 'u111', 'mail' => 'u111@x.x', 'pass' => bcrypt('u1'), 'score' => '0']);
        User::create(['username' => 'u112', 'mail' => 'u112@x.x', 'pass' => bcrypt('u2'), 'score' => '0']);
        User::create(['username' => 'u113', 'mail' => 'u113@x.x', 'pass' => bcrypt('u3'), 'score' => '0']);
        User::create(['username' => 'u114', 'mail' => 'u114@x.x', 'pass' => bcrypt('u4'), 'score' => '0']);
        User::create(['username' => 'u115', 'mail' => 'u115@x.x', 'pass' => bcrypt('u5'), 'score' => '0']);
        User::create(['username' => 'u116', 'mail' => 'u116@x.x', 'pass' => bcrypt('u6'), 'score' => '0']);
        User::create(['username' => 'u117', 'mail' => 'u117@x.x', 'pass' => bcrypt('u7'), 'score' => '0']);
        User::create(['username' => 'u118', 'mail' => 'u118@x.x', 'pass' => bcrypt('u8'), 'score' => '0']);
        User::create(['username' => 'u119', 'mail' => 'u119@x.x', 'pass' => bcrypt('u9'), 'score' => '0']);

        //For each user, create a conversation with themselves

        for ($x = 1; $x < 5; $x++) {
            DB::insert('INSERT INTO conversations VALUE ()');
            $conversationId = \DB::select('SELECT id FROM conversations ORDER BY id DESC LIMIT 1')[0]->id;
            echo $conversationId;
            \DB::insert('INSERT INTO conversations_participants (conversationId, userId) VALUE (?, ?)', [$conversationId, $x]);
        }
    }
    /*
    public function runn() {
        DB::table('users')->delete();

        $projects = array(
            ['id' => 1, 'username' => 'armin', 'mail' => 'a@a.a', 'pass' => bcrypt('armin')],
            ['id' => 2, 'username' => 'bruno', 'mail' => 'b@b.b', 'pass' => bcrypt('bruno')],
            ['id' => 3, 'username' => 'raphael', 'mail' => 'r@r.r', 'pass' => bcrypt('raphael')],
            ['id' => 4, 'username' => 'fouad', 'mail' => 'f@f.f', 'pass' => bcrypt('fouad')]
        );

        DB::table('projects')->insert($projects);
    }*/
}
