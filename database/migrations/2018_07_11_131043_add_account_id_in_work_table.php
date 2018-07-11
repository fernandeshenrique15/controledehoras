<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAccountIdInWorkTable extends Migration
{
    public function up()
    {
        Schema::table('works', function (Blueprint $table) {
            $table->unsignedInteger('idAccount');
			$table->foreign('idAccount')->references('id')->on('accounts')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('works', function (Blueprint $table) {
            $table->dropForeign('works_idAccount_foreign');
        });
    }
}
