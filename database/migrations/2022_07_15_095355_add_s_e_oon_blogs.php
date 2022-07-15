<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSEOonBlogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->string('seo_title')->nullable()->after('userid');
            $table->string('seo_description')->nullable()->after('seo_title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(
            'blogs',
            function (Blueprint $table) {
                $table->dropColumn('seo_title');
                $table->dropColumn('seo_description');
            }
        );
    }
}
