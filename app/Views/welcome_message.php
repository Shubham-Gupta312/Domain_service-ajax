<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

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
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



</head>
<style>
    .header-item img {
        max-width: 60%;
    }

    .modal-dialog {
        max-width: 1000px;
        margin: 1.75rem auto;
        overflow-y: scroll;
        height: 500px;
    }

    input {
        color: #333;
    }

    textarea,
    input[type="text"],
    input[type="password"],
    input[type="datetime"],
    input[type="datetime-local"],
    input[type="date"],
    input[type="month"],
    input[type="time"],
    input[type="week"],
    input[type="number"],
    input[type="email"],
    input[type="url"],
    input[type="search"],
    input[type="tel"],
    input[type="color"] {
        border: 1px solid rgba(6, 6, 6, 0.2);
        font-family: "Mulish", sans-serif;
        outline: 0;
        -webkit-box-shadow: none;
        -moz-box-shadow: none;
        box-shadow: none;
        font-size: 16px;
        line-height: 26px;
        border-radius: 4px;
        padding: 13px 15px 13px 27px;
        width: 100%;
        background: #FFFEFE;
        color: #060606;
    }
    #logout a{
        color: #333;
    }
</style>

<body class="body counter-scroll dashboard show ">

    <div id="wrapper">
        <div id="pagee" class="clearfix">
            <!-- Main Header -->
            <header class="main-header ">

                <!-- Header Lower -->
                <div class="header-lower">
                    <div class="container6">
                        <div class="row">
                            <div class="col-lg-12">

                                <div class="inner-container d-flex justify-content-between align-items-center">

                                    <div class="nav-outer flex align-center">
                                    </div>
                                    <?php if (session()->loggedin == 'loggedin'): ?>
                                        <div class="header-account flex align-center" style="margin-top: 25px">
                                            <div class="avatars-box flex align-center">
                                                <div>
                                                    <?= ucfirst(session()->username); ?>
                                                </div>
                                            </div>
                                            <div class="flat-bt-top sc-btn-top">
                                                <span id="logout"><a href="<?= base_url('logout')?>">Log-out</a></span>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <div class="header-account flex align-center" style="margin-top: 25px">
                                            <div class="avatars-box flex align-center">
                                                <div><a href="<?= base_url('login') ?>">Sign-In</a></div>
                                            </div>
                                        </div>
                                    <?php endif ?>

                                    <div class="mobile-nav-toggler mobile-button"><span></span></div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Header Lower -->
            </header>
            <div class="btn2 header-item " id="left-menu-btn" style=" margin-left: 15px">
                <div class="container">
                    <img src="https://www.savithru.com/assets/images/logo.png" alt="">
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Domain Info:</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <h3>Domain Information</h3>
                                    <div class="col-md-3">
                                        <!-- Left Column -->
                                        <div class="mb-3">
                                            <label for="domainName" class="form-label">Domain Name</label>
                                            <input type="text" class="form-control" id="domainName" name="domainName">
                                        </div>
                                        <div class="mb-3">
                                            <label for="expiryDate" class="form-label">Domain Expiry Date</label>
                                            <input type="date" class="form-control" name="domainExpdate"
                                                id="expiryDate">
                                        </div>
                                        <!-- More domain-related fields can go here -->
                                    </div>
                                    <div class="col-md-3">
                                        <!-- Right Column -->
                                        <div class="mb-3">
                                            <label for="domainCost" class="form-label">Domain Cost</label>
                                            <input type="text" class="form-control" id="domainCost" name="domainCost">
                                        </div>
                                        <div class="mb-3">
                                            <label for="sellingCost" class="form-label">Selling Cost</label>
                                            <input type="text" class="form-control" id="sellingCost" name="sellingCost">
                                        </div>
                                        <!-- More domain-related fields can go here -->
                                    </div>
                                    <div class="col-md-3">
                                        <!-- Left Column -->
                                        <div class="mb-3">
                                            <label for="domainProvider" class="form-label">Domain Provider</label>
                                            <input type="text" class="form-control" id="domainProvider"
                                                name="domainProvider">
                                        </div>
                                        <div class="mb-3">
                                            <label for="RegistrationDate" class="form-label">Domain Registration
                                                Date</label>
                                            <input type="date" class="form-control" name="domainRegdate"
                                                id="RegistrationDate">
                                        </div>
                                        <!-- More domain-related fields can go here -->
                                    </div>
                                    <div class="col-md-3">
                                        <!-- Right Column -->
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Registered Email</label>
                                            <input type="email" class="form-control" id="email" name="email">
                                        </div>
                                        <div class="mb-3">
                                            <label for="contact" class="form-label">Contact No.</label>
                                            <input type="text" class="form-control" id="contact" name="phone">
                                        </div>
                                        <!-- More domain-related fields can go here -->
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="company" class="form-label">Company Name</label>
                                            <input type="text" class="form-control" id="company" name="company">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="renewalDate" class="form-label">Domain Renewal Year</label>
                                            <input type="date" class="form-control" name="renewalDate" id="renewalDate">
                                        </div>
                                    </div>
                                </div>

                                <div class="wrap-box d-flex">
                                    <div class="container mt-2">
                                        <h3>Hosting Information</h3>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="mb-3">
                                                    <label for="totalSpace" class="form-label">Total Number of Space
                                                        (GB)</label>
                                                    <input type="text" class="form-control" id="totalSpace"
                                                        name="space">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="expiryDate" class="form-label">Expiry Date</label>
                                                    <input type="date" class="form-control" name="expDate"
                                                        id="expiryDate">
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="mb-3">
                                                    <label for="hostingCost" class="form-label">Hosting Cost</label>
                                                    <input type="text" class="form-control" id="hostingCost"
                                                        name="hostingCost">

                                                </div>
                                                <div class="mb-3">
                                                    <label for="hostingSpace" class="form-label">Hosting Space
                                                        (GB)</label>
                                                    <input type="text" class="form-control" id="hostingSpace"
                                                        name="hostingSpace">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="container mt-2">
                                        <h3>SSL</h3>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <!-- Left Column -->
                                                <div class="mb-3">
                                                    <label for="domainName" class="form-label">Domain Name</label>
                                                    <input type="text" class="form-control" id="domainName"
                                                        name="domain_Name">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="expiryDate" class="form-label">Expiry Date</label>
                                                    <input type="date" class="form-control" id="expiryDate"
                                                        name="ssl_expDate">
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <!-- Right Column -->
                                                <div class="mb-3">
                                                    <label for="domainCost" class="form-label">Cost</label>
                                                    <input type="text" class="form-control" id="domainCost" name="cost">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" id="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dashboard__content">
                <section class="flat-dashboard">
                    <div class="container7">
                        <div class="row">
                            <div class="col-lg-12 flex post-col">

                                <div class="tf-new-listing " style="width:100%">
                                    <div class="new-listing bg-white" style="margin-top: 90px">
                                        <div class="table-content">
                                            <div class="wrap-listing table-responsive">
                                                <div class="content"
                                                    style="display: flex; justify-content: space-between; margin-bottom:5px">
                                                    <div class="conatiner">
                                                        <h3>List of Registered Domain's</h3>
                                                    </div>
                                                    <div class="add_form">
                                                        <button type="button" data-bs-toggle="modal"
                                                            data-bs-target="#showModal" class="btn btn-primary">
                                                            Add
                                                        </button>
                                                    </div>
                                                </div>
                                                <table class="table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>S.no</th>
                                                            <th>Domain Name</th>
                                                            <th>Domain Expiry Date</th>
                                                            <th>Hosting Expiry Date</th>
                                                            <th>SSL Expiry Date</th>
                                                            <th>Registered Mobile No.</th>
                                                            <th>Client Name</th>
                                                            <th>Registered Email-Id</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                1.
                                                            </td>
                                                            <td>
                                                                google.com
                                                            </td>
                                                            <td>
                                                                01/10/2025
                                                            </td>
                                                            <td>
                                                                01/10/2025
                                                            </td>
                                                            <td>
                                                                01/10/2025
                                                            </td>
                                                            <td>
                                                                1234567890
                                                            </td>
                                                            <td>
                                                                Shubham Gupta
                                                            </td>
                                                            <td>
                                                                Shubham@gmail.com
                                                            </td>
                                                            <td>
                                                                View
                                                            </td>

                                                        </tr>

                                                    </tbody>
                                                </table>

                                            </div>
                                            <div class="themesflat-pagination clearfix">
                                                <ul>
                                                    <li><a href="#" class="page-numbers style"><i
                                                                class="far fa-angle-left"></i></a></li>
                                                    <li><a href="#" class="page-numbers">1</a></li>
                                                    <li><a href="#" class="page-numbers">2</a></li>
                                                    <li><a href="#" class="page-numbers current">3</a></li>
                                                    <li><a href="#" class="page-numbers">4</a></li>
                                                    <li><a href="#" class="page-numbers">...</a></li>
                                                    <li><a href="#" class="page-numbers style"><i
                                                                class="far fa-angle-right"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>

    <script>

    </script>
</body>

</html>