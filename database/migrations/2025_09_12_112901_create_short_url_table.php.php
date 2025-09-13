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
        Schema::create('genrate_urls', function (Blueprint $table) {
            $table->id();
            $table->string('short_url');
            $table->text('long_url');
            $table->integer('hits')->default(0);
            $table->dateTime('created_at');
            $table->timestamp('updated_at');
        });
        Schema::table('genrate_urls', function (Blueprint $table) {
            $table->foreignId('company_id')->after('id')->constrained('companies')->onDelete('cascade');
            $table->foreignId('member_id')->after('company_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('created_by')->after('hits')->constrained('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('genrate_urls');
    }
};
