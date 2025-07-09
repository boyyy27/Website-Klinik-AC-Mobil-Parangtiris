<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up - Parangtritis Klinik AC Mobil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/styles.css'); ?>" rel="stylesheet">
    <style>
        .input-group-text {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
        }
    </style>
    <script src="https://www.gstatic.com/firebasejs/9.19.1/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.19.1/firebase-auth-compat.js"></script>
    <script>
        // Firebase configuration
        const firebaseConfig = {
            apiKey: "AIzaSyBCo6eq1Tlf5yBOm9KZw_8p7BXPWPB5PKk",
            authDomain: "acmobil-454ce.firebaseapp.com",
            projectId: "acmobil-454ce",
            storageBucket: "acmobil-454ce.appspot.com",
            messagingSenderId: "124878329280",
            appId: "1:124878329280:web:4a08ed961d721aa7b1e425",
        };

        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);

        function isValidPhoneNumber(phoneNumber) {
            const phoneRegex = /^\d{9,13}$/; // 9 to 13 digits for the phone number part
            return phoneRegex.test(phoneNumber);
        }

        function formatPhoneNumber(phoneNumber) {
            return `+62${phoneNumber.replace(/\s+/g, '')}`;
        }

        async function checkPhoneNumber(phoneNumber) {
            const response = await fetch('<?php echo site_url('auth/check_phone_number'); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `phone_number=${phoneNumber}`
            });
            return response.json();
        }

        document.addEventListener('DOMContentLoaded', function() {
            const auth = firebase.auth();
            const recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
                size: 'invisible'
            });

            document.getElementById('send-code').onclick = async function () {
                let phoneNumber = document.getElementById('phone').value;
                if (!isValidPhoneNumber(phoneNumber)) {
                    alert('Nomor telepon tidak valid. Pastikan menggunakan 9 sampai 13 digit angka.');
                    return;
                }
                phoneNumber = formatPhoneNumber(phoneNumber);

                const checkResponse = await checkPhoneNumber(phoneNumber);
                if (checkResponse.status === 'error') {
                    alert(checkResponse.message);
                    return;
                }

                auth.signInWithPhoneNumber(phoneNumber, recaptchaVerifier)
                    .then((confirmationResult) => {
                        window.confirmationResult = confirmationResult;
                        alert('Kode verifikasi terkirim.');
                    }).catch((error) => {
                        console.error('SMS not sent', error);
                        alert('Pengiriman SMS gagal: ' + error.message);
                    });
            };

            document.getElementById('verify-code').onclick = function () {
                const code = document.getElementById('verification-code').value;
                window.confirmationResult.confirm(code).then((result) => {
                    document.getElementById('is-verified').value = 1;
                    alert('Nomor telepon terverifikasi.');
                }).catch((error) => {
                    console.error('Code verification failed', error);
                    alert('Verifikasi kode gagal: ' + error.message);
                });
            };

            document.getElementById('signup-form').onsubmit = function () {
                let phoneNumber = document.getElementById('phone').value;
                document.getElementById('phone').value = formatPhoneNumber(phoneNumber);
                return true;
            };
        });
    </script>
</head>
<body>
    <div class="header-text">
        PARANGTRITIS<br>
        KLINIK AC MOBIL
    </div>
    <div class="container">
        <h1>Sign up</h1>
        <p class="welcome-text">Selamat datang!</p>
        <p>Silakan daftarkan akun Anda di bawah ini.</p>
        <form id="signup-form" action="<?php echo site_url('auth/do_signup'); ?>" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="confirm-password" class="form-label">Konfirmasi Password</label>
                <input type="password" class="form-control" id="confirm-password" name="confirm-password" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Nomor Telepon</label>
                <div class="input-group">
                    <span class="input-group-text">+62</span>
                    <input type="text" class="form-control mb-0" id="phone" name="phone" placeholder="8123456789" required>
                </div>
            </div>
            <div id="recaptcha-container"></div>
            <div class="mb-3 verification-group">
                <input type="text" class="form-control" id="verification-code" name="verification-code" placeholder="Kode verifikasi" required>
                <button type="button" class="btn btn-secondary mb-3" id="send-code">Kirim Kode</button>
                <button type="button" class="btn btn-secondary mb-3" id="verify-code">Verifikasi Kode</button>
            </div>
            <input type="hidden" id="role" name="role" value="user">
            <input type="hidden" id="is-verified" name="is-verified" value="0">
            <button type="submit" class="btn btn-primary w-100">Sign up</button>
        </form>
        <div class="login-text">
            Sudah punya akun? <a href="<?php echo base_url('welcome/login'); ?>">Login</a>
        </div>
    </div>

    
</body>
</html>
