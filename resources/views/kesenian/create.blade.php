<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Kesenian') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('kesenian.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <x-input-label for="judul" :value="__('Judul')" />
                            <x-text-input id="judul" class="block mt-1 w-full" type="text" name="judul" :value="old('judul')" required autofocus />
                            <x-input-error :messages="$errors->get('judul')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="sub_judul" :value="__('Sub Judul')" />
                            <x-text-input id="sub_judul" class="block mt-1 w-full" type="text" name="sub_judul" :value="old('sub_judul')" required />
                            <x-input-error :messages="$errors->get('sub_judul')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="deskripsi" :value="__('Deskripsi')" />
                            <textarea id="deskripsi" name="deskripsi" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('deskripsi') }}</textarea>
                            <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="banner_image" :value="__('Banner Image')" />
                            <input type="file" id="banner_image" name="banner_image" class="block mt-1 w-full">
                            <x-input-error :messages="$errors->get('banner_image')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="link_youtube" :value="__('Link YouTube')" />
                            <x-text-input id="link_youtube" class="block mt-1 w-full" type="url" name="link_youtube" :value="old('link_youtube')" />
                            <x-input-error :messages="$errors->get('link_youtube')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="file_path" :value="__('File (Image/Video)')" />
                            <input type="file" id="file_path" name="file_path" class="block mt-1 w-full">
                            <x-input-error :messages="$errors->get('file_path')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Simpan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
