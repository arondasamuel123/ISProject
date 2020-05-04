<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {

            $table->bigIncrements('client_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('company_name')->nullable();
            $table->text('bio')->nullable;
            $table->string('kra_pin')->nullable();
            $table->string('company_cert')->nullable();
            $table->smallInteger('status')->default(0);
            $table->dateTime('moderated_at')->nullable();
            $table->timestamps();
        });

        Schema::table('clients', function(Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
          
 
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
