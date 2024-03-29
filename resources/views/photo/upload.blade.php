<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Upload Photo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <header>
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Upload new photo') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('Allowed extensions: jpeg, png, jpg, gif. Max size 5MB.') }}
                    </p>
                </header>
                <form class="mt-6 space-y-6" method="post" action="{{ route('photo.upload') }}" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-auto" required />
                    </div>
                    <div>
                        <x-input-label for="image" :value="__('Image')" />
                        <x-text-input id="image" name="image" type="file" accept="image/*" class="mt-1 block w-auto" required />
                    </div>
                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Upload') }}</x-primary-button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
