<?php

use App\Models\Spell;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up(): void
	{
		Schema::create('user_spell', function (Blueprint $table) {
			$table->id();
            $table->foreignIdFor(User::class, 'user_id')->constrained();
            $table->foreignIdFor(Spell::class, 'spell_id')->constrained();
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('user_spell');
	}
};
