<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->string('code',50)->unique();
            $table->string('model',50);
            $table->string('target',50);
            $table->string('serial',50);
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->string('color',50);
            $table->string('condition',50);
            $table->decimal('price')->default(0.00);
            $table->string('accessary')->nullable();
            $table->unsignedBigInteger('vendor_id');
            $table->foreign('vendor_id')->references('id')->on('vendors');
            $table->string('invoice_number')->nullable();
            $table->string('description',255)->nullable();
            $table->string('remark',255)->nullable();
            $table->string('image')->default('none_inv.jpg')->nullable();
            $table->integer('status')->default(1); //1.New Available  2.Used Available 3.Using Not Available​ 4.Broken
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
        Schema::dropIfExists('inventories');
    }
}