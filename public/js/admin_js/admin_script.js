$(document).ready(function () {
    $("#current_pwd").keyup(function () {
        let pwd = $("#current_pwd").val();
        if (pwd.length > 7) {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });
            $.ajax({
                type: "post",
                url: "/admin/currentpwd",
                data: { currentpwd: pwd },
                success: function (data) {
                    if (data == "true") {
                        $("#current_pwd_check").html(
                            "<font color='green'>Your current password is correct</font>"
                        );
                    } else {
                        $("#current_pwd_check").html(
                            "<font color='red'>Your current password is incorrect</font>"
                        );
                    }
                },
                error: function (e) {
                    console.log(e);
                },
            });
        }
    });

    //$(".update-status").click(function () {
    $(document).on("click", ".update-status", function () {
        let text = $(this).children("i").attr("status");
        let id = $(this).attr("sectionid");

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            type: "post",
            url: "/admin/update-status",
            data: { status: text, id: id },
            success: function (data) {
                if (data.status == 1) {
                    $("#section-" + id).html(
                        '<i class="fa fa-toggle-on" status="Active" aria-hidden="true"></i>'
                    );
                } else {
                    $("#section-" + id).html(
                        '<i class="fa fa-toggle-off" status="Inactive" aria-hidden="true"></i>'
                    );
                }
            },
            error: function (e) {
                console.log(e);
            },
        });
    });

    //$(".update-category-status").click(function () {
    $(document).on("click", ".update-category-status", function () {
        let text = $(this).children("i").attr("status");
        let id = $(this).attr("categoryid");

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            type: "post",
            url: "/admin/update-category-status",
            data: { status: text, id: id },
            success: function (data) {
                if (data.status == 1) {
                    $("#category-" + id).html(
                        '<i class="fa fa-toggle-on" status="Active" aria-hidden="true"></i>'
                    );
                } else {
                    $("#category-" + id).html(
                        '<i class="fa fa-toggle-off" status="Inactive" aria-hidden="true"></i>'
                    );
                }
            },
            error: function (e) {
                console.log(e);
            },
        });
    });

    $("#section_id").change(function () {
        let id = $(this).val();
        if (id) {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });

            $.ajax({
                type: "post",
                url: "/admin/append-categories-level",
                data: { id: id },
                success: function (data) {
                    $("#append_categories_level").html(data);
                },
                error: function (e) {
                    console.log(e);
                },
            });
        }
    });

    //$(".update-product-status").click(function () {
    $(document).on("click", ".update-product-status", function () {
        let text = $(this).children("i").attr("status");
        let id = $(this).attr("productid");

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            type: "post",
            url: "/admin/update-product-status",
            data: { status: text, id: id },
            success: function (data) {
                if (data.status == 1) {
                    $("#product-" + id).html(
                        '<i class="fa fa-toggle-on" status="Active" aria-hidden="true"></i>'
                    );
                } else {
                    $("#product-" + id).html(
                        '<i class="fa fa-toggle-off" status="Inactive" aria-hidden="true"></i>'
                    );
                }
            },
            error: function (e) {
                console.log(e);
            },
        });
    });

    // $(".update-product-image-status").click(function () {
    $(document).on("click", ".update-product-image-status", function () {
        let text = $(this).text();
        let id = $(this).attr("imageid");

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            type: "post",
            url: "/admin/update-product-image-status",
            data: { status: text, id: id },
            success: function (data) {
                if (data.status == 1) {
                    $("#image-" + id).html("Active");
                } else {
                    $("#image-" + id).html("Inactive");
                }
            },
            error: function (e) {
                console.log(e);
            },
        });
    });

    $(document).on("click", ".update-brand-status", function () {
        //$(".update-brand-status").click(function () {
        let text = $(this).children("i").attr("status");
        let id = $(this).attr("brandid");

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            type: "post",
            url: "/admin/update-brand-status",
            data: { status: text, id: id },
            success: function (data) {
                if (data.status == 1) {
                    $("#brand-" + id).html(
                        '<i class="fa fa-toggle-on" status="Active" aria-hidden="true"></i>'
                    );
                } else {
                    $("#brand-" + id).html(
                        '<i class="fa fa-toggle-off" status="Inactive" aria-hidden="true"></i>'
                    );
                }
            },
            error: function (e) {
                console.log(e);
            },
        });
    });

    $(document).on("click", ".confirmDelete", function () {
        let name = $(this).attr("name");
        let record = $(this).attr("record");
        let id = $(this).attr("recordid");

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "/admin/delete-" + record + "/" + id;
            }
        });
    });

    //  $(".confirmDelete").click(function () {
    //     let name = $(this).attr("name");
    //     if (confirm("Are you sure? You want to delete " + name + " ?")) {
    //         return true;
    //     }
    //     return false;
    // });

    // code to add dynamic field

    var maxField = 10; //Input fields increment limitation
    var addButton = $(".add_button"); //Add button selector
    var wrapper = $(".field_wrapper"); //Input field wrapper
    var fieldHTML =
        '<div style="margin-top:10px;" ><input type="text" style="width:110px" name="size[]" placeholder="Size"/>&nbsp;<input type="text" style="width:110px" name="sku[]" placeholder="SKU"/>&nbsp;<input type="text" style="width:110px" name="stock[]" placeholder="Stock"/>&nbsp;<input type="text" style="width:110px" name="price[]" placeholder="Price"/>&nbsp;<a href="javascript:void(0);" class="remove_button">remove</a></div>'; //New input field html
    var x = 1; //Initial field counter is 1

    //Once add button is clicked
    $(addButton).click(function () {
        //Check maximum number of input fields
        if (x < maxField) {
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });

    //Once remove button is clicked
    $(wrapper).on("click", ".remove_button", function (e) {
        e.preventDefault();
        $(this).parent("div").remove(); //Remove field html
        x--; //Decrement field counter
    });

    //$(".update-attribute-status").click(function () {
    $(document).on("click", ".update-attribute-status", function () {
        let text = $(this).text();
        let id = $(this).attr("attributeid");

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            type: "post",
            url: "/admin/update-attribute-status",
            data: { status: text, id: id },
            success: function (data) {
                console.log(data);
                if (data.status == 1) {
                    $("#attribute-" + id).html("Active");
                } else {
                    $("#attribute-" + id).html("Inactive");
                }
            },
            error: function (e) {
                console.log(e);
            },
        });
    });
});

$(document).on("click", ".update-banner-status", function () {
    //$(".update-brand-status").click(function () {
    let text = $(this).children("i").attr("status");
    let id = $(this).attr("bannerid");

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        type: "post",
        url: "/admin/update-banner-status",
        data: { status: text, id: id },
        success: function (data) {
            if (data.status == 1) {
                $("#banner-" + id).html(
                    '<i class="fa fa-toggle-on" status="Active" aria-hidden="true"></i>'
                );
            } else {
                $("#banner-" + id).html(
                    '<i class="fa fa-toggle-off" status="Inactive" aria-hidden="true"></i>'
                );
            }
        },
        error: function (e) {
            console.log(e);
        },
    });
});
