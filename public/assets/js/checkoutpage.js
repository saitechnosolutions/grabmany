$(document).ready(function () {
    $(document).on("submit", "#checkOutMM", function (e) {
        e.preventDefault();

        const formData = new FormData($("#checkOutMM")[0]);

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            url: "/checkout/createrazor",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.status === "success") {
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
                                url: "/checkoutmm",
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
