<div class="rounded shadow-lg p-4 px-4 md:p-8 mb-6">
    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-1">
{{--        <div class="text-gray-600 text-center">--}}
{{--            <p class="font-medium text-lg">Personal Details</p>--}}
{{--            <p>Please fill out all the fields.</p>--}}
{{--        </div>--}}

        <div class="lg:col-span-2">
            <form action="{{ route('spells') }}" method="GET">
                <div class="grid gap-4 gap-y-2 text-sm md:grid-cols-4 sm:grid-cols-2">

                    <x-new.select label="Класс" name="class" :options="$classes"/>
                    <x-new.select label="Уровень" name="level" :options="$levels"/>

                    <div class="inline-flex items-end">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
