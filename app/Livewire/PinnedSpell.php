<?php

namespace App\Livewire;

use App\Models\Spell;
use App\Models\User;
use Livewire\Component;

class PinnedSpell extends Component
{
    public $spell;
    public $pinned = false;
	public function togglePin($spell_id)
    {
        if ( auth()->guest() ) {
            return;
        }

        //check if user pinned the spell already
        if ( auth()->user()->pinned_spells()->where('spell_id', $spell_id)->exists() ) {
            auth()->user()->pinned_spells()->detach($spell_id);
            $this->pinned = false;
            return;
        }

		auth()->user()->pinned_spells()->syncWithoutDetaching([$spell_id]);
        $this->pinned = true;
	}

    public function mount($spell)
    {
        $this->spell = $spell;
        $this->pinned = auth()->check() && auth()->user()->pinned_spells()->where('spell_id', $spell->id)->exists();
    }
}
