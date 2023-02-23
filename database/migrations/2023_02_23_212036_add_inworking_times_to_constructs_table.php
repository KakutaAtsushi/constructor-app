<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInworkingTimesToConstructsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('constructs', function (Blueprint $table) {
            $table->time("inworking_start_time")->nullable();
            $table->time("inworking_end_time")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('constructs', function (Blueprint $table) {
            $table->time("inworking_end_time");
        });
    }
}
