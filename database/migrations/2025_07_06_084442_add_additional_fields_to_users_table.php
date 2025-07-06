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
            $table->string('profile_picture')->nullable()->after('email');
            $table->string('phone')->nullable()->after('profile_picture');
            $table->date('date_of_birth')->nullable()->after('phone');
            $table->string('class')->nullable()->after('date_of_birth');
            $table->string('street_address')->nullable()->after('class');
            $table->string('city')->nullable()->after('street_address');
            $table->string('state')->nullable()->after('city');
            $table->string('country')->nullable()->after('state');
            $table->string('postal_code')->nullable()->after('country');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'profile_picture',
                'phone',
                'date_of_birth',
                'class',
                'street_address',
                'city',
                'state',
                'country',
                'postal_code'
            ]);
        });
    }
};
