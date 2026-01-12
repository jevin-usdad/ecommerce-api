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
            $table->foreignId('role_id')
                ->nullable()
                ->after('id')
                ->constrained('roles')
                ->cascadeOnDelete();
            $table->string('mobile_no')->nullable()->after('email');
            $table->string('country')->nullable()->after('mobile_no');
            $table->string('state')->nullable()->after('country');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();

            $table->dropColumn([
                'mobile_no',
                'country',
                'state',
            ]);

            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
        });
    }
};
