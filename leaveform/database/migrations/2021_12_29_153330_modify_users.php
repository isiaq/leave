<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddshifttousersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('cadre')->default('officer');
            $table->string('shift')->default('morning');
            $table->string('StaffID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('cadre')->nullable();
            $table->dropColumn('shift')->nullable();
            $table->dropColumn('StaffID')->nullable();
        });
    }
}
