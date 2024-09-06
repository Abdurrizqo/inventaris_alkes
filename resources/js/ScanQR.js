import { Html5QrcodeScanner } from "html5-qrcode";

function docReady(fn) {
    // see if DOM is already available
    if (document.readyState === "complete" || document.readyState === "interactive") {
        // call on next available tick
        setTimeout(fn, 1);
    } else {
        document.addEventListener("DOMContentLoaded", fn);
    }
}

docReady(function () {
    var html5QrcodeScanner = new Html5QrcodeScanner(
        "qr-reader", { fps: 10, qrbox: 300 });

    function onScanSuccess(decodedText) {
        const linkResult = document.getElementById('link-result');
        const containerResult = document.getElementById('container-result');

        containerResult.classList.remove('hidden');
        containerResult.classList.add('flex');
        linkResult.href = `/data-alkes/${decodedText}`;
    }


    function onScanError(qrCodeError) {
    }

    html5QrcodeScanner.render(onScanSuccess, onScanError);
});