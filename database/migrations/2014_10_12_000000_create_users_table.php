<?php

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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('iUserId',20);
            $table->enum('eUserRole',['Admin','User'])->default('Admin');
            $table->string('vFirstName',50);
            $table->string('vLastName',50);
            $table->string('vEmail',100)->unique()->nullable();
            $table->string('vPhoneNumber',20)->unique()->nullable();
            $table->string('vPassword',100);
            $table->tinyInteger('tiStatus')->default(1)->comment('1-Active,2-Inactive');
            $table->string('vRememberToken',255)->nullable();
            $table->timestamp('dtCreatedAt')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('dtUpdatedAt')->default(\DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'))->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
