<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChecklistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checklists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('gig_id')->nullable();
            $table->text('milestone');
            $table->boolean('done')->default(0);
            $table->timestamps();
            
            
        });
        Schema::table('checklists', function(Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users');
          
 
        });
        Schema::table('checklists', function(Blueprint $table){
            $table->foreign('gig_id')->references('gig_id')->on('gigs');
          
 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checklists');
    }
}
