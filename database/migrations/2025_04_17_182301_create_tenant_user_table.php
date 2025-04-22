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
        Schema::create(Tables::TENANT_USER, function (Blueprint $table) {
            $table->bigIncrements(Columns::id);
            $table->unsignedBigInteger(Columns::tenant_id)->index();
            $table->unsignedBigInteger(Columns::user_id)->index();
            $table->unsignedBigInteger(Columns::role_id)->index();
            $table->integer(Columns::status)->default(0)->comment('0 = inactive,1 = active, 2 = suspended'); // 1 = active, 0 = inactive, 2 = suspended
            $table->timestamps();

            // Foreign keys
            $table->foreign(Columns::tenant_id)->references(Columns::id)->on(Tables::TENANTS)->onDelete('cascade');
            $table->foreign(Columns::user_id)->references(Columns::id)->on(Tables::USERS)->onDelete('cascade');
            $table->foreign(Columns::role_id)->references(Columns::id)->on(Tables::MASTER_USER_ROLES);

            // To avoid duplicates
            $table->unique([Columns::tenant_id, Columns::user_id]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Tables::TENANT_USER);
    }
};
