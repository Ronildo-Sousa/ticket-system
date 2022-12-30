<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Categories') }}
        </h2>
    </x-slot>
  
    <x-card>
        <x-primary-button class="mb-4">
            <a href="{{ route('categories.create') }}">new category</a>
        </x-primary-button>  
        <div>
            @foreach ($categories as $category)
                <div>
                    <p>{{ $category->name }}</p>
                </div>
            @endforeach
        </div>
    </x-card>
</x-app-layout>
