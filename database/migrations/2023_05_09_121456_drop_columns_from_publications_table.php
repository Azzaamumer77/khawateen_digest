<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnsFromPublicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('publications', function (Blueprint $table) {
           $table->dropColumn('invoice_no');
           $table->dropColumn('debit');
           $table->dropColumn('credit');
           $table->dropColumn('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('publications', function (Blueprint $table) {
            $table->string('invoice_no')->unique();
            $table->decimal('debit')->nullable();
            $table->decimal('credit')->nullable();
            $table->date('date');
        });
    }
}
