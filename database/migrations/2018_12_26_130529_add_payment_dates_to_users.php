<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentDatesToUsers extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('users', function ($table) {
			$table->dateTime('payment_start_date');
			$table->dateTime('payment_end_date');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('users', function (Blueprint $table) {
			$table->dropColumn('payment_start_date');
			$table->dropColumn('payment_end_date');
		});
	}
}
