<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Spell;
use App\MoonShine\Pages\Spell\SpellIndexPage;
use App\MoonShine\Pages\Spell\SpellFormPage;
use App\MoonShine\Pages\Spell\SpellDetailPage;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Laravel\Pages\Page;

/**
 * @extends ModelResource<Spell, SpellIndexPage, SpellFormPage, SpellDetailPage>
 */
class SpellResource extends ModelResource
{
    protected string $model = Spell::class;

    protected string $title = 'Spells';
    
    /**
     * @return list<Page>
     */
    protected function pages(): array
    {
        return [
            SpellIndexPage::class,
            SpellFormPage::class,
            SpellDetailPage::class,
        ];
    }

    /**
     * @param Spell $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [];
    }
}
