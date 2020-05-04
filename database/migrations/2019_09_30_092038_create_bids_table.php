<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bids', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('g_id')->nullable();
            $table->string('project_period');
            $table->text('cover_letter');
            $table->string('amount');
            $table->smallInteger('status')->default(0);
            $table->timestamps();
        });
        Schema::table('bids', function(Blueprint $table){
            $table->foreign('g_id')->references('gig_id')->on('gigs');
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
        Schema::dropIfExists('bids');
    }
}
