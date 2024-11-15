<?php

namespace App\Livewire;

use Livewire\Component;

class QuartetoHistory extends Component
{
    public $isExpanded = false;

    public function toggle()
    {
        $this->isExpanded = !$this->isExpanded;
    }


    public function render()
    {
        return view('livewire.quarteto-history');
    }
}
