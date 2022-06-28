<?php

namespace App\Http\Livewire;

use App\Models\Default_charge;
use App\Models\Service_provider;
use App\Models\Shipment;
use App\Models\Shipment_line_item;
use App\Models\Shipment_permission;
use App\Models\Shipment_status;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\ShippingCharge;
use App\Models\User;
use App\Notifications\ShipmentCreated;
use Illuminate\Notifications\Notifiable;

class ShipmentMainForm extends Component
{
    use Notifiable;

    public $editing;
    public $shipment_id;
    public $db_shipment_id = 0; //shipment id that is created
    public $currentStep = 1;
    public $shipmentBillInfo;

    public $availableServiceProvider=[];
    public $itemsCount;
    public $itemsWeight;
    public $totalShippingCharge=0;

    public $checkedShipment=false; //is ready to create shipment or not?

    public $step_name = [
        '1' => 'Shipment Type',
        '2' => 'Service Provider',
        '3' => 'Sender and Receiver Information',
        '4' => 'Document Type and Details',
        '5' => 'Review Shipping Charge',
        '6' => 'Print'
    ];
    public $shipment_purpose_select = [
        'gift' => 'Gift',
        'commercial' => 'Commercial',
        'notforsale' => 'notforsale',
        'sample' => 'Sample'

    ];
    // protected $listeners=['nextStep'=>'$refresh'];

    //database table;
    public $awb_no, $bardcode;
    public $shipment_type, $service_provider, $shipment_purpose, $shipment_reference, $shipment_description;
    public $from_name, $from_country, $from_state, $from_city, $from_street, $from_postal_code, $from_contact_number, $from_email;
    public $to_name, $to_country, $to_state, $to_city, $to_street, $to_postal_code, $to_contact_number, $to_email;
    public $status, $gross_total, $discount, $tax, $service_charge, $net_total;
    public $from_country_code, $to_country_code;
    public $package_type;
    public $from_company_name, $to_company_name;
    public $shipment_value;
    public $from_street2, $from_street3;
    public $to_street2, $to_street3;




    //parcels array
    public $parcels = [];

    //document array
    public $documents = [];


    //dynamic cities, states

    public $dbCities =[];
    public $dbCountries=[];
    public $dbStates=[];



    //rules
    protected $step1 = [
        'shipment_type' => 'required'
    ];

    //shipping from to details
    protected $step3 = [
        'from_name' => 'required',
        'from_country' => 'required',
        'from_country_code' => 'required',
        'from_contact_number' => 'required',
        'from_postal_code' => 'required',
        'to_name' => 'required',
        'to_country' => 'required',
        'to_country_code' => 'required',
        'to_contact_number' => 'required',
        'to_postal_code' => 'required'

    ];
    protected $step3_domestic=[
        'from_city'=>'required',
        'to_city'=>'required'
    ];

    protected $step2 = [
        'service_provider' => 'required'
    ];
    protected $step4 = [
        'package_type' => 'required',
        'shipment_purpose' => 'required',
        'shipment_value'=>'required'
    ];
    protected $step4_parcel = [
        'parcels.*.name' => 'required',
    ];
    protected $step4_document = [
        'documents.*.name' => 'required',
    ];

    protected $messages = [
        'documents.*.name' => 'Document Name is required',
        'parcels.*.name' => 'Parcel Name is required',

    ];

    protected function rules()
    {
        $rules = array_merge($this->step1, $this->step3, $this->step2, $this->step4);
        return $rules;
    }

    public function render()
    {
        $this->dbCountries = ShippingCharge::where('type','country')->get();
        $this->dbCities = ShippingCharge::where('type','city')->get();
        return view('livewire.shipment-main-form');
    }

    function updatedFromCountry(){
        foreach(countryInfoList() as $country){
            if($country['name']==$this->from_country){
                $this->from_country_code=$country['calling_code'];
                break;
            }
        }
    }
    function updatedToCountry(){
        foreach(countryInfoList() as $country){
            if($country['name']==$this->to_country){
                $this->to_country_code=$country['calling_code'];
                break;
            }
        }
    }

