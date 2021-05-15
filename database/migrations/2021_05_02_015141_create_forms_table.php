<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forms', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['KTI', 'EXT', 'REG']);
            $table->foreignId('laboratory_id')->constrained();
            $table->string('theme')->nullable();
            $table->integer('practicians');
            $table->string('lecturer');
            $table->string('subject');
            $table->boolean('is_reportable');
            $table->date('practice_date');
            $table->time('practice_start_time');
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
        Schema::dropIfExists('forms');
    }
}
