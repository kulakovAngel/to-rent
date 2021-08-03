<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('item_user', function (Blueprint $table) {
            $table->id();
            $table->date('ordered_at'); //$table->timestamp('ordered_at');
            $table->date('must_return_at'); //$table->timestamp('must_return_at');
            $table->boolean('is_confirmed')->default(false);
            $table->foreignId('item_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->unsignedSmallInteger('quantity')->default(1);
            $table->boolean('is_returned')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_user');
    }
}
