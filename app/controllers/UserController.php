<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserController extends Controller {
    public function __construct()
    {
        parent:: __construct();
        $this->call->model('user_model');
    }

    public function user_read()
    {
        $userdata['users'] = $this->user_model->read();
        $this->call->view('user/user_manage', $userdata);
    }

    public function update($id)
    {
        if ($this->form_validation->submitted()) {
            $this->form_validation
                ->name('first_name')->required('First name is required!')
                ->name('last_name')->required('Last name is required!')
                ->name('username')->required('Username is required!')
                ->name('contact')->required('Contact is required!')
                ->name('gender')->required('Gender is required!')
                ->name('address')->required('Address is required!')
                ->name('email')->required('Email is required!');

            if ($this->form_validation->run()) {
                $data = [
                    'first_name' => $this->io->post('first_name'),
                    'middle_name' => $this->io->post('middle_name'),
                    'last_name' => $this->io->post('last_name'),
                    'username' => $this->io->post('username'),
                    'contact' => $this->io->post('contact'),
                    'gender' => $this->io->post('gender'),
                    'address' => $this->io->post('address'),
                    'email' => $this->io->post('email')
                ];

                if ($this->user_model->update_user($id, $data)) {
                    set_flash_alert('success', 'User data was updated successfully!');
                    redirect('auth/user/manage');
                } else {
                    set_flash_alert('danger', 'Failed to update user data.');
                    redirect('auth/user/manage');
                }
            } else {
                set_flash_alert('danger', $this->form_validation->errors());
                redirect('auth/user/manage');
            }
        }

        $userdata['user'] = $this->user_model->get_user($id);
        $this->call->view('user/edit_user', $userdata);
    }

    public function user_delete($id)
    {
        if($this->user_model->delete($id)){
            set_flash_alert('success', 'User was deleted successfully!');
            redirect('auth/user/manage');
        } else {
            set_flash_alert('danger', 'Something went wrong!');
            redirect('auth/user/manage');
        }
    }

    public function profile()
    {
        $this->call->library('lauth');
        
        if (!$this->lauth->is_logged_in()) {
            redirect('auth/login');
        }

        $user_id = $this->lauth->get_user_id();
        $data['user'] = $this->user_model->get_user($user_id);
        $data['active_membership'] = $this->user_model->get_active_membership($user_id);
        $this->call->view('user/profile_new', $data);
    }

    public function update_profile()
    {
        $this->call->library('lauth');
        
        if (!$this->lauth->is_logged_in()) {
            redirect('auth/login');
        }

        if ($this->form_validation->submitted()) {
            $this->form_validation
                ->name('first_name')->required('First name is required!')
                ->name('last_name')->required('Last name is required!')
                ->name('username')->required('Username is required!')
                ->name('contact')->required('Contact is required!')
                ->name('gender')->required('Gender is required!')
                ->name('address')->required('Address is required!')
                ->name('email')->required('Email is required!');

            if ($this->form_validation->run()) {
                $user_id = $this->lauth->get_user_id();
                $data = [
                    'first_name' => $this->io->post('first_name'),
                    'middle_name' => $this->io->post('middle_name'),
                    'last_name' => $this->io->post('last_name'),
                    'username' => $this->io->post('username'),
                    'contact' => $this->io->post('contact'),
                    'gender' => $this->io->post('gender'),
                    'address' => $this->io->post('address'),
                    'email' => $this->io->post('email'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                if ($this->user_model->update_user($user_id, $data)) {
                    set_flash_alert('success', 'Profile updated successfully!');
                } else {
                    set_flash_alert('danger', 'Failed to update profile.');
                }
            } else {
                set_flash_alert('danger', $this->form_validation->errors());
            }
        }

        redirect('user/profile');
    }
}
?>
