<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- NIK -->
        <div class="mt-4">
            <label for="nik">NIK</label>
            <input id="nik" type="text" name="nik" required class="block mt-1 w-full" />
        </div>

        <!-- Nama -->
        <div class="mt-4">
            <label for="nama">Nama</label>
            <input id="name" type="text" name="name" required class="block mt-1 w-full" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" required class="block mt-1 w-full" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required class="block mt-1 w-full" />
        </div>

        <!-- Alamat -->
        <div class="mt-4">
            <label for="alamat">Alamat</label>
            <textarea id="alamat" name="alamat" class="block mt-1 w-full"></textarea>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
    @error('email')
    <small class="text-danger">{{ $message }}</small>
@enderror

</x-guest-layout>
