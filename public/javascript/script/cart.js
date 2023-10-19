const quantities = document.querySelectorAll('.quantities')
const price = document.querySelectorAll('.price-products')
let currentInputElement = "";

// Fungsi untuk menghitung jumlah semua nilai input
function calculateTotal() {
    let quantityAll = 0;
    quantities.forEach(element => {
        quantityAll += parseInt(element.value);
    });
    return quantityAll;
}

function multiplyAll(){  
    let quantityAll = 0;
    quantities.forEach()

}

quantities.forEach(element => {
    element.addEventListener('change', function(e) {
        currentInputElement = e.target.id;

        // Memperbarui tampilan quantityAll
        const quantityAll = calculateTotal();
        $('#product_count').text(quantityAll);

        console.log(quantityAll);
    });
});
