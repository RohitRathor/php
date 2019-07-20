<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Coupon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
      {
        Schema::create('coupons', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->string('coupon_code',20)->unique();
            $table->date('valid_from');
            $table->date('valid_till');
            $table->integer('discount_type')->comment('fixed=0,percentage=1');
            $table->decimal('discount_amount', 8, 2);
            $table->decimal('minimum_amount', 8, 2);
            $table->decimal('maximum_discount', 8, 2)->nullable();
            $table->bigInteger('category_id')->nullable();
            $table->bigInteger('brand_id')->nullable();
            $table->bigInteger('product_id')->nullable();
            $table->tinyInteger('is_active')->default(0);
            $table->tinyInteger('is_approved')->default(0);
            $table->bigInteger('country_id')->nullable();
            $table->bigInteger('airport_id')->nullable();
            $table->bigInteger('created_by'); 
            $table->bigInteger('updated_by');
            $table->bigInteger('deleted_by');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->dateTime('deleted_at');
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
