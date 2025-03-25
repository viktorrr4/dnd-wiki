<div>
    <label for="{{ $name }}" class="block text-sm/6 font-xl text-white-900">
        {{ $label ?? 'Выберите' }}
    </label>
    <select
        id="{{ $name }}"
        name="{{ $name }}"
        autocomplete="country-name"
        class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
    >
        <option disabled selected value> -- выбери -- </option>

        @if( !empty( $options ) )
            @foreach($options as $id => $option)
                <option
                    value="{{ $id }}"
                    @selected( $id == request()->get( $name ) )
                >{{ $option }}</option>
            @endforeach
        @endif
    </select>
</div>
