<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use Livewire\Component;

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
    }

    public function render()
    {
        return view('livewire.posts.index', [
            'posts' => Post::latest()->get(),
        ]);
    }
}
