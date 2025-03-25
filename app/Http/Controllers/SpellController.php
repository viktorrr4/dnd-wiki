<?php

namespace App\Http\Controllers;

use App\Http\Requests\SpellFiltersRequest;
use App\Models\DNDClass;
use App\Models\Spell;
use Illuminate\Http\Request;

class SpellController extends Controller
{
	public function index(SpellFiltersRequest $request)
	{
        $spells = Spell::query()->filters( $request )->paginate()->withQueryString();
        $classes = DNDClass::query()->get(['id', 'name', 'class_id'])->mapWithKeys(function ($item) {
            return [$item->id => $item->class_id ? "---$item->name" : $item->name];
        });
        $levels = collect(range(0, 9));
		return view('spells', compact('spells', 'classes', 'levels'));
	}

    public function pinned()
    {
        $spells = Spell::query()->pinnedBy(auth()->id())->paginate()->withQueryString();
        return view('pinned-spells', compact('spells'));
    }
}
