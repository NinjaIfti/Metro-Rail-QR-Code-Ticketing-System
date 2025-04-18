<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Train Managemnt</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Train Management</h1>
            <button onclick="showAddTrainModal()" class="bg-metro-primary hover:bg-metro-dark text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-plus mr-2"></i> Add New Train
            </button>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Train ID</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Capacity</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created At</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($trains as $train)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $train->train_id }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $train->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                @if($train->status == 'active') bg-green-100 text-green-800
                                @elseif($train->status == 'maintenance') bg-yellow-100 text-yellow-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ ucfirst($train->status) }}
                            </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $train->capacity }} seats
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $train->created_at->format('Y-m-d') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button onclick="showTrainDetails({{ $train->id }})" class="text-metro-primary hover:text-metro-dark mr-3">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button onclick="showEditTrainModal({{ $train->id }})" class="text-indigo-600 hover:text-indigo-900 mr-3">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="confirmDelete('{{ route('admin.trains.delete', $train->id) }}')" class="text-red-600 hover:text-red-900">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                No trains found. <button onclick="showAddTrainModal()" class="text-metro-primary hover:underline">Add a new train</button>.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 border-t border-gray-200">
                {{ $trains->links() }}
            </div>
        </div>
    </div>

    <!-- Train Details Modal -->
    <div id="trainDetailsModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-1/2 lg:w-1/3 shadow-lg rounded-md bg-white">
            <div class="flex justify-between items-center pb-3">
                <h3 class="text-xl font-bold text-gray-800" id="modalTitle">Train Details</h3>
                <button onclick="closeTrainDetailsModal()" class="text-gray-400 hover:text-gray-500">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div id="trainDetailsContent" class="mt-4 space-y-3">
                <!-- Content will be populated dynamically -->
            </div>
            <div class="mt-6 flex justify-end">
                <button onclick="closeTrainDetailsModal()" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Close
                </button>
            </div>
        </div>
    </div>

    <!-- Add Train Modal -->
    <div id="addTrainModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-2/3 lg:w-1/2 shadow-lg rounded-md bg-white">
            <div class="flex justify-between items-center pb-3 border-b">
                <h3 class="text-xl font-bold text-gray-800">Add New Train</h3>
                <button onclick="closeAddTrainModal()" class="text-gray-400 hover:text-gray-500">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="addTrainForm" action="{{ route('admin.trains.store') }}" method="POST" class="p-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Train ID -->
                    <div>
                        <label for="add_train_id" class="block text-sm font-medium text-gray-700 mb-1">Train ID *</label>
                        <input type="text" name="train_id" id="add_train_id"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-metro-primary focus:border-metro-primary"
                               placeholder="e.g. MR-101" required>
                        <p class="text-red-500 text-xs mt-1 hidden" id="add_train_id_error"></p>
                    </div>

                    <!-- Name -->
                    <div>
                        <label for="add_name" class="block text-sm font-medium text-gray-700 mb-1">Train Name</label>
                        <input type="text" name="name" id="add_name"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-metro-primary focus:border-metro-primary"
                               placeholder="e.g. Dhaka Express">
                        <p class="text-red-500 text-xs mt-1 hidden" id="add_name_error"></p>
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="add_status" class="block text-sm font-medium text-gray-700 mb-1">Status *</label>
                        <select name="status" id="add_status"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-metro-primary focus:border-metro-primary" required>
                            <option value="active">Active</option>
                            <option value="maintenance">Maintenance</option>
                            <option value="inactive">Inactive</option>
                        </select>
                        <p class="text-red-500 text-xs mt-1 hidden" id="add_status_error"></p>
                    </div>

                    <!-- Capacity -->
                    <div>
                        <label for="add_capacity" class="block text-sm font-medium text-gray-700 mb-1">Capacity (Seats) *</label>
                        <input type="number" name="capacity" id="add_capacity"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-metro-primary focus:border-metro-primary"
                               placeholder="e.g. 200" value="200" min="0" required>
                        <p class="text-red-500 text-xs mt-1 hidden" id="add_capacity_error"></p>
                    </div>
                </div>

                <!-- Description -->
                <div class="mt-6">
                    <label for="add_description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description" id="add_description" rows="4"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-metro-primary focus:border-metro-primary"
                              placeholder="Enter train description..."></textarea>
                    <p class="text-red-500 text-xs mt-1 hidden" id="add_description_error"></p>
                </div>

                <div class="mt-6 flex justify-end">
                    <button type="button" onclick="closeAddTrainModal()" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                        Cancel
                    </button>
                    <button type="submit" class="bg-metro-primary hover:bg-metro-dark text-white font-bold py-2 px-4 rounded">
                        Add Train
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Train Modal -->
    <div id="editTrainModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-2/3 lg:w-1/2 shadow-lg rounded-md bg-white">
            <div class="flex justify-between items-center pb-3 border-b">
                <h3 class="text-xl font-bold text-gray-800">Edit Train</h3>
                <button onclick="closeEditTrainModal()" class="text-gray-400 hover:text-gray-500">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="editTrainForm" method="POST" class="p-6">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_train_id_hidden">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Train ID -->
                    <div>
                        <label for="edit_train_id" class="block text-sm font-medium text-gray-700 mb-1">Train ID *</label>
                        <input type="text" name="train_id" id="edit_train_id"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-metro-primary focus:border-metro-primary"
                               placeholder="e.g. MR-101" required>
                        <p class="text-red-500 text-xs mt-1 hidden" id="edit_train_id_error"></p>
                    </div>

                    <!-- Name -->
                    <div>
                        <label for="edit_name" class="block text-sm font-medium text-gray-700 mb-1">Train Name</label>
                        <input type="text" name="name" id="edit_name"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-metro-primary focus:border-metro-primary"
                               placeholder="e.g. Dhaka Express">
                        <p class="text-red-500 text-xs mt-1 hidden" id="edit_name_error"></p>
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="edit_status" class="block text-sm font-medium text-gray-700 mb-1">Status *</label>
                        <select name="status" id="edit_status"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-metro-primary focus:border-metro-primary" required>
                            <option value="active">Active</option>
                            <option value="maintenance">Maintenance</option>
                            <option value="inactive">Inactive</option>
                        </select>
                        <p class="text-red-500 text-xs mt-1 hidden" id="edit_status_error"></p>
                    </div>

                    <!-- Capacity -->
                    <div>
                        <label for="edit_capacity" class="block text-sm font-medium text-gray-700 mb-1">Capacity (Seats) *</label>
                        <input type="number" name="capacity" id="edit_capacity"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-metro-primary focus:border-metro-primary"
                               placeholder="e.g. 200" min="0" required>
                        <p class="text-red-500 text-xs mt-1 hidden" id="edit_capacity_error"></p>
                    </div>
                </div>

                <!-- Description -->
                <div class="mt-6">
                    <label for="edit_description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description" id="edit_description" rows="4"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-metro-primary focus:border-metro-primary"
                              placeholder="Enter train description..."></textarea>
                    <p class="text-red-500 text-xs mt-1 hidden" id="edit_description_error"></p>
                </div>

                <div class="mt-6 flex justify-end">
                    <button type="button" onclick="closeEditTrainModal()" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                        Cancel
                    </button>
                    <button type="submit" class="bg-metro-primary hover:bg-metro-dark text-white font-bold py-2 px-4 rounded">
                        Update Train
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteConfirmModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                    <i class="fas fa-exclamation-triangle text-red-600"></i>
                </div>
                <h3 class="text-lg leading-6 font-medium text-gray-900">Delete Train</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500">
                        Are you sure you want to delete this train? This action cannot be undone.
                    </p>
                </div>
                <div class="items-center px-4 py-3">
                    <button id="deleteConfirmBtn" data-url=""
                            class="px-4 py-2 bg-red-600 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                        Delete
                    </button>
                    <button onclick="closeDeleteModal()"
                            class="mt-3 px-4 py-2 bg-gray-100 text-gray-700 text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-300">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Show Train Details Modal
        function showTrainDetails(id) {
            fetch(`/admin/trains/${id}/details`)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert('Error: ' + data.error);
                        return;
                    }

                    const statusClass = data.status === 'Active'
                        ? 'bg-green-100 text-green-800'
                        : (data.status === 'Maintenance' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800');

                    const content = `
                    <div class="grid grid-cols-1 gap-4">
                        <div class="border-b pb-2">
                            <span class="text-gray-500 text-sm">Train ID:</span>
                            <span class="text-gray-900 font-medium ml-2">${data.train_id}</span>
                        </div>
                        <div class="border-b pb-2">
                            <span class="text-gray-500 text-sm">Name:</span>
                            <span class="text-gray-900 font-medium ml-2">${data.name || 'N/A'}</span>
                        </div>
                        <div class="border-b pb-2">
                            <span class="text-gray-500 text-sm">Status:</span>
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${statusClass} ml-2">${data.status}</span>
                        </div>
                        <div class="border-b pb-2">
                            <span class="text-gray-500 text-sm">Capacity:</span>
                            <span class="text-gray-900 font-medium ml-2">${data.capacity} seats</span>
                        </div>
                        <div class="border-b pb-2">
                            <span class="text-gray-500 text-sm">Description:</span>
                            <span class="text-gray-900 font-medium ml-2">${data.description || 'No description provided.'}</span>
                        </div>
                        <div>
                            <span class="text-gray-500 text-sm">Created:</span>
                            <span class="text-gray-900 font-medium ml-2">${data.created_at}</span>
                        </div>
                    </div>
                `;

                    document.getElementById('trainDetailsContent').innerHTML = content;
                    document.getElementById('trainDetailsModal').classList.remove('hidden');
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while fetching train details.');
                });
        }

        function closeTrainDetailsModal() {
            document.getElementById('trainDetailsModal').classList.add('hidden');
        }

        // Add Train Modal
        function showAddTrainModal() {
            document.getElementById('addTrainModal').classList.remove('hidden');
        }

        function closeAddTrainModal() {
            document.getElementById('addTrainModal').classList.add('hidden');
            document.getElementById('addTrainForm').reset();
            // Hide all error messages
            document.querySelectorAll('#addTrainForm .text-red-500').forEach(el => {
                el.classList.add('hidden');
                el.textContent = '';
            });
        }

        // Edit Train Modal
        function showEditTrainModal(id) {
            // Fetch train details and populate the form
            fetch(`/admin/trains/${id}/details`)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert('Error: ' + data.error);
                        return;
                    }

                    document.getElementById('edit_train_id_hidden').value = id;
                    document.getElementById('edit_train_id').value = data.train_id;
                    document.getElementById('edit_name').value = data.name || '';
                    document.getElementById('edit_status').value = data.status.toLowerCase();
                    document.getElementById('edit_capacity').value = data.capacity;
                    document.getElementById('edit_description').value = data.description || '';

                    // Set form action
                    document.getElementById('editTrainForm').action = `/admin/trains/${id}`;

                    // Show the modal
                    document.getElementById('editTrainModal').classList.remove('hidden');
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while fetching train details for editing.');
                });
        }

        function closeEditTrainModal() {
            document.getElementById('editTrainModal').classList.add('hidden');
            document.getElementById('editTrainForm').reset();
            // Hide all error messages
            document.querySelectorAll('#editTrainForm .text-red-500').forEach(el => {
                el.classList.add('hidden');
                el.textContent = '';
            });
        }

        // Delete Confirmation
        function confirmDelete(url) {
            document.getElementById('deleteConfirmBtn').dataset.url = url;
            document.getElementById('deleteConfirmModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteConfirmModal').classList.add('hidden');
        }

        // Event Listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Add Train Form Submit
            document.getElementById('addTrainForm').addEventListener('submit', function(e) {
                e.preventDefault();
                const form = this;
                const formData = new FormData(form);

                fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    },
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            window.location.reload();
                        } else if (data.errors) {
                            // Display validation errors
                            Object.keys(data.errors).forEach(field => {
                                const errorElement = document.getElementById(`add_${field}_error`);
                                if (errorElement) {
                                    errorElement.textContent = data.errors[field][0];
                                    errorElement.classList.remove('hidden');
                                }
                            });
                        } else {
                            alert('An error occurred while adding the train.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while submitting the form.');
                    });
            });

            // Edit Train Form Submit
            document.getElementById('editTrainForm').addEventListener('submit', function(e) {
                e.preventDefault();
                const form = this;
                const formData = new FormData(form);

                fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    },
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            window.location.reload();
                        } else if (data.errors) {
                            // Display validation errors
                            Object.keys(data.errors).forEach(field => {
                                const errorElement = document.getElementById(`edit_${field}_error`);
                                if (errorElement) {
                                    errorElement.textContent = data.errors[field][0];
                                    errorElement.classList.remove('hidden');
                                }
                            });
                        } else {
                            alert('An error occurred while updating the train.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while submitting the form.');
                    });
            });

            // Delete Train
            document.getElementById('deleteConfirmBtn').addEventListener('click', function() {
                const url = this.dataset.url;

                fetch(url, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            window.location.reload();
                        } else {
                            alert('Error: ' + data.message);
                            closeDeleteModal();
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while deleting.');
                        closeDeleteModal();
                    });
            });
        });
    </script>
</body>
</html>
