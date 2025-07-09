<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign In - Parangtritis Klinik AC Mobil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/styles.css'); ?>" rel="stylesheet">

    <script type="module">
    import { initializeApp } from "https://www.gstatic.com/firebasejs/9.4.0/firebase-app.js";
    import { getAuth, GoogleAuthProvider, signInWithPopup } from "https://www.gstatic.com/firebasejs/9.4.0/firebase-auth.js";

    const firebaseConfig = {
        apiKey: "AIzaSyBCo6eq1Tlf5yBOm9KZw_8p7BXPWPB5PKk",
        authDomain: "acmobil-454ce.firebaseapp.com",
        projectId: "acmobil-454ce",
        storageBucket: "acmobil-454ce.appspot.com",
        messagingSenderId: "124878329280",
        appId: "1:124878329280:web:4a08ed961d721aa7b1e425",
        measurementId: "G-GXH9ZV5R9L"
    };

    const app = initializeApp(firebaseConfig);
    const auth = getAuth(app);
    const provider = new GoogleAuthProvider();

    function signInWithGoogle() {
        signInWithPopup(auth, provider)
            .then((result) => {
                const user = result.user;

                // Send Google user data to the server
                fetch("<?php echo site_url('auth/google_login'); ?>", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        googleUser: {
                            id: user.uid,
                            email: user.email,
                            displayName: user.displayName
                        }
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.href = "<?php echo base_url('welcome'); ?>";
                    } else {
                        console.error("Google login failed: ", data.message);
                    }
                })
                .catch(error => {
                    console.error("Error during Google login: ", error);
                });
            })
            .catch((error) => {
                console.error("Error during sign in: ", error);
            });
    }

    window.addEventListener('DOMContentLoaded', (event) => {
        document.getElementById('google-btn').addEventListener('click', signInWithGoogle);
    });
</script>


</head>

<body>
    <div class="header-text">
       <a href="<?php echo base_url('welcome');?>"> PARANGTRITIS<br>
        KLINIK AC MOBIL
        </a>
    </div>
    <div class="container">
        <h1>Sign in</h1>
        <p class="welcome-text">Selamat datang!</p>
        <p>Silakan masukkan akun Anda di bawah ini.</p>

        <?php if ($this->session->flashdata('error')) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php } ?>

        <form action="<?php echo site_url('auth/do_login'); ?>" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3 form-group">
                <label for="password" class="form-label">Password</label>
                <a href="#" class="forgot-password no-underline">Lupa password?</a>
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3 text-start">
                <small>Belum Punya Akun? Silahkan <a href="<?php echo base_url('auth/signup'); ?>">daftar disini</a>.</small>
            </div>
            <button type="submit" class="btn btn-primary w-100">Sign in</button>
        </form>
        <div class="text-center my-3">Atau</div>
        <a href="#" class="google-btn" id="google-btn">
            <img src="<?php echo base_url('assets/img/google-logo.png'); ?>" alt="Google logo" width="20"> Sign in with Google
        </a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>