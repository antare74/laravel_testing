<!-- social media login button -->
<div class="flex align-items-center items-center justify-center mx-auto my-5">
    <!-- btn login google -->
    <a href="{{ route('login.google') }}" class="shadow m-2 bg-red-500 hover:bg-red-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">
        <span class="ml-2 text-sm text-gray-300">{{ __('Login with Google') }}</span>
    </a>
    <!-- btn login facebook -->
    <a href="{{ route('login') }}" class="shadow m-2 bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">
        <span class="ml-2 text-sm text-gray-300">{{ __('Login with Facebook') }}</span>
    </a>

</div>
