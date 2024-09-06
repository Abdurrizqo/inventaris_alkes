import axios from "axios";

const id = document.getElementById('form-id').value;
const buttons = document.getElementsByTagName("button");
const loadingStat = document.getElementById("loading-stat");

document.getElementById('tombol-kembali').onclick = function () {
    toggleLoadingState(true);
    const url = `/barang-kembali/${id}`;

    axios.get(url)
        .then(response => {
            alert('Barang berhasil dikembalikan!');
            window.location.reload(true);
        })
        .catch(error => {
            toggleLoadingState(false);
            console.error('Error:', error);
            alert('Terjadi kesalahan saat mengembalikan barang.');
        });
};

document.getElementById('tombol-hilang').onclick = function () {
    toggleLoadingState(true);
    const url = `/barang-hilang/${id}`;

    axios.get(url)
        .then(response => {
            alert('Barang dinyatakan hilang!');
            window.location.reload(true);
        })
        .catch(error => {
            toggleLoadingState(false);
            console.error('Error:', error);
            alert('Terjadi kesalahan saat mengubah status barang hilang.');
        });
};

function toggleLoadingState(isLoading) {
    if (isLoading) {
        loadingStat.classList.add('flex');
        loadingStat.classList.remove('hidden');
    } else {
        loadingStat.classList.remove('flex');
        loadingStat.classList.add('hidden');
    }
    for (var i = 0; i < buttons.length; i++) {
        buttons[i].disabled = isLoading;
    }
}
