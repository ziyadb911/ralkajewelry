<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTiktokToCompanyInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_infos', function (Blueprint $table) {
            $table->string('tiktok', 100)->nullable()->after('twitter');
            $table->string('tokopedia', 100)->nullable()->after('tiktok');
            $table->string('shopee', 100)->nullable()->after('tokopedia');
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
            $table->dropColumn('shopee');
            $table->dropColumn('tokopedia');
            $table->dropColumn('tiktok');
        });
    }
}
