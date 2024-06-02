const rupiah = (number) => {
    return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR"
    }).format(number).replace(/,00$/, '');
}

$(".recordsPerPage").on("change", function (event) {
    const urlParams = new URLSearchParams(window.location.search);
    urlParams.set('show', event.target.value);
    if (event.target.value === 'all') {
        urlParams.delete('page');
    }
    window.location.search = urlParams.toString();
})

$(".option").each((index, option) => {
    const showParameterValue = new URLSearchParams(window.location.search).get('show');
    if (showParameterValue == option.value) option.selected = true;
});

$(".select-category").on("change", function (event) {
    const urlParams = new URLSearchParams(window.location.search);
    urlParams.set('category', event.target.value);
    if (event.target.value === 'all') {
        urlParams.delete('category');
    }
    window.location.search = urlParams.toString();
})


$(".option-status").each((index, option) => {
    const showParameterValue = new URLSearchParams(window.location.search).get('category');
    if (showParameterValue == option.value) option.selected = true;
});


$(".select-transactions-sorting").on("change", function (event) {
    const urlParams = new URLSearchParams(window.location.search);
    urlParams.set('sort', event.target.value);
    if (event.target.value === 'newfirst') {
        urlParams.delete('sort');
    }
    window.location.search = urlParams.toString();
})

$(".option-sorting").each((index, option) => {
    const showParameterValue = new URLSearchParams(window.location.search).get('sort');
    if (showParameterValue == option.value) option.selected = true;
});


function showModalConfirm(visible, message) {
    if (visible) {
        $(".confirm-modal").removeClass("hidden");
        $(".backdrop").removeClass("hidden");
        $("#confirm-modal-message").text(message);
    } else {
        $(".confirm-modal").addClass("hidden");
        $(".backdrop").addClass("hidden");
        $("#confirm-modal-message").text("");
    }
}


$(".delete-btn-goods").on("click", function () {
    event.preventDefault();
    showModalConfirm(true, "Apakah Kamu Yakin Ingin Menghapus Produk Ini");
})


$(".next-confirm").on("click", function (event) {
    event.preventDefault();
    showModalConfirm(false)
    $(".delete-product").submit();
});

$(".delete-product").on("submit", function (event) {
    event.preventDefault();
    var form = this; // Store the form reference

    // Close the modal
    showModalConfirm(false, function() {
        // Submit the form after the modal is closed
        form.submit();
    });
});


$(".decline-confirm").on("click", function () {
    showModalConfirm(false)
})



let debounceTimer;
$("#search_products").on("input", function (event) {
    const currentUrl = "product/search"
    clearTimeout(debounceTimer)

    const productsContainer = $(".product-container");

    if (event.target.value.trim() === "") {
        window.location.reload();
        return;
    }

    debounceTimer = setTimeout(() => {
        $.ajax({
            url: currentUrl,
            method: "post",
            dataType: 'json',
            data: {
                "searchValue": event.target.value,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                productsContainer.empty()

                if (response.data == "empty") {
                    productsContainer.append(`
                    <tr>
                       <td colspan="100%" style="padding: 10px;">Tidak Menemukan Produk!</td>
                    </tr>
                    `)
                } else {
                    $(".not-found-transactions").remove()
                    response.data.forEach((result) => {
                        productsContainer.append(`
                        <tr>
                        <td class="product-id" data-productid="{{ $product->id }}">
                            ${result.id}
                        </td>
                        <td class="product-thumbnail flex justify-center border-none"
                            data-thumbnail="{{ $product->photo }}">
                            <div class="thumbnail overflow-hidden h-12 w-16">
                              <img class="w-full h-full object-cover" src="${result.photo ? `http://${window.location.host}/${result.photo}` : `http://${window.location.host}/images/default/mart.png`}" alt="">
                            </div>
                        </td >
                        <td class="product-td">${result.name}</td>
                        <td class="price-td">${rupiah(result.price)}</td>
                        <td class="product-stock">${result.stock}</td>
                        <td class="product-category">${result.category.name}</td>
                        <td>
                            <div class="action-wrappers flex items-center gap-2 justify-center">
                                <a href="${`http://${window.location.host}/mart/product/${result.slug}`}"
                                    class="bg-gradient-to-r from-green-600 to-green-400 p-2 text-white rounded-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                        fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                        <path
                                            d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr >

                            `)

                    });
                }

            },
            error: function (error) {
                return
            }
        });
    }, 300)

})
