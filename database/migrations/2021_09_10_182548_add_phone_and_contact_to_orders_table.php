<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPhoneAndContactToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('contact');
            $table->string('phone');
            $table->string('references')->nullable();

            // change nulleable columns
            $table->string('adress')->nullable()->change();
            $table->foreignId('department_id')->nullable()->change();
            $table->foreignId('city_id')->nullable()->change();
            $table->foreignId('district_id')->nullable()->change();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('contact');
            $table->dropColumn('phone');
        });
    }
}
