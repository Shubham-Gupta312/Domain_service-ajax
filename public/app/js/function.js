$(document).ready(function () {
    //Filter data acc. to date range
    $('#filterButton').on('click', function () {
        var startDate = $('#startDate').val();
        var endDate = $('#endDate').val();
        // console.log(startDate, endDate);

        // Update the URL to include the date parameters
        // var url = "<?= base_url('fetchDataBetweenDays') ?>?startDate=" + startDate + "&endDate=" + endDate;
        var url = "fetchDataBetweenDays?startDate=" + startDate + "&endDate=" + endDate;

        $.ajax({
            url: url,
            type: 'GET',
            success: function (response) {
                // console.log('Data Between Two Days:', response);
                // Clear existing DataTable
                $('#myTable').DataTable().clear().destroy();

                if (response.length > 0) {
                    // Reinitialize DataTable with new data
                    $('#myTable').DataTable({
                        data: response,
                        columns: [
                            // Define your columns based on the response data
                            { data: 'id' },
                            { data: 'domain_name' },
                            { data: 'domain_expiry' },
                            { data: 'hosting_expiry' },
                            { data: 'ssl_expiry' },
                            { data: 'phone' },
                            { data: 'client_name' },
                            { data: 'email' },
                            {
                                // Add a custom column for "View" or "Renew" link
                                data: null,
                                render: function (data, type, row) {
                                    // Check if domain_expiry is within 30 days
                                    var expiryDate = new Date(row.domain_expiry);
                                    var currentDate = new Date();
                                    var thirtyDaysFromNow = new Date();
                                    thirtyDaysFromNow.setDate(currentDate.getDate() + 30);

                                    if (expiryDate <= thirtyDaysFromNow) {
                                        // Display "Renew" button
                                        return '<button class="renew-button btn btn-info" data-domain-id="' + row.id + '">Renew</button>';
                                    } else {
                                        // Display "View" link
                                        return '<a href="#" data-bs-toggle="modal" data-bs-target="#viewModal" class="view" data-domain-id="' + row.id + '">View</a>';
                                    }
                                }
                            }
                        ],

                    });
                } else {
                    // If no data, display a message
                    $('#myTable').html('<p style="text-align: center; font-weight: bold; color: #000; font-size: 16px;">No data found</p>');
                }
            },
            error: function () {
                // Handle AJAX error here
                console.error('Error fetching data');
            }
        });
    });


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
            // url: "<?= base_url('domain_data') ?>",
            url: "domain_data",
            data: formData,
            dataType: "json",
            success: function (response) {
                $('input').removeClass('is-invalid');
                if (response.status == 'success') {
                    // $('input').val('');
                    $('#showModal').modal('hide');
                    // console.log(response);
                } else {
                    let error = response.errors;
                    // console.log(error);
                    for (const key in error) {
                        // console.log(key);
                        // console.log(key, error[key]);
                        document.getElementById(key).classList.add('is-invalid');
                        document.getElementById(key + '_msg').innerHTML = error[key];
                    }
                    // console.log(response.message);
                    // alert(response.message);
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
                // url: "<?= base_url('view_data') ?>",
                url: "view_data",
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
                    var hostingRegister = response.domainInfo.hosting_register;
                    var hostingExpiry = response.domainInfo.hosting_expiry;
                    var hostingSpace = response.domainInfo.hosting_space;
                    var hostingCost = response.domainInfo.hosting_cost;
                    var sslRegister = response.domainInfo.ssl_register;
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
                    $('#Vhosting_register').val(hostingRegister);
                    $('#Vhosting_expiry').val(hostingExpiry);
                    $('#Vhosting_space').val(hostingSpace);
                    $('#Vhosting_cost').val(hostingCost);
                    $('#Vssl_register').val(sslRegister);
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
            // url: "<?= base_url('retrive_data') ?>",
            url: "retrive_data",
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
                var domainId = rowData[0];
                var domainName = rowData[1];
                var domainExpiry = rowData[2];
                var hostingExpiry = rowData[3];
                var sslExpiry = rowData[4];
                var domainRegister = rowData[9];
                var hostingRegister = rowData[10];
                var sslRegister = rowData[11];
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
                            $(rowNode).find('td:eq(2)').css('color', 'red').text('The domain has expired.');
                        } else {
                            const difference = Math.abs(endDate - startDate);
                            const differenceInDays = Math.ceil(difference / (1000 * 60 * 60 * 24));
                            // console.log(`Domian Name: ${domainName} startDate: ${domainRegister}, expiryDate: ${domainExpiry}, The domain will expire in ${differenceInDays} days.`);

                            if (differenceInDays <= 30) {
                                // Apply red color and show relevant information
                                $(rowNode).find('td:eq(2)').css('color', 'red').html(`${formatDate(domainExpiry)}<br>${differenceInDays} days`);

                                // Create a Renew button
                                var renewButton = $('<button>').text('Renew').addClass('renew-button btn btn-info');
                                // Append the Renew button to the last column
                                // console.log(renewButton);
                                $(this.node()).find('td:eq(8)').empty().append(renewButton);

                                // trigger a email to registered email-id
                                $.ajax({
                                    // url: "<?= base_url('sendRenewalEmail') ?>", // Update with your actual controller and method
                                    url: "sendRenewalEmail",
                                    type: 'POST',
                                    data: {
                                        'domainId': domainId
                                    }, // or 'GET' depending on your server-side configuration
                                    success: function (response) {
                                        // Handle success, if needed
                                        // console.log('Email sent successfully');
                                    },
                                    error: function (error) {
                                        // Handle error, if needed
                                        // console.error('Error sending email', error);
                                    }
                                });
                            }
                            else {
                                // Show "View" for other cases
                                $(this.node()).find('td:eq(8)');
                            }
                        }
                    }
                }
                // End of domain 
                // Check if both hosting Register and hostingExpiry are present
                if (hostingRegister && hostingExpiry) {
                    const HostStartDate = new Date(hostingRegister);
                    const HostEndDate = new Date(hostingExpiry);
                    const today = new Date();
                    // console.log(domainRegister, 'startDate');
                    // console.log(domainExpiry, 'expiryDate');

                    if (!isNaN(HostStartDate.getTime()) && !isNaN(HostEndDate.getTime())) {
                        if (HostEndDate < today) {
                            // The domain has expired. Please renew it.
                            $(rowNode).find('td:eq(3)').css('color', 'red').text('The Hosting has expired.');
                        } else {
                            const difference = Math.abs(HostEndDate - HostStartDate);
                            const differenceInDays = Math.ceil(difference / (1000 * 60 * 60 * 24));
                            // console.log(`Domian Name: ${domainName} startDate: ${hostingRegister}, expiryDate: ${hostingExpiry}, The Hosting will expire in ${differenceInDays} days.`);

                            if (differenceInDays <= 30) {
                                // Apply red color and show relevant information
                                $(rowNode).find('td:eq(3)').css('color', 'red').html(`${formatDate(hostingExpiry)}<br>${differenceInDays} days`);

                                // Create a Renew button
                                var renewButton = $('<button>').text('Renew').addClass('renew-button btn btn-info');
                                // Append the Renew button to the last column
                                // console.log(renewButton);
                                $(this.node()).find('td:eq(8)').empty().append(renewButton);

                                // trigger a email to registered email-id
                                $.ajax({
                                    // url: "<?= base_url('sendRenewalEmail') ?>", // Update with your actual controller and method
                                    url: "sendRenewalEmail",
                                    type: 'POST',
                                    data: {
                                        'domainId': domainId
                                    },
                                    success: function (response) {
                                        // console.log('Email sent successfully');
                                    },
                                    error: function (error) {
                                        // console.error('Error sending email', error);
                                    }
                                });
                            }
                            else {
                                $(this.node()).find('td:eq(8)');
                            }
                        }
                    }
                }
                // End of hosting
                // Check if both sslRegister and sslExpiry are present
                if (sslRegister && sslExpiry) {
                    const SSLstartDate = new Date(sslRegister);
                    const SSLendDate = new Date(sslExpiry);
                    const today = new Date();

                    if (!isNaN(SSLstartDate.getTime()) && !isNaN(SSLendDate.getTime())) {
                        if (SSLendDate < today) {
                            // The domain has expired. Please renew it.
                            $(rowNode).find('td:eq(4)').css('color', 'red').text('The SSL has expired.');
                        } else {
                            const difference = Math.abs(SSLendDate - SSLstartDate);
                            const differenceInDays = Math.ceil(difference / (1000 * 60 * 60 * 24));
                            // console.log(`Domian Name: ${domainName} startDate: ${sslRegister}, expiryDate: ${sslExpiry}, The SSl will expire in ${differenceInDays} days.`);

                            if (differenceInDays <= 30) {
                                // Apply red color and show relevant information
                                $(rowNode).find('td:eq(4)').css('color', 'red').html(`${formatDate(sslExpiry)}<br>${differenceInDays} days`);

                                // Create a Renew button
                                var renewButton = $('<button>').text('Renew').addClass('renew-button renew-mail btn btn-info');
                                // Append the Renew button to the last column
                                // console.log(renewButton);
                                $(this.node()).find('td:eq(8)').empty().append(renewButton);

                                // trigger a email to registered email-id
                                $.ajax({
                                    // url: "<?= base_url('sendRenewalEmail') ?>", // Update with your actual controller and method
                                    url: "sendRenewalEmail",
                                    type: 'POST',
                                    data: {
                                        'domainId': domainId
                                    },
                                    success: function (response) {
                                        // console.log('Email sent successfully');
                                    },
                                    error: function (error) {
                                        // console.error('Error sending email', error);
                                    }
                                });
                            }
                            else {
                                $(this.node()).find('td:eq(8)');
                            }
                        }
                    }
                }
                // End of SSL

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
            // url: "<?= base_url('edit') ?>",
            url: "edit",
            data: {
                'domainID': id
            },
            success: function (response) {
                // console.log(response);
                var DomainName = response.domain.domain_name;
                var DomainExpiry = response.domain.domain_expiry;
                var DomainRegestration = response.domain.domain_register;
                var HostingRegister = response.domain.hosting_register;
                var HostingExpiry = response.domain.hosting_expiry;
                var sslRegister = response.domain.ssl_register;
                var sslExpiry = response.domain.ssl_expiry;
                // console.log(DomainName); 
                $('#RdomainName').val(DomainName);
                $('#domain_regs').val(DomainRegestration);
                // console.log(domReg);
                $('#domain_exp').val(DomainExpiry);
                $('#hosting_regs').val(HostingRegister);
                $('#hosting_exp').val(HostingExpiry);
                $('#ssl_regs').val(sslRegister);
                $('#ssl_exp').val(sslExpiry);

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
            'hosting_regs': $('#hosting_regs').val(),
            'hosting_exp': $('#hosting_exp').val(),
            'ssl_regs': $('#ssl_regs').val(),
            'ssl_exp': $('#ssl_exp').val(),
        };
        // console.log(data); // Log data before sending
        $.ajax({
            method: "POST",
            // url: "<?= base_url('update_data') ?>",
            url: "update_data",
            data: data,
            success: function (response) {
                $('#renewModal').modal('hide');
                // console.log(response.status);
                alert(response.message);
            }
        });
    });
});