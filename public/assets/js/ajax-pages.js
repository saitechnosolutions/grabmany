$(document).ready(function () {
    $(".addcart").click(function () {
        $button = $(this);
        $product_id = $(this).data("product_id");
        $user_id = $(this).data("user_id");
        $product_quantity = $(this).data("product_quantity");
        $price = $(this).data("price");

        if ($button.hasClass("added")) {
            Swal.fire({
                icon: "warning",
                title: "Already Added!",
                text: "This item is already in your cart.",
                confirmButtonColor: "#3085d6",
            });
            return;
        }
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/add-cart",
            data: {
                product_id: $product_id,
                user_id: $user_id,
                product_quantity: $product_quantity,
                price: $price,
            },
            type: "POST",
            dataType: "json",
            success: function (result) {
                if (result.status == "success") {
                    $button.addClass("added");
                    $button.find(".action-text").text("Added");
                    $(".badge").text(result.count);
                    Swal.fire({
                        icon: "success",
                        title: "Added to Cart!",
                        text: `Total items in cart: ${result.count}`,
                        confirmButtonColor: "#28a745",
                    });
                } else {
                    Swal.fire({
                        icon: "warning",
                        title: "Already Added!",
                        text: `This item is already in your cart.`,
                        confirmButtonColor: "#28a745",
                    });
                }
            },
        });
    });
});

$(document).ready(function () {
    // $(".addtocart").on("click", function (e) {
    //     e.preventDefault();

    //     var $product_id = $(this).data("product_id");
    //     var $user_id = $(this).data("user_id");
    //     var $price = $(this).data("price");
    //     var $product_quantity =
    //         $(this).closest(".actions").find(".qty-input").val() || 1;

    //     $.ajax({
    //         headers: {
    //             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    //         },
    //         url: "/add-cart",
    //         type: "POST",
    //         data: {
    //             product_id: $product_id,
    //             user_id: $user_id,
    //             product_quantity: $product_quantity,
    //             price: $price,
    //         },
    //         dataType: "JSON",
    //         success: function (result) {
    //             if (result.status === "success") {
    //                 $(".badge").text(result.count);
    //                 Swal.fire({
    //                     icon: "success",
    //                     title: "Added to Cart!",
    //                     text: `Total items in cart: ${result.count}`,
    //                     confirmButtonColor: "#28a745",
    //                 });
    //             } else {
    //                 Swal.fire({
    //                     icon: "warning",
    //                     title: "Already Added!",
    //                     text: `This item is already in your cart.`,
    //                     confirmButtonColor: "#28a745",
    //                 });
    //             }
    //         },
    //         error: function (xhr) {
    //             Swal.fire({
    //                 icon: "error",
    //                 title: "Error",
    //                 text: "Failed to add item to cart.",
    //                 confirmButtonColor: "#dc3545",
    //             });
    //         },
    //     });
    // });

    function updateSubtotal() {
        let subtotal = 0;
        $(".total-price").each(function () {
            let value =
                parseFloat(
                    $(this)
                        .text()
                        .replace(/[^\d.-]/g, "")
                ) || 0;
            subtotal += value;
        });
        $("#subtotal").text(subtotal.toFixed(2) + " ₹"); // Update visible subtotal
        $("#subtotal-hidden").val(subtotal.toFixed(2)); // Set hidden input value
    }

    updateSubtotal();

    $(document).on("change", ".qty-input", function () {
        let $row = $(this).closest("tr");
        let price = parseFloat($row.find("td:eq(1)").text()); 
        let qty = parseInt($(this).val());
        let cartId = $(this).data("cart-id");
        let gstPercent = 18; 
        if (isNaN(price) || isNaN(qty)) return;

        let totalPrice = price * qty;
        let gstAmount = totalPrice * (gstPercent / 100);
        let totalWithGst = Math.round(totalPrice);

      
        $row.find(".price-val").text(totalWithGst);

       
        $row.find('input[name="totalprice[]"]').val(totalWithGst);
        $row.find('input[name="product_quantity[]"]').val(qty);

        updateSubtotal();
       
        $.ajax({
            url: "/update-cart",
            method: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr("content"),
                cart_id: cartId,
                quantity: qty,
                total_price: totalWithGst,
            },
            success: function (res) {
                if (res.success) {
                    $("#subtotal").text(res.order_total + " ₹");
                    $("input#subtotal").val(res.order_total);
                }
            },
            error: function () {
                console.log("Failed to update cart. Please try again.");
            },
        });
    });
});

