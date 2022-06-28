<div>
    <style>
        .custom-control-input:checked~.custom-control-label::before{
            border-color: green;
            background-color: green;
            box-shadow: none;
        }
        .custom-control-input{
            width:100px;
        }
    </style>
    <div class="row mt-4 mb-4">
        <div class="col-md-8 mx-auto">
            @if($editing)<span class="text-info">Editing Service Provider: <strong>{{ $name }}({{ $sp_id }})</strong> </span> @endif
           <div class="form-row">
               <div class="col-md-3">
                   <label for="type">Type</label>
                   <select name="type" wire:model.defer="type" id="type" class="form-control">
                       <option value="">-- Choose One --</option>
                        <option value="international">International</option>
                        <option value="domestic">Domestic</option>
                    </select>
                    <span class="text-danger">@error('type'){{ $message }}@enderror</span>
                </div>
                <div class="col-md-6">
                    <label for="serviceProvider">Service Provider Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" wire:model.defer="name">
                    <span class="text-danger">@error('name'){{ $message }}@enderror</span>
                </div>
                <div class="col align-self-end">
                    @if($editing)
                    <button class="btn btn-success" wire:click="updateServiceProvider">Update</button>
                    @else
                    <button class="btn btn-success" wire:click="saveServiceProvider">Save</button>
                    @endif
                    @if($editing) <button class="btn btn-info" wire:click="cancelEditing">Cancel</button> @endif
                </div>
           </div>
        </div>

    </div>
    <h3 class="text-info text-center m">List of Service Providers</h3>
    <div class="table-responsive">
        <table class="table table-striped ">
            <thead >
                <tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Service Provider</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($serviceProviders as $provider)
                    <tr>
                        <td>{{ $provider->id }}</td>
                        <td>{{ ucfirst($provider->type) }}</td>
                        <td>{{ $provider->name }}</td>
                        <td>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" value="{{ $provider->id }}" wire:click="ChangeStatus({{ $provider->id }})" @if($provider->status) checked @endif class="custom-control-input" id="switch{{ $provider->id }}">
                                <label class="custom-control-label" for="switch{{ $provider->id }}"></label>
                            </div>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-danger"  wire:loading.attr="disabled" wire:click="deleteServiceProvider({{ $provider->id }})"><i class="fas fa-trash"></i> Delete</button>
                            <button class="btn btn-sm btn-info"  wire:loading.attr="disabled" wire:click="editServiceProvider({{ $provider->id }})"><i class="fas fa-edit"></i> Edit</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
