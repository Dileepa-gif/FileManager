<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoldersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('folders', function (Blueprint $table) {
            $table->id();
            $table->string('folder_name',65);
            $table->string('folder_description')->nullable();
            $table->bigInteger('admin_id')->unsigned()->nullable();
            $table->boolean('gallery')->default(false);
            $table->boolean('separate')->default(false);
            $table->boolean('hidden_for_member')->default(false);
            $table->boolean('hidden_for_visitor')->default(true);
            $table->string('cover_image_path');
            $table->timestamps();
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('folders');
    }
}
