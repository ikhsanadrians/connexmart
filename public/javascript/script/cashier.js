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
