<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
<main>
    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-semibold text-gray-900">User Management</h1>
                <div class="flex space-x-3">
                    <a href=""
                       class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-gray-700 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        Export
                    </a>
                    <a href="{{ route('admin.users.create') }}"
                       class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                             fill="currentColor">
                            <path fill-rule="evenodd"
                                  d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                  clip-rule="evenodd"/>
                        </svg>
                        Add New User
                    </a>
                </div>
            </div>

            @if (session('success'))
                <div class="mb-4 bg-green-50 border-l-4 border-green-400 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                 fill="currentColor">
                                <path fill-rule="evenodd"
                                      d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-green-700">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 bg-red-50 border-l-4 border-red-400 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                 fill="currentColor">
                                <path fill-rule="evenodd"
                                      d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">User List</h3>
                        <div class="flex items-center space-x-3">
                            <div class="relative">
                                <input type="text" id="search-input" placeholder="Search users..."
                                       class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 sm:text-sm"/>
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                              d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </div>
                            <select id="role-filter" name="role_filter"
                                    class="form-select block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="all">All Roles</option>
                                <option value="admin">Admin</option>
                                <option value="train_master">Train Master</option>
                                <option value="commuter">Commuter</option>
                            </select>
                            <select id="status-filter" name="status_filter"
                                    class="form-select block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="all">All Status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            <button id="reset-filters"
                                    class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Reset
                            </button>
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-200">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Name
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Role
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Last Login
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($users as $user)
                                <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                                    <td class="px-6 py-4 whitespace-nowrap flex items-center space-x-3">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full"
                                                 src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=f3f4f6&color=1f2937"
                                                 alt="{{ $user->name }}">
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900 user-name">{{ $user->name }}</div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 user-email">
                                        {{ $user->email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($user->roles->isNotEmpty())
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full user-role
                                                @if($user->roles->first()->name == 'admin')
                                                    bg-red-100 text-red-800
                                                @elseif($user->roles->first()->name == 'train_master')
                                                    bg-yellow-100 text-yellow-800
                                                @else
                                                    bg-blue-100 text-blue-800
                                                @endif">
                                                {{ ucfirst($user->roles->first()->name) }}
                                            </span>
                                        @else
                                            <span class="text-gray-500 user-role">No Role</span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full user-status
                                            {{ $user->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ ucfirst($user->status) }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $user->last_login_at ? $user->last_login_at->diffForHumans() : 'Never' }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex items-center space-x-3">
                                            <a href="javascript:void(0);"
                                               onclick="viewUserDetails({{ $user->id }})"
                                               class="text-blue-600 hover:text-blue-900 focus:outline-none focus:underline">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                            <a href="javascript:void(0);"
                                               onclick="openEditModal({{ $user->id }})"
                                               class="text-indigo-600 hover:text-indigo-900 focus:outline-none focus:underline">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                     viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"/>
                                                    <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"/>
                                                </svg>
                                            </a>
                                            <a href="javascript:void(0);"
                                               onclick="confirmDelete({{ $user->id }})"
                                               class="text-red-600 hover:text-red-900 focus:outline-none focus:underline">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                     viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            <!-- No results row (hidden by default) -->
                            <tr id="no-results-row" class="hidden">
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                    No users found matching your search criteria.
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                @if($users->hasPages())
                    <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                        {{ $users->links('pagination::tailwind') }}
                    </div>
                @endif
            </div>
        </div>

        <footer class="bg-white rounded-lg shadow-md p-4 mt-6">
            <div class="flex flex-col md:flex-row justify-between items-center text-sm text-gray-600">
                <div>&copy; 2025 Dhaka Metro Rail. All rights reserved.</div>
                <div class="mt-2 md:mt-0">Admin Dashboard v1.0.2</div>
            </div>
        </footer>

        <!-- View User Modal -->
        <div id="userDetailsModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center z-50 hidden">
            <div class="bg-white rounded-lg shadow-lg w-1/3 p-6">
                <h3 class="text-2xl font-semibold text-gray-900">User Details</h3>
                <div id="userDetailsContent" class="mt-4">
                    <!-- User details will be loaded here dynamically -->
                </div>
                <div class="mt-4 flex justify-end space-x-3">
                    <button id="closeViewModal" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">Close</button>
                </div>
            </div>
        </div>

        <!-- Edit User Modal -->
        <div id="editUserModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center z-50 hidden">
            <div class="bg-white rounded-lg shadow-lg w-1/2 p-6">
                <h3 class="text-2xl font-semibold text-gray-900">Edit User</h3>
                <form id="editUserForm" class="mt-4">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_user_id" name="user_id">

                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label for="edit_name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" id="edit_name" name="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="edit_email" class="block text-sm font-medium text-gray-700">Email address</label>
                            <input type="email" id="edit_email" name="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="edit_role" class="block text-sm font-medium text-gray-700">Role</label>
                            <select id="edit_role" name="role" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="admin">Admin</option>
                                <option value="train_master">Train Master</option>
                                <option value="commuter">Commuter</option>
                            </select>
                        </div>

                        <div>
                            <label for="edit_status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select id="edit_status" name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>

                        <div>
                            <label for="edit_password" class="block text-sm font-medium text-gray-700">
                                Password (leave empty to keep current password)
                            </label>
                            <input type="password" id="edit_password" name="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="edit_password_confirmation" class="block text-sm font-medium text-gray-700">
                                Confirm Password
                            </label>
                            <input type="password" id="edit_password_confirmation" name="password_confirmation" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end space-x-3">
                        <button type="button" id="closeEditModal" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Update User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // View User Modal
        window.viewUserDetails = function(userId) {
            fetch(`/admin/users/${userId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('User not found');
                    }
                    return response.json();
                })
                .then(data => {
                    // Populate the modal with user details
                    const userDetails = `
                        <p class="mb-2"><strong>Name:</strong> ${data.name}</p>
                        <p class="mb-2"><strong>Email:</strong> ${data.email}</p>
                        <p class="mb-2"><strong>Role:</strong> ${data.role}</p>
                        <p class="mb-2"><strong>Status:</strong> ${data.status}</p>
                        <p class="mb-2"><strong>Last Login:</strong> ${data.last_login_at}</p>
                    `;

                    // Show the modal with the populated details
                    document.getElementById('userDetailsContent').innerHTML = userDetails;
                    document.getElementById('userDetailsModal').classList.remove('hidden');
                })
                .catch(error => {
                    console.error('Error fetching user details:', error);
                    Swal.fire({
                        title: 'Error',
                        text: 'Failed to fetch user details.',
                        icon: 'error',
                        confirmButtonText: 'Close',
                    });
                });
        };

        // Edit User Modal
        window.openEditModal = function(userId) {
            // Fetch user data
            fetch(`/admin/users/${userId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('User not found');
                    }
                    return response.json();
                })
                .then(data => {
                    // Populate form fields
                    document.getElementById('edit_user_id').value = userId;
                    document.getElementById('edit_name').value = data.name;
                    document.getElementById('edit_email').value = data.email;

                    // Handle role selection
                    const roleSelect = document.getElementById('edit_role');
                    for (let i = 0; i < roleSelect.options.length; i++) {
                        if (roleSelect.options[i].value === data.role.toLowerCase()) {
                            roleSelect.selectedIndex = i;
                            break;
                        }
                    }

                    // Handle status selection
                    const statusSelect = document.getElementById('edit_status');
                    for (let i = 0; i < statusSelect.options.length; i++) {
                        if (statusSelect.options[i].value === data.status.toLowerCase()) {
                            statusSelect.selectedIndex = i;
                            break;
                        }
                    }

                    // Clear password fields
                    document.getElementById('edit_password').value = '';
                    document.getElementById('edit_password_confirmation').value = '';

                    // Show the modal
                    document.getElementById('editUserModal').classList.remove('hidden');
                })
                .catch(error => {
                    console.error('Error fetching user data for edit:', error);
                    Swal.fire({
                        title: 'Error',
                        text: 'Failed to load user data for editing.',
                        icon: 'error',
                        confirmButtonText: 'Close',
                    });
                });
        };

        // Handle edit form submission
        document.getElementById('editUserForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const userId = document.getElementById('edit_user_id').value;
            const formData = new FormData(this);

            // Create a proper data object
            const data = {};
            formData.forEach((value, key) => {
                // Skip empty password if not provided
                if (key === 'password' && value === '') {
                    return;
                }
                data[key] = value;
            });

            // Send AJAX request
            fetch(`/admin/users/${userId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(data)
            })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(data => {
                            throw new Error(data.message || 'Failed to update user');
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    // Close modal
                    document.getElementById('editUserModal').classList.add('hidden');

                    // Show success message
                    Swal.fire({
                        title: 'Success',
                        text: 'User updated successfully!',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        // Reload the page to reflect changes
                        window.location.reload();
                    });
                })
                .catch(error => {
                    console.error('Error updating user:', error);
                    Swal.fire({
                        title: 'Error',
                        text: error.message || 'Failed to update user.',
                        icon: 'error',
                        confirmButtonText: 'Close',
                    });
                });
        });

        // Delete User Function
        window.confirmDelete = function(userId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this user deletion!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete user!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Create a form to send the DELETE request
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/admin/users/${userId}`;

                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'DELETE';

                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    form.appendChild(methodInput);
                    form.appendChild(csrfInput);
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        };

        // Close modals
        document.getElementById('closeViewModal').addEventListener('click', function() {
            document.getElementById('userDetailsModal').classList.add('hidden');
        });

        document.getElementById('closeEditModal').addEventListener('click', function() {
            document.getElementById('editUserModal').classList.add('hidden');
        });

        // Close modals when clicking outside
        window.addEventListener('click', function(event) {
            const viewModal = document.getElementById('userDetailsModal');
            const editModal = document.getElementById('editUserModal');

            if (event.target === viewModal) {
                viewModal.classList.add('hidden');
            }

            if (event.target === editModal) {
                editModal.classList.add('hidden');
            }
        });

        // Enhanced search and filter functionality
        const searchInput = document.getElementById('search-input');
        const roleFilter = document.getElementById('role-filter');
        const statusFilter = document.getElementById('status-filter');
        const resetFiltersBtn = document.getElementById('reset-filters');
        const userTable = document.querySelector('tbody');
        const noResultsRow = document.getElementById('no-results-row');

        function filterUsers() {
            const searchTerm = searchInput.value.toLowerCase().trim();
            const selectedRole = roleFilter.value.toLowerCase();
            const selectedStatus = statusFilter.value.toLowerCase();

            let visibleRowCount = 0;

            // Get all table rows except the no-results-row
            const rows = Array.from(userTable.querySelectorAll('tr:not(#no-results-row)'));

            rows.forEach(row => {
                // Get the cell contents, accounting for nested elements
                const nameCell = row.querySelector('.user-name');
                const emailCell = row.querySelector('.user-email');
                const roleCell = row.querySelector('.user-role');
                const statusCell = row.querySelector('.user-status');

                if (!nameCell || !emailCell || !roleCell || !statusCell) {
                    return; // Skip if any required cell is missing
                }

                const name = nameCell.textContent.toLowerCase().trim();
                const email = emailCell.textContent.toLowerCase().trim();
                const role = roleCell.textContent.toLowerCase().trim();
                const status = statusCell.textContent.toLowerCase().trim();

                // Check matching conditions
                const nameMatch = name.includes(searchTerm);
                const emailMatch = email.includes(searchTerm);
                const roleMatch = selectedRole === 'all' || role.includes(selectedRole);
                const statusMatch = selectedStatus === 'all' || status.includes(selectedStatus);

                // Determine row visibility
                const isVisible = (searchTerm === '' || nameMatch || emailMatch) && roleMatch && statusMatch;

                row.style.display = isVisible ? '' : 'none';

                if (isVisible) {
                    visibleRowCount++;
                }
            });

            // Handle no results scenario
            if (noResultsRow) {
                noResultsRow.style.display = visibleRowCount === 0 ? 'table-row' : 'none';
            }
        }

        // Debounce function to improve performance
        function debounce(func, delay) {
            let debounceTimer;
            return function() {
                const context = this;
                const args = arguments;
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(() => func.apply(context, args), delay);
            };
        }

        // Add event listeners with debounce
        if (searchInput) {
            searchInput.addEventListener('input', debounce(filterUsers, 300));
        }

        if (roleFilter) {
            roleFilter.addEventListener('change', filterUsers);
        }

        if (statusFilter) {
            statusFilter.addEventListener('change', filterUsers);
        }

        // Reset filters
        if (resetFiltersBtn) {
            resetFiltersBtn.addEventListener('click', function() {
                if (searchInput) searchInput.value = '';
                if (roleFilter) roleFilter.value = 'all';
                if (statusFilter) statusFilter.value = 'all';
                filterUsers();
            });
        }

        // Initial filter to handle page load state
        // Initial filter to handle page load state
        filterUsers();

        // Keyboard navigation for modals
        document.addEventListener('keydown', function(event) {
            // Close modals when Escape key is pressed
            if (event.key === 'Escape') {
                const viewModal = document.getElementById('userDetailsModal');
                const editModal = document.getElementById('editUserModal');

                if (!viewModal.classList.contains('hidden')) {
                    viewModal.classList.add('hidden');
                }

                if (!editModal.classList.contains('hidden')) {
                    editModal.classList.add('hidden');
                }
            }
        });

        // Handle clicks on modal container but not content
        document.getElementById('userDetailsModal').addEventListener('click', function(event) {
            if (event.target === this) {
                this.classList.add('hidden');
            }
        });

        document.getElementById('editUserModal').addEventListener('click', function(event) {
            if (event.target === this) {
                this.classList.add('hidden');
            }
        });

        // Form validation for edit form
        const editForm = document.getElementById('editUserForm');
        if (editForm) {
            editForm.querySelectorAll('input').forEach(input => {
                input.addEventListener('invalid', function() {
                    // Add shake animation for invalid fields
                    this.classList.add('border-red-500');
                    setTimeout(() => {
                        this.classList.remove('border-red-500');
                    }, 500);
                });
            });

            // Password confirmation validation
            const passwordField = document.getElementById('edit_password');
            const confirmField = document.getElementById('edit_password_confirmation');

            if (passwordField && confirmField) {
                confirmField.addEventListener('input', function() {
                    if (passwordField.value && this.value) {
                        if (passwordField.value !== this.value) {
                            this.setCustomValidity('Passwords do not match');
                        } else {
                            this.setCustomValidity('');
                        }
                    } else {
                        this.setCustomValidity('');
                    }
                });

                passwordField.addEventListener('input', function() {
                    if (confirmField.value) {
                        if (this.value !== confirmField.value) {
                            confirmField.setCustomValidity('Passwords do not match');
                        } else {
                            confirmField.setCustomValidity('');
                        }
                    }
                });
            }
        }
    });
</script>
</body>
</html>
