<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('category', function (Blueprint $table) {
			$table->increments('iCategoryId');
			$table->integer('iParentCategoryId')->unsigned()->nullable();
			$table->string('vTitle')->unique();
			$table->string('vSlug');
			$table->tinyInteger('tiStatus')->default(1)->comment('1-Active,0-Inactive');
			$table->timestamp('dtCreatedAt')->default(\DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('dtUpdatedAt')->default(\DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'))->nullable();
		});

		Schema::table('category', function (Blueprint $table) {
			$table->foreign('iParentCategoryId')->references('iCategoryId')->on(TBL_CATEGORY)->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('category');
	}
}