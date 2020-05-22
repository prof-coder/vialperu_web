<?php
// ====================================================================
// Modificación: inicio | Elianhers Banco fecha 27/04/2020
// Decripción: migracion para incoorporar el la confirmacion de precios
// ====================================================================
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddConfirmPriceUserRequests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_requests', function (Blueprint $table) {
            $table->boolean('confirm_price')->nullable()->default(0);
        });
    }

/**
 * Reverse the migrations.
 *
 * @return void
 */
    public function down()
    {
        Schema::table('user_requests', function (Blueprint $table) {
            $table->dropColumn('confirm_price');
        });
    }
}
// ====================================================================
// Modificación: fin
// ====================================================================
