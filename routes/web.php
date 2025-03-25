<?php

use App\Http\Controllers\SpellController;
use App\Models\DNDClass;
use Illuminate\Support\Facades\Route;

Route::controller(SpellController::class)->group(function () {
    Route::get('', 'index')->name('spells');
    Route::get('pinned', 'pinned')->name('spells.pinned');
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';

Route::get('save/spells', function () {
    dd('Route is disabled');
    $spells = json_decode(Storage::disk('public')->get('classSpells.json'), true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        dd(json_last_error_msg()); // Покажет ошибку декодирования
    }

    $allSpells = \App\Models\Spell::all(['id', 'en_name'])->pluck('en_name', 'id')->map(function ($item) {
        return strtolower( $item );
    })->flip();


    foreach ($spells as $data) {
        $class = new DNDClass();
        $class->fill([
            'name' => is_string($data['title']['ru']) ? $data['title']['ru'] : $data['title']['ru']['text'] ?? 'N/A',
            'en_name' => is_string($data['title']['en']) ? $data['title']['en'] : $data['title']['en']['text'] ?? 'N/A',
            'source' => $data['title']['en']['source'] ?? 'PHB',
        ]);
        $created = $class->save();

        if (!$created) {
            dd($class->getErrors());
        }

        if (!empty($data['spells'])) {
            foreach ($data['spells'] as $spell) {
                $toLowerSpell = strtolower($spell);

                if (!$allSpells->has($toLowerSpell)) {
                    continue;
                }

                $class->spells()->attach($allSpells->get($toLowerSpell));
            }
        }

        if (!empty($data['subclasses'])) {
            foreach ($data['subclasses'] as $sub) {
                $subClass = new DNDClass();
                $subClass->fill([
                    'name' => is_string($sub['title']['ru']) ? $sub['title']['ru'] : $sub['title']['ru']['text'] ?? 'N/A',
                    'en_name' => is_string($sub['title']['en']) ? $sub['title']['en'] : $sub['title']['en']['text'] ?? 'N/A',
                    'source' => $sub['title']['en']['source'] ?? 'PHB',
                    'class_id' => $class->id,
                ]);

                $created = $subClass->save();

                if (!$created) {
                    dd($subClass->getErrors());
                }

                if (!empty($data['spells'])) {
                    foreach ($data['spells'] as $spell) {
                        $toLowerSpell = strtolower($spell);

                        if (!$allSpells->has($toLowerSpell)) {
                            continue;
                        }

                        $subClass->spells()->attach($allSpells->get($toLowerSpell));
                    }
                }
            }
        }
    }
});
