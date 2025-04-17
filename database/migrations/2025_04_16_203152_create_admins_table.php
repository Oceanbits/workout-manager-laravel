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
        Schema::create(Tables::ADMINS, function (Blueprint $table) {
            $table->bigIncrements(Columns::id);
            $table->string(Columns::name);
            $table->string(Columns::email)->unique();
            $table->string(Columns::phone)->unique();
            $table->string(Columns::password);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger(Columns::role_id)->index();

            // Foreign key constraint
            $table->foreign(Columns::role_id)
                ->references(Columns::id)
                ->on(Tables::MASTER_ADMIN_ROLES)
                ->onDelete('cascade');
        });

        // Insert a default admin (make sure the role with ID 1 exists)
        DB::table(Tables::ADMINS)->insert([
            Columns::name => 'Admin',
            Columns::email => 'milin.oceantechs@gmail.com',
            Columns::phone => '8980606000',
            Columns::password => Hash::make('Qwerty@12345'), // securely hash password
            Columns::role_id => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Tables::ADMINS);
    }
};
