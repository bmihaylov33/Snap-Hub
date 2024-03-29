<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
        @if (!$users->isEmpty()) 
            @foreach ($users as $user)
            <div class="relative group">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6 aspect-w-1 aspect-h-1 px-3 py-4 text-gray-900 dark:text-gray-100">
                    <h5 class="font-bold text-xl truncate">{{ $user->name }}</h5>
                    <h5 class="font-bold text-xl truncate">{{ $user->created_at->diffForHumans() }}</h5>
                    @if ('admin' === auth()->user()->role)
                        <div class="flex items-center gap-4 mt-2">
                            <a href="{{ route('users.photos', $user->id) }}">
                                <x-primary-button>{{ __('View Photos') }}</x-primary-button>
                            </a>
                        </div>
                    @else
                        <p class="text-xl truncate">Uploaded Photos: {{ $user->photos_count }}</p>
                    @endif
                </div>
            </div>
            @endforeach
            {{ $users->links() }}
            @else
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900 dark:text-gray-100">
                    <p class="p-4 text-lg font-medium text-gray-900 dark:text-gray-100" role="alert">
                        {{ __('No results found.') }}
                    </p>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>