document.addEventListener('DOMContentLoaded', function () {
    // Inicializa o QuaggaJS para ler o código de barras
    Quagga.init({
        inputStream: {
            name: "Live",
            type: "LiveStream",
            target: document.querySelector('#scanner'),
            constraints: {
                facingMode: "environment"
            }
        },
        decoder: {
            readers: ["code_128_reader", "ean_reader", "ean_8_reader"]
        }
    }, function(err) {
        if (err) {
            console.log(err);
            return;
        }
        Quagga.start();
    });

    Quagga.onDetected(function(data) {
        const barcode = data.codeResult.code;
        fetchProductInfo(barcode);
    });

    function fetchProductInfo(barcode) {
        fetch(`getProduct.php?barcode=${barcode}`)
            .then(response => response.json())
            .then(data => {
                const productInfoElement = document.getElementById('product-info');
                productInfoElement.textContent = data.name ? data.name : 'Produto não encontrado';
            })
            .catch(error => {
                console.error('Erro ao buscar informações do produto:', error);
            });
    }
});