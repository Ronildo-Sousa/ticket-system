@props([
    'user' => null, 
    'roles',
    'action' => route('users.store')
])

<x-card class="w-2/5 mx-auto">
    <form method="POST" action="{{ $action }}">
        @csrf

        <h1 class="mb-5 text-xl font-semibold">{{ $title ?? 'Create a new user' }}</h1>

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name')"
                value="{{ $user->name ?? '' }}" autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        @if (!$user)
            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')"
                    value="{{ $user->email ?? '' }}" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
        @endif

        <!-- Roles -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('Role')" />
            <select name="role" id="role" class="w-full border border-gray-300 rounded shadow-sm">
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block w-full mt-1" type="password" name="password"
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block w-full mt-1" type="password"
                name="password_confirmation" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('users.index') }}">
                <x-secondary-button>
                    {{ __('Cancel') }}
                </x-secondary-button>
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-card>
