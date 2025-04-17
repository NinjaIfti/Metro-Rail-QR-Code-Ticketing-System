<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function viewUserDetails(userId) {
            // Send AJAX request to the server to fetch user details
            fetch(`/users/${userId}`)
                .then(response => {
                    // If the response is not OK, throw an error
                    if (!response.ok) {
                        throw new Error('User not found');
                    }
                    return response.json();
                })
                .then(data => {
                    // Populate the modal with user details
                    const userDetails = `
                    <p><strong>Name:</strong> ${data.name}</p>
                    <p><strong>Email:</strong> ${data.email}</p>
                    <p><strong>Role:</strong> ${data.role}</p>
                    <p><strong>Status:</strong> ${data.status}</p>
                    <p><strong>Last Login:</strong> ${data.last_login_at}</p>
                `;

                    // Show the modal with the populated details
                    document.getElementById('userDetailsContent').innerHTML = userDetails;
                    document.getElementById('userDetailsModal').classList.remove('hidden');
                })
                .catch(error => {
                    console.error('Error fetching user details:', error);
                    // Optionally, show an error message in the modal
                    Swal.fire({
                        title: 'Error',
                        text: 'Failed to fetch user details.',
                        icon: 'error',
                        confirmButtonText: 'Close',
                    });
                });
        }

        // Close modal functionality
        document.getElementById('closeModal')?.addEventListener('click', function () {
            document.getElementById('userDetailsModal').classList.add('hidden');
        });
    </script>


    <script>
        function confirmDelete(deleteUrl) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this user deletion!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete user!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = deleteUrl;
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            // User Search and Filter Functionality
            const searchInput = document.querySelector('input[placeholder="Search users..."]');
            const roleFilter = document.querySelector('select[name="role_filter"]');
            const statusFilter = document.querySelector('select[name="status_filter"]');
            const userTable = document.querySelector('tbody');
            const noResultsRow = document.getElementById('no-results-row');

            function filterUsers() {
                const searchTerm = searchInput.value.toLowerCase().trim();
                const selectedRole = roleFilter.value.toLowerCase();
                const selectedStatus = statusFilter.value.toLowerCase();

                let visibleRowCount = 0;

                // Get all table rows
                const rows = userTable.querySelectorAll('tr');

                rows.forEach(row => {
                    const name = row.querySelector('.user-name').textContent.toLowerCase();
                    const email = row.querySelector('.user-email').textContent.toLowerCase();
                    const role = row.querySelector('.user-role').textContent.toLowerCase();
                    const status = row.querySelector('.user-status').textContent.toLowerCase();

                    // Check matching conditions
                    const nameMatch = name.includes(searchTerm);
                    const emailMatch = email.includes(searchTerm);
                    const roleMatch = selectedRole === 'all' || role === selectedRole;
                    const statusMatch = selectedStatus === 'all' || status === selectedStatus;

                    // Determine row visibility
                    const isVisible = (nameMatch || emailMatch) && roleMatch && statusMatch;

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
                return function () {
                    const context = this;
                    const args = arguments;
                    clearTimeout(debounceTimer);
                    debounceTimer = setTimeout(() => func.apply(context, args), delay);
                }
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

            // Optional: Reset filters
            const resetFiltersBtn = document.getElementById('reset-filters');
            if (resetFiltersBtn) {
                resetFiltersBtn.addEventListener('click', function () {
                    if (searchInput) searchInput.value = '';
                    if (roleFilter) roleFilter.value = 'all';
                    if (statusFilter) statusFilter.value = 'all';
                    filterUsers();
                });
            }
        });
    </script>
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
                                <input type="text" placeholder="Search users..."
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
                            <select
                                class="form-select block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option>All Roles</option>
                                <option>Admin</option>
                                <option>User</option>
                                <option>Train Master</option>
                            </select>
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
                                            <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $user->email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($user->roles->isNotEmpty())
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                    @foreach($user->roles as $role)
                        @if($role->name == 'admin') bg-red-100 text-red-800
                        @elseif($role->name == 'train_master') bg-yellow-100 text-yellow-800
                        @else bg-blue-100 text-blue-800 @endif
                    @endforeach">
            {{ ucfirst($user->roles->first()->name) }} <!-- Display the first role -->
        </span>
                                        @else
                                            <span class="text-gray-500">No Role</span>
                                            <!-- Display message if no roles are assigned -->
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                {{ $user->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
        {{ ucfirst($user->status) }} <!-- Display active/inactive status -->
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
                                                View
                                            </a>


                                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                               class="text-indigo-600 hover:text-indigo-900 focus:outline-none focus:underline">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                     viewBox="0 0 20 20"
                                                     fill="currentColor">
                                                    <path
                                                        d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"/>
                                                    <path fill-rule="evenodd"
                                                          d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                          clip-rule="evenodd"/>
                                                </svg>
                                            </a>
                                            <button
                                                onclick="confirmDelete('{{ route('admin.users.delete', $user->id) }}')"
                                                class="text-red-600 hover:text-red-900 focus:outline-none focus:underline">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                     viewBox="0 0 20 20"
                                                     fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                          d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                          clip-rule="evenodd"/>
                                                </svg>
                                                <button/>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
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

        <!-- Modal Structure (hidden by default) -->
        <div id="userDetailsModal"
             class="fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center z-50 hidden">
            <div class="bg-white rounded-lg shadow-lg w-1/3 p-6">
                <h3 class="text-2xl font-semibold text-gray-900">User Details</h3>
                <div id="userDetailsContent" class="mt-4">
                    <!-- User details will be loaded here dynamically -->
                </div>
                <div class="mt-4 flex justify-end space-x-3">
                    <button id="closeModal" class="px-4 py-2 bg-red-500 text-white rounded-md">Close</button>
                </div>
            </div>
        </div>
    </div>

</main>
</body>
</html>
