<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('New Category') }}
        </h2>
    </x-slot>

    <x-default-form 
        :title="__('Create a new category')" 
        :name="__('name')" 
        :label="__('Category name')" 
        :placeholder="__('your category name here...')" 
        action="{{ route('categories.store') }}"
     />
</x-app-layout>
