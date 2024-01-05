<head>
    <meta charset="utf-8">
    <title>DreamHome - Real Estate HTML Template</title>

    <meta name="author" content="themesflat.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href=<?= ASSET_URL . "public/app/dist/font-awesome.css" ?>>

    <link rel="stylesheet" href=<?= ASSET_URL . "public/app/dist/app.css" ?>>
    <link rel="stylesheet" href=<?= ASSET_URL . "public/app/dist/responsive.css" ?>>
    <link rel="stylesheet" href=<?= ASSET_URL . "public/app/dist/owl.css" ?>>

    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href=<?= ASSET_URL . "public/assets/images/logo/Favicon.png" ?>>
    <link rel="apple-touch-icon-precomposed" href=<?= ASSET_URL . "public/assets/images/logo/Favicon.png" ?>>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

</head>
<style>
    .flex-none img {
        margin-top: 80px;
    }

    .wrap-modal {
        width: 50%;
        margin-left: 15rem;
    }

    .text-center {
        margin-right: 7.5rem;
        margin-top: 7px;

    }
</style>

<body class="body">

    <div id="wrapper">
        <div class="container" style="margin-top: 2rem">
            <div class="space-y-20 pd-40">
                <div class="wrap-modal flex">
                    <div class="images flex-none">
                        <img src="https://www.savithru.com/assets/images/logo.png" alt="images">
                    </div>
                    <div class="content" style="margin-left: 10px">
                        <div class="title-login fs-30 fw-7 lh-45"><u>Login</u></div>
                        <div class="comments">
                            <div class="respond-comment">
                                <form id="formId" class="comment-form form-submit"  accept-charset="utf-8">
                                    <fieldset class="">
                                        <label class="fw-6">Account</label>
                                        <input type="email" id="email" class="tb-my-input" name="email"
                                            placeholder="Email or user name">
                                        <img class="img-icon img-email" src="assets/images/icon/icon-gmail.svg"
                                            alt="images">
                                            <div class="invalid-feedback" class="text-danger" id="email_msg"></div>
                                    </fieldset>
                                    <fieldset class="style-wrap">
                                        <label class="fw-6">Password</label>
                                        <input type="password" id="password" name="password" class="input-form password-input"
                                            placeholder="Your password">
                                        <img class="img-icon" src="assets/images/icon/icon-password.svg" alt="images">
                                        <div class="invalid-feedback" class="text-danger" id="password_msg"></div>
                                    </fieldset>
                                    <button class="sc-button" id="submit" name="submit" type="submit">
                                        Login
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="text-box text-center fs-13">Don’t you have an account? <a
                                class="font-2 fw-7 fs-13 color-popup text-color-3" href="<?= base_url('register') ?>"
                                aria-label="Close">Register</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#submit').click(function (event) {
                event.preventDefault(); // Prevents the default form submission behavior
                console.log('clicked');
                let formData = $('#formId').serialize();
                // console.log(formData)
                $.ajax({
                    method: "POST",
                    url: "<?= base_url('login') ?>",
                    data: formData,
                    dataType: "json",
                    success: function (response) {
                        $('input').removeClass('is-invalid');
                        if (response.status == 'success') {
                            $('input').val('');
                            window.location.href = "<?= base_url() ?>";
                        } else {
                            let error = response.errors;
                            // console.log(error);
                            for (const key in error) {
                                // console.log(key, error[key]);
                                document.getElementById(key).classList.add('is-invalid');
                                document.getElementById(key + '_msg').innerHTML = error[key];
                            }
                        }
                    }
                });
            });
        });
    </script>

</body>

</html>