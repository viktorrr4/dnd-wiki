<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up(): void
	{
		Schema::table('spells', function (Blueprint $table) {
			$table->string('en_name', 255)->nullable()->after('name');
			$table->string('materials', 255)->nullable()->after('components');
			$table->string('school', 255)->nullable()->after('components');

            $table->dropColumn('classes');
            $table->dropColumn('subclasses');
		});
	}

	public function down(): void
	{
		Schema::table('spells', function (Blueprint $table) {
			$table->dropColumn('en_name');
			$table->dropColumn('materials');
			$table->dropColumn('school');

            $table->string('classes', 255)->nullable()->after('duration');
            $table->string('subclasses', 255)->nullable()->after('duration');
		});
	}
};
