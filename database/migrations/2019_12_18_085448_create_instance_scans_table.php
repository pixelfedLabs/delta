<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstanceScansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instance_scans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('instance_id')->unsigned()->nullable();
            $table->string('domain')->nullable()->index();
            $table->bigInteger('user_count')->unsigned()->nullable();
            $table->bigInteger('post_count')->unsigned()->nullable();
            $table->bigInteger('mau_count')->unsigned()->nullable();
            $table->json('nodeinfo')->nullable();
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
        Schema::dropIfExists('instance_scans');
    }
}
