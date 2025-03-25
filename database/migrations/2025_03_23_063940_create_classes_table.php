<?php

use App\Models\DNDClass;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up(): void
	{
		Schema::create('classes', function (Blueprint $table) {
			$table->id();
			$table->foreignIdFor(DNDClass::class, 'class_id')->nullable()->constrained();
			$table->string('name');
			$table->string('en_name');
			$table->string('source')->default('PHB')->nullable();
			$table->timestamps();
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('classes');
	}
};
