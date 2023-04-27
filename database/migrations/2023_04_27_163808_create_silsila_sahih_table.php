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
        Schema::create('silsila_sahih', function (Blueprint $table) {
            $table->id();
            $table->integer('hadees_number');
            $table->text('book_name_en')->nullable();
            $table->text('book_name_ur')->nullable();
            $table->text('book_chapter_en')->nullable();
            $table->text('book_chapter_ur')->nullable();
            $table->text('hadees_ur');
            $table->text('hadees_ar');
            $table->text('hadees_en');
            $table->string('status_en')->nullable();
            $table->string('status_ur')->nullable();
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
        Schema::dropIfExists('silsila_sahih');
    }
};
