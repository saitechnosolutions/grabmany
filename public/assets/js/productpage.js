$(document).ready(function () {
    // Auto-select category from URL

    $("#price-range").slider({
        range: true,
        min: 0,
        max: 10000,
        values: [0, 10000],
        slide: function (event, ui) {
            $("#min-price").text(ui.values[0]);
            $("#max-price").text(ui.values[1]);
        },
        change: function () {
            filterProducts();
        },
    });

    function filterProducts() {
        var selectedCategory = $(".catego.active").data("cat") || "all";
        var sortOrder = $(".orderby").val();
        var priceMin = $("#price-range").slider("values", 0);
        var priceMax = $("#price-range").slider("values", 1);
        var productsFound = false;

        $(".produc").each(function () {
            var productCategory = $(this).data("cat");
            var productPrice = parseFloat($(this).data("price"));

            var matchesCategory =
                selectedCategory === "all" ||
                productCategory == selectedCategory;
            var matchesPrice =
                productPrice >= priceMin && productPrice <= priceMax;

            if (matchesCategory && matchesPrice) {
                $(this).show();
                productsFound = true;
            } else {
                $(this).hide();
            }
        });

        var $products = $(".produc:visible").toArray();
        if (sortOrder === "price") {
            $products.sort((a, b) => $(a).data("price") - $(b).data("price"));
        } else if (sortOrder === "price-desc") {
            $products.sort((a, b) => $(b).data("price") - $(a).data("price"));
        } else if (sortOrder === "date") {
            $products.sort(
                (a, b) =>
                    new Date($(b).data("date")) - new Date($(a).data("date"))
            );
        }

        $("#product-container").append($products);
        $("#no-products").toggle(!productsFound);
    }

    $(document).on("click", ".catego", function (e) {
        e.preventDefault();
        $(".catego").removeClass("active");
        $(this).addClass("active");
        filterProducts();
    });

    $(".orderby").change(function () {
        filterProducts();
    });

    filterProducts(); // Initial filter
    // Initial filter
});

// *PRICE RANGE FILTER

$(document).ready(function () {
    $(".price_range_filter_hidden").hide();
    $(document).on("click", "#show_hidden_price_range", function () {
        $(".price_range_filter_hidden").toggle(500);
    });
});

$(document).ready(function () {
    $(document).on("click", "#prod_price_filter", function () {
        let minvalue = $("#prod_price_filter_min").val();
        let maxvalue = $("#prod_price_filter_max").val();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            url: "/product/pricefilter",
            type: "POST",
            data: {
                minvalue: minvalue,
                maxvalue: maxvalue,
            },
            success: function (response) {
                $("#product-container").empty();
                let prodHtml = "";

                if (response.status == 200 && response.products.length > 0) {
                    $.each(response.products, function (index, product) {
                        console.log(product);
                        prodHtml += `
                            <div class="col-lg-4 col-12 col-sm-6 featureCol mb-7 produc"
                                data-cat="${product.categoryid}" 
                                data-price="${product.offer_price}" 
                                data-date="${product.created_at}">
                                
                                <div class="card" style="border-radius: 15px;height:480px">
                                    <div class="card-header bg-transparent text-right">
                                        <a href="/product-details/${product.product.prod_unique_name}">
                                            <img src="https://dashboardgrabmany.saitechnosolutions.co.in/images/${product.product.product_image}" class="card-img-top" alt="Prod Image"
                                                style="object-fit:contain;height:300px;">
                                        </a>
                                    </div>

                                    <div class="card-body">
                                        <h5 class="card-title text-center">
                                            <a href="/product-details/${product.product.prod_unique_name}">${product.product.product_name}</a>
                                        </h5>
                                        <div class="row">
                                            <div class="col-lg-12 text-center">`;

                        if (product.mrp_price === product.offer_price) {
                            prodHtml += `₹${product.mrp_price}`;
                        } else {
                            prodHtml += `<del>₹${product.mrp_price}</del> ₹${product.offer_price}`;
                        }

                        prodHtml += `</div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-lg-12">
                                                <button class="btn btnTheme btnShop p-2 text-white w-full" style="min-width:270px">
                                                    Add to Cart
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                    });
                } else {
                    prodHtml = `<div class="text-danger">No Available Products</div>`;
                }

                $("#product-container").html(prodHtml);
            },
        });
    });
});

$(document).ready(function () {
    $(document).on("change", ".category-radio", function () {
        let selectedCategory = $(this).val();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            url: "/product/categoryfilter",
            type: "POST",
            data: {
                selectedCategory: selectedCategory,
            },
            success: function (response) {
                $("#product-container").empty();
                let prodHtml = "";

                if (response.status == 200 && response.products.length > 0) {
                    $.each(response.products, function (index, product) {
                        console.log(product);
                        prodHtml += `
                            <div class="col-lg-4 col-12 col-sm-6 featureCol mb-7 produc"
                                data-cat="${product.categoryid}" 
                                data-price="${product.offer_price}" 
                                data-date="${product.created_at}">
                                
                                <div class="card" style="border-radius: 15px;height:480px">
                                    <div class="card-header bg-transparent text-right">
                                        <a href="/product-details/${product.product.prod_unique_name}">
                                            <img src="https://dashboardgrabmany.saitechnosolutions.co.in/images/${product.product.product_image}" class="card-img-top" alt="Prod Image"
                                                style="object-fit:contain;height:300px;">
                                        </a>
                                    </div>

                                    <div class="card-body">
                                        <h5 class="card-title text-center">
                                            <a href="/product-details/${product.product.prod_unique_name}">${product.product.product_name}</a>
                                        </h5>
                                        <div class="row">
                                            <div class="col-lg-12 text-center">`;

                        if (product.mrp_price === product.offer_price) {
                            prodHtml += `₹${product.mrp_price}`;
                        } else {
                            prodHtml += `<del>₹${product.mrp_price}</del> ₹${product.offer_price}`;
                        }

                        prodHtml += `</div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-lg-12">
                                                <button class="btn btnTheme btnShop p-2 text-white w-full" style="min-width:270px">
                                                    Add to Cart
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                    });
                } else {
                    prodHtml = `<div class="text-danger">No Available Products</div>`;
                }

                $("#product-container").html(prodHtml);
            },
        });
    });
});

