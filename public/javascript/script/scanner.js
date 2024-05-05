let currentCameraPosition = 1;
let scanner = new Instascan.Scanner({ video: document.getElementById('preview'), mirror: false });
let camerasAvailable = [];
let checkoutCode = "";


const rupiah = (number) => {
    return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR"
    }).format(number).replace(/,00$/, '');
}


function scannerGetValue(content) {
    const currentUrl = '/scan/send'
    $.ajax({
        url: currentUrl,
        method: 'post',
        dataType: 'json',
        data: {
            "checkout_code": content,
            _token: $('meta[name="csrf-token"]').attr('content'),
        },
        success: function (response) {
            $("#success-scan").removeClass("hidden-items").addClass("visible-items");
            $("#transaction-price").text(rupiah(response.data.total_price))
            $("#transaction-code").text(response.data.checkout_code)
            $("#transaction-timestamp").text(response.data.updated_at)
            $("#transaction")
        },
        error: function (error) {
            return
        }
    });
}


function scannerConfirm() {
    const currentUrl = '/scan/confirm'
    $.ajax({
        url: currentUrl,
        method: 'put',
        dataType: 'json',
        data: {
            "checkout_code": checkoutCode,
            _token: $('meta[name="csrf-token"]').attr('content'),
        },
        success: function (response) {
            alert("Berhasil Bosku")
        },
        error: function (error) {
            return
        }
    });
}

scanner.addListener('scan', function (content, image) {
    scannerGetValue(content)
    checkoutCode = content
});

$(".scanner-confirm-button").on("click", function () {
    scannerConfirm()
})

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

