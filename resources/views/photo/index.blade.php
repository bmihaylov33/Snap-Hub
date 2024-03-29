<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $photo->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-2 gap-6">
            <div class="relative group">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <img src="{{ asset($photo->image_path) }}" class="object-cover object-center w-full h-full" alt="{{ $photo->title }}">
                </div>
                <div class="px-3 py-4 text-gray-900 dark:text-gray-100">
                    <h5 class="font-bold text-xl truncate">{{ $photo->title }}</h5>
                    <h5 class="font-bold text-xl truncate">{{ $photo->user->name }}</h5>
                    <p class="card-text">{{ $photo->created_at->format('M d, Y, g:i A') }}</p>
                </div>
                @if (auth()->id() === $photo->user->id)
                    <x-danger-button
                        x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'confirm-image-deletion')"
                    >{{ __('Delete Image') }}</x-danger-button>

                    <x-modal name="confirm-image-deletion" :show="$errors->imageDeletion->isNotEmpty()" focusable>
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
            <div class="relative group">
                <div class="bg-white dark:bg-gray-800 px-3 py-4 overflow-hidden shadow-sm sm:rounded-lg text-gray-900 dark:text-gray-100">
                    <h2 class="pl-4 font-bold text-2xl truncate leading-tight">
                        {{ __('Comments') }}
                    </h2>

                    @if (!$photo->comments->isEmpty()) 
                        @foreach ($photo->comments as $comment)
                            <div class="grid grid-cols-2 gap-6">
                                <div class="border-grey-500 my-4 px-4">
                                    <div class="shadow-sm">
                                        <p class="text-sm text-gray-400">{{ $comment->user->name }} • {{ $comment->created_at->diffForHumans() }}</p>
                                        <p class="text-base">{{ $comment->content }}</p>
                                    </div>
                                </div>
                                @if ('admin' === auth()->user()->role)
                                <div class="my-4 px-4 justify-self-end">
                                    <x-danger-button-sm
                                        x-data=""
                                        x-on:click.prevent="$dispatch('open-modal', 'confirm-comment-deletion-{{ $comment->id }}')"
                                    >{{ __('Delete Comment') }}</x-danger-button-sm>
    
                                    <x-modal name="confirm-comment-deletion-{{ $comment->id }}" :show="$errors->commentDeletion->isNotEmpty()" focusable>
                                        <form method="post" action="{{ route('comments.destroy', $comment->id) }}" class="p-6">
                                            @csrf
                                            @method('delete')
    
                                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                                {{ __('Are you sure you want to delete this comment?') }}
                                                <p class="text-base italic">{{ $comment->content }}</p>
                                            </h2>
    
                                            <div class="mt-6 flex justify-end">
                                                <x-secondary-button x-on:click="$dispatch('close')">
                                                    {{ __('Cancel') }}
                                                </x-secondary-button>
    
                                                <x-danger-button class="ms-3">
                                                    {{ __('Delete Comment') }}
                                                </x-danger-button>
                                            </div>
                                        </form>
                                    </x-modal>
                                </div>
                                @endif
                            </div>
                        @endforeach
                    @else
                        <div>
                            <p class="p-4 text-base font-medium" role="alert">
                                {{ __('No comments found.') }}
                            </p>
                        </div>
                    @endif

                    @if (auth()->check() && ('user' === auth()->user()->role))
                        <form action="{{ route('comments.store', $photo) }}" method="POST" class="px-2">
                            @csrf
                            <div class="w-100 text-gray-900 dark:text-gray-100">
                                <x-text-area id="content" name="content" placeholder="Add a comment" rows="4" class="mt-1 block w-full" required />
                            </div>
                            <div class="mt-2">
                                <x-primary-button>{{ __('Add Comment') }}</x-primary-button>
                            </div>
                        </form>
                        @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>