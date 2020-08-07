<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertAdminUser extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$email = env('ADMIN_EMAIL', 'suporte@revenuebrasil.com.br');
		$password = env('ADMIN_PASSWORD', 'Suporte@suporte123');
		DB::table('users')->insert([
			'name' => 'Suporte',
			'email' => $email,
			'password' => bcrypt($password)
		]);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		$email = env('ADMIN_EMAIL','suporte@revenuebrasil.com.br');
		DB::delete('DELETE FROM users WHERE email = ?', [$email]);
	}
}
