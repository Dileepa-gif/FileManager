<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileSubmissionFileTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_submission_file_types', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('file_submission_id')->unsigned();
            $table->bigInteger('file_types_id')->unsigned();
            $table->foreign('file_submission_id')->references('id')->on('file_submissions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('file_types_id')->references('id')->on('file_types')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('file_submission_file_types');
    }
}
