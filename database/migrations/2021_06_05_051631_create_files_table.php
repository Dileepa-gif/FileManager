<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('data_name',36);
            $table->string('real_name',45)->nullable();
            $table->string('file_type',10);
            $table->integer('size');
            $table->string('file_description')->nullable();
            $table->string('path');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->boolean('see_in_gallery')->default(true);
            $table->boolean('see_in_homepage')->default(false);
            $table->boolean('approval')->default(false);
            $table->boolean('hidden_for_member')->default(false);
            $table->boolean('hidden_for_visitor')->default(true);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}
