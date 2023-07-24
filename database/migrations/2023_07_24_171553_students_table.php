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
        DB::statement("CREATE TABLE students (  
            id INT primary key not null,
            name TEXT not null,
            email TEXT not null,
            phone TEXT not null
        )");


        DB::statement("INSERT INTO students (id, name, email, phone) VALUES (1, 'Ahmed', 'ahmed@test.com', '+201000000001')");
        DB::statement("INSERT INTO students (id, name, email, phone) VALUES (2, 'Mostafa', 'mostafa@test.com', '+201000000002')");
        DB::statement("INSERT INTO students (id, name, email, phone) VALUES (3, 'Rawan', 'rawan@test.com', '+201000000003')");
        DB::statement("INSERT INTO students (id, name, email, phone) VALUES (4, 'Tarek', 'tarek@test.com', '+201000000004')");
        DB::statement("INSERT INTO students (id, name, email, phone) VALUES (5, 'Mariam', 'mariam@test.com', '+201000000005')");
        DB::statement("INSERT INTO students (id, name, email, phone) VALUES (6, 'Salah', 'salas@test.com', '+201000000006')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP IF EXISTS students");
    }
};
