<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Leaves extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->integer('days');
            $table->string('type')->default('annual');
            $table->date('start');
            $table->string('phone')->nullable();
            $table->string('reason')->nullable();
            $table->string('address')->nullable();
            $table->integer('holidays')->default(0);

            $table->string('decl')->nullable();
            $table->string('decl_sig')->nullable();
            $table->date('decl_date')->nullable();
            $table->date('decl_name')->nullable();
            $table->date('decl_email')->nullable();
            $table->string('super_sig')->nullable();
            $table->date('super_date')->nullable();
            $table->string('super_name')->nullable();
            $table->string('super_email')->nullable();
            $table->string('hod_sig')->nullable();
            $table->date('hod_date')->nullable();
            $table->string('hod_name')->nullable();
            $table->string('hod_email')->nullable();
            $table->string('hr_sig')->nullable();
            $table->date('hr_date')->nullable();
            $table->string('hr_name')->nullable();
            $table->string('hr_email')->nullable();
            $table->string('status')->nullable();
            
            $table->timestamps(); // created_at, modified_at
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
        Schema::dropIfExists('leaves');
    }
}
