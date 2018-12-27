<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsHistoriesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('payments_histories', function (Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('user_id');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
			$table->string('payments_id')->nullable();
			$table->string('description')->nullable();
			$table->dateTime('date')->nullable();
			$table->string('payer_id')->nullable();
			$table->string('payment_method')->nullable();
			$table->float('amount')->nullable();
			$table->float('discount')->default(0)->nullable();
			$table->string('country_code')->nullable();
			$table->string('postal_code')->nullable();
			$table->string('currency_code')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('payments_histories');
	}
}
