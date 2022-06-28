<?php

namespace App\Http\Livewire;

use App\Models\Default_charge;
use Livewire\Component;

class DefaultCharge extends Component
{
    public $editing=false;
    public $type,$weight,$charge;
    public $charges;
    public $deleteID;

    protected $listeners=['confirmed','cancelled'];


    public function render()
    {
        $this->charges=Default_charge::orderBy('type','ASC')->orderBy('weight','ASC')->get();
        return view('livewire.default-charge');
    }
    function edit($id){
        $dc=Default_charge::findorFail($id);
        $this->type=$dc->type;
        $this->weight=$dc->weight;
        $this->charge=$dc->charge;
        $this->editing=true;
    }
    function cancel(){
        $this->editing=false;
        $this->reset('type','weight','charge');
    }
    function save(){
        $errors=false;
        $arr1=['type'=>$this->type,'weight'=>$this->weight];
        $arr2=['charge'=>$this->charge];
        $this->validate([
            'type'=>'required',
            'weight'=>'required',
            'charge'=>'required'
        ]);
        $dc=Default_charge::updateOrCreate($arr1,$arr2);
            if($dc){
                $this->cancel();
                $this->alert('success','Shipping Charge Saved Successfully');
            }
    }
    function deleteCharge($id){
        $this->deleteID=$id;
        $this->confirm('Do you want to delete this Shipping Charge?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'cancelButtonText' => 'No',
            'onConfirmed' => 'confirmed',
            'onCancelled' => 'cancelled'
        ]);
    }

    function confirmed(){
        Default_charge::findOrFail($this->deleteID)->delete();
        $this->alert('success','Shipping Charge Deleted Successfully');
    }

    function cancelled(){

    }
}
