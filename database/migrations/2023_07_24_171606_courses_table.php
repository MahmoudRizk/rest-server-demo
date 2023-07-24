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
        DB::statement("CREATE TABLE courses(    
            id INT primary key not null,
            name TEXT not null
        )");

        DB::statement("INSERT INTO courses (id, name) VALUES (1, 'English')");
        DB::statement("INSERT INTO courses (id, name) VALUES (2, 'Maths')");
        DB::statement("INSERT INTO courses (id, name) VALUES (3, 'Physics')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP IF EXISTS courses");
    }
};
