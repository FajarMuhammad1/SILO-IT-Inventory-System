<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up()
{
    Schema::table('helpdesk_monitorings', function (Blueprint $table) {
        $table->string('pengguna')->nullable()->after('tanggal');
    });
}

public function down()
{
    Schema::table('helpdesk_monitorings', function (Blueprint $table) {
        $table->dropColumn('pengguna');
    });
}

};
