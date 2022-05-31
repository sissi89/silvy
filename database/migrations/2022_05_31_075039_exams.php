<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Exams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams',function (Blueprint $table){
            // attributo quale attributo deve essere aggangiato in quale entità
            $table->id('id');
            $table->unsignedBigInteger('student');
           
            $table->unsignedBigInteger('subject');
            $table->unsignedBigInteger('teacher');
            $table->unsignedBigInteger('valutation');

          
            // chiavi esterne 
              $table->foreign('subject')->references('id')->on('subjects')->onDelete('CASCADE'); // materia
           $table->foreign('teacher')->references('id')->on('teachers')->onDelete('CASCADE'); // teacher
           $table->foreign('student')->references('id')->on('students')->onDelete('CASCADE'); // teacher 
            $table->timestamps();  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
