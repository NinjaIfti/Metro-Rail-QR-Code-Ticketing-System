<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('ticket_number')->unique();
            $table->string('from_station');
            $table->string('to_station');
            $table->dateTime('journey_date');
            $table->time('departure_time');
            $table->time('arrival_time');
            $table->integer('number_of_passengers')->default(1);
            $table->decimal('fare', 8, 2);
            $table->string('qr_code')->nullable();
            $table->enum('status', ['active', 'used', 'cancelled'])->default('active');
            $table->enum('payment_status', ['paid', 'unpaid'])->default('unpaid');
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
        Schema::dropIfExists('tickets');
    }
};
