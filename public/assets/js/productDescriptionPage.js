$(document).ready(function () {
    function getOrCreateGuestId() {
        let guestId = localStorage.getItem("guest_user_id");

        if (!guestId) {
            guestId = crypto.randomUUID(); // Still uses native API
            localStorage.setItem("guest_user_id", guestId);
        }

        return guestId;
    }

    const guestUserId = getOrCreateGuestId();
    $("#logged_user_id").val(guestUserId);
});

$(document).ready(function () {
    var galleryThumbs = new Swiper(".gallery-thumbs", {
        spaceBetween: 5,
        freeMode: true,
        watchSlidesVisibility: true,
        watchSlidesProgress: true,
        breakpoints: {
            0: {
                slidesPerView: 3,
            },
            992: {
                slidesPerView: 4,
            },
        },
    });
    var galleryTop = new Swiper(".gallery-top", {
        spaceBetween: 10,
        slidesPerView: 1,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        thumbs: {
            swiper: galleryThumbs,
        },
    });
    // change carousel item height
    // gallery-top
    let productCarouselTopWidth = $(".gallery-top").outerWidth();
    $(".gallery-top").css("height", productCarouselTopWidth);

    // gallery-thumbs
    let productCarouselThumbsItemWith = $(
        ".gallery-thumbs .swiper-slide"
    ).outerWidth();
    $(".gallery-thumbs").css("height", productCarouselThumbsItemWith);
});

$(document).ready(function () {
    $(document).on("blur", "#qty-input", function () {
        let qty_value = $(this).val();

        $("#hidden_prod_varient_qty").val(qty_value);
    });
});

$(document).ready(function () {
    const $decreaseBtn = $("#decreaseBtn");
    const $increaseBtn = $("#increaseBtn");
    const $quantityInput = $("#quantityInput");

    $decreaseBtn.on("click", function () {
        let currentValue = parseInt($quantityInput.val()) || 0;
        if (currentValue > 0) {
            $quantityInput.val(currentValue - 1).trigger("input");
        }
    });

    $increaseBtn.on("click", function () {
        let currentValue = parseInt($quantityInput.val()) || 0;
        if (currentValue < 99) {
            $quantityInput.val(currentValue + 1).trigger("input");
        }
    });

    $quantityInput.on("input", function () {
        let value = parseInt($(this).val());
        $("#hidden_prod_varient_qty").val(value);
        if (isNaN(value) || value < 0) {
            $(this).val(0);
        } else if (value > 99) {
            $(this).val(99);
        }
    });
});

// *SINGLE PRODUCT CHECKOUT OPEN

$(document).on("submit", "#single_prod_checkout", function (e) {
    e.preventDefault();

    var size_value = $("#hidden_prod_varient_size").val();
    var color_value = $("#hidden_prod_varient_color").val();

    if (!size_value || !color_value) {
        Swal.fire({
            icon: "warning",
            title: "Select Size & Color",
            text: "Please select both size and color before Proceeding To Checkout",
        });
        return;
    }

    $("#staticBackdropcheckout").modal("show");
});

