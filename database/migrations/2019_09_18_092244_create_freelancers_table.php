<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFreelancersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('freelancers', function (Blueprint $table) {
            $table->bigIncrements('freelancer_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('skills')->nullable();
            $table->text('bio')->nullable();
            $table->string('level_type')->nullable();
            $table->text('bid')->nullable();
            $table->smallInteger('status')->default(0);
            $table->string('profile_photo')->nullable();
            $table->dateTime('moderated_at')->nullable();

            $table->timestamps();
        });

        Schema::table('freelancers', function(Blueprint $table){
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
        Schema::dropIfExists('freelancers');
    }
}
