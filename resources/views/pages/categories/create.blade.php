<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b shadow-md border-black-500">
                    <form class="w-full max-w-sm" method="POST" action="{{ route('categories.store') }}">
                        {{ @csrf_field() }}
                        <div class="md:flex md:items-center mb-6">
                            <div class="md:w-1/3">
                                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"
                                    for="product-name">
                                    Name
                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <input
                                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                                    id="product-name" type="text" name="name" placeholder="Eg: Electronic">
                            </div>
                        </div>
                        <div class="md:flex md:items-center mt-8">
                            <div class="md:w-1/3"></div>
                            <div class="md:w-2/3">
                                <button
                                    class="inline-block bg-green-600 hover:bg-green-400 focus:shadow-outline focus:outline-none rounded-sm px-3 py-1 text-sm font-semibold text-white mr-2 mb-2"
                                    type="submit">
                                    Create
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
