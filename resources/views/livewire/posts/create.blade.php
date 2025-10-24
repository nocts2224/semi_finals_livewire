<div class="p-6 bg-white rounded border">
    <h2 class="text-xl font-bold mb-3">Create New Post</h2>

    <div class="mb-3">
        <label class="block mb-1">Title</label>
        <input type="text" wire:model="title" class="w-full border p-2 rounded">
        @error('title') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
    </div>

    <div class="mb-3">
        <label class="block mb-1">Content</label>
        <textarea wire:model="content" class="w-full border p-2 rounded"></textarea>
        @error('content') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
    </div>

    <button wire:click="save" class="bg-green-600 text-white px-4 py-2 rounded">Save</button>
    <button wire:click="cancel" class="bg-gray-600 text-white px-4 py-2 rounded ml-2">Cancel</button>
</div>