    public function mount()
    {

        if ($this->editing == "true") {
            $shipment = Shipment::findOrFail($this->shipment_id);
            $this->from_name = $shipment->from_name;
            $this->from_company_name = $shipment->from_company_name;
            $this->from_country = $shipment->from_country;
            $this->from_city = $shipment->from_city;
            $this->from_street = $shipment->from_street;
            $this->from_state = $shipment->from_state;
            $this->from_email = $shipment->from_email;
            $this->from_postal_code = $shipment->from_postal_code;
            $this->from_street2=$shipment->from_street2;
            $this->from_street3=$shipment->from_street3;

            $phone_array = explode('-', $shipment->from_contact_number);
            $this->from_country_code = $phone_array[0];
            $this->from_contact_number = $phone_array[1];

            $this->to_name = $shipment->to_name;
            $this->to_company_name = $shipment->to_company_name;
            $this->to_country = $shipment->to_country;
            $this->to_city = $shipment->to_city;
            $this->to_street = $shipment->to_street;
            $this->to_state = $shipment->to_state;
            $this->to_email = $shipment->to_email;
            $this->to_postal_code = $shipment->to_postal_code;
            $this->to_street2=$shipment->to_street2;
            $this->to_street3=$shipment->to_street3;

            $to_phone_array = explode('-', $shipment->from_contact_number);
            $this->to_country_code = $to_phone_array[0];
            $this->to_contact_number = $to_phone_array[1];

            $this->shipment_type = $shipment->shipment_type;
            $this->service_provider = $shipment->service_provider;
            $this->shipment_purpose = $shipment->shipment_purpose;
            $this->shipment_reference = $shipment->shipment_reference;
            $this->shipment_description = $shipment->shipment_description;
            $this->shipment_package_type = $shipment->package_type;
            $this->shipment_value = $shipment->shipment_value;



            //packages details
            $shipment_line_items = Shipment_line_item::where('shipment_id', $this->shipment_id)->get();

            foreach ($shipment_line_items as $sli) {
                $this->package_type = $sli->package_type;

                if ($sli->package_type == "document") {
                    $this->documents[] = ['name' => $sli->package_name, 'quantity' => $sli->quantity];
                } elseif ($sli->package_type == "parcel") {
                    $this->parcels[] = ['name' => $sli->package_name, 'quantity' => $sli->quantity, 'length' => $sli->length, 'breadth' => $sli->breadth, 'height' => $sli->height, 'weight' => $sli->weight];
                }
            }
        } else {
            $this->parcels = [
                ['name' => '', 'quantity' => 1, 'length' => 1, 'breadth' => 1, 'height' => 1, 'weight' => 1],
            ];
            $this->documents = [
                ['name' => '', 'quantity' => 1],
            ];

        }
    }
    //get loggedin user info and fill on form
    public function fillUserInfo(){
        $this->from_name=auth()->user()->name;
        $this->from_email=auth()->user()->email;
        $this->from_postal_code=auth()->user()->userAddress->postal_code??null;
        $this->from_country=auth()->user()->userAddress->country??null;
        $this->from_street=auth()->user()->userAddress->street??null;
        $this->from_company_name=auth()->user()->company_name??null;
        $this->from_contact_number=auth()->user()->phone??null;

        if($this->from_country){
            $code = ShippingCharge::where('name',$this->from_country)->first();
            if($code)$this->from_country_code=$code->dialcode;
        }
    }
    public function submitFirst()
    {
        //fill logged in user info
        $this->fillUserInfo();
        $this->validate($this->step1);

        if ($this->shipment_type == "domestic") {
            $this->from_country="Nepal";
            $this->to_country="Nepal";
            $this->from_country_code='977';
            $this->to_country_code='977';
        }

        if($this->shipment_type=="domestic"){
            $this->availableServiceProvider=Service_provider::where(['type'=>'domestic','status'=>1])->get();
        }
        else{
            $this->availableServiceProvider=Service_provider::where(['type'=>'international','status'=>1])->get();
        }

        $this->currentStep = 2;
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }



    public function submitSecond()
    {
        $validatedData = $this->validate($this->step2);
        
         if($this->from_country){
             foreach(countryInfoList() as $dbCountryList){
                 if($dbCountryList['name']==$this->from_country){
                     $this->from_country_code=$dbCountryList['calling_code'];
                     break;
                 }
             }
             
             
            //  if($this->from_country=="Nepal"){
            //      $this->from_country_code='977';
            //  }else{
            // $code = ShippingCharge::where('name',$this->from_country)->first();
            // if($code)$this->from_country_code=$code->dialcode;
            // }
        }
        
        $this->currentStep = 3;
    }
    public function submitThird()
    {
        if($this->shipment_type=='domestic'){
        $this->validate($this->step3_domestic);
        }
        $validatedData = $this->validate($this->step3);


        $this->currentStep = 4;
    }
    public function resetChargeStats(){
        $this->itemsWeight=0;
        $this->itemsCount=0;
        $this->totalShippingCharge=0;
    }

