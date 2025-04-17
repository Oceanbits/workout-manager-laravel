<?php

use App\Constants\Columns;
use App\Constants\Tables;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(Tables::TENANT_INFO, function (Blueprint $table) {
            $table->bigIncrements(Columns::id);
            $table->string(Columns::name);
            $table->unsignedBigInteger(Columns::tenant_id);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Tables::TENANT_INFO);
    }
};
