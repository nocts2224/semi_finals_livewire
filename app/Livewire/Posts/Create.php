<?php

namespace App\Livewire\Posts;

use Livewire\Component;
use App\Models\Post;

class Create extends Component
{
    public $title;
    public $content;
    public $showForm = false;

    protected $listeners = ['openCreateForm' => 'showForm'];

    public function showForm()
    {
        $this->showForm = true;
    }

    public function cancel()
    {
        $this->showForm = false;
        $this->title = '';
        $this->content = '';
    }

    public function save()
    {
        $this->validate([
            'title' => 'required|min:3',
            'content' => 'required|min:10',
        ]);

        Post::create([
            'title' => $this->title,
            'content' => $this->content
        ]);

        // Use dispatch instead of emit for Livewire v3
        $this->dispatch('postAdded');
        $this->cancel();

        // Optional: Add success message
        session()->flash('message', 'Post created successfully!');
    }

    public function render()
    {
        return view('livewire.posts.create');
    }
}
