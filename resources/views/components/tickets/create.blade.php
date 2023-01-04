<x-app-layout>
    <x-card class="mx-auto md:w-3/4">
        <form action="{{ route('tickets.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <h1 class="mb-3 text-xl font-semibold">{{ __('Create a new ticket') }}</h1>
            <div class="mb-3">
                <x-input-label for="title" :value="__('Title')" />
                <x-text-input id="{{ __('title') }}" class="block w-full mt-1" type="text" name="{{ __('title') }}"
                    :value="old(__('title'))" autofocus placeholder="{{ __('ticket title here...') }}" />
                <x-input-error :messages="$errors->get(__('title'))" class="mt-2" />
            </div>

            <div class="flex flex-col justify-between md:flex-row">
                <div class="w-full mb-3">
                    <x-input-label for="description" :value="__('description')" />
                    <textarea id="{{ __('description') }}" rows="6" name="{{ __('description') }}" value="{{ old('desciprion') }}"
                        class="w-full text-black border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        placeholder="{{ __('your description here...') }}"></textarea>
                    <x-input-error :messages="$errors->get(__('description'))" class="mt-2" />
                </div>
                <div class="w-full mb-4 md:ml-3 md:w-1/3 lg">
                    <x-input-label for="priority" :value="__('priority')" />
                    <select name="{{ __('priority_id') }}" id="{{ __('priority') }}"
                        class="w-full text-sm border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @foreach ($priorities as $priority)
                            <option value="{{ $priority->id }}">{{ $priority->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get(__('priority'))" class="mt-2" />
                </div>
            </div>
            <div class="flex justify-around md:justify-between">
                <div class="mb-3">
                    <x-input-label for="labels" :value="__('labels (one or more)')" />
                    <select name="{{ __('labels[]') }}" id="{{ __('labels') }}" multiple
                        class="w-full p-3 rounded-md shadow-sm borderbg-gray-300 hover:border focus:border-indigo-500 focus:ring-indigo-500">
                        <option selected value="0">{{ __('Select a label') }}</option>
                        @foreach ($labels as $label)
                            <option value="{{ $label->id }}">{{ $label->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get(__('labels'))" class="mt-2" />
                    @error('labels.*')
                        @foreach ($errors->get('labels.*') as $error)
                            <x-input-error :messages="$error[0]" class="mt-2" />
                        @endforeach
                    @enderror
                </div>
                <div class="mb-3">
                    <x-input-label for="categories" :value="__('categories (one or more)')" />
                    <select name="{{ __('categories[]') }}" id="{{ __('categories') }}" multiple
                        class="w-full p-3 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option selected value="0">{{ __('Select a category') }}</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('categories')" class="mt-2" />
                    @error('categories.*')
                        @foreach ($errors->get('categories.*') as $error)
                            <x-input-error :messages="$error[0]" class="mt-2" />
                        @endforeach
                    @enderror
                </div>
            </div>
            <div>
                <x-primary-button>
                    {{ __('create') }}
                </x-primary-button>
            </div>
        </form>
    </x-card>
</x-app-layout>
