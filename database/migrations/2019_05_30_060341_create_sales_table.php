<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('customer_type',['register', 'non-register']);
            $table->integer('customer_id')->nullable(); 
            $table->decimal('total', 10, 2);
            $table->decimal('discount', 10, 2)->nullable();
            $table->decimal('grand_total', 10, 2)->nullable();
            $table->decimal('return_amount', 10, 2);
            $table->decimal('due_amount', 10, 2);
            $table->decimal('pay_amount', 10, 2)->nullable();
            $table->decimal('vat_amount')->nullable();
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
        Schema::dropIfExists('sales');
    }
}
