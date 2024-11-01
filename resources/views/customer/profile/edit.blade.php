@extends('front.layouts.app')

@section('content')
    <div class="min-h-screen flex flex-col items-center py-8 max-w-[540px] mx-auto">
        <!-- Back Button and Title -->
        <div class="w-full flex items-center justify-between mb-8 px-3">
            <a href="/my-profile">
                <div
                    class="flex items-center justify-center w-10 h-10 rounded-full bg-[#E0DC00] transition-all duration-300 hover:shadow-[0_10px_20px_0_#e0dc00cc]">
                    <img src="{{ asset('assets/images/icons/arrow-left.svg') }}" class="w-5 h-5 object-contain" alt="icon">
                </div>
            </a>
            <h1 class="text-lg font-semibold">Ubah Profil</h1>
            <span></span> <!-- Placeholder for alignment -->
        </div>

        <!-- Form -->
        <form action="{{ route('customer.update') }}" method="POST" enctype="multipart/form-data" class="w-full mt-8 px-4">
            @csrf
            <!-- Profile Image -->
            <!-- Profile Image -->
            <div class="relative flex justify-center mb-6">
                <img id="profile-pic-preview" src="{{ Storage::url(Auth::user()->avatar) }}" alt="Profile Picture"
                    class="w-24 h-24 rounded-full object-cover">
                <label for="profile-pic-upload"
                    class="absolute bottom-0 ml-16 w-7 h-7 bg-blue-500 rounded-full flex items-center justify-center cursor-pointer">
                    <img
                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAAAsTAAALEwEAmpwYAAAAe0lEQVR4nO3QOwqAMBBF0fGzG12O4FIsk9J9WLlGiyuBBPzERmfAIrcJIXAeRKQkIoAHZks8pTsC9MDGOa+FV/Ec1UeACViBNt6Hy4j7iqdyI59wx70FaOJ7p40fR2qtb8k1/xb3Bf/dt7jXeByww0OmeMgUD5niJXloB4XGGRY1SJAvAAAAAElFTkSuQmCC">
                </label>
                <input id="profile-pic-upload" type="file" name="avatar" class="hidden"
                    onchange="previewImage(event)" />
            </div>

            <!-- Full Name -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-800 mb-1">Nama Lengkap</label>
                <input type="text" name="name" value="{{ Auth::user()->name }}"
                    class="w-full border-b border-gray-400 focus:border-black outline-none p-1" placeholder="Nama Lengkap">
            </div>

            <!-- Email -->
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-800 mb-1">Email</label>
                <input type="email" name="email" value="{{ Auth::user()->email }}"
                    class="w-full border-b border-gray-400 focus:border-black outline-none p-1" placeholder="Email">
            </div>

            <!-- Save Button for Basic Info -->
            <button type="submit"
                class="w-full bg-[#E0DC00] text-black font-semibold py-2 rounded-full hover:bg-[#e0dc00cc] transition-colors">
                Save
            </button>
        </form>

        <!-- Password Update Section -->
        <form action="/update-password" method="POST" class="w-full mt-6 px-4">
            @csrf
            <!-- Old Password -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-800 mb-1">Password Lama</label>
                <input type="password" name="old_password"
                    class="w-full border-b border-gray-400 focus:border-black outline-none p-1" placeholder="Password Lama">
            </div>

            <!-- New Password -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-800 mb-1">Password Baru</label>
                <input type="password" name="new_password"
                    class="w-full border-b border-gray-400 focus:border-black outline-none p-1" placeholder="Password Baru">
            </div>

            <!-- Confirm Password -->
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-800 mb-1">Konfirmasi Password</label>
                <input type="password" name="new_password_confirmation"
                    class="w-full border-b border-gray-400 focus:border-black outline-none p-1"
                    placeholder="Konfirmasi Password">
            </div>

            <!-- Save Button for Password -->
            <button type="submit"
                class="w-full bg-[#E0DC00] text-black font-semibold py-2 rounded-full hover:bg-[#e0dc00cc] transition-colors">
                Save
            </button>
        </form>
    </div>

    @if (session('success'))
        <script>
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('profile-pic-preview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
