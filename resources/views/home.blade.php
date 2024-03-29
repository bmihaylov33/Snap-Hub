<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @auth
            @if (auth()->user()->role === 'user')
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
                    @if (!$photos->isEmpty()) 
                        @foreach ($photos as $photo)
                        <div class="relative group">
                            <a href="{{ route('photo.index', ['photo' => $photo]) }}">
                                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6 aspect-w-1 aspect-h-1 group-hover:opacity-75">
                                    <img src="{{ asset($photo->image_path) }}" class="object-cover object-center w-full h-full" alt="{{ $photo->title }}">
                                </div>
                                <div class="px-3 py-2 text-gray-900 dark:text-gray-100">
                                    <h5 class="font-bold text-xl truncate">{{ $photo->title }}</h5>
                                    <p>{{ $photo->created_at->diffForHumans() }}</p>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    @else
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                <p class="p-6 text-lg font-medium text-gray-900 dark:text-gray-100" role="alert">
                                    {{ __('No results found.') }}
                                </p>
                            </div>
                        </div>
                    @endif
                </div>
            @elseif(auth()->user()->role === 'admin')
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-4 pb-6">
                    <h2 class="font-bold text-2xl truncate leading-tight text-gray-900 dark:text-gray-100 mb-4">
                        {{ __('Last 5 users') }}
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
                        @if (!$users->isEmpty()) 
                            @foreach ($users as $user)
                            <div class="relative group">
                                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6 aspect-w-1 aspect-h-1 px-3 py-4 text-gray-900 dark:text-gray-100 hover:opacity-75">
                                    <h5 class="font-bold text-xl truncate">{{ $user->name }}</h5>
                                    <h5 class="font-bold text-xl truncate">{{ $user->email }}</h5>
                                    <p>{{ $user->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6 text-gray-900 dark:text-gray-100">
                                    <p class="p-6 text-lg font-medium text-gray-900 dark:text-gray-100" role="alert">
                                        {{ __('No results found.') }}
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-4">
                    <h2 class="font-bold text-2xl truncate leading-tight text-gray-900 dark:text-gray-100 mb-4">
                        {{ __('Last 5 photos') }}
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
                        @if (!$photos->isEmpty()) 
                            @foreach ($photos as $photo)
                            <div class="relative group">
                                <a href="{{ route('photo.index', ['photo' => $photo]) }}">
                                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6 aspect-w-1 aspect-h-1 group-hover:opacity-75">
                                        <img src="{{ asset($photo->image_path) }}" class="object-cover object-center w-full h-full" alt="{{ $photo->title }}">
                                    </div>
                                    <div class="px-3 py-2 text-gray-900 dark:text-gray-100">
                                        <h5 class="font-bold text-xl truncate">{{ $photo->title }}</h5>
                                        <p>{{ $photo->created_at->diffForHumans() }}</p>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        @else
                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6 text-gray-900 dark:text-gray-100">
                                    <p class="p-6 text-lg font-medium text-gray-900 dark:text-gray-100" role="alert">
                                        {{ __('No results found.') }}
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        @else
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
                @if (!$photos->isEmpty()) 
                    @foreach ($photos as $photo)
                    <div class="relative group">
                        <a href="{{ route('photo.index', ['photo' => $photo]) }}">
                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6 aspect-w-1 aspect-h-1 group-hover:opacity-75">
                                <img src="{{ asset($photo->image_path) }}" class="object-cover object-center w-full h-full" alt="{{ $photo->title }}">
                            </div>
                            <div class="px-3 py-2 text-gray-900 dark:text-gray-100">
                                <h5 class="font-bold text-xl truncate">{{ $photo->title }}</h5>
                                <p>{{ $photo->created_at->diffForHumans() }}</p>
                            </div>
                        </a>
                    </div>
                    @endforeach
                @else
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <p class="p-6 text-lg font-medium text-gray-900 dark:text-gray-100" role="alert">
                                {{ __('No results found.') }}
                            </p>
                        </div>
                    </div>
                @endif
            </div>
        @endauth
    </div>
</x-app-layout>
