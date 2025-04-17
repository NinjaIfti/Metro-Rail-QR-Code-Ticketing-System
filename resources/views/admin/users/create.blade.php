<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
        }

        .sidebar-link.active {
            background-color: #062040;
            color: white;
        }
    </style>
    <link rel="icon" type="image/png" href="{{ asset('images/metrorailforico.png') }}">
</head>

<body>


<div class="bg-white rounded-lg shadow-md p-6">
    <h2 class="text-2xl font-semibold text-gray-900 mb-4">Add New User</h2>

    <!-- Display any success or error message -->
    @if (session('success'))
        <div class="mb-4 bg-green-50 border-l-4 border-green-400 p-4">
            <p class="text-green-700">{{ session('success') }}</p>
        </div>
    @elseif (session('error'))
        <div class="mb-4 bg-red-50 border-l-4 border-red-400 p-4">
            <p class="text-red-700">{{ session('error') }}</p>
        </div>
    @endif

    <!-- User Creation Form -->
    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <!-- Name -->
            <div class="sm:col-span-2">
                <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                <input type="text" name="name" id="name"
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                       required>
                @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Email -->
            <div class="sm:col-span-2">
                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                <input type="email" name="email" id="email"
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                       required>
                @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Password -->
            <div class="sm:col-span-2">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password"
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                       required>
                @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Confirm Password -->
            <div class="sm:col-span-2">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm
                    Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                       required>
            </div>

            <!-- Role -->
            <div class="sm:col-span-2">
                <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                <select name="role" id="role"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        required>
                    <option value="commuter">Commuter</option>
                    <option value="train_master">Train Master</option>
                    <option value="admin">Administrator</option>
                </select>
                @error('role') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

        </div>

        <div class="mt-6">
            <button type="submit"
                    class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Create User
            </button>
        </div>
    </form>
</div>
<!-- Footer -->
<footer class="bg-white rounded-lg shadow-md p-4 mt-6">
    <div class="flex flex-col md:flex-row justify-between items-center text-sm text-gray-600">
        <div>&copy; 2025 Dhaka Metro Rail. All rights reserved.</div>
        <div class="mt-2 md:mt-0">Admin Dashboard v1.0.2</div>
    </div>
</footer>
</body>
</html>
