<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $kesenian->judul }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">{{ $kesenian->sub_judul }}</h3>
                    <p class="mt-1 text-sm text-gray-600">{{ $kesenian->deskripsi }}</p>

                    @if ($kesenian->banner_image)
                        <div class="mt-4">
                            <h4 class="text-md font-medium text-gray-900">Banner Image</h4>
                            <img src="{{ asset('storage/' . $kesenian->banner_image) }}" alt="Banner Image" class="mt-2 h-40">
                        </div>
                    @endif

                    @if ($kesenian->link_youtube)
                        <div class="mt-4">
                            <h4 class="text-md font-medium text-gray-900">Video</h4>
                            <iframe width="560" height="315" src="{{ str_replace('watch?v=', 'embed/', $kesenian->link_youtube) }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    @endif

                    @if ($kesenian->file_path)
                        <div class="mt-4">
                             <h4 class="text-md font-medium text-gray-900">File</h4>
                            <a href="{{ asset('storage/' . $kesenian->file_path) }}" target="_blank" class="text-blue-500">Download/Lihat File</a>
                        </div>
                    @endif

                    <div class="mt-6">
                        <a href="{{ route('kesenian.index') }}" class="text-indigo-600 hover:text-indigo-900">Kembali ke Daftar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
