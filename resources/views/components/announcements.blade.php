<!-- Announcements Section (replaces Testimonials) -->
<section class="py-16 bg-metro-primary bg-opacity-5">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl font-bold mb-3 text-center text-gray-800">Metro Announcements</h2>
        <p class="text-xl text-gray-600 text-center mb-12 max-w-3xl mx-auto">Stay updated with the latest information about Dhaka Metro Rail.</p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @php
                $announcements = \App\Models\Announcement::with('user')
                                ->active()
                                ->orderBy('priority', 'desc')
                                ->orderBy('published_at', 'desc')
                                ->take(3)
                                ->get();
            @endphp

            @forelse ($announcements as $announcement)
                <div class="bg-white p-8 rounded-xl shadow-lg">
                    <div class="flex items-center mb-4 justify-between">
                        <h3 class="font-bold text-xl text-gray-800">{{ $announcement->title }}</h3>
                        @if ($announcement->priority === 'high')
                            <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded">Important</span>
                        @endif
                    </div>
                    <div class="text-gray-600 mb-6">
                        {!! Str::limit(strip_tags($announcement->content), 200) !!}
                        @if (strlen(strip_tags($announcement->content)) > 200)
                            <a href="#" class="text-metro-primary hover:underline" data-bs-toggle="modal" data-bs-target="#announcementModal{{ $announcement->id }}">Read more</a>
                        @endif
                    </div>
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-metro-primary bg-opacity-10 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-bullhorn text-metro-primary"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Posted {{ $announcement->published_at->diffForHumans() }}</p>
                            <p class="text-sm text-gray-500">By {{ $announcement->user->name }}</p>
                        </div>
                    </div>
                </div>

                <!-- Announcement Modal -->
                <div class="modal fade" id="announcementModal{{ $announcement->id }}" tabindex="-1" aria-labelledby="announcementModalLabel{{ $announcement->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="announcementModalLabel{{ $announcement->id }}">{{ $announcement->title }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                {!! $announcement->content !!}
                                <hr class="my-4">
                                <div class="text-sm text-gray-500">
                                    Posted {{ $announcement->published_at->format('F j, Y, g:i a') }} by {{ $announcement->user->name }}
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center p-8 bg-white rounded-xl shadow-lg">
                    <i class="fas fa-info-circle text-3xl text-gray-400 mb-4"></i>
                    <p class="text-gray-600">No announcements are currently available.</p>
                </div>
            @endforelse
        </div>

        @if(count($announcements) > 0)
            <div class="text-center mt-8">
                <a href="{{ route('announcements') }}" class="inline-block px-6 py-3 bg-metro-primary text-white rounded-lg hover:bg-blue-700 transition duration-300">
                    View All Announcements
                </a>
            </div>
        @endif
    </div>
</section>
