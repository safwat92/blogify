<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <div>
            <x-input-label for="profile" :value="__('Profile')" />
            <x-text-input id="profile" class="block w-full text-sm text-gray-500
           file:mr-4 file:py-2 file:px-4
           file:rounded-md file:border-0
           file:text-sm file:font-medium
           file:bg-gray-50 file:text-gray-700
           hover:file:bg-gray-100
           cursor-pointer
           border border-gray-300
           rounded-md shadow-sm
           focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500 mb-4"  type="file" name="profile" :value="old('profile')" autofocus
        autocomplete="profile" accept="image/png, image/jpeg, image/jpg, image/webp"/>
            <x-input-error :messages="$errors->get('profile')" class="mt-2" />
        </div>

        <!-- Name -->
        <div class="flex gap-3">
            <div class="flex-1">
                <x-input-label for="fname" :value="__('First Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus
                    autocomplete="name" />
                <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
            </div>
            <div class="flex-1">
                <x-input-label for="name" :value="__('Last Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autofocus
                    autocomplete="name" />
                <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
            </div>
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- Birthdate & gender --}}
        <div class="flex gap-3 items-center">
            <div class="mt-4 flex-1">
                <x-input-label for="birth_date" :value="__('Birthdate')" />
                <x-text-input id="birth_date" class="block mt-1 w-full" type="date" name="birth_date" :value="old('birth_date')" required
                    autocomplete="birth_date" />
                <x-input-error :messages="$errors->get('birth_date')" class="mt-2" />
            </div>
            
            <div class="mt-4 flex-1">
                <x-input-label for="gender" :value="__('Gender')" />
                <select name="gender" id="gender" class="flex-1 w-full mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    <option value="male">male</option>
                    <option value="female">female</option>
                    <option value="other">other</option>
                </select>
                <x-input-error :messages="$errors->get('gender')" class="mt-2" />
            </div>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
