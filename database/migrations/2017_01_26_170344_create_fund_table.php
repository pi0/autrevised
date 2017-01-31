<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFundTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funds', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->integer('rating');
            $table->string('acceptance');
            $table->text('description');
            $table->text('duration');
            $table->text('financial');
            $table->text('requirements');
            $table->text('deadline');
            $table->text('link1');
            $table->text('link2');
            $table->text('memo');
            $table->text('farsi');
            $table->text('comments');
            $table->integer('organization_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
