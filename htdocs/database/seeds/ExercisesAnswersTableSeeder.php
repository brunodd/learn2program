<?php

use Illuminate\Database\Seeder;
use App\Answer;

class ExercisesAnswersTableSeeder extends Seeder {

    public function run() {
        DB::table('answers')->delete();
        DB::statement('ALTER TABLE answers AUTO_INCREMENT=1');

        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                                VALUES ("xx", true, 1, 1)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                                VALUES ("xx", true, 2, 1)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                                VALUES ("xx", true, 2, 2)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                                VALUES ("xx", true, 1, 5)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                                VALUES ("xx", true, 1, 3)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                                VALUES ("xx", true, 4, 5)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                                VALUES ("xx", true, 10, 10)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                                VALUES ("xx", true, 2, 3)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                                VALUES ("xx", true, 9, 1)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                                VALUES ("xx", true, 2, 10)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                                VALUES ("xx", true, 2, 7)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                                VALUES ("xx", true, 2, 9)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                        		VALUES ("xx", true, 2, 8)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                				VALUES ("xx", true, 2, 3)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                                VALUES ("xx", true, 3, 10)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                                VALUES ("xx", true, 3, 9)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                        		VALUES ("xx", true, 3, 8)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                        		VALUES ("xx", true, 3, 6)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                				VALUES ("xx", true, 3, 3)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                                VALUES ("xx", true, 1, 7)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 4, 1)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                        		VALUES ("xx", true, 4, 2)');
	    DB::insert('INSERT INTO answers (given_code, success, uId, eId)
	            				VALUES ("xx", true, 4, 3)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
       							VALUES ("xx", true, 4, 4)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
            					VALUES ("xx", true, 4, 6)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 5, 1)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                        		VALUES ("xx", true, 5, 2)');
	    DB::insert('INSERT INTO answers (given_code, success, uId, eId)
	            				VALUES ("xx", true, 5, 3)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
       							VALUES ("xx", true, 5, 4)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
            					VALUES ("xx", true, 5, 6)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 5, 7)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 7, 1)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                        		VALUES ("xx", true, 7, 2)');
	    DB::insert('INSERT INTO answers (given_code, success, uId, eId)
	            				VALUES ("xx", true, 7, 3)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
       							VALUES ("xx", true, 7, 4)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
            					VALUES ("xx", true, 7, 6)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 7, 7)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 7, 8)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 9, 1)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                        		VALUES ("xx", true, 9, 2)');
	    DB::insert('INSERT INTO answers (given_code, success, uId, eId)
	            				VALUES ("xx", true, 9, 3)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
       							VALUES ("xx", true, 9, 4)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
            					VALUES ("xx", true, 9, 6)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 9, 7)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 9, 8)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 9, 9)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                        		VALUES ("xx", true, 11, 2)');
	    DB::insert('INSERT INTO answers (given_code, success, uId, eId)
	            				VALUES ("xx", true, 11, 3)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
       							VALUES ("xx", true, 11, 4)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
            					VALUES ("xx", true, 11, 6)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 11, 7)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 11, 8)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 11, 9)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 13, 1)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                        		VALUES ("xx", true, 13, 2)');
	    DB::insert('INSERT INTO answers (given_code, success, uId, eId)
	            				VALUES ("xx", true, 13, 3)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
       							VALUES ("xx", true, 13, 4)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
            					VALUES ("xx", true, 13, 6)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 13, 7)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 13, 8)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 13, 9)');
	    DB::insert('INSERT INTO answers (given_code, success, uId, eId)
	            				VALUES ("xx", true, 15, 3)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
       							VALUES ("xx", true, 15, 4)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
            					VALUES ("xx", true, 15, 6)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 15, 7)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 15, 8)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 15, 9)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 17, 1)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                        		VALUES ("xx", true, 17, 2)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
       							VALUES ("xx", true, 17, 4)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
            					VALUES ("xx", true, 17, 6)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 17, 7)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 17, 8)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 17, 9)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 19, 1)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                        		VALUES ("xx", true, 19, 2)');
	    DB::insert('INSERT INTO answers (given_code, success, uId, eId)
	            				VALUES ("xx", true, 19, 3)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
       							VALUES ("xx", true, 19, 4)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
            					VALUES ("xx", true, 19, 6)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 19, 7)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 19, 8)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 19, 9)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 21, 1)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                        		VALUES ("xx", true, 21, 2)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 21, 7)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 21, 8)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 21, 9)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 23, 1)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                        		VALUES ("xx", true, 23, 2)');
	    DB::insert('INSERT INTO answers (given_code, success, uId, eId)
	            				VALUES ("xx", true, 23, 3)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
       							VALUES ("xx", true, 23, 4)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
            					VALUES ("xx", true, 23, 6)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 23, 7)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 23, 8)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 23, 9)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 25, 1)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                        		VALUES ("xx", true, 25, 2)');
	    DB::insert('INSERT INTO answers (given_code, success, uId, eId)
	            				VALUES ("xx", true, 25, 3)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
       							VALUES ("xx", true, 25, 4)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 25, 9)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 27, 1)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                        		VALUES ("xx", true, 27, 2)');
	    DB::insert('INSERT INTO answers (given_code, success, uId, eId)
	            				VALUES ("xx", true, 27, 3)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
       							VALUES ("xx", true, 35, 4)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
            					VALUES ("xx", true, 35, 6)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 35, 7)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 35, 8)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 35, 9)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 35, 1)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                        		VALUES ("xx", true, 35, 2)');
	    DB::insert('INSERT INTO answers (given_code, success, uId, eId)
	            				VALUES ("xx", true, 35, 3)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
       							VALUES ("xx", true, 35, 4)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
            					VALUES ("xx", true, 35, 6)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 35, 7)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 35, 8)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 35, 9)');
		DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 35,10)');
		DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 35, 5)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
            					VALUES ("xx", true, 36, 6)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 36, 7)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 36, 8)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 36, 9)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 36, 1)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                        		VALUES ("xx", true, 36, 2)');
	    DB::insert('INSERT INTO answers (given_code, success, uId, eId)
	            				VALUES ("xx", true, 36, 3)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
       							VALUES ("xx", true, 36, 4)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
            					VALUES ("xx", true, 36, 6)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 36, 7)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 36, 8)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 36, 9)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 36,10)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 36,11)');
        DB::insert('INSERT INTO answers (given_code, success, uId, eId)
                       	 		VALUES ("xx", true, 36,12)');
    }
}
