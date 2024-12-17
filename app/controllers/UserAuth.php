<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserAuth extends Controller {

    public function __construct()
    {
        parent::__construct();
        if (segment(2) != 'logout' && logged_in()) {
            redirect('dashboard');
        }
        $this->call->library('email');
    }
    
    public function index() {
        $this->call->view('user/user_login');
    }  

    public function user_login() {
        if ($this->form_validation->submitted()) {
            $username = $this->io->post('uname');
            $email = $this->io->post('email');
            $password = $this->io->post('password');

            // Ensure only one credential is used: username or email
            $data = $this->lauth->user_login($username, $email, $password);

            if (empty($data)) {
                $this->session->set_flashdata([
                    'is_invalid' => 'is-invalid',
                    'err_message' => 'These credentials do not match our records.'
                ]);
                redirect('user/user_login');
            } else {
                $this->lauth->user_set_logged_in($data);
                redirect('dashboard');
            }
        } else {
            $this->call->view('user/user_login');
        }
    }
    public function user_register() {

        if($this->form_validation->submitted()) {
            $fname = $this->io->post('fname');
            $mname = $this->io->post('mname');
            $lname = $this->io->post('lname');
            $username = $this->io->post('uname');
            $contact = $this->io->post('contact');
            $gender = $this->io->post('gender');
            $address = $this->io->post('address');
            $email = $this->io->post('email');
			$email_token = bin2hex(random_bytes(50));
            $this->form_validation
            ->name('fname')->required('First name is required!')
                ->name('mname')->required('Middle name is required!')
                ->name('lname')->required('Last name is required!')
                ->name('uname')->required('username is required!')
                ->name('uname')
                    ->required()
                    ->is_unique('user_info', 'username', $username, 'Username was already taken.')
                    ->min_length(5, 'Username must not be less than 5 characters.')
                    ->max_length(20, 'Username must not be more than 20 characters.')
                    ->alpha_numeric_dash('Special characters are not allowed in username.')
                ->name('contact')
                    ->required('Contact number is required!')
                    ->pattern('int', 'Contact number must contain only digits.')
                    ->min_length(10, 'Contact number must be at least 10 digits.')
                    ->max_length(15, 'Contact number must not exceed 15 digits.')
                ->name('gender')
                    ->required('Gender is required!')
                    ->in_list('male,female,other', 'Gender must be male, female, or other.')
                ->name('address')
                    ->required('Address is required!')
                    ->min_length(10, 'Address must not be less than 10 characters.')
                ->name('email')
                    ->required()
                    ->is_unique('user_info', 'email', $email, 'Email was already taken.')
                ->name('password')
                    ->required()
                    //->min_length(8, 'Password must not be less than 8 characters.')
                ->name('password_confirmation')
                    ->required()
                    //->min_length(8, 'Password confirmation name must not be less than 8 characters.')
                    ->matches('password', 'Passwords did not match.');
                if($this->form_validation->run()) {
                    if($this->lauth->user_register($fname,$mname,$lname,$username,$contact,$gender,$address, $email, $this->io->post('password'), $email_token)) {
                        $data = $this->lauth->user_login($username,$email, $this->io->post('password'));
                        $this->lauth->user_set_logged_in($data);
                        redirect('/dashboard');
                    } else {
                        set_flash_alert('danger', config_item('SQLError'));
                    }
                }  else {
                    set_flash_alert('danger', $this->form_validation->errors()); 
                    redirect('user/user_register');
                }
        } else {
            $this->call->view('user/user_register');
        }
        
    }
    
    public function user_read($id) {
        $user = $this->lauth->get_user($id);
    
        if ($user) {
            $this->call->view('user/user_list', ['user' => $user]);
        } else {
            set_flash_alert('danger', 'User not found.');
            redirect('user/user_list');
        }
    }
    
    public function user_update($id) {
        if ($this->form_validation->submitted()) {
            $update_data = [
                'first_name' => $this->io->post('fname'),
                'middle_name' => $this->io->post('mname'),
                'last_name' => $this->io->post('lname'),
                'username' => $this->io->post('uname'),
                'contact' => $this->io->post('contact'),
                'gender' => $this->io->post('gender'),
                'address' => $this->io->post('address'),
                'email' => $this->io->post('email'),
            ];
    
            $this->form_validation
            ->name('fname')->required('First name is required!')
            ->name('mname')->required('Middle name is required!')
            ->name('lname')->required('Last name is required!')
            ->name('uname')->required()
                ->is_unique('user_info', 'username', $update_data['uname'], 'Username was already taken.')
                ->min_length(5, 'Username must not be less than 5 characters.')
                ->max_length(20, 'Username must not be more than 20 characters.')
                ->alpha_numeric_dash('Special characters are not allowed in the username.')
            ->name('contact')->required('Contact number is required!')
                ->pattern('int', 'Contact number must contain only digits.')
                ->min_length(10, 'Contact number must be at least 10 digits.')
                ->max_length(15, 'Contact number must not exceed 15 digits.')
            ->name('gender')->required('Gender is required!')
                ->in_list('male,female,other', 'Gender must be male, female, or other.')
            ->name('address')->required('Address is required!')
                ->min_length(10, 'Address must not be less than 10 characters.')
            ->name('email')->required()->valid_email();
    
            if ($this->form_validation->run()) {
                if ($this->lauth->update_user($id, $update_data)) {
                    set_flash_alert('success', 'User updated successfully.');
                    redirect('user/user_view/' . $id);
                } else {
                    set_flash_alert('danger', config_item('SQLError'));
                }
            } else {
                set_flash_alert('danger', $this->form_validation->errors());
            }
        } else {
            $user = $this->lauth->get_user($id);
            if ($user) {
                $this->call->view('user/user_edit', ['user' => $user]);
            } else {
                set_flash_alert('danger', 'User not found.');
                redirect('user/user_list');
            }
        }
    }
    public function user_delete($id) {
        if ($this->lauth->delete_user($id)) {
            set_flash_alert('success', 'User deleted successfully.');
        } else {
            set_flash_alert('danger', config_item('SQLError'));
        }
        redirect('user/user_list');
    }
    
    
    private function send_password_token_to_email($email, $token) {
		$template = file_get_contents(ROOT_DIR.PUBLIC_DIR.'/templates/reset_password_email.html');
		$search = array('{token}', '{base_url}');
		$replace = array($token, base_url());
		$template = str_replace($search, $replace, $template);
		$this->email->recipient($email);
		$this->email->subject('Perfect Fitness Gym Reset Password'); //change based on subject
		$this->email->sender('pfitnessgym@email.com'); //change based on sender email
		$this->email->reply_to('pfitnessgym@email.com'); // change based on sender email
		$this->email->email_content($template, 'html');
		$this->email->send();
	}

	public function password_reset() {
		if($this->form_validation->submitted()) {
			$email = $this->io->post('email');
			$this->form_validation
				->name('email')->required()->valid_email();
			if($this->form_validation->run()) {
				if($token = $this->lauth->user_reset_password($email)) {
					$this->send_password_token_to_email($email, $token);
                    $this->session->set_flashdata(['alert' => 'is-valid']);
				} else {
					$this->session->set_flashdata(['alert' => 'is-invalid']);
				}
			} else {
				set_flash_alert('danger', $this->form_validation->errors());
			}
		}
		$this->call->view('user/user_password_reset');
	}

    public function set_new_password() {
        if($this->form_validation->submitted()) {
            $token = $this->io->post('token');
			if(isset($token) && !empty($token)) {
				$password = $this->io->post('password');
				$this->form_validation
					->name('password')
						->required()
						->min_length(8, 'New password must be atleast 8 characters.')
					->name('re_password')
						->required()
						->min_length(8, 'Retype password must be atleast 8 characters.')
						->matches('password', 'Passwords did not matched.');
						if($this->form_validation->run()) {
							if($this->lauth->user_reset_password_now($token, $password)) {
								set_flash_alert('success', 'Password was successfully updated.');
							} else {
								set_flash_alert('danger', config_item('SQLError'));
							}
						} else {
							set_flash_alert('danger', $this->form_validation->errors());
						}
			} else {
				set_flash_alert('danger', 'Reset token is missing.');
			}
    	redirect('user/user_set-new-password/?token='.$token);
        } else {
             $token = $_GET['token'] ?? '';
            if(! $this->lauth->user_get_reset_password_token($token) && (! empty($token) || ! isset($token))) {
                set_flash_alert('danger', 'Invalid password reset token.');
            }
            $this->call->view('user/user_new_password');
        }
		
	}

    public function user_logout() {
        if ($this->lauth->user_set_logged_out()) {
            redirect('user/user_login');
        }
    }
    
}
?>
