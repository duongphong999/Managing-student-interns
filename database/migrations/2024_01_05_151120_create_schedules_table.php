<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('class_name', 50);
            $table->string('subject');
            $table->string('teacher');
            $table->enum('frametime', ['0', '1']);
            $table->float('starttime', 8, 2);
            $table->float('endtime', 8, 2);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('note')->nullable();
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
        Schema::dropIfExists('schedules');
    }
};
