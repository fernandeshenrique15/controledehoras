<?php

use ControleDeHoras\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
	public function run() {
		$this->call(UserTableSeeder::class);
	}
}

class UserTableSeeder extends Seeder {
	public function run() {
		User::create(['name' => 'Administrador', 'email' => 'fernandeshenrique15@gmail.com', 'password' => bcrypt('laravel'),
		]);
	}
}