$(document).ready(function () {
    $(".single_checkout_step_two").hide();

    $(document).on("click", "#proceed_second_checkout_step", function () {
        var checkout_prod_price = $("#checkout_prod_price").val();
        var user_id = $("#logged_user_id").val();
        var prod_id = $("#checkout_prod_id").val();
        var product_quantity = $("#hidden_prod_varient_qty").val() || 1;

        var user_id = localStorage.getItem("guest_user_id");

        var size_value = $("#hidden_prod_varient_size").val();
        var color_value = $("#hidden_prod_varient_color").val();

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/check-out",
            type: "POST",
            data: {
                checkout_prod_price: checkout_prod_price,
                user_id: user_id,
                prod_id: prod_id,
                product_quantity: product_quantity,
                size_value: size_value,
                color_value: color_value,
            },
            dataType: "JSON",
            success: function (result) {
                if (result.status == 200) {
                    $(".single_checkout_step_one").hide();
                    $(".single_checkout_step_two").show();

                    let product = result.product;

                    $("#single_check_product_id").val(product.id);
                    $("#single_check_product_varient_id").val(
                        product.prod_varient_id
                    );
                    $("#single_check_product_size_value").val(product.size);
                    $("#single_check_product_color_value").val(product.color);
                    $("#single_check_product_quantity").val(product.quantity);
                    $("#single_check_product_total_price").val(product.total);
                    $("#single_check_product_single_price").val(product.price);
                    $("#single_check_product_user_id").val(user_id);

                    let row = `
                    <tr class="cart_item">
                        <td class="product-name">
                            ${product.name}    
                        </td>
                        <td class="product-image">
                            <img src="https://dashboardgrabmany.saitechnosolutions.co.in/images/${product.image}" alt="${product.name}" style="width: 60px;">
                        </td>
                        <td class="product-price">₹${product.price}</td>
                        <td class="product-image">${product.quantity}</td>
                        <td class="product-image">${product.color}</td>
                        <td class="product-image">${product.size}</td>
                        <td class="product-total text-end"><span class="amount"> ₹${product.total} </span></td>
                    </tr>
                    `;

                    $("table.table tbody").append(row);

                    // Update totals
                    let currentSubtotal =
                        parseFloat($(".cart_total").text().replace("₹", "")) ||
                        0;
                    let newSubtotal =
                        currentSubtotal + parseFloat(product.total);
                    $(".cart_total").text(`₹${newSubtotal}`);
                    $(".total").text(`₹${newSubtotal + 50}`);
                    $(".total-hidden").val(`${newSubtotal + 50}`);
                    $("input[name='cart_total']").val(newSubtotal);
                    $("input[name='total']").val(newSubtotal + 50);

                    // Get billing and shipping values
                    const billingHtml = `
                        <h5>Billing Details</h5>
                        <p><strong>Name:</strong> ${$(".name_bill").val()}</p>
                        <p><strong>Email:</strong> ${$(".email_bill").val()}</p>
                        <p><strong>Phone:</strong> ${$(
                            ".number_bill"
                        ).val()}</p>
                        <p><strong>Address:</strong> ${$(
                            ".address_bill"
                        ).val()}, ${$(
                        ".city_bill option:selected"
                    ).text()} - ${$(".zip_bill").val()}</p>
                        <p><strong></strong> ${$(
                            ".state_bill option:selected"
                        ).text()}</p>
                    `;

                    const shippingHtml = `
                        <h5>Shipping Details</h5>
                        <p><strong>Name:</strong> ${$(".name_ship").val()}</p>
                        <p><strong>Email:</strong> ${$(".email_ship").val()}</p>
                        <p><strong>Phone:</strong> ${$(
                            ".number_ship"
                        ).val()}</p>
                        <p><strong>Address:</strong> ${$(
                            ".address_ship"
                        ).val()}, ${$(
                        ".city_ship option:selected"
                    ).text()} - ${$(".zip_ship").val()}</p>
                        <p><strong></strong> ${$(
                            ".state_ship option:selected"
                        ).text()} </p>
                    `;

                    $(".single_check_billing_details").html(billingHtml);
                    $(".single_check_shipping_details").html(shippingHtml);
                } else {
                    Swal.fire({
                        icon: "warning",
                        title: "Already Added!",
                        text: `This item is already in your cart.`,
                        confirmButtonColor: "#28a745",
                    });
                }
            },
            error: function (xhr) {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Failed to add item to cart.",
                    confirmButtonColor: "#dc3545",
                });
            },
        });
    });
});

$(document).ready(function () {
    $(document).on("submit", "#single_checkout_form_data", function (e) {
        e.preventDefault();

        const formData = new FormData($("#single_checkout_form_data")[0]);

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            url: "/checkout/create-razor",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.status === "success") {
                    $("#staticBackdropcheckout").modal("hide");
                    const options = {
                        key: response.key,
                        amount: response.amount,
                        currency: "INR",
                        name: "Your Store Name",
                        description: "Order Payment",
                        order_id: response.order_id,
                        handler: function (paymentResult) {
                            // Append Razorpay response to FormData
                            formData.append(
                                "razorpay_payment_id",
                                paymentResult.razorpay_payment_id
                            );
                            formData.append(
                                "razorpay_order_id",
                                paymentResult.razorpay_order_id
                            );
                            formData.append(
                                "razorpay_signature",
                                paymentResult.razorpay_signature
                            );

                            // Submit final form data
                            $.ajax({
                                url: "/checkout/create-order",
                                type: "POST",
                                data: formData,
                                processData: false,
                                contentType: false,
                                success: function (response) {
                                    Swal.fire({
                                        title: "Success",
                                        text: response.message,
                                        icon: "success",
                                        customClass: {
                                            popup: "swal-custom-popup",
                                        },
                                    });

                                    // Toast Notification
                                    const Toast = Swal.mixin({
                                        toast: true,
                                        position: "top-end",
                                        showConfirmButton: false,
                                        timer: 1500,
                                        timerProgressBar: true,
                                        customClass: {
                                            popup: "swal-custom-popup",
                                        },
                                        didOpen: (toast) => {
                                            toast.onmouseenter = Swal.stopTimer;
                                            toast.onmouseleave =
                                                Swal.resumeTimer;
                                        },
                                    });

                                    Toast.fire({
                                        icon: "success",
                                        title: response.message,
                                    });

                                    // Redirect after success
                                    setTimeout(function () {
                                        window.location.href = "/";
                                    }, 1500);
                                },
                                error: function () {
                                    alert(
                                        "Order failed to store. Please contact support."
                                    );
                                    $('button[type="submit"]').prop(
                                        "disabled",
                                        false
                                    );
                                },
                            });
                        },
                        prefill: {
                            name: $("#firstname").val(),
                            email: $("#defemail").val(),
                            contact: $("#defphone").val(),
                        },
                        theme: {
                            color: "#3399cc",
                        },
                    };

                    const rzp = new Razorpay(options);
                    rzp.open();
                } else {
                    alert("Failed to create Razorpay order.");
                    $('button[type="submit"]').prop("disabled", false);
                }
            },
            error: function (err) {
                console.error(err);
                alert("Server error. Please try again.");
                $('button[type="submit"]').prop("disabled", false);
            },
        });
    });
});
