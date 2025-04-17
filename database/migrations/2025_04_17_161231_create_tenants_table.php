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
        Schema::create(Tables::TENANTS, function (Blueprint $table) {
            $table->bigIncrements(Columns::id);
            $table->string(Columns::name);
            $table->string(Columns::notes)->nullable();
            $table->string(Columns::db_host);
            $table->string(Columns::db_name)->unique();
            $table->string(Columns::db_user);
            $table->string(Columns::db_password)->default('');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Tables::TENANTS);
    }
};
