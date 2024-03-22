<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addPriceWholesaleModalLabel">{{ __('Add Wholesale Price') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="wholesalePriceForm">
                @csrf
                <input type="hidden" name="field_id" value="{{ $data['id'] }}">
                <div id="wholesalePriceFields">
                    <input type="hidden" name="variation_wholesale_name[]"
                        value="{{ explode('wholesale-', $data['id'])[1] }}">
                    @forelse ($data['priceRange'] as $range)
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="wholesalePrice">{{ __('Wholesale Price') }}</label>
                                <input type="text" class="form-control" name="variation_wholesale_price[]"
                                    placeholder="Enter Wholesale Price" value="{{ $range['price'] }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="minQuantity">{{ __('Minimum Quantity') }}</label>
                                <input type="number" class="form-control" name="variation_min_quantity[]"
                                    placeholder="Enter Minimum Quantity" value="{{ $range['min'] }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="maxQuantity">{{ __('Maximum Quantity') }}</label>
                                <input type="number" class="form-control" name="variation_max_quantity[]"
                                    placeholder="Enter Maximum Quantity" value="{{ $range['max'] }}">
                            </div>
                        </div>
                        @empty
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="wholesalePrice">{{ __('Wholesale Price') }}</label>
                                <input type="text" class="form-control" name="variation_wholesale_price[]"
                                    placeholder="Enter Wholesale Price" >
                            </div>
                            <div class="form-group col-md-4">
                                <label for="minQuantity">{{ __('Minimum Quantity') }}</label>
                                <input type="number" class="form-control" name="variation_min_quantity[]"
                                    placeholder="Enter Minimum Quantity">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="maxQuantity">{{ __('Maximum Quantity') }}</label>
                                <input type="number" class="form-control" name="variation_max_quantity[]"
                                    placeholder="Enter Maximum Quantity">
                            </div>
                        </div>
                    @endforelse
                </div>
                <button type="button" class="btn btn-primary addFields" id="addFields" data-variant="">Add Price
                    Field</button>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="saveWholesalePrice">Save</button>
        </div>
    </div>
</div>