    public function submitBeforeFourth(){

        $validatedData = $this->validate($this->step4);
        if ($this->package_type == "document") {
            $this->validate($this->step4_document);
            $this->resetChargeStats();

            foreach ($this->documents as $document) {
                        $this->resetChargeStats();

                $this->itemsCount+=$document['quantity'];
                //getting price of shipment
                if($this->shipment_type=="domestic"){

                    $getDBcharge=Default_charge::where(['type'=>'domestic','weight'=>10])->first();
                    $defaultCharge=$getDBcharge->charge?$getDBcharge->charge:200;

                    $shipmentCharge=ShippingCharge::where(['type'=>'city','name'=>$this->to_city,'weight'=>1])->first();

                    $price=($shipmentCharge?$shipmentCharge->shippingCharge:$defaultCharge)*$document['quantity'];
                    $this->totalShippingCharge+=$price; //adding shipping charge

                }
                else{
                    $getDBcharge=Default_charge::where(['type'=>'international','weight'=>10])->first();
                    $defaultCharge=$getDBcharge->charge?$getDBcharge->charge:3000;

                    $shipmentCharge=ShippingCharge::where(['type'=>'country','name'=>$this->to_country,'weight'=>1])->first();
                    $price=($shipmentCharge?$shipmentCharge->shippingCharge:$defaultCharge)*$document['quantity'];
                    $this->totalShippingCharge+=$price; //adding shipping charge
                }
            }
        }
        if ($this->package_type == "parcel") {
            $this->validate($this->step4_parcel);
            $this->resetChargeStats();

            foreach($this->parcels as $parcel){
                $this->itemsCount+=$parcel['quantity'];
                        $shipCharge=0;
                        $weight = round($parcel['weight'] / 0.5)*.5;
                        $this->itemsWeight=$this->itemsWeight+$weight;

                    //getting price of shipment
                    if($this->shipment_type=="domestic"){

                        if($weight<=10){
                            // get default weight
                            $getDBcharge=Default_charge::where(['type'=>'domestic','weight'=>10])->first();
                            $defaultCharge=$getDBcharge->charge?$getDBcharge->charge:200;

                            $shipmentCharge=ShippingCharge::where(['type'=>'city','name'=>$this->to_city,'weight'=>$weight])->first();
                            $shipCharge=($shipmentCharge?$shipmentCharge->shippingCharge:$defaultCharge);
                        }
                        else{
                            //get price greater than 10 kg
                            $getDBcharge=Default_charge::where(['type'=>'domestic'])->orderBy('weight','DESC')->get();
                            foreach($getDBcharge as $dbCharge){
                                if($weight>$dbCharge->weight){
                                    $charge = $weight*$dbCharge->charge;
                                    $shipCharge=$charge;
                                }
                            }
                        }
                    }
                    // end of domestic charge
                    else{

                        if($weight<=10){
                            // get default weight
                            $getDBcharge=Default_charge::where(['type'=>'international','weight'=>10])->first();
                            $defaultCharge=$getDBcharge->charge?$getDBcharge->charge:3000;

                            $shipmentCharge=ShippingCharge::where(['type'=>'country','name'=>$this->to_country,'weight'=>$weight])->first();
                            $shipCharge=($shipmentCharge?$shipmentCharge->shippingCharge:$defaultCharge);
                        }
                        else{
                            //get price greater than 10 kg
                            $getDBcharge=Default_charge::where(['type'=>'international'])->orderBy('weight','DESC')->get();
                            foreach($getDBcharge as $dbCharge){
                                if($weight>$dbCharge->weight){
                                    $charge = $weight*$dbCharge->charge;
                                    $shipCharge=$charge;
                                    break;

                                }
                            }
                        }
                    }
                        $this->totalShippingCharge+=$shipCharge; //adding shipping charge

            }



        }
        $this->checkedShipment=true;
        $this->currentStep=5;
    }


