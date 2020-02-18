<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReturnProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('customer_id')->nullable();
            $table->integer('sale_id');
            $table->decimal('total', 10, 2);
            $table->decimal('discount', 10, 2)->nullable();;
            $table->decimal('grand_total', 10, 2)->nullable();
            $table->decimal('return_amount', 10, 2);
            $table->decimal('due_amount', 10, 2)->nullable();
            $table->string('pay_method');
            $table->decimal('check_no','20')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('check_owner_name')->nullable();
            $table->decimal('card_invoice_no')->nullable();
            $table->string('card_owner_name')->nullable();
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
        Schema::dropIfExists('return_products');
    }
}
