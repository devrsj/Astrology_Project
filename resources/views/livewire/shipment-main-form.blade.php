<div>
  <style>
      @media print {
    body * {
        visibility: hidden;
    }
    #printDiv, #printDiv * {
        visibility: visible;
    }
    #printDiv {
        position: absolute;
        top: 0;
  }
}
  </style>

<h3 class="text-muted">{{ $step_name[$currentStep] }} <h5> Step: {{ $currentStep}}/{{ count($step_name) }}</h5> </h3>

<input type="hidden" wire:model="shipment_id" value="{{ $shipment_id }}">

{{-- first step --}}
<div class="shadow p-4 {{ $currentStep != 1 ? 'd-none' : '' }}">
    <div>
        @error('shipment_type')
         <div class="alert alert-danger alert-dismissible fade show" role="alert">
             {{ $message }}
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
         </div>
        @enderror
     </div>
    <div class="d-flex justify-content-around ">
        <div  class="card col-md-3  text-center p-4 {{ $shipment_type=="domestic"?'bg-info':'bg-success' }}" style="height:100px" >
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" id="domestic" wire:model="shipment_type" value="domestic" name="shipment_type">
                <label class="custom-control-label" for="domestic"><h3>Domestic</h3></label>
              </div>
        </div>
        <div  class="card col-md-3  text-center p-4 {{ $shipment_type=="international"?'bg-info':'bg-success' }}" style="height:100px" >
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" id="international" wire:model="shipment_type" value="international" name="shipment_type">
                <label class="custom-control-label" for="international"><h3>International</h3></label>
              </div>
        </div>

    </div>
    <div class="d-flex flex-row-reverse">
        <button type="button"  class="btn btn-success " wire:loading.attr="disabled"  wire:click.prevent="submitFirst">Next
            <span wire:loading wire:target="submitFirst" class="spinner-border spinner-border-sm text-warning"   aria-hidden="true"></span>
        </button>
    </div>
    <br>
 </div>
 {{-- end of step 1   --}}


 {{-- step 2  --}}
 <div class="shadow p-4 {{ $currentStep != 2 ? 'd-none' : 'd-block' }}">
    <div>
        @error('service_provider')
         <div class="alert alert-danger alert-dismissible fade show" role="alert">
             {{ $message }}
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
         </div>
        @enderror
     </div>

    <div class="d-flex " style="overflow-x:scroll">

       @if(!empty($shipment_type))
            @foreach ($availableServiceProvider as $provider)
                    <div  class="card col-md-3  text-center p-4 mx-1 {{ $service_provider==$provider->name?'bg-info':'bg-success' }}"  >
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="{{ $provider->name }}" wire:model="service_provider" value="{{ $provider->name }}" name="service_provider">
                            <label class="custom-control-label" for="{{ $provider->name }}"><h3>{{ ucfirst($provider->name) }}</h3></label>
                        </div>
                    </div>
            @endforeach
        @endif



    </div>
    <div class="d-flex flex-row-reverse">
        <button type="button"  class="btn btn-success " wire:loading.attr="disabled"  wire:click.prevent="submitSecond">Next
            <span wire:loading wire:target="submitSecond" class="spinner-border spinner-border-sm text-warning"   aria-hidden="true"></span>
        </button>
        <button type="button"  class="mx-3 btn btn-danger " wire:click.prevent="stepBack">Back</button>
    </div>
    <br>

 </div>

