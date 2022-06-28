<?php

namespace App\Http\Livewire;

use App\Models\Shipment;
use App\Models\Shipment_status;
use Carbon\Carbon;
use Livewire\Component;

class ShippingTracker extends Component
{
    public $shipment_status=[];
    public $awb_no;
    public $last_status;
    public $shipment;
    public $status_list;

    protected $queryString = ['awb_no'];





    public function render()
    {
        return view('livewire.shipping-tracker');
    }

    public function mount(){

            $this->checkTracking();

    }

    public function checkTracking(){


        if($this->awb_no==""){
            $this->alert('error','Enter Tracking Code');
            $this->shipment_status=[];
            return;
        }
        elseif(!is_numeric($this->awb_no)){
            $this->alert('error','Tracking Code must be number only');
            $this->shipment_status=[];
            return;
        }

        $this->shipment=Shipment::withSum('shipment_line_items','weight')->withCount('shipment_line_items')->withCount('status')->where('awb_no',$this->awb_no)->first();
        if(!$this->shipment){
            $this->alert('error','Tracking ID not found on database');
            $this->shipment_status=[];
            return;
        }
        $this->shipment_status=Shipment_status::where('shipment_id',$this->shipment->id)->orderByDesc('date')->get()->groupBy(function($status) {
            return Carbon::parse($status->date)->format('Y-m-d');
        })->toArray();



        $this->alert('success','Shipment Status Loaded Successfully');
    }

}
