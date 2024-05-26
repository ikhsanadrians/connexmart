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


$(".delete-btn-category").on("click", function () {
    event.preventDefault();
    showModalConfirm(true, "Apakah Kamu Yakin Ingin Menghapus Kategori Ini");
})


$(".next-confirm").on("click", function () {
    $(".delete-category").submit();
    showModalConfirm(false)
});


$(".decline-confirm").on("click", function () {
    showModalConfirm(false)
})



let debounceTimer;
$("#search_category").on("input", function (event) {
    const currentUrl = "goodscategory/search"
    clearTimeout(debounceTimer)

    const categoryContainer = $(".category");

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
                categoryContainer.empty()

                if (response.data == "empty") {
                    categoryContainer.append(`
                    <tr>
                       <td colspan="100%" style="padding: 10px;">Tidak Menemukan Produk!</td>
                    </tr>
                    `)
                } else {
                    $(".not-found-transactions").remove()
                    response.data.forEach((result) => {
                        console.log(result)
                        categoryContainer.append(`
                        <tr>
                        <td class="category-id" data-name="${result.name}" data-categoryid="${result.id}">
                            ${result.id}
                            </td>
                        <td class="category-thumbnail flex justify-center border-none">${result.name}</td>
                        <td class="category-totalproduct" data-description="{{ $category->desc }}">
                            ${result.products_count}
                        </td>
                        <td>
                            <div class="action-wrappers flex items-center gap-2 justify-center">
                                <button id="${result.id}" data-id="${result.name}"
                                    class="edit-goods-categoty-update-btn bg-gradient-to-r from-yellow-600 to-yellow-400 p-2 text-white rounded-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                        fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                        <path
                                            d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z" />
                                    </svg>
                                </button>
                                <a href="${`http://${window.location.host}/mart/goodscategorydelete/${result.id}`}" class="bg-gradient-to-r from-red-600 to-red-400 p-2 text-white rounded-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                            fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                        </svg>
                                </a>
                            </div>
                        </td>
                    </tr>

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
