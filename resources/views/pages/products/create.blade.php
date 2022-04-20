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
                    <form class="w-full max-w-sm" method="POST" action="{{ route('products.store') }}">
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
                                    id="product-name" type="text" name="name" placeholder="Eg: Shoes">
                            </div>
                        </div>
                        <div class="md:flex md:items-center mb-6 mt-8">
                            <div class="md:w-1/3">
                                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"
                                    for="inline-description">
                                    Description
                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <textarea
                                    name="description"
                                    class="
                                        form-control
                                        block
                                        w-full
                                        px-3
                                        py-1.5
                                        text-base
                                        font-normal
                                        text-gray-700
                                        bg-white bg-clip-padding
                                        border border-solid border-gray-300
                                        rounded
                                        transition
                                        ease-in-out
                                        m-0
                                        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none
                                    "
                                    id="inline-description"
                                    rows="3"
                                    placeholder="Your message"
                                ></textarea>
                            </div>
                        </div>
                        <div class="md:flex md:items-center mb-6 mt-8">
                            <div class="md:w-1/3">
                                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"
                                    for="inline-password">
                                    Categories
                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <div class="inline-block relative w-64">
                                        @if ($categories->count() > 0)
                                            <select name="category_id" class="block appearance-none w-full bg-white px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        @else
                                        <a
                                            id="addCategory"
                                            href="{{ route('categories.create') }}"
                                            class="inline-block bg-blue-600 hover:bg-blue-400 focus:shadow-outline focus:outline-none rounded-sm px-3 py-1 text-sm font-semibold text-white mr-2 mb-2"
                                            type="submit">
                                            add category
                                        </a>
                                        @endif
                                </div>
                            </div>
                        </div>
                        <div class="md:flex md:items-center mt-5">
                            <div class="md:w-1/3"></div>
                            <div class="md:w-2/3">
                                <button
                                    id="createBtn"
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
    @section('js')
        <script>
            let btnCategory = document.getElementById('addCategory');
            let btnCreate = document.getElementById('createBtn');
            if (btnCategory) {
                btnCreate.disabled = true;
                btnCreate.style.cursor = 'not-allowed';
            }
        </script>
    @endsection
</x-app-layout>
