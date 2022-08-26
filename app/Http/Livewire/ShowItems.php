<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ShowItems extends Component
{
    public $name = '';
    public $items = [];

    protected $rules = [
        'name' => 'required|min:1',
        'items' => 'required',
        'items.*.name' => 'required|min:1',
    ];

    // public function updated($propertyName) {
    //     $this->validateOnly($propertyName); // TODO: validation does not work as expected.
    // }

    public function addItem() {
        array_push($this->items, ['name' => '']);
    }

    public function submit()
    {
        $this->validate();
        dd($this);
    }

    public function render()
    {
        return view('livewire.show-items');
    }
}
