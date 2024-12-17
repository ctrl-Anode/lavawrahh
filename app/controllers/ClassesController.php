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

    public function scheduled_classes()
    {
        if (!$this->lauth->is_logged_in()) {
            redirect('auth/login');
        }

        $user_id = $this->lauth->get_user_id();
        $userdata['scheduled_classes'] = $this->Classes_model->get_user_bookings($user_id);
        $this->call->view('user/scheduled_classes', $userdata);
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
        $classes = $this->Classes_model->read();
        $userdata['classes'] = is_array($classes) ? $classes : array();
        $this->call->view('gymclasses/manage_classes', $userdata);
    }

    public function class_manage()
    {
        if (!$this->lauth->is_logged_in()) {
            redirect('auth/login');
        }
        
        $user_id = $this->lauth->get_user_id();
        $userdata['bookings'] = $this->Classes_model->get_user_bookings($user_id);
        
        // Load user template views
        $this->call->view('templates/usersidebar');
        $this->call->view('user/booked_class_manage', $userdata);
    }

    public function cancel_booking($booking_id)
    {
        if (!$this->lauth->is_logged_in()) {
            redirect('auth/login');
        }

        $user_id = $this->lauth->get_user_id();
        
        // Verify the booking belongs to the user
        $booking = $this->Classes_model->get_booking($booking_id, $user_id);
        
        if ($booking && $this->Classes_model->cancel_booking($booking_id, $user_id)) {
            set_flash_alert('success', 'Class booking cancelled successfully.');
        } else {
            set_flash_alert('danger', 'Failed to cancel class booking.');
        }
        
        redirect('user/booked_classes');
    }

    public function avail()
    {
        if (!$this->lauth->is_logged_in()) {
            redirect('auth/login');
        }

        if ($this->form_validation->submitted()) {
            $this->form_validation
                ->name('id')
                ->required('Please select a class to book.');

            if ($this->form_validation->run()) {
                try {
                    $user_id = $this->lauth->get_user_id();
                    $class_id = intval($this->io->post('id'));
                    
                    if ($class_id <= 0) {
                        throw new Exception('Invalid class ID.');
                    }

                    // Get class details first to verify it exists
                    $class = $this->Classes_model->get_one($class_id);
                    if (!$class) {
                        throw new Exception('Class not found.');
                    }

                    if ($this->Classes_model->avail($class_id, $user_id)) {
                        set_flash_alert('success', 'Class booked successfully!');
                    } else {
                        set_flash_alert('danger', 'Failed to book class.');
                    }
                } catch (Exception $e) {
                    set_flash_alert('danger', $e->getMessage());
                }
            } else {
                set_flash_alert('danger', $this->form_validation->errors());
            }
        } else {
            set_flash_alert('danger', 'Invalid form submission.');
        }
        
        redirect('user/class/display');
    }
}?>
