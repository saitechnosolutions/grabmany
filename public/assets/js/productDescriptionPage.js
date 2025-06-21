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

    var checkout_prod_price = $("#checkout_prod_price").val();
    var user_id = $("#logged_user_id").val();
    var prod_id = $("#checkout_prod_id").val();
    var product_quantity = $("#hidden_prod_varient_qty").val() || 1;

    var size_value = $("#hidden_prod_varient_size").val();
    var color_value = $("#hidden_prod_varient_color").val();

    if (!size_value || !color_value) {
        Swal.fire({
            icon: "warning",
            title: "Select Size & Color",
            text: "Please select both size and color before adding to wishlist.",
        });
        return;
    }

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
                $("#staticBackdropcheckout").modal("show");
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
