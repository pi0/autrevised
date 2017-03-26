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
            $table->string('name')->unique();
            $table->integer('rating');
            $table->string('acceptance')->nullable();
            $table->text('description')->nullable();
            $table->text('duration')->nullable();
            $table->text('financial')->nullable();
            $table->text('requirements')->nullable();
            $table->text('deadline')->nullable();
            $table->text('link1')->nullable();
            $table->text('link2')->nullable();
            $table->text('memo')->nullable();
            $table->text('farsi');
            $table->text('comments')->nullable();
            $table->boolean('visible')->default(true);
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
