<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConstructsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('constructs', function (Blueprint $table) {
            $table->id();
            $table->string("location");
            $table->string("office")->nullable();
            $table->string("hashtag");
            $table->string("detail");
            $table->string("real_work_time")->nullable();
            $table->string("editor");
            $table->string("business_name");
            $table->string("route");
            $table->tinyInteger("remind_flag")->default(0);
            $table->tinyInteger("flag")->default(0);
            $table->string("bus_station");
            $table->tinyInteger("bus_relocation_flag")->default(0);
            $table->string("remarks")->nullable();
            $table->datetime("started_at");
            $table->datetime("ended_at")->nullable();
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
        Schema::dropIfExists('constructs');
    }
}