{{-- end of step 2 --}}


 {{-- step 3  --}}
 <div class="shadow p-4 {{ $currentStep != 3 ? 'd-none' : 'd-block' }}">

    <div class="row">
     @foreach (['from','to'] as $fromto)
     <div class="col-md-6">            {{-- start of sender information --}}
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" id="basic-layout-form">{{ $fromto=="from"?'Sender Information':'Receiver Information' }}</h4>
            </div>
            <div class="card-content collapse show">
                <div class="card-body">

                    <form class="form">
                        <div class="form-body">

                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">

                                        <label for="{{ $fromto }}_name"> Name <span class="text-danger">*</span> </label>
                                        <input type="text" id="{{ $fromto }}_name" class=" @if($fromto=="from") @error('from_name') is-invalid @enderror @else @error('to_name') is-invalid @enderror @endif form-control"
                                               wire:model.defer="{{ $fromto }}_name" >
                                     </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">

                                        <label for="{{ $fromto }}_company_name">Company Name </label>
                                        <input type="text" id="{{ $fromto }}_name" class=" @if($fromto=="from") @error('from_company_name') is-invalid @enderror @else @error('to_company_name') is-invalid @enderror @endif form-control"
                                                wire:model.defer="{{ $fromto }}_company_name" >
                                     </div>
                                </div>
                            </div>


                            <div class="row">
                                @if($shipment_type=="international")
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="{{ $fromto }}_country">Country <span class="text-danger">*</span></label>
                                        <select  name="{{ $fromto }}_country"  wire:model.lazy="{{ $fromto }}_country" class="custom-select block @if($fromto=="from") @error('from_country') is-invalid @enderror @else @error('to_country') is-invalid @enderror @endif" id="{{ $fromto }}_country">
                                            <option value="" >-- Select Country --</option>
                                        @foreach (countryInfoList() as $dbCountry)
                                            <option value="{{ $dbCountry['name']}}">{{ $dbCountry['name']}}</option>
                                        @endforeach
                                        </select>

                                    </div>
                                </div>
                                @endif
                            </div>

                            <div class="row">

                                @if($shipment_type=="domestic")
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="{{ $fromto }}_city">District </label>
                                        <select id="{{ $fromto }}_city" class="form-control @if($fromto=="from") @error('from_city') is-invalid @enderror @else @error('to_city') is-invalid @enderror @endif" wire:model.lazy="{{ $fromto }}_city">
                                        <option value="" >-- Select District --</option>
                                        @foreach (districtInfo() as $dbCity)
                                            <option value="{{ $dbCity['name']}}">{{ $dbCity['name'] }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                @endif

                            </div>


                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="{{ $fromto }}_street">Street</label>
                                        <input type="text" id="{{ $fromto }}_street" class="form-control @if($fromto=="from") @error('from_street') is-invalid @enderror @else @error('to_street') is-invalid @enderror @endif"
                                              wire:model.defer="{{ $fromto }}_street" >
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="{{ $fromto }}_postal_code">Postal Code </label>
                                        <input type="text" id="{{ $fromto }}_postal_code" class="form-control @if($fromto=="from") @error('from_postal_code') is-invalid @enderror @else @error('to_postal_code') is-invalid @enderror @endif"
                                              wire:model.defer="{{ $fromto }}_postal_code">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                               @if($shipment_type=="international")
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="{{ $fromto }}_street2">Street 2</label>
                                            <input type="text" id="{{ $fromto }}_street2" class="form-control @if($fromto=="from") @error('from_street2') is-invalid @enderror @else @error('to_street2') is-invalid @enderror @endif"
                                                wire:model.defer="{{ $fromto }}_street2" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="{{ $fromto }}_street3">Street 3</label>
                                            <input type="text" id="{{ $fromto }}_street3" class="form-control @if($fromto=="from") @error('from_street3') is-invalid @enderror @else @error('to_street3') is-invalid @enderror @endif"
                                                wire:model.defer="{{ $fromto }}_street3" >
                                        </div>
                                    </div>
                               @endif
                            </div>


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="{{ $fromto }}_email">E-mail Address</label>
                                        <input type="text" id="{{ $fromto }}_email" class="form-control @if($fromto=="from") @error('from_email') is-invalid @enderror @else @error('to_email') is-invalid @enderror @endif"
                                              wire:model.defer="{{ $fromto }}_email">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="countryCode">Country Code <span class="text-danger">*</span></label>
                                        <input type="tel" disabled wire:model="{{ $fromto }}_country_code"  class="form-control @if($fromto=="from") @error('from_country_code') is-invalid @enderror @else @error('to_country_code') is-invalid @enderror @endif" id="{{ $fromto }}_countryCode">
                                        </select>
                                    </div>

                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="{{ $fromto }}_contact_number">Contact Number <span class="text-danger">*</span></label>
                                        <input type="number" id="{{ $fromto }}_contact_number" class="form-control @if($fromto=="from") @error('from_contact_number') is-invalid @enderror @else @error('to_contact_number') is-invalid @enderror @endif"
                                             wire:model.defer="{{ $fromto }}_contact_number">
                                    </div>
                                </div>

                            </div>




                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>         {{-- end of sender information  --}}
     @endforeach
    </div>
    <br>

    <div class="d-flex flex-row-reverse">
        <button type="button"  class="btn btn-success " wire:loading.attr="disabled"  wire:click.prevent="submitThird">Next
            <span wire:loading wire:target="submitThird" class="spinner-border spinner-border-sm text-warning"   aria-hidden="true"></span>
        </button>
        <button type="button"  class="mx-3 btn btn-danger " wire:click.prevent="stepBack">Back</button>
    </div>
    <br>

 </div>

{{-- end of step 2 --}}


 {{-- step 4  --}}
 <div class="shadow p-4 {{ $currentStep != 4 ? 'd-none' : 'd-block' }}">
    <div>
        @error('shipment_type')
         <div class="alert alert-danger alert-dismissible fade show" role="alert">
             {{ $message }}
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
         </div>
        @enderror
     </div>

    <div class="d-flex justify-content-around ">
        <div  class="card col-md-3  text-center p-4 {{ $package_type=="document"?'bg-info':'bg-success' }}" style="height:100px" >
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" id="document" wire:model="package_type" value="document" name="package_type">
                <label class="custom-control-label" for="document"><h3>Document</h3></label>
              </div>
        </div>

        <div  class="card col-md-3  text-center p-4 {{ $package_type=="parcel"?'bg-info':'bg-success' }}" style="height:100px" >
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" id="parcel" wire:model="package_type" value="parcel" name="package_type">
                <label class="custom-control-label" for="parcel"><h3>Parcel</h3></label>
              </div>
        </div>
    </div>

    <div class="col-md-12  show my-3" >
        <div class="card">
            <div class="card-body">
                <form class="form">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="shipment_value">Shipment Value<span class="text-danger">*</span></label>
                                    <input wire:model.defer="shipment_value" id="shipment_value" class="form-control @error('shipment_value') is-invalid @enderror" >
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="purpose">What is the purpose of your shipment? <span class="text-danger">*</span></label>
                                    <select wire:model.defer="shipment_purpose" class="custom-select block @error('shipment_purpose') is-invalid @enderror" >
                                        <option value="">--- Select Purpose ---</option>
                                        @foreach ($shipment_purpose_select as $key=>$purpose)
                                        <option value="{{ $key }}">{{ $purpose }}</option>
                                        @endforeach


                                    </select>
                                </div>
                            </div>
                           <div class="col-md">
                            <div class="form-group">
                                <label for="shipmentReference">Add Shipment Reference</label>
                                <input type="text" id="shipmentReference" class="form-control"
                                        wire:model.defer="shipment_reference">
                            </div>
                           </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <form class="form">
                    <div class="form-body">
                        <div class="row">
                            <label for="shipment_description">Summarize the content of the shipment</label>
                            <textarea id="shipment_description" wire:model.defer="shipment_description" class="form-control"></textarea>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if($package_type=="document")
    <div class="col-md-12  show my-3" >

            <h3 class="text-info text-center">Fill up document info</h3>
            <div class="card-content ">
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table">
                            <thead>
                            <tr>
                                <th>Document Name</th>
                                <th>Quantity</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($documents as $index=>$document)
                            <tr>
                                <td><input type="text" placeholder="Enter name"  name="documents[{{ $index }}][name]" wire:model.defer="documents.{{ $index }}.name"  class="form-control @error('documents.'.$index.'.name') is-invalid @enderror" ></td>
                                <td><input type="number" min=1 name="documents[{{ $index }}][quantity]" wire:model.defer="documents.{{ $index }}.quantity" step="1" class="form-control" ></td>

                                <td><button wire:click="removeDocument({{ $index }})" class="btn btn-danger btn-sm">Delete</button></td>
                            </tr>
                            @endforeach
                            </tbody>
                           <tr>
                                <td></td>
                               <td></td>
                               <td colspan="2"><button wire:click="addDocument" class="btn btn-info btn-sm">Add New Document Row</button></td>
                           </tr>

                        </table>
                    </div>
                </div>

            </div>


    </div>
    @endif

    @if($package_type=="parcel")
        <h4 class="text-center text-info">Fill Up Parcel Details</h4>
            <div class="card-content ">
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table">
                            <thead>
                            <tr>
                                <th>Parcel Name</th>
                                <th>Quantity</th>
                                <th>Length(cm)</th>
                                <th>Breadth(cm)</th>
                                <th>Height(cm)</th>
                                <th>Weight(kg)</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($parcels as $index=>$parcel)
                            <tr>

                                <td><input type="text"  placeholder="Enter name"  name="parcels[{{ $index }}][name]" wire:model.defer="parcels.{{ $index }}.name"  class="form-control @error('parcels.'.$index.'.name') is-invalid @enderror" ></td>
                                <td><input type="number" min=1 name="parcels[{{ $index }}][quantity]" wire:model.defer="parcels.{{ $index }}.quantity" step="1" class="form-control" ></td>
                                <td><input type="number" min=1 name="parcels[{{ $index }}][length]"  wire:model.defer="parcels.{{ $index }}.length" step="any" class="form-control individual-length" onChange="checkVolumeWeight()"></td>
                                <td><input type="number" min=1 name="parcels[{{ $index }}][breadth]" wire:model.defer="parcels.{{ $index }}.breadth" step="any" class="form-control individual-breadth" onChange="checkVolumeWeight()"></td>
                                <td><input type="number" min=1 name="parcels[{{ $index }}][height]"  wire:model.defer="parcels.{{ $index }}.height" step="any" class="form-control individual-height" onChange="checkVolumeWeight()"></td>
                                <td><input type="number" min=1 name="parcels[{{ $index }}][weight]"  wire:model.defer="parcels.{{ $index }}.weight" step="any" class="form-control" ></td>
                                <td><button wire:click="removeParcel({{ $index }})" class="btn btn-danger btn-sm">Delete</button></td>
                            </tr>

                            @endforeach
                            </tbody>
                           <tr>
                               <td colspan ="4"> Volume by dimension  : <strong id="volumeWeight"></strong> </td>
                               <td><input type="hidden" id="hiddenVolumeWeight" name="weight_by_dimension" value=""></td>
                               <td colspan="2"><button wire:click="addParcel" class="btn btn-info btn-sm">Add New Parcel Row</button></td>
                           </tr>

                        </table>
                    </div>
                </div>

            </div>

    @endif

    <div class="d-flex flex-row-reverse">
        <button type="button"  class="btn btn-info " wire:loading.attr="disabled"  wire:click.prevent="submitBeforeFourth"> Check Shipping Charge
            <span wire:loading wire:target="submitBeforeFourth" class="spinner-border spinner-border-sm text-warning"   aria-hidden="true"></span>
        </button>
        <button type="button"  class="mx-3 btn btn-danger " wire:click.prevent="stepBack">Back</button>
    </div>
    <br>

    <div class="mt-4">
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Please fill the highlighted fields (of parcel or document) above before submitting
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </div>

 </div>

{{-- end of step 4 --}}


 {{-- step 5  --}}
 <div class="p-4 {{ $currentStep != 5 ? 'd-none' : 'd-block' }}">

    <div class="table-responsive">
        <table  class="table table-hover">
            <thead>
                <tr>
                    <th>Shipment Type</th>
                    <th>Service Provider</th>
                    <th>Source</th>
                    <th>Destination</th>
                    <th>Number of Items</th>
                    <th>Total Weight</th>
                    <th>Total Shipping Charge</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $shipment_type }}</td>
                    <td>{{ $service_provider }}</td>
                    <td>{{ $shipment_type=="international"?$from_country:$from_city}}</td>
                    <td>{{ $shipment_type=="international"?$to_country:$to_city}}</td>
                    <td>{{ $itemsCount}}</td>
                    <td>{{ $itemsWeight}}</td>
                    <td>{{ $totalShippingCharge }}</td>

                </tr>

            </tbody>
        </table>
    </div>


    <div class="d-flex flex-row-reverse">
        <button type="button"  class="btn btn-success " wire:loading.attr="disabled"  wire:click.prevent="submitFourth">@if($shipment_id)Update @else   Create @endif Shipment & Print
            <span wire:loading wire:target="submitFourth" class="spinner-border spinner-border-sm text-warning"   aria-hidden="true"></span>
        </button>
        <button type="button"  class="mx-3 btn btn-danger " wire:click.prevent="stepBack">Back</button>
    </div>
    <br>

 </div>

