import axios from "axios";

document.addEventListener('DOMContentLoaded', function () {
    const buttonPinjam = document.getElementById('button_pinjam');
    const buttonLoading = document.getElementById('button_loading');
    const form = document.getElementById('form_pinjam');
    const usernameInput = document.getElementById('username_pegawai');
    const passwordInput = document.getElementById('password_pegawai');
    const idBarang = document.getElementById('id_barang');
    const waInput = document.getElementById('tel_pegawai');
    const csrfToken = document.querySelector('input[name="_token"]').value;

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        toggleLoadingState(true);

        // Menghapus pesan error sebelumnya
        clearErrors();

        let isValid = validateForm();

        if (isValid) {
            const sendData = {
                'username':usernameInput.value,
                'password':passwordInput.value,
                'no_wa':waInput.value,
                'barang':idBarang.value,
            }

            axios.post('/pinjam-barang', sendData, {
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then(response => {
                    alert('Peminjaman Barang Berhasil');
                    window.location.reload(true);
                })
                .catch(error => {
                    toggleLoadingState(false);

                    if (error.response && error.response.status === 401) {
                        alert('Username Atau Password Salah');
                    } else {
                        alert('Terjadi kesalahan saat meminjam barang.');
                    }
                });
        } else {
            toggleLoadingState(false);
        }
    });

    function toggleLoadingState(isLoading) {
        if (isLoading) {
            buttonPinjam.classList.add('hidden');
            buttonPinjam.classList.remove('inline-flex');
            buttonLoading.classList.add('inline-flex');
            buttonLoading.classList.remove('hidden');
        } else {
            buttonPinjam.classList.add('inline-flex');
            buttonPinjam.classList.remove('hidden');
            buttonLoading.classList.add('hidden');
            buttonLoading.classList.remove('inline-flex');
        }

        const inputs = document.getElementsByTagName("input");
        for (var i = 0; i < inputs.length; i++) {
            inputs[i].disabled = isLoading;
        }
    }

    function validateForm() {
        let isValid = true;

        // Validasi username tidak boleh kosong
        if (usernameInput.value.trim() === '') {
            showError(usernameInput, 'Username tidak boleh kosong.');
            isValid = false;
        }

        // Validasi password tidak boleh kosong
        if (passwordInput.value.trim() === '') {
            showError(passwordInput, 'Password tidak boleh kosong.');
            isValid = false;
        }

        // Validasi nomor WA tidak boleh kosong dan harus valid
        const waPattern = /^(\+62|62|0)8[1-9][0-9]{6,9}$/;
        if (waInput.value.trim() === '') {
            showError(waInput, 'Nomer WA tidak boleh kosong.');
            isValid = false;
        } else if (!waPattern.test(waInput.value.trim())) {
            showError(waInput, 'Nomer WA tidak valid.');
            isValid = false;
        }

        return isValid;
    }

    function showError(input, message) {
        const errorDiv = document.createElement('div');
        errorDiv.className = 'text-red-500 text-sm mt-2';
        errorDiv.innerText = message;
        input.classList.add('border-red-500');
        input.parentNode.appendChild(errorDiv);
    }

    function clearErrors() {
        const errors = document.querySelectorAll('.text-red-500');
        errors.forEach(error => error.remove());
        const inputs = document.querySelectorAll('input');
        inputs.forEach(input => input.classList.remove('border-red-500'));
    }
});
