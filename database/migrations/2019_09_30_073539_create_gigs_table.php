<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gigs', function (Blueprint $table) {
            $table->bigIncrements('gig_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('gig_name');
            $table->text('gig_description');
            $table->string('gig_duration');
            $table->integer('gig_payment');
            $table->string('project_files')->nullable();
            $table->boolean('is_complete')->nullable();


            $table->timestamps();
        });

        // Schema::create('client_freelancer', function (Blueprint $table) {
         
        //     $table->integer('freelancer_id');
        //     $table->integer('client_id');
        //     $table->primary(['freelancer_id','client_id']);
        // });

        Schema::table('gigs', function(Blueprint $table){
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
        Schema::dropIfExists('gigs');
    }
}
