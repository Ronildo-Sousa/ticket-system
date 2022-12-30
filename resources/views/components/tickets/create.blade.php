<x-app-layout>
    <x-card class="mx-auto lg:w-3/4">
        <form action="{{ route('tickets.store') }}" method="post">
            @csrf
            <h1 class="mb-3 text-xl font-semibold">{{ __('Create a new ticket') }}</h1>
            <div>
                <x-input-label for="title" :value="__('Title')" />
                <x-text-input id="{{ __('title') }}" class="block w-full mt-1" type="text" name="{{ __('title') }}"
                    :value="old(__('title'))" autofocus placeholder="{{ __('ticket title here...') }}" />
                <x-input-error :messages="$errors->get(__('title'))" class="mt-2" />
            </div>
            <div>
                <x-input-label for="description" :value="__('description')" />
                <x-text-input id="{{ __('description') }}" class="block w-full mt-1" type="text"
                    name="{{ __('description') }}" :value="old(__('description'))" autofocus
                    placeholder="{{ __('ticket description here...') }}" />
                <x-input-error :messages="$errors->get(__('description'))" class="mt-2" />
            </div>
            <div>
                <x-input-label for="labels" :value="__('labels (one or more)')" />
                <select name="{{ __('labels[]') }}" id="{{ __('labels') }}" multiple>
                    @foreach ($labels as $label)
                        <option value="{{ $label->id }}">{{ $label->name }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get(__('labels'))" class="mt-2" />
            </div>
            <div>
                <x-input-label for="categories" :value="__('categories (one or more)')" />
                <select name="{{ __('categories[]') }}" id="{{ __('categories') }}" multiple>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get(__('categories'))" class="mt-2" />
            </div>
            <div>
                <x-input-label for="priority" :value="__('priority')" />
                <select name="{{ __('priority_id') }}" id="{{ __('priority') }}">
                    @foreach ($priorities as $priority)
                        <option value="{{ $priority->id }}">{{ $priority->name }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get(__('priority'))" class="mt-2" />
            </div>
            <div>
                <x-primary-button>
                    {{ __('create') }}
                </x-primary-button>
            </div>
        </form>
    </x-card>
</x-app-layout>
