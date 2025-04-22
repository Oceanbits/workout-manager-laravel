<?php

use App\Constants\Columns;
use App\Constants\Tables;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Tables::USERS, function (Blueprint $table) {
            $table->bigIncrements(Columns::id);
            // $table->string('name');
            $table->string(Columns::email)->unique();
            $table->string(Columns::phone)->unique()->nullable();
            // $table->timestamp('email_verified_at')->nullable();
            $table->string(Columns::password);
            $table->string(Columns::fcm_token)->nullable();
            $table->string(Columns::first_name)->nullable();
            $table->string(Columns::middle_name)->nullable();
            $table->string(Columns::last_name)->nullable();
            $table->string(Columns::image_url)->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Tables::USERS);
    }
}
