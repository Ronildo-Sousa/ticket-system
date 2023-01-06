<x-app-layout>
    <x-card>
        <div class="mb-3">
        <a href="{{ route('users.create') }}" >
            <x-primary-button>
                new user
            </x-primary-button>
        </a>
    </div>
        @foreach ($users as $user)
            <p>{{ $user->name }}</p>
        @endforeach
    </x-card>
</x-app-layout>