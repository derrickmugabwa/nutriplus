<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDietaryRestrictionsTable extends Migration
{
    public function up()
    {
        Schema::create('dietary_restrictions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->string('restriction_type');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dietary_restrictions');
    }
}
