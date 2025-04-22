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
        Schema::connection('tenant')->create(Tables::TENANT_INFO, function (Blueprint $table) {
            $table->bigIncrements(Columns::id);
            $table->string(Columns::name);
            $table->unsignedBigInteger(Columns::tenant_id);
            $table->unsignedBigInteger(Columns::tenant_admin_user_id)->index()->nullable();

            $table->unsignedBigInteger(Columns::tenant_admin_auth_user_id)->index()->nullable();
            $table->foreign(Columns::tenant_admin_auth_user_id)->references(Columns::id)->on(Tables::AUTH_USERS)->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('tenant')->dropIfExists(Tables::TENANT_INFO);
    }
};
