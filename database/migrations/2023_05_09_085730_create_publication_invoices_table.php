<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicationInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publication_invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('publication_id');
            $table->string('invoice_no')->unique();
            $table->decimal('debit')->nullable();
            $table->decimal('credit')->nullable();
            $table->date('date');
            $table->timestamps();
            $table->foreign('publication_id')->references('id')->on('publications')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('publication_invoices');
    }
}
