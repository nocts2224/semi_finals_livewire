<div class="p-8 bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
    @if (!$showForm)
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-4xl font-bold text-gray-900">Posts</h1>
                <button wire:click="create"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-lg font-semibold shadow-md hover:shadow-lg transition-all duration-200">
                    + Add New Post
                </button>
            </div>

            @if (session()->has('message'))
                <div
                    class="bg-green-50 border-l-4 border-green-500 text-green-800 p-4 rounded-lg mb-6 shadow-sm message-fade flex items-center gap-3">
                    <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="font-medium">{{ session('message') }}</span>
                </div>
            @endif

            @if (session()->has('delete_message'))
                <div
                    class="bg-red-50 border-l-4 border-red-500 text-red-800 p-4 rounded-lg mb-6 shadow-sm message-fade flex items-center gap-3">
                    <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M8.257 3.099c.366-.446.957-.446 1.323 0l7.071 8.626c.33.403.016 1.025-.661 1.025H1.847c-.677 0-.991-.622-.661-1.025l7.071-8.626z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="font-medium">{{ session('delete_message') }}</span>
                </div>
            @endif


            <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200">
                <table class="w-full">
                    <thead class="bg-gradient-to-r from-gray-100 to-gray-50">
                        <tr>
                            <th class="border-b-2 border-gray-200 p-4 text-left font-bold text-gray-700 text-sm uppercase tracking-wider">ID</th>
                            <th class="border-b-2 border-gray-200 p-4 text-left font-bold text-gray-700 text-sm uppercase tracking-wider">Title</th>
                            <th class="border-b-2 border-gray-200 p-4 text-left font-bold text-gray-700 text-sm uppercase tracking-wider">Author</th>
                            <th class="border-b-2 border-gray-200 p-4 text-left font-bold text-gray-700 text-sm uppercase tracking-wider">Content</th>
                            <th class="border-b-2 border-gray-200 p-4 text-center font-bold text-gray-700 text-sm uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        @forelse($posts as $post)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="p-4 text-gray-600 font-medium">{{ $post->id }}</td>
                                <td class="p-4 font-semibold text-gray-900">{{ $post->title }}</td>
                                <td class="p-4 text-gray-600">{{ $post->author }}</td>
                                <td class="p-4 text-gray-600">{{ $post->content }}</td>
                                <td class="p-4 text-center">
                                    <button wire:click="confirmDelete({{ $post->id }})"
                                        class="text-red-600 hover:text-white hover:bg-red-600 px-4 py-2 rounded-lg font-semibold transition-all duration-200">
                                        Delete
                                    </button>


                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-gray-500 p-12">
                                    <div class="flex flex-col items-center gap-3">
                                        <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <p class="text-lg font-medium">No posts yet.</p>
                                        <p class="text-sm text-gray-400">Create your first post to get started</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @else
        @include('livewire.posts.create')
    @endif

    <!-- Delete Confirmation Modal -->
    @if ($confirmingDelete)
        <div class="fixed inset-0 flex items-center justify-center z-50">
            <div
                class="bg-white border border-gray-200 rounded-2xl shadow-2xl p-6 w-full max-w-md mx-4 text-center animate-fade-in">
                <h2 class="text-xl font-semibold text-gray-800 mb-3">Confirm Deletion</h2>
                <p class="text-gray-600 mb-6">
                    Are you sure you want to delete this post? This action cannot be undone.
                </p>

                <div class="flex justify-center space-x-4">
                    <button wire:click="deleteConfirmed"
                        class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg font-medium transition">
                        Yes, Delete
                    </button>
                    <button wire:click="$set('confirmingDelete', false)"
                        class="bg-gray-100 hover:bg-gray-200 text-gray-800 px-5 py-2 rounded-lg font-medium transition">
                        Cancel
                    </button>
                </div>
            </div>
        </div>

        <style>
            @keyframes fade-in {
                from {
                    opacity: 0;
                    transform: translateY(-10px) scale(0.96);
                }

                to {
                    opacity: 1;
                    transform: translateY(0) scale(1);
                }
            }

            .animate-fade-in {
                animation: fade-in 0.25s ease-out;
            }
        </style>
    @endif
