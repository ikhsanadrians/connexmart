
$(document).ready(function () {
    $('.select-product-to-add-stock').select2();

});

$('.select-product-to-add-stock').on('change', function (event) {
    let selectedOption = $(this).find('option:selected').val();

    $.ajax({
        url: `/mart/penerimaan-stok/${selectedOption}/show`,
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
        },
        error: function (error) {
            return
        }
    });
});

let productToStok = [];

let isStockReset = false;
$("#switch-btn").on("change", function () {
    isStockReset = $(this).is(':checked');
    $("#description-stok-text").text(isStockReset ? "Jumlah Stok Baru" : "Jumlah Stok Tambahan");
    $("#stok-inputnew").attr("placeholder", isStockReset ? "Masukan Stok Baru" : "Masukan Stok Tambahan");
});


