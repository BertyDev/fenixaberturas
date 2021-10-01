<?php

use App\Models\Order;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('contact');
            $table->string('phone');

            // $table->string('adress')->nullable();            
            // $table->string('references')->nullable();
            // $table->foreignId('department_id')->constrained();
            // $table->foreignId('city_id')->constrained();
            // $table->foreignId('district_id')->constrained();


            $table->enum('status', [
                Order::PENDIENTE,
                Order::RECIBIDO,
                Order::ENVIADO,
                Order::ENTREGADO,
                Order::ANULADO,
            ])->default(Order::PENDIENTE);

            $table->enum('envio_type', [Order::RETIRA, Order::ENVIO]);

            $table->float('shipping_cost');

            $table->float('total');

            $table->json('content');

            $table->json('envio')->nullable();


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
        Schema::dropIfExists('orders');
    }
}
