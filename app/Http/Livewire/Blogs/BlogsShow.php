<?php

namespace App\Http\Livewire\Blogs;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class BlogsShow extends Component
{
    use LivewireAlert;

    public function render()
    {
        return view('livewire.blogs.blogs-show');
    }

}
