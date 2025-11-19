// document.getElementById("btnSearch").onclick = function () {
//     let search = document.getElementsByName("search-product")[0].value;
//     window.location.href = "?search="+search;
// }

$(function () {
// $(document).ready(function () {
    $("#btnSearch").click(function () {
        let search = $("input[name=search-product]").val();
        window.location.href = "?search="+search;
    });

    $("#btnUpdateCart").click(function () {
        let updatedCartData = [];
        $(".table-row").each(function (index, element) {
            let obj = {
                MASP: $(element).find("input[type=hidden]").val(),
                QTY: $(element).find(".num-product").val()
            };
            updatedCartData.push(obj);
        });

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr("content")
            },
            type: "POST",
            url: BASE_URL+"/cart/update",
            data: {
                // "updated_cart": [
                //     {
                //         "MASP":"FSP00001",
                //         "QTY":1
                //     },
                //     {
                //         "MASP":"FSP00002",
                //         "QTY":0
                //     }
                // ],
                updated_cart: JSON.stringify(updatedCartData)
            },
            // contentType: "json",
            success: function (result) {
                console.log(result);
                window.location.reload();
            },
            error: function () {

            }
        });
    });

    $("#btnUpdateTotals").click(function () {
        var transport_method = $("select[name=transport_method]").val();
        if(transport_method == "ghn") var fee = 50000;
        else if(transport_method == "ghtc") var fee = 20000;
        $("#pUpdateTotals").html("Phí vận chuyển: "+fee.toLocaleString()+"&#8363;");

        var sub_total = $("#spnSubTotal").html().replace("/[^0-9+]/g", ""+fee);

        $("#spnTotal").html(sub_total);
    });
});

