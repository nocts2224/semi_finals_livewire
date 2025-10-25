<?php

namespace App\Livewire\Posts;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

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
        $this->reset(['title', 'content', 'showForm']);
    }

    public function save()
    {
        $this->validate([
            'title' => 'required|min:3',
            'content' => 'required|min:10',
        ]);

        // Automatically set author from logged-in user
        Post::create([
            'title'   => $this->title,
            'author'  => Auth::id(), // or Auth::id() if you use user_id
            'content' => $this->content,
        ]);

        $this->dispatch('postAdded');
        $this->cancel();

        session()->flash('message', 'Post created successfully!');
    }

    public function render()
    {
        return view('livewire.posts.create');
    }
}
