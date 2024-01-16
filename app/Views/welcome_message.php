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
    <!-- Data Table -->
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>



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

    .dataTables_filter {
        float: right;
    }

    .pagination {
        float: right;
    }

    .dataTables_info,
    .paging_simple_numbers {
        margin-top: 12px;
    }

    .no-data-cell {
        color: #7eccbf;
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

    .conatiner-title h3 {
        margin-left: -20px;
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

                                    <div class="container" id="domainContainer" style="display: none;">
                                        <div class="row">
                                            <h3>Domain Information</h3>
                                            <div class="col-md-3">
                                                <!-- Left Column -->
                                                <div class="mb-3">
                                                    <label for="domainName" class="form-label">Domain Name</label><span
                                                        class="text-danger">*</span>
                                                    <input type="text" class="form-control" id="domain_name"
                                                        name="domain_name">
                                                    <div class="invalid-feedback" class="text-danger"
                                                        id="domain_name_msg">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="expiryDate" class="form-label">Domain Expiry
                                                        Date</label><span class="text-danger">*</span>
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
                                                    <label for="domainCost" class="form-label">Domain Cost
                                                        (&#x20B9;)</label><span class="text-danger">*</span>
                                                    <input type="text" class="form-control" id="domain_cost"
                                                        name="domain_cost">
                                                    <div class="invalid-feedback" class="text-danger"
                                                        id="domain_cost_msg">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="sellingCost" class="form-label">Selling Cost
                                                        (&#x20B9;)</label><span class="text-danger">*</span>
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
                                                        Provider</label><span class="text-danger">*</span>
                                                    <input type="text" class="form-control" id="domain_provider"
                                                        name="domain_provider">
                                                    <div class="invalid-feedback" class="text-danger"
                                                        id="domain_provider_msg"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="RegistrationDate" class="form-label">Domain Registration
                                                        Date</label><span class="text-danger">*</span>
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
                                                    <label for="email" class="form-label">Registered Email</label><span
                                                        class="text-danger">*</span>
                                                    <input type="email" class="form-control" id="email" name="email">
                                                    <div class="invalid-feedback" class="text-danger" id="email_msg">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="contact" class="form-label">Phone/Mobile
                                                        No.</label><span class="text-danger">*</span>
                                                    <input type="text" class="form-control" id="phone" name="phone">
                                                    <div class="invalid-feedback" class="text-danger" id="phone_msg">
                                                    </div>
                                                </div>
                                                <!-- More domain-related fields can go here -->
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="company" class="form-label">Company Name</label><span
                                                        class="text-danger">*</span>
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
                                                        Year</label><span class="text-danger">*</span>
                                                    <input type="date" class="form-control" name="domain_renew"
                                                        id="domain_renew">
                                                    <div class="invalid-feedback" class="text-danger"
                                                        id="domain_renew_msg">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="renewalDate" class="form-label">Client Name</label><span
                                                        class="text-danger">*</span>
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
                                                        <label for="expiryDate" class="form-label">Expiry
                                                            Date</label><span class="text-danger">*</span>
                                                        <input type="date" class="form-control" name="hosting_expiry"
                                                            id="hosting_expiry">
                                                        <div class="invalid-feedback" class="text-danger"
                                                            id="hosting_expiry_msg"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="totalSpace" class="form-label">Hosting Space
                                                            (GB)</label><span class="text-danger">*</span>
                                                        <input type="text" class="form-control" id="hosting_space"
                                                            name="hosting_space">
                                                        <div class="invalid-feedback" class="text-danger"
                                                            id="hosting_space_msg"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="mb-3">
                                                        <label for="hostingCost" class="form-label">Hosting Cost
                                                            (&#x20B9;)</label><span class="text-danger">*</span>
                                                        <input type="text" class="form-control" id="hosting_cost"
                                                            name="hosting_cost">
                                                        <div class="invalid-feedback" class="text-danger"
                                                            id="hosting_cost_msg"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="hostingCost" id="hostlabelDomain"
                                                            class="form-label">Domain Name</label><span
                                                            class="text-danger mandatory">*</span>
                                                        <input type="text" class="form-control" id="domainName"
                                                            name="domainName">
                                                        <div class="invalid-feedback" class="text-danger"
                                                            id="domainName_msg"></div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="container" id="sslContainer" style="display: none;">
                                        <h3>SSL</h3>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="mb-3">
                                                    <label for="expiryDate" class="form-label">SSL Expiry
                                                        Date</label><span class="text-danger">*</span>
                                                    <input type="date" class="form-control" id="ssl_expiry"
                                                        name="ssl_expiry">
                                                    <div class="invalid-feedback" class="text-danger"
                                                        id="ssl_expiry_msg"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <!-- Right Column -->
                                                <div class="mb-3">
                                                    <label for="domainCost" class="form-label">SSL Cost
                                                        (&#x20B9;)</label><span class="text-danger">*</span>
                                                    <input type="text" class="form-control" id="ssl_cost"
                                                        name="ssl_cost">
                                                    <div class="invalid-feedback" class="text-danger" id="ssl_cost_msg">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <!-- Left Column -->
                                                <div class="mb-3">
                                                    <label for="domainName" id="labelDomain" class="form-label">Domain
                                                        Name</label><span class="text-danger mandatoryssl">*</span>
                                                    <input type="text" class="form-control" id="Domain-Name"
                                                        name="Domain-Name">
                                                    <div class="invalid-feedback" class="text-danger"
                                                        id="Domain-Name_msg"></div>
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
                                            <label for="domainCost" class="form-label">Domain Cost (&#x20B9;)</label>
                                            <input type="text" class="form-control" readonly id="Vdomain_cost"
                                                name="domain_cost">
                                            <div class="invalid-feedback" class="text-danger" id="domain_cost_msg">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="sellingCost" class="form-label">Selling Cost (&#x20B9;)</label>
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
                                                    <label for="hostingCost" class="form-label">Hosting Cost
                                                        (&#x20B9;)</label>
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
                                                    <label for="domainCost" class="form-label">SSL Cost
                                                        (&#x20B9;)</label>
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

            <!-- Renew Modal -->
            <div class="modal fade" id="renewModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Renew Domain</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="renewForm">
                                <div class="container">
                                    <div class="row">
                                        <h2>Domain Renew Info:</h2>
                                        <div class="col-md-3">
                                            <!-- Left Column -->
                                            <input type="hidden" name="id" id="domain_id">
                                            <div class="mb-3">
                                                <label for="domainName" class="form-label">Domain Name</label>
                                                <input type="text" class="form-control" id="RdomainName"
                                                    name="RdomainName" readonly>
                                                <div class="invalid-feedback" class="text-danger" id="RdomainName_msg">
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="RegDate" class="form-label">Domain Registration
                                                    Date</label>
                                                <input type="date" name="domain_regs" id="domain_regs"
                                                    class="form-control">
                                                <div class="invalid-feedback" class="text-danger" id="domain_regs_msg">
                                                </div>
                                            </div>
                                            <!-- More domain-related fields can go here -->
                                        </div>
                                        <div class="col-md-3">
                                            <!-- Right Column -->
                                            <div class="mb-3">
                                                <label for="expiryDate" class="form-label">Domain Expiry Date</label>
                                                <input type="date" name="domain_exp" id="domain_exp"
                                                    class="form-control">
                                                <div class="invalid-feedback" class="text-danger" id="domain_exp_msg">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" id="update" class="btn btn-primary">Save changes</button>
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
                                                    <div class="conatiner-title">
                                                        <h3>List of Registered Domain's</h3>
                                                    </div>
                                                    <div class="date-range me-auto" style="margin-left: 5rem">
                                                        <input type="date" name="from_date" id="from_date">
                                                        <input type="date" name="to_date" id="to_date">
                                                    </div>
                                                    <div class="add_form">
                                                        <button type="button" data-bs-toggle="modal"
                                                            data-bs-target="#showModal" class="btn btn-primary">
                                                            Add
                                                        </button>
                                                    </div>
                                                </div>
                                                <table class="table-bordered" id="myTable">
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


    <script>
        // <!-- domain name hide or show  -->
        $('input[type="checkbox"]').on('change', function () {
            var sslChecked = $('input[value="ssl"]').is(':checked');
            var hostingChecked = $('input[value="hosting"]').is(':checked');
            var domainChecked = $('input[value="domain"]').is(':checked');

            if ((domainChecked && sslChecked) || (domainChecked && hostingChecked) || (domainChecked && sslChecked && hostingChecked)) {
                // ssl feild hide
                $("#labelDomain").hide();
                $('#Domain-Name').hide();
                $('.mandatoryssl').hide();
                // hosting field hide
                $('#hostlabelDomain').hide();
                $('#domainName').hide();
                $('.mandatory').hide();
            }
            else if (sslChecked && hostingChecked) {
                $("#labelDomain").hide();
                $('#Domain-Name').hide();
                $('.mandatoryssl').hide();
                $('#domainName').show();
                $('#hostlabelDomain').show();
                $('.mandatory').show();
            }
            else if (sslChecked) {
                $("#labelDomain").show();
                $('#Domain-Name').show();
                $('.mandatoryssl').show();
            }
            else if (hostingChecked) {
                $('#domainName').show();
                $('#hostlabelDomain').show();
                $('.mandatory').show();
            }

        });

        // <!--  Modal container adjust css -->
        $('input[type="checkbox"]').on('change', function () {
            if ($('input[type="checkbox"]:checked').length > 0) {
                $('.modal-scroll').css('overflow-y', 'scroll');
            } else {
                $('.modal-scroll').css('overflow-y', 'auto');
            }
        });

        // <!--  Hide/Show Container  -->
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

        // <!-- Data Insertion -->
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
                        // console.log(response);
                        alert(response.message);
                    }
                }
            });
        });

        // <!-- Fetching data of particular id-->
        $(document).on('click', '.view', function () {
            // Get the DataTable instance
            var table = $('#myTable').DataTable();
            // Get the clicked row
            var row = $(this).closest('tr');
            // Get the data for the clicked row
            var rowData = table.row(row).data();
            // console.log(rowData[0]);
            var id = rowData[0];
            // console.log(id);
            // Make sure a rowId is available before making the AJAX request
            if (id) {
                // AJAX request with the rowId
                $.ajax({
                    method: "POST",
                    url: "<?= base_url('view_data') ?>",
                    data: {
                        'domainId': id  // Corrected variable name here
                    },
                    success: function (response) {
                        // console.log(response);  // Log the response to the console
                        var domainName = response.domainInfo.domain_name; // console.log(domainName);
                        var domainExpiry = response.domainInfo.domain_expiry;
                        var domainCost = response.domainInfo.domain_cost;
                        var domainRegister = response.domainInfo.domain_register;
                        var domainSellingCost = response.domainInfo.selling_cost;
                        var domainProvider = response.domainInfo.domain_provider;
                        var regiteredEmail = response.domainInfo.email;
                        var regiteredPhone = response.domainInfo.phone;
                        var companyName = response.domainInfo.company_name;
                        var domainRenew = response.domainInfo.domain_renew;
                        var clientName = response.domainInfo.client_name;
                        var hostingExpiry = response.domainInfo.hosting_expiry;
                        var hostingSpace = response.domainInfo.hosting_space;
                        var hostingCost = response.domainInfo.hosting_cost;
                        var sslExpiry = response.domainInfo.ssl_expiry;
                        var sslCost = response.domainInfo.ssl_cost;

                        $('#Vdomain_name').val(domainName);
                        $('#Vdomain_expiry').val(domainExpiry);
                        $('#Vdomain_cost').val(domainCost);
                        $('#Vselling_cost').val(domainSellingCost);
                        $('#Vdomain_provider').val(domainProvider);
                        $('#Vdomain_register').val(domainRegister);
                        $('#Vemail').val(regiteredEmail);
                        $('#Vphone').val(regiteredPhone);
                        $('#Vcompany_name').val(companyName);
                        $('#Vdomain_renew').val(domainRenew);
                        $('#Vclient_name').val(clientName);
                        $('#Vhosting_expiry').val(hostingExpiry);
                        $('#Vhosting_space').val(hostingSpace);
                        $('#Vhosting_cost').val(hostingCost);
                        $('#Vssl_expiry').val(sslExpiry);
                        $('#Vssl_cost').val(sslCost);
                        $("#viewModal").modal('show');

                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            } else {
                console.error('Row ID not found.');
            }
        });



        // Function to format date as dd-mm-yyyy
        function formatDate(date) {
            if (!date) return '-- No data --';

            // Convert to Date object if it's a string
            const dateObj = typeof date === 'string' ? new Date(date) : date;

            if (!(dateObj instanceof Date) || isNaN(dateObj)) {
                return '-- Invalid date --';
            }

            const day = dateObj.getDate().toString().padStart(2, '0');
            const month = (dateObj.getMonth() + 1).toString().padStart(2, '0');
            const year = dateObj.getFullYear();

            return `${day}-${month}-${year}`;

        };

        // server-side data table   // <!-- Retrive data -->
        var table = $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            paging: true,
            ajax: {
                url: "<?= base_url('retrive_data') ?>",
                type: "POST"
            },
            createdRow: function (row, data, dataIndex) {
                // Fetch all table values
                const dateColumnIndexes = [2, 3, 4, 9];
                // Iterate through each cell in the row
                $('td', row).each(function (columnIndex) {
                    var value = data[columnIndex];
                    // console.log(data[2]); // console.log(value)

                    // Format date if the column index corresponds to a date column
                    if (dateColumnIndexes.includes(columnIndex)) {
                        value = formatDate(value);
                    }

                    var displayValue = value !== null && value !== undefined && value !== '' ? value : '-- No data --';
                    // Add a class to cells containing "No data"
                    if (displayValue === '-- No data --') {
                        $(this).addClass('no-data-cell');
                    }
                    // Set the cell content
                    $(this).html(displayValue);
                });
            },
            drawCallback: function (settings) {
                // console.log('Table redrawn:', settings);
                // Iterate through each row in the DataTable
                table.rows().every(function (index, element) {
                    // Get data for the row (including hidden columns)
                    var rowData = this.data();
                    // Get the row node
                    var rowNode = this.node();

                    // Fetch domain register date, expiry date, hosting expiry andd ssl expiry from the row data
                    var domainRegister = rowData[9];
                    var domainExpiry = rowData[2];
                    var sslExpiry = rowData[4];
                    var hostingExpiry = rowData[3];
                    // Check if both domainRegister and domainExpiry are present
                    if (domainRegister && domainExpiry) {
                        const startDate = new Date(domainRegister);
                        const endDate = new Date(domainExpiry);
                        const today = new Date();
                        // console.log(domainRegister, 'startDate');
                        // console.log(domainExpiry, 'expiryDate');

                        if (!isNaN(startDate.getTime()) && !isNaN(endDate.getTime())) {
                            if (endDate < today) {
                                // The domain has expired. Please renew it.
                                $(rowNode).find('td:eq(9)').css('color', 'red').text('The domain has expired.');
                            } else {
                                const difference = Math.abs(endDate - startDate);
                                const differenceInDays = Math.ceil(difference / (1000 * 60 * 60 * 24));
                                // console.log(`startDate: ${domainRegister}, expiryDate: ${domainExpiry}, The domain will expire in ${differenceInDays} days.`);

                                if (differenceInDays <= 30) {
                                    // Apply red color and show relevant information
                                    $(rowNode).find('td:eq(2)').css('color', 'red').html(`${formatDate(domainExpiry)}<br>${differenceInDays} days`);

                                    // Create a Renew button
                                    var renewButton = $('<button>').text('Renew').addClass('renew-button btn btn-info');
                                    // Append the Renew button to the last column
                                    // console.log(renewButton);
                                    $(this.node()).find('td:eq(8)').empty().append(renewButton);

                                    // trigger a email to registered email-id
                                } else {
                                    // Show "View" for other cases
                                    $(this.node()).find('td:eq(8)');
                                }
                            }
                        }
                    }
                });
            }

        });


        // <!-- for edit the data and renewal modal open-->
        $(document).on('click', '.renew-button', function () {
            // console.log('Renew button clicked');
             var table = $('#myTable').DataTable();
            // Get the clicked row
            var row = $(this).closest('tr');
            // Get the data for the clicked row
            var rowData = table.row(row).data();
            // console.log(rowData[0]);
            var id = rowData[0];
            // assign id to update the value
            $("#domain_id").val(id);
            // console.log(id);
            $.ajax({
                method: "POST",
                url: "<?= base_url('edit') ?>",
                data: {
                    'domainID': id
                },
                success: function (response) {
                    // console.log(response);
                    var DomainName = response.domain.domain_name;
                    var DomainExpiry = response.domain.domain_expiry;
                    var DomainRegestration = response.domain.domain_register;
                    // console.log(DomainName); 
                        $('#RdomainName').val(DomainName);
                        $('#domain_regs').val(DomainRegestration);
                        // console.log(domReg);
                        $('#domain_exp').val(DomainExpiry);
                        $('#renewModal').modal('show');
                }
            });
        });


        // Update the data 
        $('#update').click(function (e) {
            e.preventDefault();
            // console.log('clicked');
            
            var data = {
                'id': $('#domain_id').val(),
                'domain_regs': $('#domain_regs').val(),
                'domain_exp': $('#domain_exp').val(),
            };
            // console.log(data); // Log data before sending
            $.ajax({
                method: "POST",
                url: "<?= base_url('update_data') ?>",
                data: data,
                success: function (response) {
                    $('#renewModal').modal('hide');
                    // console.log(response.status);
                    alert(response.message);
                }
            });
        });

    </script>

</body>

</html>