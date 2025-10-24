<div class="p-6">

    @if (!$showForm)
        <h1 class="text-2xl font-bold text-center mb-4">Posts</h1>

        <div class="text-right mb-4">
            <button wire:click="create" class="bg-blue-600 text-white px-4 py-2 rounded">
                New Post
            </button>
        </div>

        @if (session()->has('message'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4 text-center message-fade"> ✅ {{ session('message') }}
        </div> @endif

        <table class="w-full border">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border p-2">ID</th>
                    <th class="border p-2">Title</th>
                    <th class="border p-2">Content</th>
                    <th class="border p-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($posts as $post)
                    <tr>
                        <td class="border p-2">{{ $post->id }}</td>
                        <td class="border p-2">{{ $post->title }}</td>
                        <td class="border p-2">{{ $post->content }}</td>
                        <td class="border p-2 text-center">
                            <button wire:click="delete({{ $post->id }})" class="text-red-600">
                                Delete
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-gray-500 p-4">No posts yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    @else
        @include('livewire.posts.create')
    @endif
    <style>
        .message-fade {
            animation: fadeOut 4s ease-in-out forwards;
        }

        @keyframes fadeOut {
            0% {
                opacity: 0;
                transform: translateY(-10px);
            }

            15% {
                opacity: 1;
                transform: translateY(0);
            }

            75% {
                opacity: 1;
                transform: translateY(0);
            }

            100% {
                opacity: 0;
                transform: translateY(-10px);
                display: none;
            }
        }
    </style>
</div>
