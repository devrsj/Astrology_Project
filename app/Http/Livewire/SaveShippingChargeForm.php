<?php

namespace App\Http\Livewire;

use App\Exports\CityShippingCharges;
use App\Exports\CountryShippingCharges;
use App\Models\ShippingCharge;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class SaveShippingChargeForm extends Component
{
    public $type,$name,$weight,$shippingCharge;
    public $dbCountry;
    public $dbDistricts;
    public $shippingCharges;
    public $deleteID;
    public $editing=false;

    protected $listeners=['confirmed','cancelled'];

    public function render()
    {
        $this->emit('countryUpdated');
        $this->emit('districtUpdated');
        if($this->name) {
            $this->updateShippingCharges();
        }
        return view('livewire.save-shipping-charge-form');
    }

    function updatedType(){
        $this->emit('countryUpdated');
        $this->resetAll();
    }

    function updateShippingCharges(){
        $this->shippingCharges=ShippingCharge::where('name',$this->name)->orderBy('weight','ASC')->get();
    }
    public function updatedName(){
        $this->updateShippingCharges();
        $this->emit('countryUpdated');
    }


    function saveShippingCharge(){
        $validated=$this->validate([
            'type'=>'required',
            'name'=>'required',
            'weight'=>'required',
        ]);
        $charge=$this->validate([
            'shippingCharge'=>'required'
        ]);

        ShippingCharge::updateOrCreate($validated,$charge);
        $this->editing=false;
        $this->reset(['weight','shippingCharge']);
        $this->alert('success','Shipping Charge Has Been Saved Successfully');

    }

    function editShippingCharge($id){
        $this->editing=true;
        $shipping = ShippingCharge::find($id);
        $this->shippingCharge=$shipping->shippingCharge;
        $this->weight=$shipping->weight;
    }

    function resetAll(){
        $this->editing=false;
        $this->reset(['weight','shippingCharge','name']);
        $this->shippingCharges='';
    }

    function deleteShippingCharge($id){
        $this->deleteID=$id;
        $this->confirm('Do you want to delete this Service Charge?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'cancelButtonText' => 'No',
            'onConfirmed' => 'confirmed',
            'onCancelled' => 'cancelled'
        ]);
    }

    function confirmed(){

        ShippingCharge::findOrFail($this->deleteID)->delete();
        $this->alert('success','Service Charge Deleted Successfully');
    }

    function cancelled(){

    }


    function exportCity(){
        $this->alert('success','City Shipping Charges Exported');
        return Excel::download(new CityShippingCharges, 'cityCharges.xlsx');
    }
    function exportCountry(){
        $this->alert('success','Country Shipping Charges Exported');
        return Excel::download(new CountryShippingCharges, 'countryCharges.xlsx');
    }


}
