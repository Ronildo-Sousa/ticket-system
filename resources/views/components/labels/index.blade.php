<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Labels') }}
        </h2>
    </x-slot>
  
    <x-card>
        <x-primary-button class="mb-4">
            <a href="{{ route('labels.create') }}">new label</a>
        </x-primary-button>  
        <div>
            @foreach ($labels as $label)
                <div>
                    <p>{{ $label->name }}</p>
                </div>
            @endforeach
        </div>
    </x-card>
</x-app-layout>
