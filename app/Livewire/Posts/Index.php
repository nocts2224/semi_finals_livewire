<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $title;
    public $content;
    public $showForm = false;
    public $confirmingDelete = false;
    public $deleteId = null;

    public function create()
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

    Post::create([
        'title' => $this->title,
        'author' => Auth::user()->name,
        'content' => $this->content,
    ]);

    session()->flash('message', 'Post created successfully!');
    $this->cancel();
}


    public function delete($id)
    {
        Post::find($id)?->delete();
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->confirmingDelete = true;
    }

    public function deleteConfirmed()
    {
        $this->delete($this->deleteId);
        $this->confirmingDelete = false;
        $this->deleteId = null;

        session()->flash('delete_message', 'Post deleted successfully!');
    }

    public function render()
    {
        return view('livewire.posts.index', [
            'posts' => Post::latest()->get(),
        ]);
    }
}