$(document).ready(function () {
    $(document).on("change", "#product_sort_filter", function () {
        let sortvalue = $(this).val();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            url: "/product/sortfilter",
            type: "POST",
            data: {
                sortvalue: sortvalue,
            },
            success: function (response) {
                $("#product-container").empty();
                let prodHtml = "";

                if (response.status == 200 && response.products.length > 0) {
                    $.each(response.products, function (index, product) {
                        console.log(product);
                        prodHtml += `
                            <div class="col-lg-4 col-12 col-sm-6 featureCol mb-7 produc"
                                data-cat="${product.categoryid}" 
                                data-price="${product.offer_price}" 
                                data-date="${product.created_at}">
                                
                                <div class="card" style="border-radius: 15px;height:480px">
                                    <div class="card-header bg-transparent text-right">
                                        <a href="/product-details/${product.product.prod_unique_name}">
                                            <img src="https://dashboardgrabmany.saitechnosolutions.co.in/images/${product.product.product_image}" class="card-img-top" alt="Prod Image"
                                                style="object-fit:contain;height:300px;">
                                        </a>
                                    </div>

                                    <div class="card-body">
                                        <h5 class="card-title text-center">
                                            <a href="/product-details/${product.product.prod_unique_name}">${product.product.product_name}</a>
                                        </h5>
                                        <div class="row">
                                            <div class="col-lg-12 text-center">`;

                        if (product.mrp_price === product.offer_price) {
                            prodHtml += `₹${product.mrp_price}`;
                        } else {
                            prodHtml += `<del>₹${product.mrp_price}</del> ₹${product.offer_price}`;
                        }

                        prodHtml += `</div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-lg-12">
                                                <button class="btn btnTheme btnShop p-2 text-white w-full" style="min-width:270px">
                                                    Add to Cart
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                    });
                } else {
                    prodHtml = `<div class="text-danger">No Available Products</div>`;
                }

                $("#product-container").html(prodHtml);
            },
        });
    });
});

// *SIZE SELECT

$(document).ready(function () {
    $(document).on("click", ".prod_add_to_cart", function () {
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

                $(".prod_size_append_prod").html(sizeHtml);
                $("#prodCartModal_prod_id").val(prod_id);
                $("#prodCartModal").modal("show");
            },
            error: function () {
                alert("Something went wrong. Please try again.");
            },
        });
    });
});
