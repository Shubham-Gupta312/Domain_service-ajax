    <!-- Data Table -->
    <script>
        $(document).ready(function () {
            // let table = new DataTable('#myTable');
            setTimeout(function () {
                $('#myTable').DataTable();
            }, 400);
        });
    </script>

    <!-- domain name hide or show  -->
    <script>
        $(document).ready(function () {
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
        });

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

    <!-- // Data Insertion -->
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

    <!-- // Retrive data -->
    <script>
        $.ajax({
            method: "GET",
            url: "<?= base_url('retrive_data') ?>",
            success: function (response) {
                // console.log(value['name']);

                // Function to format date as dd-mm-yyyy
                function formatDate(date) {
                    const day = date.getDate().toString().padStart(2, '0');
                    // console.log(day);
                    const month = (date.getMonth() + 1).toString().padStart(2, '0');
                    const year = date.getFullYear();
                    return `${day}-${month}-${year}`;
                }

                $.each(response.domain, function (key, value) {
                    // Convert date strings to Date objects
                    const domainExpiryDate = new Date(value['domain_expiry']);
                    const hostingExpiryDate = new Date(value['hosting_expiry']);
                    const sslExpiryDate = new Date(value['ssl_expiry']);

                    // Format dates as dd-mm-yyyy
                    const domainExpiryFormatted = formatDate(domainExpiryDate);
                    const hostingExpiryFormatted = formatDate(hostingExpiryDate);
                    const sslExpiryFormatted = formatDate(sslExpiryDate);

                    const row = $('<tr>' +
                        '<th scope="row" class="domainId">' + value['id'] + '</th>' +
                        '<td>' + value['domain_name'] + '</td>' +
                        '<td>' +
                        '<span class="result">' + domainExpiryFormatted + '</span>' +
                        '<br><small class="days"></small>' +
                        '</td>' +
                        '<td class="hstExpiry">' + hostingExpiryFormatted + '</td>' +
                        '<td class="sslExpiry" >' + sslExpiryFormatted + '</td>' +
                        '<td class="phone">' + value['phone'] + '</td>' +
                        '<td class="clientName">' + value['client_name'] + '</td>' +
                        '<td class="email">' + value['email'] + '</td>' +
                        '<td>' + '<a href="#" data-bs-toggle="modal" data-bs-target="#viewModal" class="view" >View</a>' + '</td>' +
                        '</tr>');

                    $('.domainInfo').append(row);

                    const startDateInput = value['domain_register'];
                    const expiryDateInput = value['domain_expiry'];

                    if (startDateInput && expiryDateInput) {
                        // console.log(startDateInput, 'startDate');
                        // console.log(expiryDateInput, 'expiryDate');
                        const startDate = new Date(startDateInput);
                        const endDate = new Date(expiryDateInput);
                        const today = new Date();

                        if (!isNaN(startDate.getTime()) && !isNaN(endDate.getTime())) {
                            if (endDate < today) {
                                // console.log('The domain has expired. Please renew it.');
                                row.find('.result').css('color', 'red').text('The domain has expired.');
                            } else {
                                const difference = Math.abs(endDate - startDate);
                                const differenceInDays = Math.ceil(difference / (1000 * 60 * 60 * 24));
                                // console.log(`startDate: ${startDateInput}, expiryDate: ${expiryDateInput}, The domain will expire in ${differenceInDays} days.`);

                                if (differenceInDays <= 30) {
                                    row.find('.result').css('color', 'red').text(domainExpiryFormatted);
                                    row.find('.days').text(differenceInDays + ' days').css('color', 'red');

                                    // Append the "Renew" button to the renew-cell
                                    var renewButton = $('<button>').text('Renew').addClass('renew-button btn btn-info');
                                    var renewButtonCell = $('<td class="renew-cell">').append(renewButton);
                                    row.append(renewButtonCell);
                                }
                            }
                        }
                    } else if (!(startDateInput && expiryDateInput)) {
                        // console.log('no data');
                        row.find('.result').css('color', '#7eccbf').text('-- No Data --');
                    }
                    // Check if the domain has been recently renewed, hide the "Renew" button
                    if (value['recently_renewed']) {
                        row.find('.renew-button').hide();
                    }

                    var hstExpr = value['hosting_expiry'];
                    var sslExpr = value['ssl_expiry'];
                    var email = value['email'];
                    var phone = value['phone'];
                    var clientName = value['client_name'];
                    if (!hstExpr) {
                        row.find('.hstExpiry').css('color', '#7eccbf').text('-- No Data --');
                    }
                    if (!sslExpr) {
                        row.find('.sslExpiry').css('color', '#7eccbf').text('-- No Data --');
                    }
                    if (!email) {
                        row.find('.email').css('color', '#7eccbf').text('-- No Data --');
                    }
                    if (!phone) {
                        row.find('.phone').css('color', '#7eccbf').text('-- No Data --');
                    }
                    if (!clientName) {
                        row.find('.clientName').css('color', '#7eccbf').text('-- No Data --');
                    }
                });

            }
        });

    </script>

    <!-- for edit the data and renewal modal open-->
    <script>
        $(document).on('click', '.renew-button', function () {
            // console.log('Renew button clicked');
            var domain_Id = $(this).closest('tr').find('.domainId').text();
            $("#domain_id").val(domain_Id);
            // console.log(domain_Id);
            $.ajax({
                method: "POST",
                url: "<?= base_url('edit') ?>",
                data: {
                    'domainID': domain_Id
                },
                success: function (response) {
                    $.each(response, function (key, domain_value) {
                        // console.log($('#RdomainName').val(domain_value['domain_name'])); 
                        $('#RdomainName').val(domain_value['domain_name']);
                        $('#domain_regs').val(domain_value['domain_register']);
                        // console.log(domReg);
                        $('#domain_exp').val(domain_value['domain_expiry']);
                        $('#renewModal').modal('show');
                    });
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
            console.log(data); // Log data before sending
            $.ajax({
                method: "POST",
                url: "<?= base_url('update_data') ?>",
                data: data,
                success: function (response) {
                    $('#renewModal').modal('hide');
                    // console.log(response.status);
                }
            });
        });

    </script>