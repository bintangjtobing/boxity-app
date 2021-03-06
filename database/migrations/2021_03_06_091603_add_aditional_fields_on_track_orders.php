<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAditionalFieldsOnTrackOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('track_orders', function (Blueprint $table) {
            $table->string('order_status')->after('sender_city');
            $table->string('activity')->nullable()->after('order_status');
            $table->string('payload')->after('activity');
            $table->string('receiver_address')->after('payload');
            $table->string('sender_address')->after('receiver_address');
            $table->string('stuff_desc')->after('sender_address');
        });
        Schema::table('track_reports', function (Blueprint $table) {
            $table->string('updated_by')->after('estimated_arrival_date');
            $table->string('activity')->nullable()->after('last_location');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('track_orders', function (Blueprint $table) {
            $table->dropColumn('order_status');
            $table->dropColumn('activity');
            $table->dropColumn('payload');
            $table->dropColumn('receiver_address');
            $table->dropColumn('sender_address');
            $table->dropColumn('stuff_desc');
        });
        Schema::table('track_reports', function (Blueprint $table) {
            $table->dropColumn('updated_by');
            $table->dropColumn('activity');
        });
    }
}
