import rupiah from "./utils/rupiahFormater.js";

$("#recordsPerPage").on("change", function (e) {
    const urlParams = new URLSearchParams(window.location.search);
    urlParams.set('show', e.target.value);
    window.location.search = urlParams.toString();
})

$(".option").each((index, option) => {
    const showParameterValue = new URLSearchParams(window.location.search).get('show');
    if (showParameterValue == option.value) option.selected = true;
});



const updateClock = () => {
    const currentTime = moment().format('HH:mm');
    $("#clock-text").text(currentTime);
};

updateClock();

setInterval(updateClock, 60000);



$(".add").on('click', function (e) {
    const currentUrl = "/mart/cashier/addorder"
    const itemList = $(".item-list")
    const products = $(e.currentTarget).closest(".product-card")
    const productId = products.attr("id")
    const productName = products.find(".product-name").attr("data-name")
    const productPrice = products.find(".product-price").attr("data-price")

    itemList.append(`
        <div class="item flex items-center justify-between border-b-[1.8px] border-slate-200 border-dashed p-4">
            <div class="item-desc">
                <div class="desc-name font-medium">
                    <p>${productName}</p>
                </div>
                <div class="desc-price text-zinc-400">
                    ${rupiah(productPrice)}
                </div>
            </div>
            <div class="item-qtycontrol">
                <div class="input-quantity flex border-slate-300 border-[1.3px] w-fit px-2 py-1 rounded-md">
                    <button id="decrease">-</button>
                    <input type="number" value="1" class="input-of-quantity w-12 text-center focus:outline-none px-1" min="1" id="value_quantity" max="20">
                    <button id="increase">+</button>
                </div>
            </div>
        </div>
    `);

    itemList.scrollTop($(".item-list")[0].scrollHeight);

    $.ajax({
        url: currentUrl,
        method: "post",
        dataType: 'json',
        data: {
            "product_id": productId,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            console.log(data)
        },
        error: function () {
            return
        }
    },

    )
})
