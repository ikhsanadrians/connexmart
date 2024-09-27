
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
            console.log(response);
            $('.stok-list-container').html(`
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
        },
        error: function (error) {
            return
        }
    });
});
