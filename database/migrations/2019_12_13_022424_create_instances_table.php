<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->nullable()->index();
            $table->bigInteger('team_id')->unsigned()->nullable()->index();
            $table->string('name')->nullable();
            $table->string('domain')->nullable();
            $table->text('description')->nullable();
            $table->bigInteger('post_count')->unsigned()->nullable()->index();
            $table->bigInteger('user_count')->unsigned()->nullable()->index();
            $table->json('nodeinfo')->nullable();
            $table->timestamp('approved_at')->nullable();
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
        Schema::dropIfExists('instances');
    }
}