$(document).ready(function () {
    $(".removecart").click(function () {
        let product_id = $(this).data("id");
        let user_id = $(this).data("user_id");
        let row = $(this).closest("tr");
        let productTotalText = row.find(".total-price").text().trim();
        let productTotal =
            parseFloat(productTotalText.replace(/[^\d.-]/g, "")) || 0;
        let orderTotalElement = $("#subtotal");
        let orderTotal = parseFloat(orderTotalElement.text()) || 0;

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/removecart",
            type: "POST",
            data: {
                product_id: product_id,
                user_id: user_id,
            },
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    let newOrderTotal = orderTotal - productTotal;
                    orderTotalElement.text(newOrderTotal.toFixed(2));
                    row.remove();
                    $(".badge").each(function () {
                        let count = parseInt($(this).text(), 10);
                        if (count > 0) {
                            $(this).text(count - 1);
                        }
                    });

                    Swal.fire({
                        icon: "success",
                        title: "Cart Item Deleted!",
                        confirmButtonColor: "#28a745",
                    });
                } else {
                    Swal.fire({
                        icon: "warning",
                        title: "Already Deleted!",
                        confirmButtonColor: "#28a745",
                    });
                }
            },
            error: function () {
                Swal.fire({
                    icon: "warning",
                    title: "Error in removing item.",
                    confirmButtonColor: "#28a745",
                });
            },
        });
    });
});
$(document).on("click", "#ship-to-different-address-checkbox", function () {
    if ($(this).prop("checked") == true) {
        // Get billing details
        let nameShip = $(".name_bill").val();
        let emailShip = $(".email_bill").val();
        let numberShip = $(".number_bill").val();
        let stateShip = $(".state_bill").val();
        let cityShip = $(".city_bill").val();
        let postShip = $(".zip_bill").val();
        let addShip = $(".address_bill").val();

        // Fill in shipping fields
        $(".name_ship").val(nameShip);
        $(".email_ship").val(emailShip);
        $(".number_ship").val(numberShip);
        $(".state_ship").val(stateShip).trigger("change"); // Important: trigger city reload
        $(".zip_ship").val(postShip);
        $(".address_ship").val(addShip);

        // After a short delay (for AJAX to load cities), set city
        setTimeout(function () {
            $(".city_ship").val(cityShip);
        }, 500);
    } else {
        // Clear shipping fields
        $(
            ".name_ship, .email_ship, .number_ship, .state_ship, .zip_ship, .address_ship"
        ).val("");
        $(".city_ship").find("option:not(:first)").remove().end().val("");
    }
});

$(document).ready(function () {
    $(".state_bill").change(function () {
        var state_id = $(this).val();

        if (state_id) {
            $.ajax({
                type: "GET",
                url: "/stateCity/" + state_id,
                dataType: "json",
                success: function (response) {
                    $(".city_bill")
                        .empty()
                        .append('<option value="">Select City</option>');

                    $.each(response, function (index, city) {
                        $(".city_bill").append(
                            '<option value="' +
                                city.name +
                                '">' +
                                city.name +
                                "</option>"
                        );
                    });
                },
                error: function () {
                    alert("Unable to load cities. Please try again.");
                },
            });
        } else {
            $(".city_bill")
                .empty()
                .append('<option value="">Select City</option>');
        }
    });
});

$(document).on("change", ".state_ship", function () {
    var stateID = $(this).val();
    if (stateID) {
        $.ajax({
            url: "/stateShipCity/" + stateID,
            type: "GET",
            dataType: "json",
            success: function (data) {
                $(".city_ship")
                    .empty()
                    .append('<option value="">Select City</option>');
                $.each(data, function (key, value) {
                    $(".city_ship").append(
                        '<option value="' +
                            value.name +
                            '">' +
                            value.name +
                            "</option>"
                    );
                });
            },
        });
    } else {
        $(".city_ship").empty().append('<option value="">Select City</option>');
    }
});

$(document).ready(function () {
    // Initially hide the shipping form
    // $(".ship-form").hide();

    $("#ship-to-different-address-checkbox").on("change", function () {
        if ($(this).is(":checked")) {
            // Show the form with animation
            $(".ship-form").slideDown(300);
        } else {
            // Hide the form with animation
            $(".ship-form").slideUp(300);
        }
    });
});
