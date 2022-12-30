@props([
    'actionRoute' => route('dashboard'),
    'placeholder' => 'your placeholder here...',
    'label' => 'some name',
    'name' => 'name',
    'title' => 'Example form',
    'buttonName' => 'create'
])
<x-card class="lg:w-1/2 md:mx-auto">
    <form {{ $attributes }} method="post">
        @csrf
        <h1 class="mb-3 text-xl font-semibold">{{ $title }}</h1>
        <x-input-label for="{{__($name)}}" :value="__($label)" />
        <x-input-error :messages="$errors->get(__($name))" class="mt-2" />
        <div class="flex items-center justify-between">
            <div class="w-full">
                <x-text-input id="{{__($name)}}" class="block w-full mt-1" type="text" name="{{__($name)}}"
                    :value="old(__($name))" autofocus placeholder="{{ $placeholder }}" />
            </div>
            <x-primary-button class="py-3 mt-1 ml-2">
                {{ $buttonName }}
            </x-primary-button>
        </div>
    </form>
</x-card>