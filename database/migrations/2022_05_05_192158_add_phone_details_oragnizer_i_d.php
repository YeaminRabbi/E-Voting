<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPhoneDetailsOragnizerID extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('organizer_id')->after('password')->nullable();
            $table->string('phone')->after('organizer_id')->nullable();
            $table->text('details')->after('phone')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('organizer_id');
            $table->dropColumn('phone');
            $table->dropColumn('details');
        });
    }
}
