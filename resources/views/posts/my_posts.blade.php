<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-4">
                        <a href="{{ route('posts.create') }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Create New Post') }}
                        </a>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @forelse($posts as $post)
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg sm:col-span-1 mb-8">
                                <img src="{{ Storage::url($post->images) }}" class="w-full h-40 object-cover">
                                <h3 class="font-bold text-lg mb-2">{{ $post->title }}</h3>
                                <p class="text-gray-600 text-sm mb-2">{{ $post->category->category_name }}</p>
                                <p class="text-gray-700 text-base mb-2">
                                    {{ strlen($post->description) > 100 ? substr($post->description, 0, 100) . '...' : $post->description }}
                                </p>
                                <a href="{{ route('posts.show', $post->id) }}"
                                    class="text-blue-500 hover:text-blue-700">{{ __('Read more') }}</a>
                            </div>
                        @empty
                            <p>{{ __('You have not created any posts yet.') }}</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
</x-app-layout>
