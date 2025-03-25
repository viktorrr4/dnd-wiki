<?php

namespace App\Models;

use App\Http\Requests\SpellFiltersRequest;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class Spell
 *
 * @package App\Models
 *
 * @property string $name
 * @property string $en_name
 * @property string $level
 * @property string $time
 * @property string $distance
 * @property string $components
 * @property string $duration
 * @property string $subclasses
 * @property string $source
 * @property string $description
 * @property string $school
 *
 * @method Builder filters(SpellFiltersRequest $request)
 */
class Spell extends Model
{
	protected $fillable = [
		'name',
		'en_name',
		'level',
		'time',
		'distance',
		'components',
		'duration',
		'subclasses',
		'source',
		'description',
		'school',
	];

    protected function listing() : Attribute
    {
        return new Attribute(
            get: function ($value) {
                return collect([
                    'time' => $this->time,
                    'distance' => $this->distance,
                    'components' => $this->components,
                    'materials' => $this->materials,
                    'duration' => $this->duration,
                    'school' => $this->school,
                    'classes' => $this->classes->filter(fn($class) => ! $class->class_id)->pluck('name')->implode(', '),
                    'source' => $this->source,
                ]);
            },
        );
    }

    public function classes(): BelongsToMany
    {
        return $this->belongsToMany(DNDClass::class, 'class_spell', 'spell_id', 'class_id');
    }

    public function pinned(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_spell', 'spell_id', 'user_id');
    }

    public function scopeFilters( Builder $query, SpellFiltersRequest $request ): Builder
    {
        if ( $request->has('class') ) {
            $query->whereHas('classes', function ($query) use ($request) {
                $query->where('class_spell.class_id', $request->get('class'));
            });
        }

        if ( $request->has('level') ) {
            $query->where('level', $request->get('level'));
        }

        return $query;
    }

    public function scopePinnedBy( Builder $query, $user_id ): Builder
    {
        if ( $user_id ) {
            $query->whereHas('pinned', function ($query) use ($user_id) {
                $query->where('user_spell.user_id', $user_id);
            });
        }

        return $query;
    }
}
