<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TicketUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()    {
        Schema::create('ticket_user', function (Blueprint $table) {
            $table->primary(['user_id', 'ticket_id']);
            $table->biginteger('user_id')->unsigned()->index();
            $table->biginteger('ticket_id')->unsigned()->index();
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
        Schema::dropIfExists('ticket_user');

    }
}
