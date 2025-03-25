<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up()
	{
		Schema::create('spells', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->string('level');
			$table->string('time');
			$table->string('distance');
			$table->text('components');
			$table->string('duration');
			$table->string('classes');
			$table->string('subclasses');
			$table->text('source');
			$table->text('description');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('spells');
	}
};