    //fifthstep
    public function submitFourth()
    {


        DB::transaction(function ()  {
            if (is_numeric($this->shipment_id)) {
                $shipment = Shipment::find($this->shipment_id);
            } else {
                $shipment = new Shipment();
            }


            $shipment->from_name = $this->from_name;
            $shipment->from_company_name = $this->from_company_name;
            $shipment->from_country = $this->from_country;
            $shipment->from_city = $this->from_city;
            $shipment->from_street = $this->from_street;
            $shipment->from_state = $this->from_state;
            $shipment->from_email = $this->from_email;
            $shipment->from_postal_code = $this->from_postal_code;
            $shipment->from_contact_number = $this->from_country_code . '-' . $this->from_contact_number;
            $shipment->from_street2=$this->from_street2;
            $shipment->from_street3=$this->from_street3;

            $shipment->to_name = $this->to_name;
            $shipment->to_company_name = $this->to_company_name;
            $shipment->to_country = $this->to_country;
            $shipment->to_city = $this->to_city;
            $shipment->to_street = $this->to_street;
            $shipment->to_street2=$this->to_street2;
            $shipment->to_street3=$this->to_street3;
            $shipment->to_state = $this->to_state;
            $shipment->to_email = $this->to_email;
            $shipment->to_postal_code = $this->to_postal_code;
            $shipment->to_contact_number = $this->to_country_code . '-' . $this->to_contact_number;

            $shipment->shipment_type = $this->shipment_type;
            $shipment->service_provider = $this->service_provider;
            $shipment->shipment_purpose = $this->shipment_purpose;
            $shipment->shipment_reference = $this->shipment_reference;
            $shipment->shipment_description = $this->shipment_description;
            $shipment->shipment_package_type = $this->package_type;
            $shipment->shipment_value = $this->shipment_value;

            if (!is_numeric($this->shipment_id)) {
                $shipment->created_by = auth()->user()->id;
                $shipment->created_by_name = auth()->user()->name;
            } else {
                $shipment->updated_by = auth()->user()->id;
                $shipment->updated_by_name = auth()->user()->name;
            }

            if (!is_numeric($this->shipment_id)) {
                //barcode and awb
                $uniqueCode=substr(time(), 2, 8);
                $shipment->barcode = $uniqueCode;
                $shipment->awb_no = $uniqueCode;
            }
            $shipment->save();

            //get ID
            if (is_numeric($this->shipment_id)) $this->db_shipment_id = $this->shipment_id;
            else $this->db_shipment_id = $shipment->id;


            //store permissions on table
            $details=[
                'user_id'=>auth()->user()->id,
                'shipment_id'=>$this->db_shipment_id,
                'shipping_charge'=>1,
                'shipment'=>1
            ];

            Shipment_permission::updateOrCreate ($details,$details);

            if (is_numeric($this->shipment_id)) {
                Shipment_line_item::where('shipment_id', $this->shipment_id)->delete();
            }
            //SAVING shipping items
            $totalShippingCharge=0;
            if ($this->package_type == "document") {
                $this->validate($this->step4_document);
                foreach ($this->documents as $document) {
                    $sli = new shipment_line_item();
                    $sli->shipment_id = $this->db_shipment_id;
                    $sli->package_type = $this->package_type;
                    $sli->package_name = $document['name'];
                    $sli->quantity = $document['quantity'];

                    if (!is_numeric($this->shipment_id)) {
                        $sli->created_by = auth()->user()->id;
                        $sli->created_by_name = auth()->user()->name;
                    } else {
                        $sli->updated_by = auth()->user()->id;
                        $sli->updated_by_name = auth()->user()->name;
                    }

                    //getting price of shipment
                    if($this->shipment_type=="domestic"){

                        $getDBcharge=Default_charge::where(['type'=>'domestic','weight'=>10])->first();
                        $defaultCharge=$getDBcharge->charge?$getDBcharge->charge:200;

                        $shipmentCharge=ShippingCharge::where(['type'=>'city','name'=>$shipment->to_city,'weight'=>1])->first();

                        $sli->price=($shipmentCharge?$shipmentCharge->shippingCharge:$defaultCharge)*$document['quantity'];
                        $totalShippingCharge+=$sli->price; //adding shipping charge

                    }
                    else{
                        $getDBcharge=Default_charge::where(['type'=>'international','weight'=>10])->first();
                        $defaultCharge=$getDBcharge->charge?$getDBcharge->charge:3000;

                        $shipmentCharge=ShippingCharge::where(['type'=>'country','name'=>$shipment->to_country,'weight'=>1])->first();
                        $sli->price=($shipmentCharge?$shipmentCharge->shippingCharge:$defaultCharge)*$document['quantity'];
                        $totalShippingCharge+=$sli->price; //adding shipping charge
                    }
                    $sli->save();
                }
            } elseif ($this->package_type == "parcel") {
                $this->validate($this->step4_parcel);
                foreach ($this->parcels as $parcel) {
                    $sli = new shipment_line_item();
                    $sli->shipment_id = $this->db_shipment_id;
                    $sli->package_type = $this->package_type;
                    $sli->package_name = $parcel['name'];
                    $sli->quantity = $parcel['quantity'];
                    $sli->length = $parcel['length'];
                    $sli->breadth = $parcel['breadth'];
                    $sli->height = $parcel['height'];
                    $sli->weight = $parcel['weight'];
                    $sli->weight_by_dimension=(($parcel['length']*$parcel['breadth']*$parcel['height'])/5000);


                    //getting price of shipment
                    if($this->shipment_type=="domestic"){

                        $shipCharge=0;
                        $weight = round($parcel['weight'] / 0.5)*.5;

                        if($weight<=10){
                            // get default weight
                            $getDBcharge=Default_charge::where(['type'=>'domestic','weight'=>10])->first();
                            $defaultCharge=$getDBcharge->charge?$getDBcharge->charge:200;

                            $shipmentCharge=ShippingCharge::where(['type'=>'city','name'=>$shipment->to_city,'weight'=>$weight])->first();
                            $shipCharge=($shipmentCharge?$shipmentCharge->shippingCharge:$defaultCharge);
                        }
                        else{
                            //get price greater than 10 kg
                            $getDBcharge=Default_charge::where(['type'=>'domestic'])->orderBy('weight','DESC')->get();
                            foreach($getDBcharge as $dbCharge){
                                if($weight>$dbCharge->weight){
                                    $charge = $weight*$dbCharge->charge;
                                    $shipCharge=$charge;
                                }
                            }
                        }
                        $sli->price=$shipCharge;
                        $totalShippingCharge+=$shipCharge; //adding shipping charge
                    }
                    // end of domestic charge
                    else{
                        $shipCharge=0;
                        $weight = round($parcel['weight'] / 0.5)*.5;
                        if($weight<=10){
                            // get default weight
                            $getDBcharge=Default_charge::where(['type'=>'international','weight'=>10])->first();
                            $defaultCharge=$getDBcharge->charge?$getDBcharge->charge:3000;

                            $shipmentCharge=ShippingCharge::where(['type'=>'country','name'=>$shipment->to_country,'weight'=>$weight])->first();
                            $shipCharge=($shipmentCharge?$shipmentCharge->shippingCharge:$defaultCharge);
                        }
                        else{
                            //get price greater than 10 kg
                            $getDBcharge=Default_charge::where(['type'=>'international'])->orderBy('weight','DESC')->get();
                            foreach($getDBcharge as $dbCharge){
                                if($weight>$dbCharge->weight){
                                    $charge = $weight*$dbCharge->charge;
                                    $shipCharge=$charge;
                                    break;

                                }
                            }
                        }
                        $sli->price=$shipCharge;
                        $totalShippingCharge+=$shipCharge; //adding shipping charge
                    }

                    if (!is_numeric($this->shipment_id)) {
                        $sli->created_by = auth()->user()->id;
                        $sli->created_by_name = auth()->user()->name;
                    } else {
                        $sli->updated_by = auth()->user()->id;
                        $sli->updated_by_name = auth()->user()->name;
                    }

                    $sli->save();
                }
            }


            //saving gross
            $shipment->gross_total=$totalShippingCharge;
            $shipment->net_total=$totalShippingCharge;
            $shipment->save();


            if (!is_numeric($this->shipment_id)) {
                //inserting into shipment status
                $ss = new Shipment_status();
                $ss->shipment_id = $this->db_shipment_id;
                $ss->activities = 'Information Received';
                $ss->location = 'KTM';
                $ss->created_by = auth()->user()->id;
                $ss->created_by_name = auth()->user()->name;
                $ss->save(); //save
            }

            $admin=User::where('user_type','app_user')->first();
            $shipment = Shipment::withSum('shipment_line_items','weight')->withCount('shipment_line_items')->find($this->db_shipment_id);
            $items = $shipment->shipment_line_items;
            $admin->notify(new ShipmentCreated($shipment,$items));
            $shipment->notify(new ShipmentCreated($shipment,$items));



        }, 3); //3 attemps until rollback

        $this->shipmentBillInfo = Shipment::withSum('shipment_line_items','weight')->withCount('shipment_line_items')->find($this->db_shipment_id);
        // $items = $shipment->shipment_line_items;

        $this->alert('success','Shipment Saved Successfully');
        $this->currentStep=6;

    }





