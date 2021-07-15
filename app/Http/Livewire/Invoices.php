<?php

namespace App\Http\Livewire;

use App\Models\category;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class Invoices extends Component
{
    use WithPagination;

    public $categories;
    public $users;
    public $quantity_type;
    public $quantity_value;
    public $user_id;
    public $category_id;
    public $modalId;
    public $modalForVisible = false;


    public function mount()
    {
        $this->categories = category::all();
        $this->users = User::all();
    }

    public function showCreateModal()
    {
        $this->modelFormReset();
        $this->modalForVisible = true;

    }

    public function showUpdateModal($id)
    {

        $this->modelFormReset();
        $this->modalForVisible = true;
        $this->modalId = $id;
        $this->loadModalData();
    }

    public function rules()
    {
        return [
            'quantity_type' => ['required'],
            'quantity_value' => ['required'],
            'user_id' => ['required'],
            'category_id' => ['required'],
        ];
    }

    public function modelFormReset()
    {
        $this->quantity_value = null;

    }

    public function modelData()
    {
        return [
            'quantity_type' => $this->quantity_type,
            'quantity_value' => $this->quantity_value,
            'user_id' => $this->user_id,
            'category_id' => $this->category_id,
        ];
    }

    public function loadModalData()
    {
        $data = Invoice::find($this->modalId);
        $this->user_id = $data->user_id;
        $this->category_id = $data->category_id;
        $this->quantity_type = $data->quantity_type;
        $this->quantity_value = $data->quantity_value;
    }

    public function store()
    {

        $this->validate();
        Invoice::create($this->modelData());
        $this->modelFormReset();
        $this->modalForVisible = false;



    }

    public function update()
    {
        $this->validate();
        $invoice = Invoice::where('id',$this->modalId)->first();
        $invoice->update($this->modelData());
        $this->modalForVisible = false;
        $this->modelFormReset();

        session()->flash('message' , ' Invoice Updated Successfully');
    }

    public function all_invoices()
    {
        return Invoice::with(['category', 'user'])->orderBy('id', 'desc')->paginate(5);
    }

    public function render()
    {
        return view('livewire.invoices', [
            'invoices' => $this->all_invoices()
        ]);
    }
}
