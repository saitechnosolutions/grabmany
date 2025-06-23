$(document).ready(function () {
    $(".slick-fade").slick({
        fade: true,
        speed: 500,
        autoplay: true,
        autoplaySpeed: 1000,
        arrows: true,
    });
});

$(".fade-new").slick({
    dots: false,
    infinite: true,
    speed: 500,
    autoplay: true,
    autoplaySpeed: 2000,
    fade: true,
    cssEase: "linear",
});

// *SIZE SELECT

$(document).ready(function () {
    $(document).on("click", ".add_cart_home_prod", function () {
        let prod_id = $(this).data("prod_id");

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            url: "/product/getvarientdetails",
            type: "POST",
            data: {
                prod_id: prod_id,
            },
            success: function (response) {
                let sizeHtml = "";

                if (response.status == 200) {
                    $.each(response.groupedvarients, function (index, product) {
                        console.log(product[0].size_value);
                        sizeHtml += `
                            <div class="selectable-card rounded text-center p-2 me-2 prod_size_select_home"
                                data-size_value="${product[0].size_value}" 
                                data-product_id="${product[0].product_id}"
                                style="width: 100px;margin-right:5px;">
                                <div class="fw-bold">${product[0].size_value}</div>
                            </div>
                        `;
                    });
                } else {
                    sizeHtml += `<div>No Available Sizes</div>`;
                }

                $(".prod_size_append_home").html(sizeHtml);
                $("#cartModal_prod_id").val(prod_id);
                $("#cartModal").modal("show");
            },
            error: function () {
                alert("Something went wrong. Please try again.");
            },
        });
    });
});

// *COLOR SELECT

$(document).ready(function () {
    $(".home_prod_color_title").hide();

    // Handle size selection
    $(document).on("click", ".prod_size_select_home", function () {
        // Remove previous selection
        $(".prod_size_select_home").removeClass("active");
        $(this).addClass("active");

        let size_value = $(this).data("size_value");
        let prod_id = $(this).data("product_id");

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            url: "/product/fetchcolordetails",
            type: "POST",
            data: {
                size_value: size_value,
                prod_id: prod_id,
            },
            success: function (response) {
                let colorHtml = "";

                if (response.status == 200 && response.products.length > 0) {
                    $.each(response.products, function (index, product) {
                        colorHtml += `
                                <div class="selectable-card rounded prod_color_select_home"
                                    data-color="${product.color_value}"
                                    style="
                                        width: 50px;
                                        height: 50px;
                                        background-color: ${product.color_value};
                                        margin-right: 5px;">
                                </div>
                            `;
                    });
                    $(".home_prod_color_title").show();
                } else {
                    colorHtml = `<div class="text-danger">No Available Colors</div>`;
                    $(".home_prod_color_title").hide();
                }

                $(".prod_color_append_home").html(colorHtml);
            },
        });
    });

    // Handle color selection
    $(document).on("click", ".prod_color_select_home", function () {
        $(".prod_color_select_home").removeClass("active");
        $(this).addClass("active");
    });
});

$(document).ready(function () {
    $(document).on("click", ".cartModal_close_btn", function () {
        $("#cartModal").modal("hide");
    });
});

$(document).on("click", ".cartModal_submit_btn", function (e) {
    e.preventDefault();

    var product_id = $("#cartModal_prod_id").val();
    var user_id = $("#cartModal_user_id").val();
    var product_quantity = $("#qty-input").val() || 1;

    var size_value = $(".prod_size_select_home.active").data("size_value");
    var color_value = $(".prod_color_select_home.active").data("color");

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
        url: "/cart/store",
        type: "POST",
        data: {
            product_id: product_id,
            user_id: user_id,
            product_quantity: product_quantity,
            size_value: size_value,
            color_value: color_value,
        },
        dataType: "JSON",
        success: function (result) {
            if (result.status == 200) {
                Swal.fire("Success", "Product Added To Cart", "success");

                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    },
                });

                Toast.fire({
                    icon: "success",
                    title: "Product Added To Cart",
                });

                setTimeout(function () {
                    window.location.reload();
                }, 1500);
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

$(document).ready(function () {
    $("#second_stage_forget").hide();
    $(document).on("submit", "#forget_password_email_submit", function (e) {
        e.preventDefault();

        var phone = $("#forget_pass_email_input").val();

        if (!phone) {
            Swal.fire({
                icon: "warning",
                title: "Email Is Required",
                text: "Please Enter the Registered email to proceed with the password reset",
            });
            return;
        }

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/auth/forget-check",
            type: "POST",
            data: {
                phone: phone,
            },
            dataType: "JSON",
            success: function (result) {
                $("#first_stage_forget").hide();
                $("#second_stage_forget").show();

                $("#forget_pass_hidden_user").val(result.userid);
            },
            error: function (xhr) {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "User Not Found",
                    confirmButtonColor: "#dc3545",
                });
            },
        });
    });

    $(document).on("submit", "#forget_password_password_submit", function (e) {
        e.preventDefault();

        let password = $("#forget_pass_password_input").val();
        let userid = $("#forget_pass_hidden_user").val();

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/auth/reset-password",
            type: "POST",
            data: {
                password: password,
                userid: userid,
            },
            dataType: "JSON",
            success: function (result) {
                if (result.status == 200) {
                    Swal.fire("Success", "Password reset Success", "success");

                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 1500,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        },
                    });

                    Toast.fire({
                        icon: "success",
                        title: "Password reset Success",
                    });

                    setTimeout(function () {
                        window.location.href = "/login";
                    }, 1500);
                } else {
                    Swal.fire({
                        icon: "warning",
                        title: "Error",
                        text: `Something Went Wrong`,
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
