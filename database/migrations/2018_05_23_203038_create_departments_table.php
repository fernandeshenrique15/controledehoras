<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentsTable extends Migration {
	public function up() {
		Schema::create('departments', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name', 50);
		});
	}

	public function down() {
		Schema::dropIfExists('departments');
	}
}
