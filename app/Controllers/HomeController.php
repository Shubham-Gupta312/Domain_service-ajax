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
            // $data['domainName'] = $this->request->getPost('domainName');
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
            // $data['domain-Name'] = $this->request->getPost('domain-Name');
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
        $data['domain'] = $fetchData->findAll();
        return $this->response->setJSON($data);
    }

    public function view_data()
    {
        $view_data = new \App\Models\DomainInfoModel();
        $domainId = $this->request->getPost('domainId');
        $data['domainInfo'] = $view_data->find($domainId);
        return $this->response->setJSON($data);
    }

    public function update()
    {
        echo "Update Function";
    }
}

