<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_user', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('inventory_id');

            $table->bigInteger('delivery_node_code')->unique();
            $table->unsignedBigInteger('reference_id')->nullable();
            $table->foreign('reference_id')->references('id')->on('users')->onUpdate('cascade');
            $table->unsignedBigInteger('preparer_id')->nullable();
            $table->foreign('preparer_id')->references('id')->on('users')->onUpdate('cascade');

            $table->string('condition',20)->nullable();
            $table->string('accessary',100)->nullable();
            $table->boolean('is_normal_user')->default(true); //true=>Permanant User, false=>Borrow Users
            $table->boolean('is_printed')->default(false); //true=>Permanant User, false=>Borrow Users
            $table->boolean('is_using')->default(true);
            $table->string('inventory_description')->nullable();
            $table->string('usage_description')->nullable();
            $table->dateTime('started_at')->nullable();
            $table->dateTime('finished_at')->nullable();
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
        Schema::dropIfExists('inventory_table');
    }
}
