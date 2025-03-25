<?php

use App\Models\DNDClass;
use App\Models\Spell;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up(): void
	{
		Schema::create('class_spell', function (Blueprint $table) {
			$table->id();
            $table->foreignIdFor(Spell::class, 'spell_id')->constrained();
            $table->foreignIdFor(DNDClass::class, 'class_id')->constrained();
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('class_spell');
	}
};
