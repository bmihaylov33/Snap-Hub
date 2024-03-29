<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $user->name }}'s Photos
        </h2>
    </x-slot>

    <div class="py-12">
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
                    
                    @if ('admin' === auth()->user()->role)
                        <x-danger-button
                            x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'confirm-image-deletion-{{ $photo->id }}')"
                        >{{ __('Delete Image') }}</x-danger-button>

                        <x-modal name="confirm-image-deletion-{{ $photo->id }}" :show="$errors->imageDeletion->isNotEmpty()" focusable>
                            <form method="post" action="{{ route('photo.destroy', $photo->id) }}" class="p-6">
                                @csrf
                                @method('delete')

                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    {{ __('Are you sure you want to delete this photo?') }}
                                </h2>

                                <div class="mt-6 flex justify-end">
                                    <x-secondary-button x-on:click="$dispatch('close')">
                                        {{ __('Cancel') }}
                                    </x-secondary-button>

                                    <x-danger-button class="ms-3">
                                        {{ __('Delete Image') }}
                                    </x-danger-button>
                                </div>
                            </form>
                        </x-modal>
                    @endif
                </div>
                @endforeach
                {{ $photos->links() }}
            @else
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4 text-gray-900 dark:text-gray-100">
                        <p class="p-4 text-lg font-medium" role="alert">
                            {{ __('No results found.') }}
                        </p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>