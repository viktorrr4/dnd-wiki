<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class DNDClass
 *
 * @package App\Models
 *
 * @property string $name
 * @property string $en_name
 * @property int $class_id
 */
class DNDClass extends Model
{

    protected $table = 'classes';
	protected $fillable = [
		'name',
		'en_name',
		'class_id',
	];

    public function spells(): BelongsToMany
    {
        return $this->belongsToMany(Spell::class, 'class_spell', 'class_id', 'spell_id');
    }
}
