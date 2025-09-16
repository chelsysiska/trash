<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Profil
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto p-6 bg-white rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Edit Profil</h1>

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')

            {{-- Nama --}}
            <label class="block mb-2">Nama</label>
            <input name="name" value="{{ old('name', $user->name) }}" class="w-full border rounded p-2 mb-2">
            @error('name') <div class="text-red-600 text-sm mb-2">{{ $message }}</div> @enderror

            {{-- Email --}}
            <label class="block mb-2">Email</label>
            <input name="email" type="email" value="{{ old('email', $user->email) }}" class="w-full border rounded p-2 mb-2">
            @error('email') <div class="text-red-600 text-sm mb-2">{{ $message }}</div> @enderror

            <div class="my-4 border-t"></div>

            <p class="text-sm text-gray-600 mb-2">Ganti password (opsional). Untuk mengganti password, isi kolom berikut:</p>

            {{-- Password lama --}}
            <label class="block mb-2">Password Saat Ini</label>
            <input name="current_password" type="password" class="w-full border rounded p-2 mb-2">
            @error('current_password') <div class="text-red-600 text-sm mb-2">{{ $message }}</div> @enderror

            {{-- Password baru --}}
            <label class="block mb-2">Password Baru</label>
            <input name="password" type="password" class="w-full border rounded p-2 mb-2">
            @error('password') <div class="text-red-600 text-sm mb-2">{{ $message }}</div> @enderror

            {{-- Konfirmasi --}}
            <label class="block mb-2">Konfirmasi Password Baru</label>
            <input name="password_confirmation" type="password" class="w-full border rounded p-2 mb-4">

            <div class="flex justify-end">
                <a href="{{ url()->previous() }}" class="mr-3 px-4 py-2 border rounded">Batal</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</x-app-layout>
