<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ClassesController extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->call->model('Classes_model');
        $this->call->library('lauth');
    }

    public function read()
    {
        $userdata['classes'] = $this->Classes_model->read();
        $this->call->view('gymclasses/view_class', $userdata);
    }

    public function create()
    {
        if ($this->form_validation->submitted()) {
            $this->form_validation
                ->name('type')->required('Class type is required!')
                ->name('description')->required('Description is required!')
                ->name('duration_minutes')->required('Duration is required!')
                ->name('price')->required('Price is required!')
                ->name('instructor')->required('Instructor is required!')
                ->name('schedule')->required('Schedule is required!');

            if ($this->form_validation->run()) {
                $data = [
                    'type' => $this->io->post('type'),
                    'description' => $this->io->post('description'),
                    'duration_minutes' => $this->io->post('duration_minutes'),
                    'price' => $this->io->post('price'),
                    'instructor' => $this->io->post('instructor'),
                    'schedule' => $this->io->post('schedule'),
                ];

                if ($this->Classes_model->create(
                    $data['type'],
                    $data['description'],
                    $data['duration_minutes'],
                    $data['price'],
                    $data['instructor'],
                    $data['schedule']
                )) {
                    set_flash_alert('success', 'Class created successfully!');
                    redirect('auth/class/display');
                } else {
                    set_flash_alert('danger', 'Failed to create class.');
                }
            } else {
                set_flash_alert('danger', $this->form_validation->errors());
            }
        }
        $this->call->view('gymclasses/add_class');
    }

    public function update($id)
    {
        if ($this->form_validation->submitted()) {
            $this->form_validation
                ->name('type')->required('Class type is required!')
                ->name('description')->required('Description is required!')
                ->name('duration_minutes')->required('Duration is required!')
                ->name('price')->required('Price is required!')
                ->name('instructor')->required('Instructor is required!')
                ->name('schedule')->required('Schedule is required!');

            if ($this->form_validation->run()) {
                $data = [
                    'type' => $this->io->post('type'),
                    'description' => $this->io->post('description'),
                    'duration_minutes' => $this->io->post('duration_minutes'),
                    'price' => $this->io->post('price'),
                    'instructor' => $this->io->post('instructor'),
                    'schedule' => $this->io->post('schedule'),
                ];

                if ($this->Classes_model->update($id, $data)) {
                    set_flash_alert('success', 'Class updated successfully!');
                    redirect('auth/class/display');
                } else {
                    set_flash_alert('danger', 'Failed to update class.');
                }
            } else {
                set_flash_alert('danger', $this->form_validation->errors());
            }
        }

        $userdata['class'] = $this->Classes_model->get_one($id);
        $this->call->view('gymclasses/edit_class', $userdata);
    }

    public function class_manage()
    {
        $userdata['classes'] = $this->Classes_model->read();
        $this->call->view('gymclasses/manage_classes', $userdata);
    }

    public function delete($id)
    {
        if ($this->Classes_model->delete($id)) {
            set_flash_alert('success', 'Class deleted successfully!');
            redirect('auth/class/display');
        } else {
            set_flash_alert('danger', 'Failed to delete class.');
            redirect('auth/class/display');
        }
    }

    public function class_read()
    {
        $userdata['classes'] = $this->Classes_model->read();
        $this->call->view('gymclasses/avail_class', $userdata);
    }

    public function avail()
    {
        if (!$this->lauth->is_logged_in()) {
            redirect('auth/login');
        }

        if ($this->form_validation->submitted()) {
            $this->form_validation
                ->name('type')->required('Class type is required!')
                ->name('description')->required('Description is required!')
                ->name('duration_minutes')->required('Duration is required!')
                ->name('price')->required('Price is required!')
                ->name('instructor')->required('Instructor is required!')
                ->name('schedule')->required('Schedule is required!');

            if ($this->form_validation->run()) {
                $user_id = $this->lauth->get_user_id();
                $data = [
                    'type' => $this->io->post('type'),
                    'description' => $this->io->post('description'),
                    'duration_minutes' => $this->io->post('duration_minutes'),
                    'price' => $this->io->post('price'),
                    'instructor' => $this->io->post('instructor'),
                    'schedule' => $this->io->post('schedule')
                ];

                if ($this->Classes_model->avail(
                    $data['type'],
                    $data['description'],
                    $data['duration_minutes'],
                    $data['price'],
                    $data['instructor'],
                    $data['schedule']
                )) {
                    set_flash_alert('success', 'Class booked successfully!');
                } else {
                    set_flash_alert('danger', 'Failed to book class.');
                }
            } else {
                set_flash_alert('danger', $this->form_validation->errors());
            }
        }
        redirect('user/class/display');
    }
}
?>
