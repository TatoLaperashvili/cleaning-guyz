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
        Schema::create('allowance_answers', function (Blueprint $table) {
            $table->id();
            $table->json('answers');
            $table->unsignedBigInteger('allowance_id');
            $table->unsignedBigInteger('user_id');
            $table->enum('status',['pending', 'questioned', 'accepted', 'declined'])->default('pending');
            $table->text('message')->nullable();
            $table->softDeletes();
            $table->timestamps();

           
            $table->foreign('allowance_id')->references('id')->on('allowances');
            $table->foreign('user_id')->references('id')->on('users');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('allowance_answers');
    }
};
