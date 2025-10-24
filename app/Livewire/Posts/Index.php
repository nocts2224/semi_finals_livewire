<?php

namespace App\Livewire\Posts;

use Livewire\Component;
use App\Models\Post;

class Index extends Component
{
    public $title, $content;
    public $showForm = false;

    public function create()
    {
        $this->showForm = true;
    }

    public function cancel()
    {
        $this->reset(['title', 'content']);
        $this->showForm = false;
    }

    public function save()
    {
        $this->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        Post::create([
            'title' => $this->title,
            'content' => $this->content,
        ]);

        session()->flash('message', 'Post created successfully!');
        $this->cancel(); // return to table
    }

    public function delete($id)
    {
        Post::find($id)->delete();
    }

    public function render()
    {
        return view('livewire.posts.index', [
            'posts' => Post::latest()->get()
        ]);
    }
}
