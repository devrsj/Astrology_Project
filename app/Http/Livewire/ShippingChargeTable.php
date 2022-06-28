<?php

namespace App\Http\Livewire;

use App\Exports\CityShippingCharges;
use App\Exports\CountryShippingCharges;
use App\Models\ShippingCharge;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class ShippingChargeTable extends Component
{
    public $countries;
    public $search=null;
    protected $queryString=['search'];

    public $editingIndex=null;

    public function render()
    {
        $this->countries= ShippingCharge::with('parent')
        // ->where('parent_id','!=','0')
        ->where('name','like','%'.$this->search.'%')
        ->get()->toArray();

        $dbCountry = ShippingCharge::where('parent_id','0')->get();
        return view('livewire.shipping-charge-table',compact('dbCountry'));
    }

    function exportCity(){
        $this->alert('success','City Shipping Charges Exported');
        return Excel::download(new CityShippingCharges, 'cityCharges.xlsx');
    }
    function exportCountry(){
        $this->alert('success','Country Shipping Charges Exported');
        return Excel::download(new CountryShippingCharges, 'countryCharges.xlsx');
    }



    function edit($index){
        $this->editingIndex=(int)$index;

    }

    function cancelEdit(){
        $this->editingIndex=null;
    }

   function update($index){
    $this->emit('shippingUpdate');

        $selectedCountry = $this->countries[$index] ?? null;
        if(!is_null($selectedCountry)){
            $updatingShippingCharge = ShippingCharge::find($selectedCountry['id']);
            if($updatingShippingCharge){
                $updatingShippingCharge->update($selectedCountry);
                $this->editingIndex=null;
                $this->alert('success','Shipping Charges Updated Successfully');
            }
        }
   }

   function deleteCity($index){
    $this->emit('shippingUpdate');

    $selectedCountry = $this->countries[$index] ?? null;
        if(!is_null($selectedCountry)){
            ShippingCharge::find($selectedCountry['id'])->delete();
            $this->editingIndex=null;
            $this->alert('info','City Deleted Successfully');
        }
    }

}
