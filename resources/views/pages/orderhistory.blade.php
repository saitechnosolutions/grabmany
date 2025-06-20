@extends('layouts.default')
@section('main-content')
    <style>
        .table_order_history {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .order-table th,
        .order-table td {
            vertical-align: middle;
        }

        .btttn,
        .invoice_btn {
            background-color: #0d6efd;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            transition: background-color 0.3s ease;
        }

        .btttn:hover,
        .invoice_btn:hover {
            background-color: #0b5ed7;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        @media (max-width: 768px) {
            .action-buttons {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>

    <div class="container">
        <section class="table_order_history my-5">
            <h4 class="mb-4 text-center">Your Order History</h4>
            <div class="table-responsive">
                <table class="table table-bordered table-hover order-table">
                    <thead class="table-light">
                        <tr>
                            <th>Order Id</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            use Carbon\Carbon;
                            use Illuminate\Support\Facades\Auth;
                            use App\Models\ProductOrder;
                            use App\Models\ProductSlot;

                            $orders = ProductOrder::where('user_id', Auth::user()->id)
                                ->orderBy('created_at', 'desc')
                                ->get();
                        @endphp

                        @forelse ($orders as $order)
                            <tr>
                                <td>{{ $order->order_id }}</td>
                                <td>{{ Carbon::parse($order->date_ordered_on)->format('d/m/Y') }}</td>
                                <td>$ {{ number_format($order->grand_total_amount, 2) }}</td>
                                <td>
                                    <div class="action-buttons">
                                        @php
                                            $slots = ProductSlot::where('order_id', $order->order_id)->get();
                                        @endphp

                                        @if ($slots->count())
                                            <button type="button" class="btttn view-details-btn" data-bs-toggle="modal"
                                                data-bs-target="#orderDetailsModal" data-order="{{ $order->order_id }}"
                                                data-date="{{ \Carbon\Carbon::parse($order->date_ordered_on)->format('d/m/Y') }}"
                                                data-amount="{{ number_format($order->total_amount, 2) }}">
                                                View Details
                                            </button>
                                        @endif


                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">No orders found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    <!-- Order Details Modal -->
    <div class="modal fade" id="orderDetailsModal" tabindex="-1" aria-labelledby="orderDetailsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Order Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Order ID:</strong> <span id="modalOrderId"></span></p>
                    <p><strong>Date:</strong> <span id="modalOrderDate"></span></p>
                    <p><strong>Total Amount:</strong> $<span id="modalOrderAmount"></span></p>
                    <hr>
                    <div id="modalOrderItems">
                        <p>Loading items...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.view-details-btn', function() {
                let orderId = $(this).data('order');
                let orderDate = $(this).data('date');
                let orderAmount = $(this).data('amount');

                $("#modalOrderId").text(orderId);
                $("#modalOrderDate").text(orderDate);
                $("#modalOrderAmount").text(orderAmount);

                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                });

                $.ajax({
                    url: "/order/fetchordersummary",
                    type: "POST",
                    data: {
                        orderId: orderId,
                    },
                    success: function(response) {
                        let tableHtml = '';

                        if (response.status == 200 && response.orderDetails.length > 0) {
                            tableHtml += `
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Product Image</th>
                                        <th>Product Name</th>
                                        <th>MRP</th>
                                        <th>Offer Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>`;

                            $.each(response.orderDetails, function(index, item) {
                                console.log(item);
                                let product = item
                                    .product; // Assuming `product` is a relation inside each order detail
                                tableHtml += `
                                <tr>
                                    <td>
                                        <img src="https://dashboardgrabmany.saitechnosolutions.co.in/images/${product.product_image}" alt="Image" width="60" height="60" style="object-fit:contain;">
                                    </td>
                                    <td>${product.product_name}</td>
                                    <td>₹${item.mrp_price}</td>
                                    <td>₹${item.offer_price}</td>
                                    <td>${item.qty}</td>
                                    <td>₹${(item.offer_price * item.qty).toFixed(2)}</td>
                                </tr>`;
                            });

                            tableHtml += `</tbody></table>`;
                        } else {
                            tableHtml = `<div class="text-danger">No Available Products</div>`;
                        }

                        $("#product-container").html(tableHtml);
                    },
                    error: function(xhr) {
                        $("#product-container").html(
                            `<div class="text-danger">Failed to load product details.</div>`
                        );
                    }
                });
            });
        });
    </script>
@endsection
