<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Details') }}
        </h2>
    </x-slot>

    <main>
        <x-card class="max-w-3xl mx-auto -mt-5">
            <div class="">
                <div class="flex items-center justify-between">
                    <span class="p-1 font-bold border border-black rounded">
                        <p>{{ $ticket->status }}</p>
                    </span>
                    <span class="flex">
                        <p class="mr-2 font-bold">{{ __('Priority: ') }}</p>
                        <p>{{ $ticket->priority->name }}</p>
                    </span>
                    <x-primary-button>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </x-primary-button>
                </div>

                <div>
                    <h1 class="mt-3 text-xl font-semibold">{{ $ticket->title }}</h1>
                    <p>
                        {{ $ticket->description }}
                    </p>
                    <div class="mt-4">
                        <h3 class="text-lg font-semibold">{{ __('Files') }}</h3>
                        <ul>
                            @foreach ($ticket->files as $file)
                                <li class="ml-5">
                                    <a href="{{ public_path($file->file_path) }}" download>
                                        {{ $file->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </x-card>

        @foreach ($comments as $comment)
            <x-card class="max-w-3xl mx-auto -mt-20">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-lg font-semibold">{{ $comment->user->name }}</span>
                        <span class="text-xs">{{ $comment->created_at->format('d/m/Y') }}</span>
                    </div>
                    <div>
                        <p>
                            {{ $comment->body }}
                        </p>
                    </div>
                </div>
            </x-card>
        @endforeach
        <div class="flex justify-center w-screen mb-5">
            {{ $comments->links() }}
        </div>
    </main>
</x-app-layout>
