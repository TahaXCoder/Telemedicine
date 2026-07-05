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
    Schema::table('appointments', function (Blueprint $table) {
        $table->enum('appointment_type', ['online', 'physical'])->default('physical')->after('status');
        $table->string('meeting_link')->nullable()->after('appointment_type');
    });
}

public function down()
{
    Schema::table('appointments', function (Blueprint $table) {
        $table->dropColumn('appointment_type');
        $table->dropColumn('meeting_link');
    });
}
};
