<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class MembershipsController extends Controller {
    public function __construct()
    {
        parent:: __construct();
        $this->call->model('memberships_model');
    }

    public function read()
    {
        $userdata['memberships'] = $this->memberships_model->read();
        $this->call->view('membership/view_mem', $userdata);
    }

    public function apply()
    {
        if($this->form_validation->submitted()){
            $this->form_validation
                ->name('type')
                    ->required('Membership type is required!')
                ->name('price')
                    ->required('Price is required!')
                ->name('info')
                    ->required('Information is required!')
                ->name('duration_months')
                    ->required('Duration is required!');

            if($this->form_validation->run()){
                $type = $this->io->post('type');
                $price = $this->io->post('price');
                $info = $this->io->post('info');
                $duration_months = $this->io->post('duration_months');

                if($this->memberships_model->apply($type, $price, $info, $duration_months)){
                    set_flash_alert('success', 'Membership Application successful!');
                    redirect('auth/memberships/display');
                }
            } else {
                set_flash_alert('danger', $this->form_validation->errors());
                redirect('auth/memberships/apply');
            }
        }
        $this->call->view('membership/add_mem');
    }

    public function update($id)
    {
        if ($this->form_validation->submitted()) {
            $this->form_validation
                ->name('type')
                    ->required('Membership type is required!')
                ->name('price')
                    ->required('Price is required!')
                ->name('info')
                    ->required('Information is required!')
                ->name('duration_months')
                    ->required('Duration is required!')
                ->name('status')
                    ->required('Status is required!');

            if ($this->form_validation->run()) {
                $data = [
                    'type' => $this->io->post('type'),
                    'price' => $this->io->post('price'),
                    'info' => $this->io->post('info'),
                    'duration_months' => $this->io->post('duration_months'),
                    'status' => $this->io->post('status')
                ];

                if ($this->memberships_model->update($id, $data)) {
                    set_flash_alert('success', 'Membership was updated successfully!');
                    redirect('auth/memberships/display');
                } else {
                    set_flash_alert('danger', 'Failed to update membership.');
                    redirect('auth/memberships/display');
                }
            } else {
                set_flash_alert('danger', $this->form_validation->errors());
                redirect('auth/memberships/display');
            }
        }

        $userdata['membership'] = $this->memberships_model->get_one($id);
        $this->call->view('membership/edit_mem', $userdata);
    }

    public function delete($id){
        if($this->memberships_model->delete($id)){
            set_flash_alert('success', 'Membership was deleted successfully!');
            redirect('auth/memberships/display');
        } else {
            set_flash_alert('danger', 'Something went wrong!');
            redirect('auth/memberships/display');
        }
    }

    public function mem_read()
    {
        $userdata['memberships'] = $this->memberships_model->read();
        $this->call->view('membership/avail_mem', $userdata);
    }

    public function avail()
    {
        if($this->form_validation->submitted()){
            $this->form_validation
                ->name('membership_id')
                    ->required('Please select a membership plan!');

            if($this->form_validation->run()){
                $user_id = $this->lauth->get_user_id();
                $membership_id = $this->io->post('membership_id');

                if($this->memberships_model->avail($user_id, $membership_id)){
                    set_flash_alert('success', 'Membership Application successful!');
                    redirect('user/memberships/display');
                }
            } else {
                set_flash_alert('danger', $this->form_validation->errors());
                redirect('user/memberships/display');
            }
        }
        $this->call->view('membership/avail_mem');
    }

    public function mem_delete($id){
        if($this->memberships_model->mem_delete($id)){
            set_flash_alert('success', 'Application was deleted successfully!');
            redirect('auth/user/applications/manage');
        } else {
            set_flash_alert('danger', 'Something went wrong!');
            redirect('auth/user/applications/manage');
        }
    }

    public function mem_manage()
    {
        $userdata['applications'] = $this->memberships_model->app_read();
        $this->call->view('user/mem_app_manage', $userdata);
    }

    public function user_mem()
    {
        $userdata['applications'] = $this->memberships_model->app_read();
        $this->call->view('user/profile', $userdata);
    }
}
?>
