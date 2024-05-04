let currentCameraPosition = 1;
let scanner = new Instascan.Scanner({ video: document.getElementById('preview'), mirror: false });
let camerasAvailable = [];

scanner.addListener('scan', function (content, image) {
    $("#success-scan").removeClass("hidden-items").addClass("visible-items");
    $(".scanner-text").text(content);
});

Instascan.Camera.getCameras().then(function (cameras) {
    camerasAvailable = cameras;
    if (camerasAvailable.length > 0) {
        scanner.start(camerasAvailable[currentCameraPosition]);
    } else {
        console.error('No cameras found.');
    }
}).catch(function (e) {
    console.error(e);
});

function changeCameraPosition(position) {
    currentCameraPosition = position;
    scanner.stop().then(function () {
        if (camerasAvailable.length > 0) {
            scanner.start(camerasAvailable[currentCameraPosition]);
        }
    }).catch(function (e) {
        console.error('Error switching cameras:', e);
    });
}

$(".camera-option").on("click", function () {
    let newPosition = currentCameraPosition === 1 ? 0 : 1;
    changeCameraPosition(newPosition);
});

