@php
    $isAdmin = auth()->user()->role === 'admin';
    $routePrefix = $isAdmin ? 'admin' : 'train_master';
@endphp

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announcements Management</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <!-- Tailwind CSS (if you want to use it alongside Bootstrap) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
</head>
<body>
<div class="container-fluid px-4">
    <h1 class="mt-4">Announcements Management</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route($routePrefix.'.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Announcements</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div><i class="fas fa-bullhorn me-1"></i> Announcements</div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#createAnnouncementModal">
                    <i class="fas fa-plus"></i> New Announcement
                </button>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <table id="announcementsTable" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Priority</th>
                    <th>Author</th>
                    <th>Published</th>
                    <th>Expires</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($announcements as $announcement)
                    <tr>
                        <td>{{ $announcement->title }}</td>
                        <td>
                            <span class="badge {{ $announcement->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                                {{ ucfirst($announcement->status) }}
                            </span>
                        </td>
                        <td>
                            @if ($announcement->priority === 'high')
                                <span class="badge bg-danger">High</span>
                            @elseif ($announcement->priority === 'medium')
                                <span class="badge bg-warning text-dark">Medium</span>
                            @else
                                <span class="badge bg-info text-dark">Low</span>
                            @endif
                        </td>
                        <td>{{ $announcement->user->name }}</td>
                        <td>{{ $announcement->published_at ? $announcement->published_at->format('Y-m-d H:i') : 'N/A' }}</td>
                        <td>{{ $announcement->expires_at ? $announcement->expires_at->format('Y-m-d H:i') : 'Never' }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-info view-announcement"
                                    data-id="{{ $announcement->id }}"
                                    data-title="{{ $announcement->title }}"
                                    data-content="{{ $announcement->content }}"
                                    data-bs-toggle="modal" data-bs-target="#viewAnnouncementModal">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-primary edit-announcement"
                                    data-id="{{ $announcement->id }}"
                                    data-title="{{ $announcement->title }}"
                                    data-content="{{ $announcement->content }}"
                                    data-status="{{ $announcement->status }}"
                                    data-priority="{{ $announcement->priority }}"
                                    data-published="{{ $announcement->published_at ? $announcement->published_at->format('Y-m-d\TH:i') : '' }}"
                                    data-expires="{{ $announcement->expires_at ? $announcement->expires_at->format('Y-m-d\TH:i') : '' }}"
                                    data-bs-toggle="modal" data-bs-target="#editAnnouncementModal">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-danger delete-announcement"
                                    data-id="{{ $announcement->id }}"
                                    data-title="{{ $announcement->title }}"
                                    data-bs-toggle="modal" data-bs-target="#deleteAnnouncementModal">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No announcements found</td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-center">
                {{ $announcements->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Create Announcement Modal -->
<div class="modal fade" id="createAnnouncementModal" tabindex="-1" aria-labelledby="createAnnouncementModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createAnnouncementModalLabel">Create New Announcement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route($routePrefix.'.announcements.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status">
                                    <option value="active" selected>Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="priority" class="form-label">Priority</label>
                                <select class="form-select" id="priority" name="priority">
                                    <option value="low">Low</option>
                                    <option value="medium" selected>Medium</option>
                                    <option value="high">High</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="published_at" class="form-label">Publish Date (optional)</label>
                                <input type="datetime-local" class="form-control" id="published_at" name="published_at">
                                <small class="text-muted">Leave empty to publish immediately</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="expires_at" class="form-label">Expiry Date (optional)</label>
                                <input type="datetime-local" class="form-control" id="expires_at" name="expires_at">
                                <small class="text-muted">Leave empty for no expiration</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Announcement</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- View Announcement Modal -->
<div class="modal fade" id="viewAnnouncementModal" tabindex="-1" aria-labelledby="viewAnnouncementModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewAnnouncementModalLabel">View Announcement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4 id="view-title" class="mb-3"></h4>
                <div id="view-content" class="p-3 bg-light rounded"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Announcement Modal -->
<div class="modal fade" id="editAnnouncementModal" tabindex="-1" aria-labelledby="editAnnouncementModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAnnouncementModalLabel">Edit Announcement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editAnnouncementForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit-title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="edit-title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-content" class="form-label">Content</label>
                        <textarea class="form-control" id="edit-content" name="content" rows="5" required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit-status" class="form-label">Status</label>
                                <select class="form-select" id="edit-status" name="status">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit-priority" class="form-label">Priority</label>
                                <select class="form-select" id="edit-priority" name="priority">
                                    <option value="low">Low</option>
                                    <option value="medium">Medium</option>
                                    <option value="high">High</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit-published_at" class="form-label">Publish Date (optional)</label>
                                <input type="datetime-local" class="form-control" id="edit-published_at"
                                       name="published_at">
                                <small class="text-muted">Leave empty to publish immediately</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit-expires_at" class="form-label">Expiry Date (optional)</label>
                                <input type="datetime-local" class="form-control" id="edit-expires_at"
                                       name="expires_at">
                                <small class="text-muted">Leave empty for no expiration</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Announcement</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Announcement Modal -->
<div class="modal fade" id="deleteAnnouncementModal" tabindex="-1" aria-labelledby="deleteAnnouncementModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAnnouncementModalLabel">Delete Announcement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the announcement "<span id="delete-title"></span>"?</p>
                <p class="text-danger">This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" id="confirmDelete" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        // Initialize DataTable if available
        if ($.fn.DataTable) {
            $('#announcementsTable').DataTable({
                responsive: true,
                order: [[4, 'desc']], // Sort by published date
                columnDefs: [
                    {orderable: false, targets: 6} // Disable sorting on actions column
                ]
            });
        }

        // View announcement modal
        $('.view-announcement').click(function () {
            $('#view-title').text($(this).data('title'));
            $('#view-content').html($(this).data('content'));
        });

        // Edit announcement modal
        $('.edit-announcement').click(function () {
            const id = $(this).data('id');
            const formAction = "{{ route($routePrefix.'.announcements.update', ['id' => ':id']) }}".replace(':id', id);

            $('#editAnnouncementForm').attr('action', formAction);
            $('#edit-title').val($(this).data('title'));
            $('#edit-content').val($(this).data('content'));
            $('#edit-status').val($(this).data('status'));
            $('#edit-priority').val($(this).data('priority'));
            $('#edit-published_at').val($(this).data('published'));
            $('#edit-expires_at').val($(this).data('expires'));
        });

        // Delete announcement modal and action
        $('.delete-announcement').click(function () {
            const id = $(this).data('id');
            $('#delete-title').text($(this).data('title'));

            $('#confirmDelete').off().click(function () {
                $.ajax({
                    url: "{{ route($routePrefix.'.announcements.delete', ['id' => ':id']) }}".replace(':id', id),
                    type: 'DELETE',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        if (response.success) {
                            $('#deleteAnnouncementModal').modal('hide');
                            // Show success message and reload page
                            alert('Announcement deleted successfully!');
                            location.reload();
                        }
                    },
                    error: function (xhr) {
                        alert('Error deleting announcement. Please try again.');
                    }
                });
            });
        });

        // Rich text editor for announcement content if available
        if (typeof CKEDITOR !== 'undefined') {
            CKEDITOR.replace('content');
            CKEDITOR.replace('edit-content');
        }
    });
</script>
</body>
</html>
