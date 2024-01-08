<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

<head>
    <meta charset="utf-8">
    <title>Domain-Service</title>

    <meta name="author" content="themesflat.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href=<?= ASSET_URL . "public/app/dist/font-awesome.css" ?>>

    <link rel="stylesheet" href=<?= ASSET_URL . "public/app/dist/app.css" ?>>
    <link rel="stylesheet" href=<?= ASSET_URL . "public/app/dist/responsive.css" ?>>
    <link rel="stylesheet" href=<?= ASSET_URL . "public/app/dist/owl.css" ?>>

    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="https://www.savithru.com/assets/images/logo.png">
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

    .table-bordered th,
    .table-bordered td {

        text-align: center;
    }

    #logout a {
        color: #333;
    }

    .box label {
        font-size: 20px;
    }

    .box input[type="checkbox"] {
        height: 20px;
        width: 20px;
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
                                                <span id="logout"><a href="<?= base_url('logout') ?>">Log-out</a></span>
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

            <!-- Add data Modal -->
            <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-scroll">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Domain Info:</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formId">
                                <div class="container-fluid">
                                    <div class="box m-4">
                                        <label><input type="checkbox" class="checkbox m-2" name="domain_checkbox"
                                                value="domain">Domain</label>
                                        <label><input type="checkbox" class="checkbox m-2" name="hosting_checkbox"
                                                value="hosting">Hosting</label>
                                        <label><input type="checkbox" class="checkbox m-2" name="ssl_checkbox"
                                                value="ssl">SSL</label>
                                        <br><br>
                                    </div>
                                    <div class="container" id="Domain_Container" style="display:none;">
                                        <div class="mb-3">
                                            <label for="domainName" class="form-label">Domain Name</label>
                                            <input type="text" class="form-control" id="domain_Name" name="domain_Name">
                                            <div class="invalid-feedback" class="text-danger" id="domain_name_msg">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="container" id="domainContainer" style="display: none;">
                                        <div class="row">
                                            <h3>Domain Information</h3>
                                            <div class="col-md-3">
                                                <!-- Left Column -->
                                                <div class="mb-3">
                                                    <label for="domainName" class="form-label">Domain Name</label>
                                                    <input type="text" class="form-control" id="domain_name"
                                                        name="domain_name">
                                                    <div class="invalid-feedback" class="text-danger"
                                                        id="domain_name_msg">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="expiryDate" class="form-label">Domain Expiry
                                                        Date</label>
                                                    <input type="date" class="form-control" name="domain_expiry"
                                                        id="domain_expiry">
                                                    <div class="invalid-feedback" class="text-danger"
                                                        id="domain_expiry_msg"></div>
                                                </div>
                                                <!-- More domain-related fields can go here -->
                                            </div>
                                            <div class="col-md-3">
                                                <!-- Right Column -->
                                                <div class="mb-3">
                                                    <label for="domainCost" class="form-label">Domain Cost</label>
                                                    <input type="text" class="form-control" id="domain_cost"
                                                        name="domain_cost">
                                                    <div class="invalid-feedback" class="text-danger"
                                                        id="domain_cost_msg">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="sellingCost" class="form-label">Selling Cost</label>
                                                    <input type="text" class="form-control" id="selling_cost"
                                                        name="selling_cost">
                                                    <div class="invalid-feedback" class="text-danger"
                                                        id="selling_cost_msg">
                                                    </div>
                                                </div>
                                                <!-- More domain-related fields can go here -->
                                            </div>
                                            <div class="col-md-3">
                                                <!-- Left Column -->
                                                <div class="mb-3">
                                                    <label for="domainProvider" class="form-label">Domain
                                                        Provider</label>
                                                    <input type="text" class="form-control" id="domain_provider"
                                                        name="domain_provider">
                                                    <div class="invalid-feedback" class="text-danger"
                                                        id="domain_provider_msg"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="RegistrationDate" class="form-label">Domain Registration
                                                        Date</label>
                                                    <input type="date" class="form-control" name="domain_register"
                                                        id="domain_register">
                                                    <div class="invalid-feedback" class="text-danger"
                                                        id="domain_register_msg"></div>
                                                </div>
                                                <!-- More domain-related fields can go here -->
                                            </div>
                                            <div class="col-md-3">
                                                <!-- Right Column -->
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Registered Email</label>
                                                    <input type="email" class="form-control" id="email" name="email">
                                                    <div class="invalid-feedback" class="text-danger" id="email_msg">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="contact" class="form-label">Phone/Mobile No.</label>
                                                    <input type="text" class="form-control" id="phone" name="phone">
                                                    <div class="invalid-feedback" class="text-danger" id="phone_msg">
                                                    </div>
                                                </div>
                                                <!-- More domain-related fields can go here -->
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="company" class="form-label">Company Name</label>
                                                    <input type="text" class="form-control" id="company_name"
                                                        name="company_name">
                                                    <div class="invalid-feedback" class="text-danger"
                                                        id="company_name_msg">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="renewalDate" class="form-label">Domain Renewal
                                                        Year</label>
                                                    <input type="date" class="form-control" name="domain_renew"
                                                        id="domain_renew">
                                                    <div class="invalid-feedback" class="text-danger"
                                                        id="domain_renew_msg">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="renewalDate" class="form-label">Client Name</label>
                                                    <input type="text" class="form-control" name="client_name"
                                                        id="client_name">
                                                    <div class="invalid-feedback" class="text-danger"
                                                        id="client_name_msg">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="wrap-box d-flex">
                                        <div class="container" id="hostingContainer" style="display: none;">
                                            <h3>Hosting Information</h3>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="mb-3">
                                                        <label for="expiryDate" class="form-label">Expiry Date</label>
                                                        <input type="date" class="form-control" name="hosting_expiry"
                                                            id="hosting_expiry">
                                                        <div class="invalid-feedback" class="text-danger"
                                                            id="hosting_expiry_msg"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="totalSpace" class="form-label">Hosting Space
                                                            (GB)</label>
                                                        <input type="text" class="form-control" id="hosting_space"
                                                            name="hosting_space">
                                                        <div class="invalid-feedback" class="text-danger"
                                                            id="hosting_space_msg"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="mb-3">
                                                        <label for="hostingCost" class="form-label">Hosting Cost</label>
                                                        <input type="text" class="form-control" id="hosting_cost"
                                                            name="hosting_cost">
                                                        <div class="invalid-feedback" class="text-danger"
                                                            id="hosting_cost_msg"></div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="container" id="sslContainer" style="display: none;">
                                        <h3>SSL</h3>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <!-- Left Column -->
                                                <!-- <div class="mb-3">
                                                    <label for="domainName" class="form-label">Domain Name</label>
                                                    <input type="text" class="form-control" id="domainName"
                                                        name="domain_Name">
                                                </div> -->
                                                <div class="mb-3">
                                                    <label for="expiryDate" class="form-label">SSL Expiry
                                                        Date</label>
                                                    <input type="date" class="form-control" id="ssl_expiry"
                                                        name="ssl_expiry">
                                                    <div class="invalid-feedback" class="text-danger"
                                                        id="ssl_expiry_msg"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <!-- Right Column -->
                                                <div class="mb-3">
                                                    <label for="domainCost" class="form-label">SSL Cost</label>
                                                    <input type="text" class="form-control" id="ssl_cost"
                                                        name="ssl_cost">
                                                    <div class="invalid-feedback" class="text-danger" id="ssl_cost_msg">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <!-- <button type="button" id="submit" class="btn btn-primary">Save</button> -->
                                    <div id="submitButton" style="display: none;">
                                        <!-- Submit Button -->
                                        <button type="button" id="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <!-- View Data Modal -->
            <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                            <input type="text" class="form-control" readonly id="Vdomain_name"
                                                name="domain_name">
                                            <div class="invalid-feedback" class="text-danger" id="domain_name_msg">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="expiryDate" class="form-label">Domain Expiry Date</label>
                                            <input type="date" class="form-control" readonly name="domain_expiry"
                                                id="Vdomain_expiry">
                                            <div class="invalid-feedback" class="text-danger" id="domain_expiry_msg">
                                            </div>
                                        </div>
                                        <!-- More domain-related fields can go here -->
                                    </div>
                                    <div class="col-md-3">
                                        <!-- Right Column -->
                                        <div class="mb-3">
                                            <label for="domainCost" class="form-label">Domain Cost</label>
                                            <input type="text" class="form-control" readonly id="Vdomain_cost"
                                                name="domain_cost">
                                            <div class="invalid-feedback" class="text-danger" id="domain_cost_msg">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="sellingCost" class="form-label">Selling Cost</label>
                                            <input type="text" class="form-control" readonly id="Vselling_cost"
                                                name="selling_cost">
                                            <div class="invalid-feedback" class="text-danger" id="selling_cost_msg">
                                            </div>
                                        </div>
                                        <!-- More domain-related fields can go here -->
                                    </div>
                                    <div class="col-md-3">
                                        <!-- Left Column -->
                                        <div class="mb-3">
                                            <label for="domainProvider" class="form-label">Domain Provider</label>
                                            <input type="text" class="form-control" readonly id="Vdomain_provider"
                                                name="domain_provider">
                                            <div class="invalid-feedback" class="text-danger" id="domain_provider_msg">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="RegistrationDate" class="form-label">Domain Registration
                                                Date</label>
                                            <input type="date" class="form-control" readonly name="domain_register"
                                                id="Vdomain_register">
                                            <div class="invalid-feedback" class="text-danger" id="domain_register_msg">
                                            </div>
                                        </div>
                                        <!-- More domain-related fields can go here -->
                                    </div>
                                    <div class="col-md-3">
                                        <!-- Right Column -->
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Registered Email</label>
                                            <input type="email" class="form-control" readonly id="Vemail" name="email">
                                            <div class="invalid-feedback" class="text-danger" id="email_msg"></div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="contact" class="form-label">Phone/Mobile No.</label>
                                            <input type="text" class="form-control" readonly id="Vphone" name="phone">
                                            <div class="invalid-feedback" class="text-danger" id="phone_msg"></div>
                                        </div>
                                        <!-- More domain-related fields can go here -->
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="company" class="form-label">Company Name</label>
                                            <input type="text" class="form-control" readonly id="Vcompany_name"
                                                name="company_name">
                                            <div class="invalid-feedback" class="text-danger" id="company_name_msg">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="renewalDate" class="form-label">Domain Renewal Year</label>
                                            <input type="date" class="form-control" readonly name="domain_renew"
                                                id="Vdomain_renew">
                                            <div class="invalid-feedback" class="text-danger" id="domain_renew_msg">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="renewalDate" class="form-label">Client Name</label>
                                            <input type="text" class="form-control" readonly name="client_name"
                                                id="Vclient_name">
                                            <div class="invalid-feedback" class="text-danger" id="client_name_msg">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="wrap-box d-flex">
                                    <div class="container mt-2">
                                        <h3>Hosting Information</h3>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="mb-3">
                                                    <label for="expiryDate" class="form-label">Expiry Date</label>
                                                    <input type="date" class="form-control" readonly
                                                        name="hosting_expiry" id="Vhosting_expiry">
                                                    <div class="invalid-feedback" class="text-danger"
                                                        id="hosting_expiry_msg"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="totalSpace" class="form-label">Hosting Space
                                                        (GB)</label>
                                                    <input type="text" class="form-control" readonly id="Vhosting_space"
                                                        name="hosting_space">
                                                    <div class="invalid-feedback" class="text-danger"
                                                        id="hosting_space_msg"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="mb-3">
                                                    <label for="hostingCost" class="form-label">Hosting Cost</label>
                                                    <input type="text" class="form-control" readonly id="Vhosting_cost"
                                                        name="hosting_cost">
                                                    <div class="invalid-feedback" class="text-danger"
                                                        id="hosting_cost_msg"></div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="container mt-2">
                                        <h3>SSL</h3>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <!-- Left Column -->
                                                <!-- <div class="mb-3">
                                                    <label for="domainName" class="form-label">Domain Name</label>
                                                    <input type="text" class="form-control" readonly id="domainName"
                                                        name="domain_Name">
                                                </div> -->
                                                <div class="mb-3">
                                                    <label for="expiryDate" class="form-label">SSL Expiry
                                                        Date</label>
                                                    <input type="date" class="form-control" readonly id="Vssl_expiry"
                                                        name="ssl_expiry">
                                                    <div class="invalid-feedback" class="text-danger"
                                                        id="ssl_expiry_msg"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <!-- Right Column -->
                                                <div class="mb-3">
                                                    <label for="domainCost" class="form-label">SSL Cost</label>
                                                    <input type="text" class="form-control" readonly id="Vssl_cost"
                                                        name="ssl_cost">
                                                    <div class="invalid-feedback" class="text-danger" id="ssl_cost_msg">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Data Content -->
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
                                                    <tbody class="domainInfo">

                                                    </tbody>
                                                </table>

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


    <!--  -->
    <script>

    </script>
    <!--  Modal container adjust css -->
    <script>
        $(document).ready(function () {
            $('input[type="checkbox"]').on('change', function () {
                if ($('input[type="checkbox"]:checked').length > 0) {
                    $('.modal-scroll').css('overflow-y', 'scroll');
                } else {
                    $('.modal-scroll').css('overflow-y', 'auto');
                }
            });
        });
    </script>
    <!--  Hide/Show Container  -->

    <script>
        $(document).ready(function () {
            $('.checkbox').change(function () {
                var anyChecked = false;

                $('.container').hide(); // Hide all containers initially

                $('.checkbox:checked').each(function () {
                    var selected = $(this).val();
                    if (selected === 'hosting') {
                        $('#hostingContainer').show();
                    }
                    if (selected === 'domain') {
                        $('#domainContainer').show();
                    }
                    if (selected === 'ssl') {
                        $('#sslContainer').show();
                    }
                    anyChecked = true;
                });

                if (anyChecked) {
                    $('#submitButton').show();
                } else {
                    $('#submitButton').hide();
                }
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            // Data Insertion
            $('#submit').click(function (event) {
                event.preventDefault();
                // console.log('clicked');
                var formData = $('#formId').serialize();
                // console.log(formData);
                $.ajax({
                    method: "POST",
                    url: "<?= base_url('domain_data') ?>",
                    data: formData,
                    dataType: "json",
                    success: function (response) {
                        $('input').removeClass('is-invalid');
                        if (response.status == 'success') {
                            // $('input').val('');
                            $('#showModal').modal('hide');
                            console.log(response);
                        } else {
                            let error = response.errors;
                            // console.log(error);
                            for (const key in error) {
                                // console.log(key);
                                // console.log(key, error[key]);
                                document.getElementById(key).classList.add('is-invalid');
                                document.getElementById(key + '_msg').innerHTML = error[key];
                            }
                            console.log(response);
                        }
                    }
                });
            });

        });
    </script>

    <!-- Fetching data of particular id-->
    <script>
        $(document).ready(function () {
            $(document).on('click', '.view', function () {
                var domainId = $(this).closest('tr').find('.domainId').text();
                // console.log(domainId);
                $.ajax({
                    method: "POST",
                    url: "<?= base_url('view_data') ?>",
                    data: {
                        'domainId': domainId
                    },
                    success: function (response) {
                        // console.log(response);
                        $.each(response, function (key, value) {
                            $('#Vdomain_name').val(value['domain_name']);
                            $('#Vdomain_expiry').val(value['domain_expiry']);
                            $('#Vdomain_cost').val(value['domain_cost']);
                            $('#Vselling_cost').val(value['selling_cost']);
                            $('#Vdomain_provider').val(value['domain_provider']);
                            $('#Vdomain_register').val(value['domain_register']);
                            $('#Vemail').val(value['email']);
                            $('#Vphone').val(value['phone']);
                            $('#Vcompany_name').val(value['company_name']);
                            $('#Vdomain_renew').val(value['domain_renew']);
                            $('#Vclient_name').val(value['client_name']);
                            $('#Vhosting_expiry').val(value['hosting_expiry']);
                            $('#Vhosting_space').val(value['hosting_space']);
                            $('#Vhosting_cost').val(value['hosting_cost']);
                            $('#Vssl_expiry').val(value['ssl_expiry']);
                            $('#Vssl_cost').val(value['ssl_cost']);
                            // $("#viewModal").modal('');
                        });
                    }
                });
            });
        });
    </script>

    <script>
        // Retrive data
        $.ajax({
            method: "GET",
            url: "<?= base_url('retrive_data') ?>",
            success: function (response) {
                $.each(response.domain, function (key, value) {
                    // console.log(value['name']);
                    $('.domainInfo').append('<tr>' +
                        '<th scope="row" class="domainId">' + value['id'] + '</th>' +
                        '<td>' + value['domain_name'] + '</td>' +
                        '<td>' + value['domain_expiry'] + '</td>' +
                        '<td>' + value['hosting_expiry'] + '</td>' +
                        '<td>' + value['ssl_expiry'] + '</td>' +
                        '<td>' + value['phone'] + '</td>' +
                        '<td>' + value['client_name'] + '</td>' +
                        '<td>' + value['email'] + '</td>' +
                        '<td>' + '<a href="#" data-bs-toggle="modal" data-bs-target="#viewModal" class="view" >View</a>' + '</td>' +
                        '</tr>');
                });
            }
        });
    </script>
</body>

</html>