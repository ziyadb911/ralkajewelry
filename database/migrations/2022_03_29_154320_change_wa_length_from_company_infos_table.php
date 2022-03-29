<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeWaLengthFromCompanyInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_infos', function (Blueprint $table) {
            $table->string('wa', 200)->nullable()->change();
            $table->string('facebook', 200)->nullable()->change();
            $table->string('instagram', 200)->nullable()->change();
            $table->string('twitter', 200)->nullable()->change();
            $table->string('tiktok', 200)->nullable()->change();
            $table->string('tokopedia', 200)->nullable()->change();
            $table->string('shopee', 200)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_infos', function (Blueprint $table) {
            $table->string('wa', 20)->nullable()->change();
            $table->string('facebook', 100)->nullable()->change();
            $table->string('instagram', 100)->nullable()->change();
            $table->string('twitter', 100)->nullable()->change();
            $table->string('tiktok', 100)->nullable()->change();
            $table->string('tokopedia', 100)->nullable()->change();
            $table->string('shopee', 100)->nullable()->change();
        });
    }
}
