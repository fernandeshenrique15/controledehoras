<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAccountIdInRecordTable extends Migration
{
    public function up()
    {
        Schema::table('records', function (Blueprint $table) {
            $table->unsignedInteger('idAccount');
            $table->foreign('idAccount')->references('id')->on('accounts')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('records', function (Blueprint $table) {
            $table->dropForeign('records_idAccount_foreign');
        });
    }
}
