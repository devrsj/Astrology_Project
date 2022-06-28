<div>

<div class="container">
    <div class="row col-md-9 mx-auto my-4">
        <div class="col">
            <label for="type">Type <span class="text-danger">*</span></label>
            <select name="type" wire:model.defer="type" id="type" class="form-control">
                <option value="">-- Select Type --</option>
                <option value="international">International</option>
                <option value="domestic">Domestic</option>
            </select>
            <span class="text-danger">@error('type'){{ $message }}@enderror</span>
        </div>
        <div class="col">
            <label for="weight">Weight <span class="text-danger">*</span></label>
            <input type="number" id="weight" wire:model.defer="weight" class="form-control" >
            <span class="text-danger">@error('weight'){{ $message }}@enderror</span>

        </div>
        <div class="col">
            <label for="charge">Charge <span class="text-danger">*</span></label>
            <input type="number" id="charge" step="0.01" wire:model.defer="charge" class="form-control">
            <span class="text-danger">@error('charge'){{ $message }}@enderror</span>

        </div>
        <div class="col align-self-end">
            <button   wire:loading.attr="disabled" wire:click="save" class="btn btn-sm btn-success"> <i class="fas fa-save"></i> Save</button>
            @if($editing)
                <button  wire:loading.attr="disabled"  wire:click="cancel" class="btn btn-sm btn-secondary"> <i class="fas fa-undo-alt"></i> Cancel</button>
            @endif
        </div>
    </div>
    <div class="row justify-content-around">
        <div class="col-md-9">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Type</th>
                                <th>Weight(greater than)</th>
                                <th>Shipping Charge(1kg)</th>
                                <th>#</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($charges as $index=>$chargeTable)
                                <tr>
                                    <td>{{ $index+1}}</td>
                                    <td>{{ ucfirst($chargeTable->type) }}</td>
                                    <td>{{ $chargeTable->weight }}</td>
                                    <td>
                                        {{ $chargeTable->charge }}
                                    </td>
                                    <td>
                                        <button  wire:loading.attr="disabled"  wire:click="edit('{{ $chargeTable->id }}')" class="btn btn-sm btn-info"> <i class="fas fa-edit"></i> Edit</button>
                                        <button  wire:loading.attr="disabled" wire:key="del{{ $index }}" wire:click="deleteCharge('{{ $chargeTable->id }}')" class="btn btn-sm btn-danger"> <i class="fas fa-trash"></i> Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                            @if($charges->count()<1)
                            <tr>
                                 <td colspan="4" class="text-center text-gray">No Results Found</td>
                            </tr>
                            @endif
                        </tbody>


                    </table>
            </div>
    </div>
    </div>

</div>
