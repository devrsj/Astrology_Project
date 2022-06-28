<?php

namespace App\Http\Livewire;

use App\Models\Service_provider;
use Livewire\Component;

class SaveServiceProvider extends Component
{
    public $sp_id;
    public $name;
    public $type;
    public $editing=false;
    public $deleteID;

    protected $listeners=['confirmed','cancelled'];
    public function render()
    {
        $serviceProviders=Service_provider::orderBy('type','asc')->OrderByDesc('id')->get();
        return view('livewire.save-service-provider',compact('serviceProviders'));
    }

    function ChangeStatus($id){
        $status = Service_provider::findOrFail($id);
        $status->status=!$status->status;
        $status->save();
        $this->alert('success','Status Changed Successfully');
    }

    function saveServiceProvider(){
        $validated=$this->validate([
            'name'=>'required',
            'type'=>'in:domestic,international'
        ]);
        $validated['added_by']=auth()->user()->id;
        $validated['added_by_name']=auth()->user()->name;
        Service_provider::create($validated);
        $this->name='';
        $this->type='';

        $this->alert('success','Service Provider Added Successfully');
    }

    function cancelEditing(){
        $this->editing=false;
        $this->name='';
        $this->type='';

    }

    function deleteServiceProvider($id){
        $this->deleteID=$id;
        $this->confirm('Do you want to delete this Service Provider?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'cancelButtonText' => 'No',
            'onConfirmed' => 'confirmed',
            'onCancelled' => 'cancelled'
        ]);
    }

    function confirmed(){

        Service_provider::findOrFail($this->deleteID)->delete();
        $this->alert('success','Service Provider Deleted Successfully');
    }

    function cancelled(){

    }

    function editServiceProvider($id){
        $serviceProvider = Service_provider::findOrFail($id);
        $this->name=$serviceProvider->name;
        $this->type=$serviceProvider->type;
        $this->sp_id=$serviceProvider->id;
        $this->editing=true;
    }
    function updateServiceProvider(){
        $validated=$this->validate([
            'name'=>'required',
            'type'=>'in:domestic,international'
        ]);
        $serviceProvider = Service_provider::findOrFail($this->sp_id);
        $serviceProvider->type=$this->type;
        $serviceProvider->name=$this->name;
        $serviceProvider->save();
        $this->name='';
        $this->type='';
        $this->editing=false;
        $this->alert('success','Service Provider Updated Successfully');
    }

}
