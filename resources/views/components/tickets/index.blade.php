<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Tickets') }}
        </h2>
    </x-slot>
  
    <x-card>
        <x-primary-button class="mb-4">
            <a href="{{ route('tickets.create') }}">new ticket</a>
        </x-primary-button>  
        <div>
            @foreach ($tickets as $ticket)
                <div>
                    <p>{{ $ticket->title }}</p>
                </div>
            @endforeach
        </div>
    </x-card>
</x-app-layout>
