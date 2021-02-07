<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageMetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_meta', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('message_id');
            $table->date('date_end')->default('2222-01-01 00:00:00');
            $table->integer('cost')->nullable();
            $table->string('quick_delivery')->nullable();
            $table->string('horaire')->nullable();
            $table->string('best_professor')->nullable();
            $table->string('contact_online')->nullable();
            $table->string('responsive_professor')->nullable();
            $table->boolean('terminate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('message_meta');
    }
}
