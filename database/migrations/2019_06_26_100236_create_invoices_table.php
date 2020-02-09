<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('customer_type',['register', 'non-register']);
            $table->integer('customer_id')->nullable();
            $table->integer('sale_id');
            $table->decimal('total', 10, 2);
            $table->decimal('discount', 10, 2);
            $table->decimal('grand_total', 10, 2)->nullable();
            $table->decimal('return_amount', 10, 2);
            $table->decimal('due_amount', 10, 2);
            $table->decimal('pay_amount', 10, 2);
            $table->decimal('pay_method', 10, 2);
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
        Schema::dropIfExists('invoices');
    }
}
