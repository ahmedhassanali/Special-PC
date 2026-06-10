<div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="list-orders">
    <h5 class="text-dark my-3">{{ __('ecommerce.orders_title') }}</h5>
    <div class="rev-pro">
        <div class="d-flex bg-gray">
            <div class="list-group" id="list-nav-orders" role="tablist">
                <a class="list-group-item list-group-item-action active" id="current" data-bs-toggle="list"
                    href="#list-current" role="tab" aria-controls="list-current">
                    {{ __('ecommerce.current_orders') }}
                </a>
                <a class="list-group-item list-group-item-action" id="past" data-bs-toggle="list" href="#list-past"
                    role="tab" aria-controls="list-past">
                    {{ __('ecommerce.past_orders') }}
                </a>
                <a class="list-group-item list-group-item-action" id="canceled" data-bs-toggle="list"
                    href="#list-canceled" role="tab" aria-controls="list-canceled">
                    {{ __('ecommerce.cancelled_orders') }}
                </a>
            </div>
        </div>


        <div class="tab-content" id="nav-orders">

            @php
                $cancelledOrders = json_decode($cancelledOrders);
                $completedOrders = json_decode($completedOrders);
                $runningOrders = json_decode($runningOrders);
            @endphp

            <div class="tab-pane fade show active" id="list-current" role="tabpanel" aria-labelledby="list-current">
                @foreach ($runningOrders as $order)
                    <div class="order-card">
                        <div class="d-flex">
                            <img class="img-fluid" src="{{ asset($order->image) }}">
                            <div class="order-info m-2">
                                <div class="d-flex align-items-center g-4">
                                    <h6 class="text-dark">
                                        {{ $order->name }}
                                    </h6>
                                    <span class="fs-12 text-gray">
                                        {{ __('ecommerce.order_number', ['order_id' => $order->id]) }}
                                    </span>
                                </div>
                                <small class="badge blue">
                                    {{ __('ecommerce.order_status_delivery') }}
                                </small>
                            </div>
                        </div>
                        <a class="link fs-14 text-primary" href="{{ route('customer.order.show', $order->id) }}">
                            {{ __('ecommerce.order_details') }}
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="tab-pane fade" id="list-past" role="tabpanel" aria-labelledby="list-past">
                @foreach ($completedOrders as $completedOrder)
                    <div class="order-card">
                        <div class="d-flex">
                            <img class="img-fluid" src="{{ asset($completedOrder->image) }}">
                            <div class="order-info m-2">
                                <div class="d-flex align-items-center g-4">
                                    <h6 class="text-dark">
                                        {{ $completedOrder->name }}
                                    </h6>
                                    <span class="fs-12 text-gray">
                                        {{ __('ecommerce.order_number', ['order_id' => $completedOrder->id]) }}
                                    </span>
                                </div>
                                <small class="badge green">
                                    {{ __('ecommerce.order_status_delivered') }}
                                </small>
                            </div>
                        </div>
                        <a class="link fs-14 text-primary"
                            href="{{ route('customer.order.show', $completedOrder->id) }}">
                            {{ __('ecommerce.order_details') }}
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="tab-pane fade" id="list-canceled" role="tabpanel" aria-labelledby="canceled">
                @foreach ($cancelledOrders as $cancelledOrder)
                    <div class="order-card">
                        <div class="d-flex">
                            <img class="img-fluid" src="{{ asset($cancelledOrder->image) }}">
                            <div class="order-info m-2">
                                <div class="d-flex align-items-center g-4">
                                    <h6 class="text-dark">
                                        {{ $cancelledOrder->name }}
                                    </h6>
                                    <span class="fs-12 text-gray">
                                        {{ __('ecommerce.order_number', ['order_id' => $cancelledOrder->id]) }}
                                    </span>
                                </div>
                                <small class="badge red">
                                    {{ __('ecommerce.order_status_cancelled') }}
                                </small>
                            </div>
                        </div>
                        <a class="link fs-14 text-primary"
                            href="{{ route('customer.order.show', $cancelledOrder->id) }}">
                            {{ __('ecommerce.order_details') }}
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