{{-- end of step 5 --}}



 {{-- step 6  --}}
 <div class="p-4 {{ $currentStep != 6 ? 'd-none' : 'd-block' }}">
    @if($currentStep==6)
    @php
    $shipment=$shipmentBillInfo;
    @endphp
    <div class="float-right">
        @if(auth()->user()->user_type=="customer")
            <a  href="{{ route('user.shipment.index') }}"  class="btn btn-success" >View All Shipments</a>
        @else
            <a  href="{{ route('shipment.index') }}"  class="btn btn-success" >View All Shipments</a>
        @endif
    </div>
   <script> window.open("{{ route('shipment.print',$this->db_shipment_id) }}");</script>

    <br>
    <br>


                <div id="printDiv">
                    @include('admin.shipment.print-temp')
                </div>

    @endif

 </div>

{{-- end of step 6 --}}



<script>
    function checkVolumeWeight(){
        let lengths = document.getElementsByClassName('individual-length');
        let breadths = document.getElementsByClassName('individual-breadth');
        let heights = document.getElementsByClassName('individual-height');
        let volumeWeight=0;
        let individualVolume=0;
       for(i=0; i<lengths.length; i++){
           individualVolume=  (parseFloat(lengths[i].value)*parseFloat(breadths[i].value)*parseFloat(heights[i].value)/5000);
           volumeWeight +=parseFloat(individualVolume);
       }
       document.getElementById('hiddenVolumeWeight').value=volumeWeight;
       document.getElementById('volumeWeight').innerText=volumeWeight+' KG';
    }
</script>




</div> {{-- end of componnet  --}}
