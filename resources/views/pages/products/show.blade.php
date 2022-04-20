<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product detail') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="max-w-sm mx-auto bg-white border-gray-200 rounded overflow-hidden shadow-lg">
                        <div class="px-6 py-4">
                            <div class="font-bold text-xl mb-2">{{ $product->name }}</div>
                            <p class="text-gray-700 text-base">
                                {{ $product->description ? $product->description : "-" }}
                            </p>
                        </div>
                    <div class="px-6 pt-4 pb-2">
                            @if (count($product->categories) > 0)
                                @foreach ($product->categories as $category)
                                    <span
                                        class="inline-block bg-purple-400 rounded-full px-3 py-1 text-sm font-semibold text-white mr-2 mb-2">#{{ $category->name }}</span>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
