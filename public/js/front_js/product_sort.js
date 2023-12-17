$(document).ready(function () {
    $("#sort").on("change", function () {
        var sort = $(this).val();
        let fabric = filters("fabric");
        let fit = filters("fit");
        let occassion = filters("occassion");
        let sleeve = filters("sleeve");
        let pattern = filters("pattern");
        var url = $("#url").val();
        $.ajax({
            url: url,
            method: "post",
            data: {
                fabric: fabric,
                fit: fit,
                occassion: occassion,
                sleeve: sleeve,
                pattern: pattern,
                sort: sort,
                url: url,
            },
            success: function (data) {
                $(".ajax-product-listing").html(data);
            },
        });
    });

    $(".filter").on("click", function () {
        let fabric = filters("fabric");
        let fit = filters("fit");
        let occassion = filters("occassion");
        let sleeve = filters("sleeve");
        let pattern = filters("pattern");
        var sort = $("#sort option:selected").text();
        var url = $("#url").val();
        $.ajax({
            url: url,
            method: "post",
            data: {
                fabric: fabric,
                fit: fit,
                occassion: occassion,
                sleeve: sleeve,
                pattern: pattern,
                sort: sort,
                url: url,
            },
            success: function (data) {
                $(".ajax-product-listing").html(data);
            },
        });
    });

    function filters(class_name) {
        let filters = [];
        $("." + class_name + ":checked").each(function () {
            filters.push($(this).val());
        });
        return filters;
    }

    $("#getPrice").change(function () {
        size = $(this).val();
        if (size == "") {
            alert("Please select the size");
        }
        pId = $(this).attr("product-id");
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            url: "/get-product-price",
            type: "post",
            data: { productId: pId, size: size },
            success: function (data) {
                $(".getAttriPrice").html("Rs. " + data);
            },
            error: function () {
                alert("Error");
            },
        });
    });
});
