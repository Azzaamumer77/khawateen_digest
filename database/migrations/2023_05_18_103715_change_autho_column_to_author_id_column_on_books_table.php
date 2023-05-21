<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeAuthoColumnToAuthorIdColumnOnBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('books', function (Blueprint $table) {
           
            $table->dropColumn('author');
        
            // Create a new 'author_id' column as an unsigned big integer foreign key
            $table->unsignedBigInteger('author_id')->after('id');
            
            // Define the foreign key constraint
            $table->foreign('author_id')->references('id')->on('authors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('books', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['author_id']);
                        
            // Drop the 'author_id' column
            $table->dropColumn('author_id');

            $table->string('author');
        });
    }
}
