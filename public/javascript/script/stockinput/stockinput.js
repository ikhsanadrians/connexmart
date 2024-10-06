
$(document).ready(function () {
    $('.select-product-to-add-stock').select2();

});



function fetchDetailStock(params) {
    $.ajax({
        url: `/mart/penerimaan-stok/${params}/show`,
        method: "GET",
        dataType: 'json',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            $('.stok-list-container').html(`
                <p class="mb-2 font-medium">Stok Saat Ini : <span class="text-slate-600 font-normal">${response.data.product.name}</span></p>
                <table class="w-full !shadow-none">
                    <thead>
                        <tr class="text-sm">
                            <th>Stok ID</th>
                            <th>Keterangan</th>
                            <th>Stok Awal</th>
                            <th>QTY IN</th>
                            <th>QTY OUT</th>
                            <th>Stok Akhir</th>
                        </tr>
                    </thead>
                    <tbody class="product-container">
                       <tr>
                         <td>${response.data.id}</td>
                         <td>${response.data.keterangan}</td>
                         <td>${response.data.stokawal}</td>
                         <td>${response.data.qtyin}</td>
                         <td>${response.data.qtyout}</td>
                         <td>${response.data.stok_akhir}</td>
                       </tr>
                    </tbody>
                </table>`)
            $('.reset-stok-switch').removeClass('hidden').addClass('flex')
            product_id = response.data.product.id
        },
        error: function (error) {
            return
        }
    });
}



$('.select-product-to-add-stock').on('change', function (event) {
    let selectedOption = $(this).find('option:selected').val();
    fetchDetailStock(selectedOption);
});

let productToStok = [];

let isStockReset = false;
let product_id;
let stockquantity;
// Menentukan apakah stok baru atau tambahan berdasarkan tombol switch
$("#switch-btn").on("change", function () {
    isStockReset = $(this).is(':checked');
    $("#description-stok-text").text(isStockReset ? "Jumlah Stok Baru" : "Jumlah Stok Tambahan");
    $("#stok-inputnew").attr("placeholder", isStockReset ? "Masukan Stok Baru" : "Masukan Stok Tambahan");
});

// Menangkap jumlah stok yang diinputkan
$("#stok-inputnew").on("change", function () {
    stockquantity = $(this).val();
});

// Ketika tombol tambah stok diklik
$("#add_stok").on("click", function () {
    // Validasi input
    if (!stockquantity) {
        alert("Masukkan jumlah stok terlebih dahulu.");
        return;
    }

    // Tentukan tipe stok, apakah 'new' atau 'additional'
    let typeOfStock = isStockReset ? "new" : "additional";

    // Kirim data melalui AJAX
    $.ajax({
        url: `/mart/penerimaan-stok/create`,
        method: "POST",
        dataType: 'json',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            productId: product_id,
            quantityIn: stockquantity,
            typeOfStock: typeOfStock
        },
        success: function (response) {
            if (response.message === "success, get data!") {
                alert("Stok berhasil diperbarui!");
                fetchDetailStock(response.data.product_id)
            } else {
                alert("Gagal memperbarui stok.");
            }
        },
        error: function (xhr, status, error) {
            console.error(error);
        }
    });
});




