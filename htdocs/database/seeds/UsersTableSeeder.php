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
        User::create(['username' => 'raphael', 'mail' => 'r@r.r', 'pass' => bcrypt('raphael'), 'score' => '8',
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
        User::create(['username' => 'fouad', 'mail' => 'f@f.f', 'pass' => bcrypt('fouad'), 'score' => '6', 
            'image' => 'user4ProfileImage.jpg', 'info' => 'Fouad is the graphic designer.']);

        User::create(['username' => 'Sarah', 'mail' => 'SarahRWills@dayrep.com ', 'pass' => bcrypt('Sarah'), 'score' => '7']);
        User::create(['username' => 'Simone', 'mail' => 'SimoneStap@teleworm.us', 'pass' => bcrypt('Simone'), 'score' => '12']);
        User::create(['username' => 'Roef', 'mail' => 'RoefSoetens@jourrapide.com', 'pass' => bcrypt('Roef'), 'score' => '14']);
        User::create(['username' => 'Rahim', 'mail' => 'RahimFloor@teleworm.us', 'pass' => bcrypt('Rahim'), 'score' => '4']);


        User::create(['username' => 'Ikra', 'mail' => 'IkraUlijn@armyspy.com', 'pass' => bcrypt('Ikra'), 'score' => '9']);
        User::create(['username' => 'Marise', 'mail' => 'MariseVeger@armyspy.com', 'pass' => bcrypt('Marise'), 'score' => '10']);
        User::create(['username' => 'Zilan', 'mail' => 'ZilanHebben@teleworm.us', 'pass' => bcrypt('Zilan'), 'score' => '20']);
        User::create(['username' => 'Devin', 'mail' => 'DevinHermelink@jourrapide.com', 'pass' => bcrypt('Devin'), 'score' => '19']);
        User::create(['username' => 'Fiep', 'mail' => 'FiepFloor@dayrep.com', 'pass' => bcrypt('Fiep'), 'score' => '15']);
        User::create(['username' => 'Sue-Ann', 'mail' => 'Sue-AnnMoll@dayrep.com', 'pass' => bcrypt('Sue-Ann'), 'score' => '2']);


        User::create(['username' => 'Evie', 'mail' => 'EvieBerden@jourrapide.com', 'pass' => bcrypt('Evie'), 'score' => '0']);
        User::create(['username' => 'Carel', 'mail' => 'CarelVersteegen@jourrapide.com', 'pass' => bcrypt('Carel'), 'score' => '10']);
        User::create(['username' => 'Anieke', 'mail' => 'AniekeKuijs@jourrapide.com', 'pass' => bcrypt('Anieke'), 'score' => '8']);
        User::create(['username' => 'Sunaina', 'mail' => 'SunainaVerheggen@jourrapide.com', 'pass' => bcrypt('Sunaina'), 'score' => '30']);
        User::create(['username' => 'Azzeddine', 'mail' => 'AzzeddineOosterink@teleworm.us', 'pass' => bcrypt('Azzeddine'), 'score' => '21']);

        User::create(['username' => 'Fedor', 'mail' => 'FedorvanGool@armyspy.com', 'pass' => bcrypt('Fedor'), 'score' => '18']);
        User::create(['username' => 'Alican', 'mail' => 'AlicanvanLeusen@armyspy.com', 'pass' => bcrypt('Alican'), 'score' => '20']);
        User::create(['username' => 'Patty', 'mail' => 'PattyBrak@dayrep.com', 'pass' => bcrypt('Patty'), 'score' => '19']);
        User::create(['username' => 'Shivanie', 'mail' => 'ShivanieSterenborg@armyspy.com', 'pass' => bcrypt('Shivanie'), 'score' => '13']);
        User::create(['username' => 'Menno', 'mail' => 'MennoWesteneng@armyspy.com', 'pass' => bcrypt('Menno'), 'score' => '12']);

        User::create(['username' => 'Shahin', 'mail' => 'ShahinvandenDungen@jourrapide.com', 'pass' => bcrypt('Shahin'), 'score' => '0']);
        User::create(['username' => 'Jorrick', 'mail' => 'JorrickTrommelen@teleworm.us', 'pass' => bcrypt('Jorrick'), 'score' => '27']);
        User::create(['username' => 'Iyas', 'mail' => 'IyasRafidAswad@armyspy.com', 'pass' => bcrypt('Iyas'), 'score' => '8']);
        User::create(['username' => 'Ikraam', 'mail' => 'IkraamAsimahMaalouf@dayrep.com', 'pass' => bcrypt('Ikraam'), 'score' => '22']);
        User::create(['username' => 'Abdel', 'mail' => 'AbdelKazimMorcos@rhyta.com', 'pass' => bcrypt('Abdel'), 'score' => '21']);
        User::create(['username' => 'Stephan', 'mail' => 'StephanWannemaker@jourrapide.com', 'pass' => bcrypt('Stephan'), 'score' => '0']);


        User::create(['username' => 'Karin', 'mail' => 'KarinEichelberger@rhyta.com', 'pass' => bcrypt('Karin'), 'score' => '25']);
        User::create(['username' => 'Laurene', 'mail' => 'LaurenePatel@jourrapide.com', 'pass' => bcrypt('Laurene'), 'score' => '0']);
        User::create(['username' => 'Soren', 'mail' => 'SorenChalifour@teleworm.us', 'pass' => bcrypt('Soren'), 'score' => '30']);
        User::create(['username' => 'Fauna', 'mail' => 'FaunaLeroy@jourrapide.com', 'pass' => bcrypt('Fauna'), 'score' => '0']);

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
