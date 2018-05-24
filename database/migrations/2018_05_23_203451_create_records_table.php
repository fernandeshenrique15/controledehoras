<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordsTable extends Migration {
	public function up() {
		Schema::create('records', function (Blueprint $table) {
			$table->increments('id');
			$table->string('mode', 10);
			$table->time('hour');
			$table->integer('idWork')->unsigned();
			$table->foreign('idWork')->references('id')->on('works');
			$table->date('produced');
			$table->string('comment')->nullable();
			$table->timestamps();
		});
	}

	public function down() {
		Schema::dropIfExists('records');
	}
}