    public function stepBack()
    {
        $this->checkedShipment=false;
        if ($this->currentStep != 1) {
            $this->currentStep--;
        }
    }

    function gotoStep($step=1){
        $this->checkedShipment=false;
        $this->currentStep=$step;
    }

    function addParcel()
    {
        $this->parcels[] = ['name' => '', 'quantity' => 1, 'length' => 1, 'breadth' => 1, 'height' => 1, 'weight' => 1];
    }

    function removeParcel($index)
    {
        unset($this->parcels[$index]);
        $this->parcels = array_values($this->parcels);
    }

    function addDocument()
    {
        $this->documents[] = ['name' => '', 'quantity' => 1];
    }

    function removeDocument($index)
    {
        unset($this->documents[$index]);
        $this->documents = array_values($this->documents);
    }


    public $countryArray = array(
        'AD' => array('name' => 'ANDORRA', 'code' => '376'),
        'AE' => array('name' => 'UNITED ARAB EMIRATES', 'code' => '971'),
        'AF' => array('name' => 'AFGHANISTAN', 'code' => '93'),
        'AG' => array('name' => 'ANTIGUA AND BARBUDA', 'code' => '1268'),
        'AI' => array('name' => 'ANGUILLA', 'code' => '1264'),
        'AL' => array('name' => 'ALBANIA', 'code' => '355'),
        'AM' => array('name' => 'ARMENIA', 'code' => '374'),
        'AN' => array('name' => 'NETHERLANDS ANTILLES', 'code' => '599'),
        'AO' => array('name' => 'ANGOLA', 'code' => '244'),
        'AQ' => array('name' => 'ANTARCTICA', 'code' => '672'),
        'AR' => array('name' => 'ARGENTINA', 'code' => '54'),
        'AS' => array('name' => 'AMERICAN SAMOA', 'code' => '1684'),
        'AT' => array('name' => 'AUSTRIA', 'code' => '43'),
        'AU' => array('name' => 'AUSTRALIA', 'code' => '61'),
        'AW' => array('name' => 'ARUBA', 'code' => '297'),
        'AZ' => array('name' => 'AZERBAIJAN', 'code' => '994'),
        'BA' => array('name' => 'BOSNIA AND HERZEGOVINA', 'code' => '387'),
        'BB' => array('name' => 'BARBADOS', 'code' => '1246'),
        'BD' => array('name' => 'BANGLADESH', 'code' => '880'),
        'BE' => array('name' => 'BELGIUM', 'code' => '32'),
        'BF' => array('name' => 'BURKINA FASO', 'code' => '226'),
        'BG' => array('name' => 'BULGARIA', 'code' => '359'),
        'BH' => array('name' => 'BAHRAIN', 'code' => '973'),
        'BI' => array('name' => 'BURUNDI', 'code' => '257'),
        'BJ' => array('name' => 'BENIN', 'code' => '229'),
        'BL' => array('name' => 'SAINT BARTHELEMY', 'code' => '590'),
        'BM' => array('name' => 'BERMUDA', 'code' => '1441'),
        'BN' => array('name' => 'BRUNEI DARUSSALAM', 'code' => '673'),
        'BO' => array('name' => 'BOLIVIA', 'code' => '591'),
        'BR' => array('name' => 'BRAZIL', 'code' => '55'),
        'BS' => array('name' => 'BAHAMAS', 'code' => '1242'),
        'BT' => array('name' => 'BHUTAN', 'code' => '975'),
        'BW' => array('name' => 'BOTSWANA', 'code' => '267'),
        'BY' => array('name' => 'BELARUS', 'code' => '375'),
        'BZ' => array('name' => 'BELIZE', 'code' => '501'),
        'CA' => array('name' => 'CANADA', 'code' => '1'),
        'CC' => array('name' => 'COCOS (KEELING) ISLANDS', 'code' => '61'),
        'CD' => array('name' => 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'code' => '243'),
        'CF' => array('name' => 'CENTRAL AFRICAN REPUBLIC', 'code' => '236'),
        'CG' => array('name' => 'CONGO', 'code' => '242'),
        'CH' => array('name' => 'SWITZERLAND', 'code' => '41'),
        'CI' => array('name' => 'COTE D IVOIRE', 'code' => '225'),
        'CK' => array('name' => 'COOK ISLANDS', 'code' => '682'),
        'CL' => array('name' => 'CHILE', 'code' => '56'),
        'CM' => array('name' => 'CAMEROON', 'code' => '237'),
        'CN' => array('name' => 'CHINA', 'code' => '86'),
        'CO' => array('name' => 'COLOMBIA', 'code' => '57'),
        'CR' => array('name' => 'COSTA RICA', 'code' => '506'),
        'CU' => array('name' => 'CUBA', 'code' => '53'),
        'CV' => array('name' => 'CAPE VERDE', 'code' => '238'),
        'CX' => array('name' => 'CHRISTMAS ISLAND', 'code' => '61'),
        'CY' => array('name' => 'CYPRUS', 'code' => '357'),
        'CZ' => array('name' => 'CZECH REPUBLIC', 'code' => '420'),
        'DE' => array('name' => 'GERMANY', 'code' => '49'),
        'DJ' => array('name' => 'DJIBOUTI', 'code' => '253'),
        'DK' => array('name' => 'DENMARK', 'code' => '45'),
        'DM' => array('name' => 'DOMINICA', 'code' => '1767'),
        'DO' => array('name' => 'DOMINICAN REPUBLIC', 'code' => '1809'),
        'DZ' => array('name' => 'ALGERIA', 'code' => '213'),
        'EC' => array('name' => 'ECUADOR', 'code' => '593'),
        'EE' => array('name' => 'ESTONIA', 'code' => '372'),
        'EG' => array('name' => 'EGYPT', 'code' => '20'),
        'ER' => array('name' => 'ERITREA', 'code' => '291'),
        'ES' => array('name' => 'SPAIN', 'code' => '34'),
        'ET' => array('name' => 'ETHIOPIA', 'code' => '251'),
        'FI' => array('name' => 'FINLAND', 'code' => '358'),
        'FJ' => array('name' => 'FIJI', 'code' => '679'),
        'FK' => array('name' => 'FALKLAND ISLANDS (MALVINAS)', 'code' => '500'),
        'FM' => array('name' => 'MICRONESIA, FEDERATED STATES OF', 'code' => '691'),
        'FO' => array('name' => 'FAROE ISLANDS', 'code' => '298'),
        'FR' => array('name' => 'FRANCE', 'code' => '33'),
        'GA' => array('name' => 'GABON', 'code' => '241'),
        'GB' => array('name' => 'UNITED KINGDOM', 'code' => '44'),
        'GD' => array('name' => 'GRENADA', 'code' => '1473'),
        'GE' => array('name' => 'GEORGIA', 'code' => '995'),
        'GH' => array('name' => 'GHANA', 'code' => '233'),
        'GI' => array('name' => 'GIBRALTAR', 'code' => '350'),
        'GL' => array('name' => 'GREENLAND', 'code' => '299'),
        'GM' => array('name' => 'GAMBIA', 'code' => '220'),
        'GN' => array('name' => 'GUINEA', 'code' => '224'),
        'GQ' => array('name' => 'EQUATORIAL GUINEA', 'code' => '240'),
        'GR' => array('name' => 'GREECE', 'code' => '30'),
        'GT' => array('name' => 'GUATEMALA', 'code' => '502'),
        'GU' => array('name' => 'GUAM', 'code' => '1671'),
        'GW' => array('name' => 'GUINEA-BISSAU', 'code' => '245'),
        'GY' => array('name' => 'GUYANA', 'code' => '592'),
        'HK' => array('name' => 'HONG KONG', 'code' => '852'),
        'HN' => array('name' => 'HONDURAS', 'code' => '504'),
        'HR' => array('name' => 'CROATIA', 'code' => '385'),
        'HT' => array('name' => 'HAITI', 'code' => '509'),
        'HU' => array('name' => 'HUNGARY', 'code' => '36'),
        'ID' => array('name' => 'INDONESIA', 'code' => '62'),
        'IE' => array('name' => 'IRELAND', 'code' => '353'),
        'IL' => array('name' => 'ISRAEL', 'code' => '972'),
        'IM' => array('name' => 'ISLE OF MAN', 'code' => '44'),
        'IN' => array('name' => 'INDIA', 'code' => '91'),
        'IQ' => array('name' => 'IRAQ', 'code' => '964'),
        'IR' => array('name' => 'IRAN, ISLAMIC REPUBLIC OF', 'code' => '98'),
        'IS' => array('name' => 'ICELAND', 'code' => '354'),
        'IT' => array('name' => 'ITALY', 'code' => '39'),
        'JM' => array('name' => 'JAMAICA', 'code' => '1876'),
        'JO' => array('name' => 'JORDAN', 'code' => '962'),
        'JP' => array('name' => 'JAPAN', 'code' => '81'),
        'KE' => array('name' => 'KENYA', 'code' => '254'),
        'KG' => array('name' => 'KYRGYZSTAN', 'code' => '996'),
        'KH' => array('name' => 'CAMBODIA', 'code' => '855'),
        'KI' => array('name' => 'KIRIBATI', 'code' => '686'),
        'KM' => array('name' => 'COMOROS', 'code' => '269'),
        'KN' => array('name' => 'SAINT KITTS AND NEVIS', 'code' => '1869'),
        'KP' => array('name' => 'KOREA DEMOCRATIC PEOPLES REPUBLIC OF', 'code' => '850'),
        'KR' => array('name' => 'KOREA REPUBLIC OF', 'code' => '82'),
        'KW' => array('name' => 'KUWAIT', 'code' => '965'),
        'KY' => array('name' => 'CAYMAN ISLANDS', 'code' => '1345'),
        'KZ' => array('name' => 'KAZAKSTAN', 'code' => '7'),
        'LA' => array('name' => 'LAO PEOPLES DEMOCRATIC REPUBLIC', 'code' => '856'),
        'LB' => array('name' => 'LEBANON', 'code' => '961'),
        'LC' => array('name' => 'SAINT LUCIA', 'code' => '1758'),
        'LI' => array('name' => 'LIECHTENSTEIN', 'code' => '423'),
        'LK' => array('name' => 'SRI LANKA', 'code' => '94'),
        'LR' => array('name' => 'LIBERIA', 'code' => '231'),
        'LS' => array('name' => 'LESOTHO', 'code' => '266'),
        'LT' => array('name' => 'LITHUANIA', 'code' => '370'),
        'LU' => array('name' => 'LUXEMBOURG', 'code' => '352'),
        'LV' => array('name' => 'LATVIA', 'code' => '371'),
        'LY' => array('name' => 'LIBYAN ARAB JAMAHIRIYA', 'code' => '218'),
        'MA' => array('name' => 'MOROCCO', 'code' => '212'),
        'MC' => array('name' => 'MONACO', 'code' => '377'),
        'MD' => array('name' => 'MOLDOVA, REPUBLIC OF', 'code' => '373'),
        'ME' => array('name' => 'MONTENEGRO', 'code' => '382'),
        'MF' => array('name' => 'SAINT MARTIN', 'code' => '1599'),
        'MG' => array('name' => 'MADAGASCAR', 'code' => '261'),
        'MH' => array('name' => 'MARSHALL ISLANDS', 'code' => '692'),
        'MK' => array('name' => 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF', 'code' => '389'),
        'ML' => array('name' => 'MALI', 'code' => '223'),
        'MM' => array('name' => 'MYANMAR', 'code' => '95'),
        'MN' => array('name' => 'MONGOLIA', 'code' => '976'),
        'MO' => array('name' => 'MACAU', 'code' => '853'),
        'MP' => array('name' => 'NORTHERN MARIANA ISLANDS', 'code' => '1670'),
        'MR' => array('name' => 'MAURITANIA', 'code' => '222'),
        'MS' => array('name' => 'MONTSERRAT', 'code' => '1664'),
        'MT' => array('name' => 'MALTA', 'code' => '356'),
        'MU' => array('name' => 'MAURITIUS', 'code' => '230'),
        'MV' => array('name' => 'MALDIVES', 'code' => '960'),
        'MW' => array('name' => 'MALAWI', 'code' => '265'),
        'MX' => array('name' => 'MEXICO', 'code' => '52'),
        'MY' => array('name' => 'MALAYSIA', 'code' => '60'),
        'MZ' => array('name' => 'MOZAMBIQUE', 'code' => '258'),
        'NA' => array('name' => 'NAMIBIA', 'code' => '264'),
        'NC' => array('name' => 'NEW CALEDONIA', 'code' => '687'),
        'NE' => array('name' => 'NIGER', 'code' => '227'),
        'NG' => array('name' => 'NIGERIA', 'code' => '234'),
        'NI' => array('name' => 'NICARAGUA', 'code' => '505'),
        'NL' => array('name' => 'NETHERLANDS', 'code' => '31'),
        'NO' => array('name' => 'NORWAY', 'code' => '47'),
        'NP' => array('name' => 'NEPAL', 'code' => '977'),
        'NR' => array('name' => 'NAURU', 'code' => '674'),
        'NU' => array('name' => 'NIUE', 'code' => '683'),
        'NZ' => array('name' => 'NEW ZEALAND', 'code' => '64'),
        'OM' => array('name' => 'OMAN', 'code' => '968'),
        'PA' => array('name' => 'PANAMA', 'code' => '507'),
        'PE' => array('name' => 'PERU', 'code' => '51'),
        'PF' => array('name' => 'FRENCH POLYNESIA', 'code' => '689'),
        'PG' => array('name' => 'PAPUA NEW GUINEA', 'code' => '675'),
        'PH' => array('name' => 'PHILIPPINES', 'code' => '63'),
        'PK' => array('name' => 'PAKISTAN', 'code' => '92'),
        'PL' => array('name' => 'POLAND', 'code' => '48'),
        'PM' => array('name' => 'SAINT PIERRE AND MIQUELON', 'code' => '508'),
        'PN' => array('name' => 'PITCAIRN', 'code' => '870'),
        'PR' => array('name' => 'PUERTO RICO', 'code' => '1'),
        'PT' => array('name' => 'PORTUGAL', 'code' => '351'),
        'PW' => array('name' => 'PALAU', 'code' => '680'),
        'PY' => array('name' => 'PARAGUAY', 'code' => '595'),
        'QA' => array('name' => 'QATAR', 'code' => '974'),
        'RO' => array('name' => 'ROMANIA', 'code' => '40'),
        'RS' => array('name' => 'SERBIA', 'code' => '381'),
        'RU' => array('name' => 'RUSSIAN FEDERATION', 'code' => '7'),
        'RW' => array('name' => 'RWANDA', 'code' => '250'),
        'SA' => array('name' => 'SAUDI ARABIA', 'code' => '966'),
        'SB' => array('name' => 'SOLOMON ISLANDS', 'code' => '677'),
        'SC' => array('name' => 'SEYCHELLES', 'code' => '248'),
        'SD' => array('name' => 'SUDAN', 'code' => '249'),
        'SE' => array('name' => 'SWEDEN', 'code' => '46'),
        'SG' => array('name' => 'SINGAPORE', 'code' => '65'),
        'SH' => array('name' => 'SAINT HELENA', 'code' => '290'),
        'SI' => array('name' => 'SLOVENIA', 'code' => '386'),
        'SK' => array('name' => 'SLOVAKIA', 'code' => '421'),
        'SL' => array('name' => 'SIERRA LEONE', 'code' => '232'),
        'SM' => array('name' => 'SAN MARINO', 'code' => '378'),
        'SN' => array('name' => 'SENEGAL', 'code' => '221'),
        'SO' => array('name' => 'SOMALIA', 'code' => '252'),
        'SR' => array('name' => 'SURINAME', 'code' => '597'),
        'ST' => array('name' => 'SAO TOME AND PRINCIPE', 'code' => '239'),
        'SV' => array('name' => 'EL SALVADOR', 'code' => '503'),
        'SY' => array('name' => 'SYRIAN ARAB REPUBLIC', 'code' => '963'),
        'SZ' => array('name' => 'SWAZILAND', 'code' => '268'),
        'TC' => array('name' => 'TURKS AND CAICOS ISLANDS', 'code' => '1649'),
        'TD' => array('name' => 'CHAD', 'code' => '235'),
        'TG' => array('name' => 'TOGO', 'code' => '228'),
        'TH' => array('name' => 'THAILAND', 'code' => '66'),
        'TJ' => array('name' => 'TAJIKISTAN', 'code' => '992'),
        'TK' => array('name' => 'TOKELAU', 'code' => '690'),
        'TL' => array('name' => 'TIMOR-LESTE', 'code' => '670'),
        'TM' => array('name' => 'TURKMENISTAN', 'code' => '993'),
        'TN' => array('name' => 'TUNISIA', 'code' => '216'),
        'TO' => array('name' => 'TONGA', 'code' => '676'),
        'TR' => array('name' => 'TURKEY', 'code' => '90'),
        'TT' => array('name' => 'TRINIDAD AND TOBAGO', 'code' => '1868'),
        'TV' => array('name' => 'TUVALU', 'code' => '688'),
        'TW' => array('name' => 'TAIWAN, PROVINCE OF CHINA', 'code' => '886'),
        'TZ' => array('name' => 'TANZANIA, UNITED REPUBLIC OF', 'code' => '255'),
        'UA' => array('name' => 'UKRAINE', 'code' => '380'),
        'UG' => array('name' => 'UGANDA', 'code' => '256'),
        'US' => array('name' => 'UNITED STATES', 'code' => '1'),
        'UY' => array('name' => 'URUGUAY', 'code' => '598'),
        'UZ' => array('name' => 'UZBEKISTAN', 'code' => '998'),
        'VA' => array('name' => 'HOLY SEE (VATICAN CITY STATE)', 'code' => '39'),
        'VC' => array('name' => 'SAINT VINCENT AND THE GRENADINES', 'code' => '1784'),
        'VE' => array('name' => 'VENEZUELA', 'code' => '58'),
        'VG' => array('name' => 'VIRGIN ISLANDS, BRITISH', 'code' => '1284'),
        'VI' => array('name' => 'VIRGIN ISLANDS, U.S.', 'code' => '1340'),
        'VN' => array('name' => 'VIET NAM', 'code' => '84'),
        'VU' => array('name' => 'VANUATU', 'code' => '678'),
        'WF' => array('name' => 'WALLIS AND FUTUNA', 'code' => '681'),
        'WS' => array('name' => 'SAMOA', 'code' => '685'),
        'XK' => array('name' => 'KOSOVO', 'code' => '381'),
        'YE' => array('name' => 'YEMEN', 'code' => '967'),
        'YT' => array('name' => 'MAYOTTE', 'code' => '262'),
        'ZA' => array('name' => 'SOUTH AFRICA', 'code' => '27'),
        'ZM' => array('name' => 'ZAMBIA', 'code' => '260'),
        'ZW' => array('name' => 'ZIMBABWE', 'code' => '263')
    );
}
