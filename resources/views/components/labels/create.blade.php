<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('New Label') }}
        </h2>
    </x-slot>

    <x-default-form 
        :title="__('Create a new label')" 
        :name="__('name')" 
        :label="__('Label name')" 
        :placeholder="__('your label name here...')" 
        action="{{ route('labels.store') }}"
    />
</x-app-layout>
