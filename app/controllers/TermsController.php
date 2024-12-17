<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class TermsController extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->call->model('terms_model');
    }

    public function read()
    {
        $userdata['terms'] = $this->terms_model->read();
        $this->call->view('terms/view_terms', $userdata);
    }

    public function create()
    {
        if ($this->form_validation->submitted()) {
            // Debugging output to check incoming POST data
            error_log(print_r($_POST, true)); // Debugging output
            $this->form_validation
                ->name('text')->required('Term text is required!')
                ->name('status')->required('Status is required!');

            if ($this->form_validation->run()) {
                $text = $this->io->post('text');
                $status = $this->io->post('status');

                if ($this->terms_model->create($text, $status)) {
                    set_flash_alert('success', 'Term was added successfully!');
                    redirect('auth/terms/display');
                }
            } else {
                set_flash_alert('danger', $this->form_validation->errors());
                redirect('auth/terms/create');
            }
        }
        $this->call->view('terms/add_terms');
    }

    public function update($id)
    {
        if ($this->form_validation->submitted()) {
            $this->form_validation
                ->name('text')->required('Term text is required!')
                ->name('status')->required('Status is required!');

            if ($this->form_validation->run()) {
                $data = [
                    'text' => $this->io->post('text'),
                    'status' => $this->io->post('status'),
                ];

                if ($this->terms_model->update($id, $data)) {
                    set_flash_alert('success', 'Term data was updated successfully!');
                    redirect('auth/terms/display');
                } else {
                    set_flash_alert('danger', 'Failed to update term data.');
                    redirect('auth/terms/display');
                }
            } else {
                set_flash_alert('danger', $this->form_validation->errors());
                redirect('auth/terms/display');
            }
        }

        $userdata['term'] = $this->terms_model->get_one($id);
        $this->call->view('terms/edit_terms', $userdata);
    }

    public function delete($id)
    {
        if ($this->terms_model->delete($id)) {
            set_flash_alert('success', 'Term data was deleted successfully!');
            redirect('auth/terms/display');
        } else {
            set_flash_alert('danger', 'Something went wrong!');
            redirect('auth/terms/display');
        }
    }
}
?>
