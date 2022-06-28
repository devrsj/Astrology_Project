<div>
    <div class="table-reponsive">
        <div class="d-flex flex-row-reverse">
            <div class="form-inline">
                <input type="text" wire:model.defer="search" class="form-control" placeholder="Search City/Country">
                <button type="button" wire:click="render" wire:loading.attr="disabled" class="btn btn-sm btn-success inline">Search<span wire:loading wire:target="render" class="spinner-border spinner-border-sm"></span></button>
            </div>
        </div>

        <span class="text-sm text-info">You can edit each row by double clicking on the row also.</span> <br>
        <span class="text-sm text-info">Hit <strong>Enter</strong> to save and hit <strong>Esc</strong> to cancel while editing.</span>
       <div>
        <button class="btn btn-primary btn-sm" wire:loading.attr="disabled" wire:click="exportCity">Export All Cities</button>
        <button class="btn btn-primary btn-sm" wire:loading.attr="disabled" wire:click="exportCountry">Export All Countries</button>
       </div>
        <table class="table" id="shipping_charges_table">
            <thead>
                <tr>
                    <th>Country Code</th>
                    <th>Country Name</th>
                    <th>City Name</th>
                    <th>Shipping Charges</th>
                    <th>Currency</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>


                @foreach ($countries as $index=>$country)
                <tr  wire:dblclick="edit({{ $index}})">

                    <td>{{ $country['shortcode']?$country['shortcode']:$country['parent']['shortcode'] }}</td>
                    <td>
                        {{ $country['parent']?$country['parent']['name']:$country['name'] }}
                    </td>
                    <td>
                        @if($editingIndex!==$index)
                        {{ $country['parent']?$country['name']:null }}
                        @else
                           @if($country['parent'])
                           <input type="text" class="form-control" name="countries[{{ $index }}][name]"  wire:keydown.enter="update({{ $index }})" wire:keydown.escape="cancelEdit" wire:model.defer="countries.{{ $index }}.name">
                           @endif
                        </td>
                        @endif

                    <td>
                        @if($editingIndex!==$index)
                        {{ $country['shipping_charges'] }}
                        @else
                            <input type="text" class="form-control" wire:keydown.enter="update({{ $index }})" wire:keydown.escape="cancelEdit" wire:model.defer="countries.{{ $index }}.shipping_charges"></td>
                        @endif
                    </td>
                    <td>{{ $country['parent']?$country['parent']['currency_symbol']:$country['currency_symbol'] }}</td>
                    <td class="form-inline">
                        @if($editingIndex===$index)
                           <div>
                            <button type="button" wire:key="a{{ $index }}"  wire:loading.attr="disabled" wire:click="update({{ $index }})" class="btn btn-sm btn-success">Save <span wire:loading wire:target="update({{ $index }})" class="spinner-border spinner-border-sm" ></span> </button>
                           </div>
                           <div>
                            <button type="button" wire:key="b{{ $index }}" wire:loading.attr="disabled"  wire:click="cancelEdit"  class="btn btn-sm btn-danger">Cancel <span wire:loading wire:target="cancelEdit" class="spinner-border spinner-border-sm" ></span> </button>
                           </div>
                        @else
                          <div>
                            <button type="button" wire:key="c{{ $index }}" wire:click="edit({{ $index}})" wire:loading.attr="disabled" class="btn btn-sm btn-info">Edit <span wire:loading wire:target="edit({{ $index}})" class="spinner-border spinner-border-sm" ></span></button>
                        </div>
                        <div>
                            <button type="button" wire:key="d{{ $index }}" onclick="confirm('Are you sure you want to remove?') || event.stopImmediatePropagation()"  wire:click="deleteCity({{ $index }})" class="btn btn-sm btn-danger"> Delete</button>
                        </div>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


</div>
