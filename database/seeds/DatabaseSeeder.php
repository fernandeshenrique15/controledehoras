<?php

use ControleDeHoras\User;
use ControleDeHoras\Account;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
	public function run() {		
		$this->call(AccountTableSeeder::class);
		$this->call(UserTableSeeder::class);
	}
}

class AccountTableSeeder extends Seeder {
	public function run() {
		Account::create(['name' => 'Primary']);
	}
}

class UserTableSeeder extends Seeder {
	public function run() {
		User::create(['name' => 'Administrador', 'email' => 'fernandeshenrique15@gmail.com', 'password' => bcrypt('laravel'), 'idAccount' => '1',
		]);
	}
}
