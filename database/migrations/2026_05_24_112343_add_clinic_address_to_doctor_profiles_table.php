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
    Schema::table('doctor_profiles', function (Blueprint $table) {
        $table->string('clinic_address')->nullable()->after('city');
    });
}

public function down()
{
    Schema::table('doctor_profiles', function (Blueprint $table) {
        $table->dropColumn('clinic_address');
    });
}
};
