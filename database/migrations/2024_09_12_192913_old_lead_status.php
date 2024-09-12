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
        Schema::table('lead_sales', function (Blueprint $table) {
            //
            $table->string('old_billing_cycle')->nullable();
            $table->string('old_account_id')->nullable();
            $table->string('old_account_emirate_id')->nullable();
            $table->string('old_fivejee_number')->nullable();
            $table->string('old_registered_number')->nullable();
            $table->string('old_registered_email')->nullable();
            $table->string('old_expiry_date')->nullable();
            $table->string('old_dob')->nullable();
            $table->string('cancel_status')->nullable();
            $table->string('commision')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lead_sales', function (Blueprint $table) {
            //
        });
    }
};
