<div>
    <div class="py-3 py-md-4 checkout">
        <div class="container">
            <h4>Checkout</h4>
            <hr>

            @if ($this->totalProductAmount != '0')

            <div class="row">
                <div class="col-md-12 mb-4">
                    <div class="shadow bg-white p-3">
                        <h4 class="text-primary">
                            Item Total Amount :
                            <span class="float-end">${{$this->totalProductAmount}}</span>
                        </h4>
                        <hr>
                        <small>* Items will be delivered in 3 - 5 days.</small>
                        <br/>
                        <small>* Tax and other charges are included ?</small>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="shadow bg-white p-3">
                        <h4 class="text-primary">
                            Basic Information
                        </h4>
                        <hr>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Full Name*</label>
                                    <input type="text" wire:model.defer="fullname" id="fullname" class="form-control" placeholder="Enter Full Name" />
                                    @error('fullname') <small class="text-danger">{{$message}}</small>  @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Phone Number*</label>
                                    <input type="number" wire:model.defer="phone" id="phone" class="form-control" placeholder="Enter Phone Number" />
                                    @error('phone') <small class="text-danger">{{$message}}</small>  @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Email Address*</label>
                                    <input type="email" wire:model.defer="email" id="email" class="form-control" placeholder="Enter Email Address" />
                                    @error('email') <small class="text-danger">{{$message}}</small>  @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>City/Province*</label>
                                    <input type="text" wire:model.defer="city" id="city" class="form-control" placeholder="Enter city/province" />
                                    @error('city') <small class="text-danger">{{$message}}</small>  @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>District*</label>
                                    <input type="text" wire:model.defer="district" id="district" class="form-control" placeholder="Enter district" />
                                    @error('district') <small class="text-danger">{{$message}}</small>  @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Ward*</label>
                                    <input type="text" wire:model.defer="ward" id="ward" class="form-control" placeholder="Enter ward" />
                                    @error('ward') <small class="text-danger">{{$message}}</small>  @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label>Address*</label>
                                    <textarea wire:model.defer="address" id="address" class="form-control" placeholder="Enter your street and building address" rows="2"></textarea>
                                    @error('address') <small class="text-danger">{{$message}}</small>  @enderror
                                </div>
                                <div class="col-md-12 mb-3" wire:ignore>
                                    <label>Select Payment Mode: </label>
                                    <div class="d-md-flex align-items-start">
                                        <div class="nav col-md-3 flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                            <button wire:loading.attr="disabled" class="nav-link active fw-bold" id="cashOnDeliveryTab-tab" data-bs-toggle="pill" data-bs-target="#cashOnDeliveryTab" type="button" role="tab" aria-controls="cashOnDeliveryTab" aria-selected="true"><i class="fa fa-money"></i> Cash on Delivery </button>
                                            <button wire:loading.attr="disabled" class="nav-link fw-bold" id="onlinePayment-tab" data-bs-toggle="pill" data-bs-target="#onlinePayment" type="button" role="tab" aria-controls="onlinePayment" aria-selected="false"><i class="fa fa-credit-card"></i> Online Payment </button>
                                        </div>
                                        <div class="tab-content col-md-9" id="v-pills-tabContent">
                                            <div class="tab-pane active show fade" id="cashOnDeliveryTab" role="tabpanel" aria-labelledby="cashOnDeliveryTab-tab" tabindex="0">
                                                <h6>Cash on Delivery Mode</h6>
                                                <hr/>
                                                <button type="button" wire:loading.attr="disabled" wire:click="codOrder" class="btn btn-primary">
                                                    <span wire:loading.remove wire:target="codOrder">
                                                    Place Order (Cash on Delivery)
                                                    </span>
                                                    <span wire:loading wire:target="codOrder">
                                                        Placing Order
                                                    </span>
                                                </button>

                                            </div>
                                            <div class="tab-pane fade" id="onlinePayment" role="tabpanel" aria-labelledby="onlinePayment-tab" tabindex="0">
                                                <h6>Online Payment Mode</h6>
                                                <hr/>
                                                {{-- <button type="button" wire:loading.attr="disabled" class="btn btn-warning">Pay Now (Online Payment)</button> --}}
                                                <div >
                                                    <div id="paypal-button-container"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                    </div>
                </div>

            </div>
            @else
                <div class="card card-body shadow text-center p-md-5">
                    <h4>No items in cart to checkout</h4>
                    <a href="{{ url('/') }}" class="btn btn-warning">Shop now</a>
                </div>
            @endif
        </div>
    </div>
</div>


@push('scripts')
    <script src="https://www.paypal.com/sdk/js?client-id=AeYlwWvNxSMoT_JZsLRXoN5qR3SjpCCiSmyTZZDeESEaEiLqASpDo-ZNon2FBFqrSOdNO-3XyVM6HKFm&currency=USD"></script>
    <script>
        paypal.Buttons({
            onClick: function() {
                // Show a validation error if the checkbox is not checked
                if (!document.getElementById('fullname').value
                    || !document.getElementById('email').value
                    || !document.getElementById('phone').value
                    || !document.getElementById('city').value
                    || !document.getElementById('district').value
                    || !document.getElementById('ward').value
                    || !document.getElementById('address').value
                ) {
                    livewire.emit('validationForAll');
                    return false;
                } else {
                    @this.set('fullname', document.getElementById('fullname').value);
                    @this.set('email', document.getElementById('email').value);
                    @this.set('phone', document.getElementById('phone').value);
                    @this.set('city', document.getElementById('city').value);
                    @this.set('district', document.getElementById('district').value);
                    @this.set('ward', document.getElementById('ward').value);
                    @this.set('address', document.getElementById('address').value);
                }
            },

            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: "{{ $totalProductAmount }}"
                        }
                    }]
                });
            },

            onApprove: function(data, actions) {
                return actions.order.capture().then(function(orderData) {
                    console.log('Capture result:', orderData);
                    console.log(JSON.stringify(orderData, null, 2));
                    const transaction = orderData.purchase_units[0].payments.captures[0];

                    if (transaction.status === "COMPLETED") {
                        livewire.emit('transactionEmit', transaction.id);
                    }
                    // Perform additional actions or redirect to a success page
                });
            }
        }).render('#paypal-button-container');
    </script>

@endpush
