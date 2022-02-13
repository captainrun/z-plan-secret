<?php

use App\Enums\PaymentGateways;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UpdateOrdersTable extends Migration
{
    

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('customer_name');
            $table->dropColumn('customer_email');
            $table->dropColumn('customer_phone');


            $table->bigInteger('request_id');

            $table->string('payment_url');

            $table->float('total')->default(0);

            $table->string('reference');

            $table->string('currency');

            $table->text('description')->nullable();

            $table->enum('gateway', PaymentGateways::toArray());


            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('cart_id')->nullable();
            $table->foreign('cart_id')->references('id')
                ->on('carts')->onDelete('set null');
            $table->foreign('customer_id')->references('id')
                ->on('users');

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {

        });
    }
}