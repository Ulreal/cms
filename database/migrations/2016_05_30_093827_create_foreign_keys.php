<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chats', function(Blueprint $table) {
            $table->foreign('userid')->references('id')->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });

        // Schema::table('posts', function(Blueprint $table) {
        //     $table->foreign('userid')->references('id')->on('users')
        //         ->onDelete('restrict')
        //         ->onUpdate('restrict');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chats', function(Blueprint $table) {
            $table->dropForeign('chats_userid_foreign');
        });

        Schema::table('posts', function(Blueprint $table) {
            $table->dropForeign('posts_userid_foreign');
        });
    }
}
