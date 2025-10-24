<div class="p-8 bg-white rounded-xl border border-gray-200 shadow-lg max-w-2xl mx-auto">
    <h2 class="text-3xl font-bold mb-6 text-gray-900">Create New Post</h2>
    
    <div class="mb-6">
        <label class="block mb-2 font-semibold text-gray-700 text-sm uppercase tracking-wide">Title</label>
        <input type="text" wire:model="title"
            class="w-full border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 p-3 rounded-lg shadow-sm transition-all duration-200 hover:border-gray-400">
        @error('title')
            <span class="text-red-600 text-sm mt-1.5 block font-medium">{{ $message }}</span>
        @enderror
    </div>
    
    <div class="mb-6">
        <label class="block mb-2 font-semibold text-gray-700 text-sm uppercase tracking-wide">Content</label>
        <textarea wire:model="content" rows="6"
            class="w-full border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 p-3 rounded-lg shadow-sm transition-all duration-200 hover:border-gray-400 resize-y"></textarea>
        @error('content')
            <span class="text-red-600 text-sm mt-1.5 block font-medium">{{ $message }}</span>
        @enderror
    </div>
    
    <div class="flex justify-end gap-3 pt-2">
        <button wire:click="cancel"
            class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-5 py-2.5 rounded-lg font-semibold transition-all duration-200 border border-gray-300">
            Cancel
        </button>
        <button wire:click="save"
            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg font-semibold transition-all duration-200 shadow-md hover:shadow-lg">
            Save Post
        </button>
    </div>
</div>