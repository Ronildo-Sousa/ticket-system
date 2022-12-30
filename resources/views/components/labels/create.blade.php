<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('New Label') }}
        </h2>
    </x-slot>

    <x-card class="w-2/5 mx-auto">
        <section>
            <form action="{{ route('labels.store') }}" method="post">
                @csrf
                <h1 class="mb-3 text-xl font-semibold">Create a new label</h1>
                <x-input-label for="name" :value="__('Label name')" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                <div class="flex items-center justify-between">
                    <div class="w-full">
                        <x-text-input id="name" class="block w-full mt-1" type="text" name="name"
                            :value="old('name')" autofocus placeholder="{{ __('your label here...') }}" />
                    </div>
                    <x-primary-button class="py-3 mt-1 ml-2">
                        {{ __('create') }}
                    </x-primary-button>
                </div>

            </form>
        </section>
    </x-card>
</x-app-layout>
