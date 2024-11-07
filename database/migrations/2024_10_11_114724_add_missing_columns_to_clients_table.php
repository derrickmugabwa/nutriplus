<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMissingColumnsToClientsTable extends Migration
{
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            if (!Schema::hasColumn('clients', 'email')) {
                $table->string('email')->nullable();
            }
            if (!Schema::hasColumn('clients', 'phone')) {
                $table->string('phone')->nullable();
            }
            if (!Schema::hasColumn('clients', 'address')) {
                $table->text('address')->nullable();
            }
            if (!Schema::hasColumn('clients', 'gender')) {
                $table->string('gender')->nullable();
            }
            if (!Schema::hasColumn('clients', 'date_of_birth')) {
                $table->date('date_of_birth')->nullable();
            }
            if (!Schema::hasColumn('clients', 'tags')) {
                $table->json('tags')->nullable();
            }
            if (!Schema::hasColumn('clients', 'weight')) {
                $table->float('weight')->nullable();
            }
            if (!Schema::hasColumn('clients', 'height')) {
                $table->float('height')->nullable();
            }
            if (!Schema::hasColumn('clients', 'body_fat')) {
                $table->float('body_fat')->nullable();
            }
            
            // Add foreign key constraint if needed
            //$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            $columns = ['email', 'phone', 'address', 'gender', 'date_of_birth', 'tags', 'weight', 'height', 'body_fat'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('clients', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
}