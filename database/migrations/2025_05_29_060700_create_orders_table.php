<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('paket_id')->constrained();
            $table->date('event_date');
            $table->text('catatan')->nullable();
            $table->string('status')->default('menunggu'); // menunggu, disetujui, lunas
            $table->string('metode_pembayaran')->default('cod');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}