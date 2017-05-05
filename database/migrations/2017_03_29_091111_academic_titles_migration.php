<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AcademicTitlesMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic_titles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('academic_title');
            $table->timestamps();

            $table->engine = 'InnoDB';
        });

        DB::table('academic_titles')->insert(['academic_title'=>'Prof.Dr.']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('academic_titles');
    }
}
