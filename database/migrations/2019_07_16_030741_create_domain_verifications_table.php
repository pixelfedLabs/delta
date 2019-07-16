<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDomainVerificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domain_verifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->index();
            $table->string('domain')->index();
            $table->string('verification_code')->index();
            $table->timestamp('domain_verified_at')->nullable();
            $table->timestamp('verify_again_after')->nullable();
            $table->unsignedInteger('verify_count')->nullable();
            $table->boolean('invalid_domain')->default(false);
            $table->unique(['user_id', 'domain']);
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
        Schema::dropIfExists('domain_verifications');
    }
}
