<?php

namespace App\Livewire\Posts;

use Livewire\Component;
use App\Models\Post;

class Create extends Component
{
    public $title;
    public $author;
    public $content;
    public $showForm = false;

    protected $listeners = ['openCreateForm' => 'showForm'];

    public function showForm()
    {
        $this->showForm = true;
    }

    public function cancel()
    {
        $this->reset(['title', 'author', 'content', 'showForm']);
    }

    public function save()
    {
        $this->validate([
            'title' => 'required|min:3',
            'author' => 'required|min:3',
            'content' => 'required|min:10',
        ]);

        Post::create([
            'title' => $this->title,
            'author' => $this->author,
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
