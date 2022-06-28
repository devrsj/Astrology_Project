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
  .ignorePrint, .ignorePrint *{
      display: none;
  }
}
  </style>
    <h3 class="text-info text-center">Save Shipping Charges</h3>
    <div class="my-2">
        <button class="btn btn-primary btn-sm" wire:loading.attr="disabled" wire:click="exportCity">Export All Cities</button>
        <button class="btn btn-primary btn-sm" wire:loading.attr="disabled" wire:click="exportCountry">Export All Countries</button>
    </div>
    <div>
        <form class="col-md-11 mx-auto p-3 shadow-lg">
            @csrf
            <div>
               @if($editing) <span class="text-danger">Updating Charge for <strong> {{ $weight }}</strong> KG</span> @endif
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="type">Type <span class="text-danger">*</span></label>
                    <select @if($editing) disabled @endif wire:model.lazy="type" name="type" id="type" class="form-control">
                        <option value="" selected >-- Select Type --</option>
                        <option value="country">Country</option>
                        <option value="city">City</option>
                    </select>
                    <span class="text-danger">@error('type'){{ $message }}@enderror</span>
                </div>
                @if($type=="country")
                <div class="col form-group">
                    <label for="countryNameSelect2">Country Name <span class="text-danger">*</span></label>

                    <select @if($editing) disabled @endif name="name" id="countryNameSelect2" class="form-control" wire:model.lazy="name">
                        <option value="">--Select Country --</option>
                        @foreach (countryInfoList() as $country)
                         <option value="{{ $country['name'] }}">{{ $country['name'] }}</option>
                        @endforeach
                    </select>
                 <span class="text-danger">@error('name'){{ $message }}@enderror</span>
                </div>
                @endif
                @if($type=="city")
                <div class="col-6 form-group">
                    <label for="districts">District Name <span class="text-danger">*</span></label>
                    <select @if($editing) disabled @endif name="name" id="districts" class="form-control" wire:model.lazy="name">
                        <option value="">-- Select Country --</option>
                        @foreach (districtInfo() as $district)
                        <option value="{{ $district['name'] }}" >{{ $district['name'] }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger">@error('name'){{ $message }}@enderror</span>
                </div>
                @endif


            </div>

            @if($name)
            <small class="text-info font-weight-bold">Enter Weight and Shipping Charge for above selected country/city</small>
            <div class="row">
                <div class="col-md-6">
                    <label for="weight">Weight(kg)<span class="text-danger">*</span></label>
                    <input type="number" @if($editing) disabled @endif  oninput="validity.valid||(value='');" step="0.5" min="0"  max="10" id="weight" wire:model.defer="weight" placeholder="E.g 0.5, 1, 1.5" class="form-control">
                    <span class="text-danger">@error('weight'){{ $message }}@enderror</span>
                </div>
                <div class="col-md-6">
                    <label for="shippingCharge">Shipping Charge(Rs)<span class="text-danger">*</span></label>
                    <input type="number" id="shippingCharge" min="1" wire:model.defer="shippingCharge" placeholder="Enter Shipping Charge" class="form-control">
                    <span class="text-danger">@error('shippingCharge'){{ $message }}@enderror</span>
                </div>
            </div>
            @endif


            <div class="row">
              @if($type)
                <div class="form-group">
                    <button type="reset" wire:click="resetAll" class="btn btn-sm btn-danger">Reset</button>
                    <button type="button"  wire:loading.attr="disabled" wire:click="saveShippingCharge" class="btn btn-sm btn-success">@if($weight)Update @else Save @endif Charge</button>
                </div>
               @endif

            </div>
        </form>
    </div>
    <div class="container">
        @if($shippingCharges&&$shippingCharges->count()>0)
        <h3 class="text-center text-info mt-3">Shipping Charges List</h3>
        <div class="table-responsive">
            <table id="printDiv" class="table">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Name</th>
                        <th>Weight(kg)</th>
                        <th>Shipping Charges(Rs)</th>
                        <th class="ignorePrint">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($shippingCharges as $charge)
                        <tr>
                            <td>{{ ucfirst($charge->type) }}</td>
                            <td>{{ $charge->name }}</td>
                            <td>{{ $charge->weight }}</td>
                            <td>{{ $charge->shippingCharge }}</td>
                            <td class="ignorePrint">
                                <button class="btn btn-sm btn-info"  wire:loading.attr="disabled" wire:click="editShippingCharge({{ $charge->id }})"> <i class="fas fa-edit"></i> Edit</button>
                                <button class="btn btn-sm btn-danger"  wire:loading.attr="disabled" wire:click="deleteShippingCharge({{ $charge->id }})"> <i class="fas fa-trash"></i> Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
    @push('scripts')
    <script>
        Livewire.on('countryUpdated', function(){
            $(document).ready(function() {
                $("#countryNameSelect2").select2({
                    theme: 'bootstrap4'
                });
                $('#countryNameSelect2').on('change', function (e) {
                    var data = $('#countryNameSelect2').select2("val");
                    @this.set('name', data);
                });
            });
         });
         Livewire.on('countryUpdated', function(){
            $(document).ready(function() {
                $("#parentCountrySelect2").select2({
                    theme: 'bootstrap4'
                });
                $('#parentCountrySelect2').on('change', function (e) {
                    var data = $('#parentCountrySelect2').select2("val");
                    @this.set('parentCountry', data);
                });
            });
        });
         Livewire.on('districtUpdated', function(){
            $(document).ready(function() {
                $("#districts").select2({
                    theme: 'bootstrap4'
                });
                $('#districts').on('change', function (e) {
                    var data = $('#districts').select2("val");
                    @this.set('name', data);
                });
            });
        });


    </script>
    @endpush
</div>
