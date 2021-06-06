<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileSubmissionListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_submission_lists', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('file_submission_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->boolean('status')->default(false);
            $table->string('data_name',36)->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('file_submission_id')->references('id')->on('file_submissions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('file_submission_lists');
    }
}
