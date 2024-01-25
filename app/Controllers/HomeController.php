<?php

namespace App\Controllers;

use App\Libraries\Hash;

class HomeController extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }

    public function register()
    {
        if ($this->request->getMethod() == 'get') {
            return view('register');
        } elseif ($this->request->getMethod() == 'post') {
            $validation = $this->validate([
                // validation rules
                'username' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Your Name is required',
                    ]
                ],
                'email' => [
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => 'Your Email is required',
                        'valid_email' => 'You must enter a valid email'
                    ]
                ],
                'password' => [
                    'rules' => 'required|min_length[5]|max_length[10]',
                    'errors' => [
                        'required' => 'Password is required',
                        'min_length' => 'Password must have atleast 5 characters in length',
                        'max_length' => 'Password must not have more that 10 characters in length',
                    ]
                ],
                'confirmPassword' => [
                    'rules' => 'required|min_length[5]|max_length[10]|matches[password]',
                    'errors' => [
                        'required' => 'Confirm Password is required',
                        'min_length' => 'Password must have atleast 5 characters in length',
                        'max_length' => 'Password must not have more that 10 characters in length',
                        'matches' => 'Your password should be match with entered Password'
                    ]
                ],
            ]);

            // check validation condition
            if (!$validation) {
                $validation = \Config\Services::validation();
                $errors = $validation->getErrors();
                $message = ['status' => 'error', 'data' => 'Validate form', 'errors' => $errors];
                return $this->response->setJSON($message);
                // echo json_encode(['status' => 'error', 'data' => 'Validate form', 'errors' => $errors]);
            } else {
                // echo "form submit";
                $username = $this->request->getPost('username');
                $email = $this->request->getPost('email');
                $password = $this->request->getPost('password');

                $value = [
                    'username' => $username,
                    'email' => $email,
                    'password' => Hash::pass_enc($password)
                ];

                // calling model to submit data to database
                $registerModel = new \App\Models\RegisterModel();
                $query = $registerModel->insert($value);

                if (!$query) {
                    $message = ['status' => 'error', 'message' => 'Something went Wrong!'];
                    return $this->response->setJSON($message);
                } else {
                    $message = ['status' => 'success', 'message' => 'Data Added Successfully!'];
                    return $this->response->setJSON($message);
                }

                // echo json_encode(['status' => 'success', 'data' => 'Data Inserted Successfully', 'errors' => []]);
            }
        }
    }


    public function login()
    {
        if ($this->request->getMethod() == 'get') {
            return view('login');
        } elseif ($this->request->getMethod() == 'post') {
            $validation = $this->validate([
                'email' => [
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => 'Your Email is required',
                        'valid_email' => 'You must enter a valid email'
                    ]
                ],
                'password' => [
                    'rules' => 'required|min_length[5]|max_length[10]',
                    'errors' => [
                        'required' => 'Password is required',
                        'min_length' => 'Password must have atleast 5 characters in length',
                        'max_length' => 'Password must not have more that 10 characters in length',
                    ]
                ],
            ]);
            // check validation condition
            if (!$validation) {
                $validation = \Config\Services::validation();
                $errors = $validation->getErrors();
                $message = ['status' => 'error', 'data' => 'Validate form', 'errors' => $errors];
                return $this->response->setJSON($message);
                // echo json_encode(['status' => 'error', 'data' => 'Validate form', 'errors' => $errors]);
            } else {
                // echo "Login";
                $email = $this->request->getPost('email');
                $password = $this->request->getPost('password');

                // fetching databse to check user
                $loginModel = new \App\Models\RegisterModel();
                $user_data = $loginModel->where('email', $email)->first();
                $check_password = Hash::verify_pass($password, $user_data['password']);

                if (!$check_password) {
                    $message = ['status' => 'error', 'message' => 'You Entered wrong password!'];
                    return $this->response->setJSON($message);
                } else {
                    if (!is_null($user_data)) {
                        $session_data = [
                            'id' => $user_data['id'],
                            'username' => $user_data['username'],
                            'email' => $user_data['email'],
                            'loggedin' => 'loggedin'
                        ];
                        // filter data from database according to roles and send the user to their destination page 
                        session()->set($session_data);
                    }
                    $message = ['status' => 'success', 'message' => 'Logged in Successfully!'];
                    return $this->response->setJSON($message);
                    // return redirect()->to(base_url());
                }
            }
        }
    }

    public function logout()
    {
        session_unset();
        session()->destroy();
        return redirect()->to(base_url('login'));
    }

    public function domain_data()
    {
        $validationRules = [];
        $data = [];

        // Check if 'domain' checkbox is selected
        if ($this->request->getPost('domain_checkbox')) {
            $validationRules += [
                'domain_name' => [
                    'rules' => 'required',
                    'errors' => ['required' => 'Domain Name is required']
                ],
                'domain_expiry' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Domain Expiry Date is required',
                    ]
                ],
                'domain_cost' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Domain Cost is required',
                    ]
                ],
                'selling_cost' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Selling Cost is required',
                    ]
                ],
                'domain_provider' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Domain Provider is required',
                    ]
                ],
                'domain_register' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Domain Registration Date is required',
                    ]
                ],
                'email' => [
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => 'Email is required',
                        'valid_email' => 'You must enter a valid email',
                    ]
                ],
                'phone' => [
                    'rules' => 'required|numeric|max_length[10]|min_length[10]',
                    'errors' => [
                        'required' => 'Contact No. is required',
                        'numeric' => 'Your Contact No. must be a number',
                        'min_length' => 'Your Contact No. must have 10 digits number',
                        'max_length' => 'Your Contact No. must have 10 digits number'

                    ]
                ],
                'company_name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Company Name is required',
                    ]
                ],
                'domain_renew' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Domain Renewal Date is required',
                    ]
                ],
                'client_name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Client Name is required',
                    ]
                ],

            ];

            // Gather data for 'domain' checkbox
            $data['domain_name'] = $this->request->getPost('domain_name');
            $data['domain_cost'] = $this->request->getPost('domain_cost');
            $data['domain_provider'] = $this->request->getPost('domain_provider');
            $data['domain_expiry'] = $this->request->getPost('domain_expiry');
            $data['domain_register'] = $this->request->getPost('domain_register');
            $data['email'] = $this->request->getPost('email');
            $data['phone'] = $this->request->getPost('phone');
            $data['company_name'] = $this->request->getPost('company_name');
            $data['client_name'] = $this->request->getPost('client_name');
            $data['domain_renew'] = $this->request->getPost('domain_renew');
            $data['selling_cost'] = $this->request->getPost('selling_cost');
            // Collect other domain related fields here
        }

        // Check if 'hosting' checkbox is selected
        if ($this->request->getPost('hosting_checkbox')) {
            $validationRules += [
                'hosting_space' => [
                    'rules' => 'required',
                    'errors' => ['required' => 'Hosting Space is required']
                ],
                'hosting_expiry' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Hosting Expiry Date is required',
                    ]
                ],
                'hosting_register' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Hosting Register Date is required',
                    ]
                ],
                'hosting_cost' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Hosting Cost is required',
                    ]
                ],
            ];

            if (!($this->request->getPost('hosting_checkbox') && $this->request->getPost('domain_checkbox'))) {
                // Add domain name validation rules when SSL is not checked and hosting is checked
                $validationRules += [
                    'domainName' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Domain Name is required',
                        ]
                    ]
                ];
            }

            // Gather data for 'hosting' checkbox
            $data['hosting_space'] = $this->request->getPost('hosting_space');
            $data['hosting_expiry'] = $this->request->getPost('hosting_expiry');
            $data['hosting_cost'] = $this->request->getPost('hosting_cost');
            $data['hosting_register'] = $this->request->getPost('hosting_register');
            // Collect other hosting related fields here
        }

        // Check if 'ssl' checkbox is selected
        if ($this->request->getPost('ssl_checkbox')) {
            $validationRules += [
                'ssl_expiry' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'SSL Expiry date is required',
                    ]
                ],
                'ssl_register' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'SSL Register date is required',
                    ]
                ],
                'ssl_cost' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'SSL Cost is required',
                    ]
                ]
            ];
            // applicable only if domain not checked (no dependency over ssl)
            if (!$this->request->getPost('domain_checkbox')) {
                $validationRules += [
                    'domainName' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Domain Name is required',
                        ]
                    ]
                ];
            }
            // applicable only when domain and hosting not checked. If any one of them checked it will not be applicable			
            if (!$this->request->getPost('domain_checkbox') && !$this->request->getPost('hosting_checkbox')) {
                $validationRules += [
                    'Domain-Name' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Domain Name is required',
                        ]
                    ]
                ];
            }

            // Gather data for 'ssl' checkbox
            $data['ssl_register'] = $this->request->getPost('ssl_register');
            $data['ssl_expiry'] = $this->request->getPost('ssl_expiry');
            $data['ssl_cost'] = $this->request->getPost('ssl_cost');
            // Collect other ssl related fields here
        }

        // Apply validation rules
        $validation = $this->validate($validationRules);

        if (!$validation) {
            // echo "All feilds are Required";
            $validation = \Config\Services::validation();
            $errors = $validation->getErrors();
            $message = ['status' => 'error', 'data' => 'Validate form', 'errors' => $errors];
            return $this->response->setJSON($message);
            // echo json_encode(['status' => 'error', 'data' => 'Validate form', 'errors' => $errors]);
        } else {
            // echo "Form submit code"; 
            // echo json_encode(['status' => 'success', 'data' => 'Form submitted', 'errors' => []]);


            $dmnChk = $this->request->getPost('domain_checkbox');
            $hstChk = $this->request->getPost('hosting_checkbox');
            $sslChk = $this->request->getPost('ssl_checkbox');

            if ($dmnChk) {
                $data['domain_name'] = $this->request->getPost('domain_name');
            } else if ($hstChk || ($hstChk && $sslChk)) {
                $data['domain_name'] = $this->request->getPost('domainName');
            } else if ($sslChk) {
                $data['domain_name'] = $this->request->getPost('Domain-Name');
            }


            $domainModel = new \App\Models\DomainInfoModel();
            $query = $domainModel->insert($data);
            if (!$query) {
                $message = ['status' => 'error', 'message' => 'Something went Wrong!'];
                return $this->response->setJSON($message);
            } else {
                $message = ['status' => 'success', 'message' => 'Data Added Successfully!'];
                return $this->response->setJSON($message);
            }
        }
    }


    public function retrive_data()
    {
        $fetchData = new \App\Models\DomainInfoModel();
        // $data['domain'] = $fetchData->findAll();

        $draw = $_POST['draw'];
        $start = $_POST['start'];
        $length = $_POST['length'];
        $data['domain'] = $fetchData->findAll($length, $start);
        $associativeArray = [];

        foreach ($data['domain'] as $row) {
            // $tmp = array();
            // // Assuming your table has columns like 'id', 'domain_name', 'domain_expiry', etc.
            // $tmp[] = $row['id'];
            // $tmp[] = $row['domain_name'];

            // $element = 
            // $elment.= 

            // $tmp[] = $elment;

            $associativeArray[] = array(
                0 => $row['id'],
                1 => $row['domain_name'],
                2 => $row['domain_expiry'],
                3 => $row['hosting_expiry'],
                4 => $row['ssl_expiry'],
                5 => $row['phone'],
                6 => $row['client_name'],
                7 => $row['email'],
                8 => '<a href="#" data-bs-toggle="modal" data-bs-target="#viewModal" class="view">View</a>',
                9 => $row['domain_register'],
                10 => $row['hosting_register'],
                11 => $row['ssl_register'],
            );
        }

        $output = array(
            // "draw"              =>  intval($_POST["draw"]),
            "draw" => intval($draw),
            // "recordsTotal"      =>  count($associativeArray),
            // "recordsFiltered"   =>  count($associativeArray),
            "recordsTotal" => $fetchData->countAll(),
            "recordsFiltered" => $fetchData->countAll(),
            "data" => $associativeArray // ur data array here
        );
        echo json_encode($output);

    }


    public function view_data()
    {
        try {
            $view_data = new \App\Models\DomainInfoModel();
            $domainId = $this->request->getPost('domainId');
            $data['domainInfo'] = $view_data->find($domainId);
            return $this->response->setJSON($data);
        } catch (\Exception $e) {
            log_message('error', 'Error in view_data: ' . $e->getMessage());
            return $this->response->setStatusCode(500)->setJSON(['error' => 'Internal Server Error']);
        }
    }

    public function edit()
    {
        $edit_data = new \App\Models\DomainInfoModel();
        $domainId = $this->request->getPost('domainID');
        $data['domain'] = $edit_data->find($domainId);
        return $this->response->setJSON($data);
    }

    public function update_data()
    {
        $update_data = new \App\Models\DomainInfoModel();
        $domainId = $this->request->getPost('id');
        $data = [
            // 'domain_name' => $this->request->getPost('RdomainName'),
            'domain_register' => $this->request->getPost('domain_regs'),
            'domain_expiry' => $this->request->getPost('domain_exp'),
            'hosting_register' => $this->request->getPost('hosting_regs'),
            'hosting_expiry ' => $this->request->getPost('hosting_exp'),
            'ssl_register ' => $this->request->getPost('ssl_regs'),
            'ssl_expiry ' => $this->request->getPost('ssl_exp'),
        ];
        // / Debugging: Check data before update
        // var_dump($data);
        // print_r($_POST); 
        $result = $update_data->update($domainId, $data);
        // echo $update_data->getLastQuery();
        // Debugging: Check the result of the update operation
        // var_dump($result);
        if (!$result) {
            $message = ['status' => 'error', 'message' => "Something went Wrong!"];
            return $this->response->setJSON($message);
        } else {
            $message = ['status' => 'success', 'message' => "Data Updated Successfully!"];
            return $this->response->setJSON($message);
        }

    }

    public function sendRenewalEmail()
    {
        $email = new \App\Models\DomainInfoModel();
        $domainId = $this->request->getPost('domainId');
        $data = $email->find($domainId);
        // print_r($data);
        try {
            // initalise the value and fetching the array data
            $domainName = $data['domain_name'];
            $domainExpiry = strtotime($data['domain_expiry']);
            $domainRegisterDate = strtotime($data['domain_register']);
            $domainEmail = $data['email'];

            $hostingRegisterDate = strtotime($data['hosting_register']);
            $hostingExpiry = strtotime($data['hosting_expiry']);
            $hostingEmail = $data['email'];

            $sslRegisterDate = strtotime($data['ssl_register']);
            $sslExpiry = strtotime($data['ssl_expiry']);
            $sslEmail = $data['email'];

            $dmnExpDiff = $domainExpiry - $domainRegisterDate;
            $hstExpDiff = $hostingExpiry - $hostingRegisterDate;
            $sslExpDiff = $sslExpiry - $sslRegisterDate;

            $email = \Config\Services::email();

            // send mail according to their condition meet
            if (!empty($domainRegisterDate) && !empty($domainExpiry)) {
                if ($dmnExpDiff <= 30 * 24 * 60 * 60) {
                    $email->setFrom('saxenaaditi525@gmail.com', 'Savithru Technologies');
                    $email->setTo($domainEmail);
                    $email->setSubject('Domain Subscription Expiry');

                    $message = "Hello,<br><br>Your domain subscription: $domainName is expiring soon. Please renew before the expiry date: $data[domain_expiry].<br>Domain Registered on this date: $data[domain_register].<br><br>Thank you.<br>Savithru Technologies";

                    $email->setMessage($message);

                    // Send the email
                    if ($email->send()) {
                        echo 'Domain Email sent successfully';
                    } else {
                        echo 'Domain Email failed to send';
                        print_r($email->printDebugger(['headers']));
                    }
                }
            }

            if (!empty($hostingRegisterDate) && !empty($hostingExpiry)) {
                if ($hstExpDiff <= 30 * 24 * 60 * 60) {
                    $email->setFrom('saxenaaditi525@gmail.com', 'Savithru Technologies');
                    $email->setTo($hostingEmail);
                    $email->setSubject('Hosting Subscription Expiry');

                    $message = "Hello,<br><br>Your Hosting subscription: $domainName is expiring soon. Please renew before the expiry date: $data[hosting_expiry].<br>Hosting Registered on this date: $data[hosting_register].<br><br>Thank you.<br>Savithru Technologies";

                    $email->setMessage($message);

                    // Send the email
                    if ($email->send()) {
                        echo 'Hosting Email sent successfully';
                    } else {
                        echo 'Hosting Email failed to send';
                        print_r($email->printDebugger(['headers']));
                    }
                }
            }

            if (!empty($sslRegisterDate) && !empty($sslExpiry)) {
                if ($sslExpDiff <= 30 * 24 * 60 * 60) {
                    $email->setFrom('saxenaaditi525@gmail.com', 'Savithru Technologies');
                    $email->setTo($sslEmail);
                    $email->setSubject('SSL Subscription Expiry');

                    $message = "Hello,<br><br>Your SSL subscription: $domainName is expiring soon. Please renew before the expiry date: $data[ssl_expiry].<br>SSL Registered on this date: $data[ssl_register].<br><br>Thank you.<br>Savithru Technologies";

                    $email->setMessage($message);

                    // Send the email
                    if ($email->send()) {
                        echo 'SSL Email sent successfully';
                    } else {
                        echo 'SSL Email failed to send';
                        print_r($email->printDebugger(['headers']));
                    }
                }
            }
        } catch (\Exception $e) {
            echo 'Caught exception: ', $e->getMessage();
        }

    }

    public function fetchDataBetweenDays()
    {
        $startDate = $this->request->getGet('startDate');
        $endDate = $this->request->getGet('endDate');

        // log_message('debug', 'Received startDate: ' . $startDate);
        // log_message('debug', 'Received endDate: ' . $endDate);

        // Your existing code to fetch data from the model
        $fetchDate = new \App\Models\DomainInfoModel();
        $data = $fetchDate->getDataBetweenDays($startDate, $endDate);

        // Print the data (for demonstration purposes, you can format and display it as needed)
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        // Send the data as JSON response
        return $this->response->setJSON($data);
    }


}

