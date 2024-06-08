function checkUrlFilter(currentUrlParamater) {
    const urlParams = new URLSearchParams(window.location.search)
    currentUrlParamater == "all" ? urlParams.delete("status") : urlParams.set("status", currentUrlParamater)

    window.location.search = urlParams.toString()
}


$(".tfilter").on("click", function (event) {
    checkUrlFilter(event.target.id)
    $(event.target).addClass("filter-t-click")
})



$(".tfilter").each((index, filter) => {
    const filterParamsValue = new URLSearchParams(window.location.search).get("status") || "all"
    if (filterParamsValue === filter.id) {
        $(filter).addClass("filter-t-click")
    } else {
        $(filter).removeClass("filter-t-click")
    }
})
