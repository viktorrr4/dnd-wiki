<div class="spell-card group relative rounded-md max-h-[450px] overflow-hidden border-1 p-2 border-white/20">
    <header class="flex align-content-center justify-between">
        <h2 class="flex align-content-center">
            <p>[{{ $spell->level }}]</p>
            <span class="text-xl font-semibold text-black dark:text-white">&nbsp;{{ $spell->name }}</span>
        </h2>
        <div class="actions">
            <livewire:pinned-spell :spell="$spell"/>
        </div>
    </header>
    <ul>
        @foreach($spell->listing as $key => $component)
            @if( empty($component) ) @continue @endif
            <li class="text-sm grid grid-cols-3">
                <strong class="col-span-1">{{ __("spells.$key") }}: </strong>
                <span class="col-span-2">{{ $component }}</span>
            </li>
        @endforeach
    </ul>
    <div class="overflow-y-auto max-h-[200px] text-sm mt-2">
        {!! $spell->description !!}
    </div>
</div>
