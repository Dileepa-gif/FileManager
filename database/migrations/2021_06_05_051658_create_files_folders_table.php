<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesFoldersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files_folders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('files_id')->unsigned();
            $table->bigInteger('folders_id')->unsigned();
            $table->boolean('is_belong');
            $table->timestamps();
            $table->foreign('files_id')->references('id')->on('files')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('folders_id')->references('id')->on('folders')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files_folders');
    }
}
