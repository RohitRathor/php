<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Member extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->string('member_type');
            $table->string('description', 255)->updated();
            $table->string('discount');
            $table->string('shipping_free');
            $table->string('extra discount');
            $table->string('created_by');
            $table->string('delete_by');
            $table->string('updated_by');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->timestamp('delete_at');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
    {
        Schema::dropIfExists('members');
    }
}
