<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('city');
            $table->string('registration_no');
            $table->decimal('invoice_no');
            $table->date('date');
            $table->string('details');
            $table->enum('status',['Pending','Received','Returned'])->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('postages');
    }
}
