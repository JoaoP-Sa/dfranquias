<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBovinosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bovinos', function (Blueprint $table) {
            $table->id();
            $table->string('code', 6)->unique();
            $table->float('milk');
            $table->float('food');
            $table->float('weight');
            $table->date('born');
            $table->boolean('shooted_down');
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
        Schema::dropIfExists('bovinos');
    }
}
