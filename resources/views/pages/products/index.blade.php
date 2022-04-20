<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('products.create') }}"
                        class="inline-block bg-green-600 hover:bg-green-400 focus:shadow-outline focus:outline-none rounded-sm px-3 py-1 text-sm font-semibold text-white mr-2 mb-2">
                        Create
                    </a>
                    <table class="min-w-full">
                        <thead class="border-b">
                            <tr>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    #
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Name
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Description
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Category
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($products) > 0)
                            @foreach ($products as $idx=> $product)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        {{ $idx+1 }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        {{ $product->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        {{ $product->description }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        @if ($product->categories)
                                            @foreach ($product->categories as $category)
                                                <span
                                                    class="inline-block bg-purple-400 rounded-full px-3 py-1 text-sm font-semibold text-white mr-2 mb-2">#{{ $category->name }}</span>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        <a href="{{ route('products.show', $product->id) }}"
                                            class="inline-block bg-blue-600 hover:bg-blue-400 focus:shadow-outline focus:outline-none rounded-sm px-3 py-1 text-sm font-semibold text-white mr-2 mb-2">
                                            Detail
                                        </a>
                                        <a href="{{ route('products.edit', $product->id) }}"
                                            class="inline-block bg-yellow-600 hover:bg-yellow-400 focus:shadow-outline focus:outline-none rounded-sm px-3 py-1 text-sm font-semibold text-white mr-2 mb-2">
                                            Edit
                                        </a>
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                            class="inline">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button
                                                class="inline-block bg-red-600 hover:bg-red-400 focus:shadow-outline focus:outline-none rounded-sm px-3 py-1 text-sm font-semibold text-white mr-2 mb-2"
                                                type="submit">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center whitespace-no-wrap">
                                        No products found
                                    </td>
                                </tr>
                                @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
