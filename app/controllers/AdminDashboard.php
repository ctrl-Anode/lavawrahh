<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AdminDashboard extends Controller {

    public function __construct() {
        parent::__construct();
        
        // Load required libraries
        $this->call->library('lauth');
        $this->call->library('session');
        
        // Check if admin is logged in
        if (!$this->lauth->is_logged_in()) {
            redirect('auth/login');
        }
        
        // Load admin model
        $this->call->model('Admin_model');
    }

    public function index() {
        // Get statistics
        $data['total_users'] = $this->Admin_model->get_total_users();
        $data['total_classes'] = $this->Admin_model->get_total_classes();
        $data['total_bookings'] = $this->Admin_model->get_total_bookings();
        $data['active_memberships'] = $this->Admin_model->get_active_memberships();
        
        // Get lists
        $data['recent_memberships'] = $this->Admin_model->get_recent_memberships();
        $data['recent_bookings'] = $this->Admin_model->get_recent_bookings();
        
        // Get monthly stats
        $data['new_users_this_month'] = $this->Admin_model->get_new_users_this_month();
        $data['new_bookings_this_month'] = $this->Admin_model->get_new_bookings_this_month();
        
        // Pass session object to view
        $data['session'] = $this->session;
        
        // Load the dashboard view
        $this->call->view('admin_dashboard', $data);
    }

    public function manage_bookings() {
        $data['bookings'] = $this->Admin_model->get_all_booked_classes();
        $data['session'] = $this->session;
        $this->call->view('admin/manage_booked_classes', $data);
    }

    public function update_booking_status() {
        $booking_id = $this->io->post('booking_id');
        $status = $this->io->post('status');
        
        if ($this->Admin_model->update_booking_status($booking_id, $status)) {
            $this->session->set_flashdata('success', 'Booking status updated successfully');
        } else {
            $this->session->set_flashdata('error', 'Failed to update booking status');
        }
        
        redirect('admin/bookings');
    }

    public function delete_booking($booking_id) {
        if ($this->Admin_model->delete_booking($booking_id)) {
            $this->session->set_flashdata('success', 'Booking deleted successfully');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete booking');
        }
        
        redirect('admin/bookings');
    }
}
?>
