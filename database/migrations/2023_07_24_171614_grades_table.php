<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE TABLE grades(
            id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            student_id INT not null,
            course_id INT not null,
            grade TEXT,
            foreign key(student_id) references students(id),
            foreign key(course_id) references courses(id)
        )");

        DB::statement("INSERT INTO grades (id, student_id, course_id, grade) VALUES (1, 1, 1, 'A')");
        DB::statement("INSERT INTO grades (id, student_id, course_id, grade) VALUES (2, 1, 2, 'B')");
        DB::statement("INSERT INTO grades (id, student_id, course_id, grade) VALUES (3, 2, 1, 'C')");
        DB::statement("INSERT INTO grades (id, student_id, course_id, grade) VALUES (4, 2, 2, 'B')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {   
        DB::statement("DROP IF EXISTS grades");
    }
};
