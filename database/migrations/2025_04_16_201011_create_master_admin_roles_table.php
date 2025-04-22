<?php

use App\Constants\Columns;
use App\Constants\Tables;
use App\Models\MasterAdminRole;
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
            $table->string(Columns::display_name)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // Insert default role
        DB::table(Tables::MASTER_ADMIN_ROLES)->insert([
            Columns::name => MasterAdminRole::ROLE_SUPER_ADMIN,
            Columns::display_name => 'Super Admin',
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
