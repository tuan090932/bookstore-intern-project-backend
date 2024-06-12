<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Rename columns id, name
            $table->renameColumn('id', 'user_id');
            $table->renameColumn('name', 'user_name');

            // Add columns phone_number, address_id
            $table->string('phone_number', 250)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('user_id', 'id');
            $table->renameColumn('user_name', 'name');
            $table->dropColumn('phone_number');
        });
    }
};
