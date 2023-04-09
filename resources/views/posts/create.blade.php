<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Title -->
                        <div class="mb-4">
                            <label for="title" class="block text-gray-700 font-bold mb-2">{{ __('Title') }}</label>
                            <input type="text" name="title" id="title"
                                class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('title') }}"
                                required autofocus>
                            @error('title')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div class="mb-4">
                            <label for="category_id"
                                class="block text-gray-700 font-bold mb-2">{{ __('Category') }}</label>
                            <select name="category_id" id="category_id"
                                class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                                <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>--
                                    {{ __('Select a category') }} --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->category_name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Image -->
                        <div class="mb-4">
                            <label for="image"
                                class="block text-gray-700 font-bold mb-2">{{ __('Image') }}</label>
                            <input type="file" name="images" id="images"
                                class="form-input rounded-md shadow-sm mt-1 block w-full" accept="image/*" required>
                            @error('image')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description"
                                class="block text-gray-700 font-bold mb-2">{{ __('Description') }}</label>
                            <textarea name="description" id="description" class="form-input rounded-md shadow-sm mt-1 block w-full" rows="5"
                                required>{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Create') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
