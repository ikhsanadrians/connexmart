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
$(document).ready(function () {
    isDesktop()
    checkCameraPermissionAndStart();
})

function isDesktop() {
    const md = new MobileDetect(navigator.userAgent)
    if (!md.mobile()) {
        $(".scanner").empty().append(`
        <div class="container w-full mx-auto flex justify-center pt-16">
            <div class="col flex flex-col items-center">
                <img src="../../images/static/tenizenmart.png" alt="" class="h-16">
                <h1 class="text-2xl text-center lg:text-3xl w-4/5 font-semibold mt-8">Waduh, sepertinya perangkat mu tidak support</h1>
                <p class="mt-2 text-lg lg:text-xl">Kembali ke <a href="{{ route('home') }}"
                        class="underline underline-offset-2 hover:text-2xl duration-200">Homepage</a></p>
            </div>
         </div>
          `)
    }

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
            if (response.data == "balance_not_enough") {
                $(".content-confirm").empty();
                $(".content-confirm").append(`
                 <div class="balance-ntenough mt-3">
                   <h1 class="text-xl font-semibold">Maaf, Saldo anda tidak mencukupi untuk melakukan transaksi ini</h1>
                   <p class="mt-1">Silahkan melakukan TopUp terlebih dahulu, di Bank Tenizen lantai 1</p>
                  </div>`
                )
            } else {
                $("#success-scan").removeClass("hidden-items").addClass("visible-items");
                $("#transaction-price").text(rupiah(response.data.total_price))
                $("#transaction-code").text(response.data.checkout_code)
                $("#transaction-timestamp").text(response.data.updated_at)
                $("#transaction-qty").text(response.data.total_quantity)
            }
        },
        error: function (error) {
            $("#success-scan").removeClass("hidden-items").addClass("visible-items");
            $("#transaction-code").text(error)
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
        statusCode: {
            401: function (response) {
                $(".content-confirm").empty();
                $(".content-confirm").append(`
                    <div class="balance-ntenough mt-3">
                        <h1 class="text-xl font-semibold">${response.responseJSON.message}</h1>
                        <p class="mt-1">Silahkan melakukan TopUp terlebih dahulu, di Bank Tenizen lantai 1</p>
                    </div>
                `);
                loadModalMessage("Saldo Tidak Mencukupi!");
            }
        },
        success: function (response) {
            $(".content-confirm").empty();
            $(".content-confirm").append(`
            <div class="balance-ntenough mt-3">
              <h1 class="text-xl font-semibold">Pembayaran Berhasil</h1>
              <p class="mt-1">Ceritanya Pembayaran Berhasil</p>
            </div>`)
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

function checkCameraPermissionAndStart() {
    // Cek izin kamera
    navigator.mediaDevices.getUserMedia({ video: true })
        .then(function () {
            // Jika izin diberikan, dapatkan daftar kamera
            Instascan.Camera.getCameras().then(function (cameras) {
                camerasAvailable = cameras;
                if (camerasAvailable.length > 0) {
                    // Jika ada kamera yang tersedia, mulai scanner dengan kamera yang dipilih
                    scanner.start(camerasAvailable[currentCameraPosition]);
                } else {
                    console.error('No cameras found.');
                    $("#log").text("Ga Ada Kamera");
                }
            }).catch(function (error) {
                // Tangani kesalahan saat mendapatkan daftar kamera
                $("#log").text(error);
                console.error('Error getting camera list:', error);
            });
        })
        .catch(function (err) {
            $("#log").text(err);
            // Jika izin kamera belum diberikan, minta izin kamera
            console.error('Error accessing camera:', err);
        });
}


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

