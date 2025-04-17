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
        Schema::create(Tables::MASTER_ADMIN_ROLES, function (Blueprint $table) {
            $table->bigIncrements(Columns::id);
            $table->string(Columns::name)->unique();
            $table->timestamps();
            $table->softDeletes();
        });

        // Insert default role
        DB::table(Tables::MASTER_ADMIN_ROLES)->insert([
            Columns::name => 'Super Admin',
            Columns::created_at => now(),
            Columns::updated_at => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Tables::MASTER_ADMIN_ROLES);
    }
};
