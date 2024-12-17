<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserDashboard extends Controller {

    public function __construct() {
        parent::__construct();
        
        if(! logged_in()) {
            redirect('user');
        }
        
        $this->call->model('User_model');
        $this->call->model('Classes_model');
        $this->call->model('Memberships_model');
        $this->call->library('session');
    }

    public function index() {
        $user_id = $this->session->userdata('user_id');
        
        // Get user information
        $data['user'] = $this->User_model->get_user($user_id);
        
        // Get active membership
        $data['membership'] = $this->User_model->get_active_membership($user_id);
        
        // Get upcoming classes
        $data['upcoming_classes'] = $this->Classes_model->get_user_bookings($user_id);
        
        // Get class statistics
        $bookings = $this->Classes_model->get_user_bookings($user_id);
        $data['class_stats'] = array();
        
        if ($bookings) {
            foreach ($bookings as $booking) {
                $type = $booking['type'];
                if (!isset($data['class_stats'][$type])) {
                    $data['class_stats'][$type] = 0;
                }
                $data['class_stats'][$type]++;
            }
        }
        
        $this->call->view('user_dashboard', $data);
    }
}
?>
