let debounceTimer;
let currentSearchValue;

$("#search-products").on("input", function (event) {
    const urlParams = new URLSearchParams(window.location.search);
    currentSearchValue = event.target.value;

    clearTimeout(debounceTimer);
    $(".loader").removeClass("!hidden")

    const searchListContainer = $(".search-list");

    if (event.target.value === '') {
        searchListContainer.empty();
    }

    debounceTimer = setTimeout(() => {
        $.ajax({
            url: '/search',
            method: "post",
            dataType: "json",
            data: {
                "searchValue": event.target.value,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                console.log(response)
                searchListContainer.empty();

                if (response.data == "empty") {
                    $(".loader").addClass("!hidden")
                    searchListContainer.append(`
                    <div
                    class="list px-2 py-3 mt-4 flex items-center gap-2 cursor-pointer rounded-md hover:bg-gray-200 text-gray-600">
                    <div class="search-value text-sm">
                        <p>Tidak Menemukan Produk</p>
                    </div>
                </div>
                    `)
                } else if (response.data == "search_input_null") {
                    searchListContainer.empty()
                } else {
                    $("#data-notfound").remove()
                    response.data.forEach((result) => {
                        searchListContainer.append(`
                        <a href="product/${result.slug}"
                        class="list p-2 mt-1 flex items-center gap-2 cursor-pointer rounded-md hover:bg-gray-200 text-gray-600">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                               class="bi bi-search" viewBox="0 0 16 16">
                                <path
                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                            </svg>
                        </div>
                        <div class="search-value text-sm">
                            <p>${result.name}</p>
                        </div>
                    </a>
                        `);
                        $(".loader").addClass("!hidden")
                    });
                }


            },
            error: function (error) {
                $(".loader").addClass("!hidden")

            }
        });
    }, 300);
});

$(".search-button").on("click", function (event) {
    searchProduct()
})

$("#search-products").on("keypress", function (event) {
     if(event.keyCode == 13){
        searchProduct()
     }
})

function searchProduct(){
    const url = `${window.location.href}/${currentSearchValue}`
    window.location.href = url
    $("#search-products").val(currentSearchValue)
}

//searchquery pages 

$(".filter-checkout").click(function(event) {
    const urlParams = new URLSearchParams(window.location.search);
    urlParams.set("sortby", event.target.name)
    window.location.search = urlParams.toString()
})

$(".filter-checkout").each((index,filter)=>{
    console.log(filter.name)
    // if(filter.name == )
})