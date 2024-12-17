<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserDashboard extends Controller {

    public function __construct() {
        parent::__construct();
        
        // Check if user is logged in
        $this->call->library('lauth');
        if (!$this->lauth->user_is_logged_in()) {
            redirect('user');
        }
        
        // Load required models
        $this->call->model('User_model');
        $this->call->model('Classes_model');
        $this->call->model('Memberships_model');
        $this->call->library('session');
    }

    public function index() {
        $user_id = $this->session->userdata('user_id');
        
        // Get user profile information
        $data['user'] = $this->User_model->get_user($user_id);
        
        // Get active membership details
        $data['membership'] = $this->User_model->get_active_membership($user_id);
        
        if ($data['membership']) {
            // Calculate membership status
            $start_date = new DateTime($data['membership']['start_date']);
            $duration = $data['membership']['duration_months'];
            $end_date = clone $start_date;
            $end_date->modify("+{$duration} months");
            $now = new DateTime();
            
            $data['membership_status'] = [
                'start_date' => $start_date->format('Y-m-d'),
                'end_date' => $end_date->format('Y-m-d'),
                'days_remaining' => $now < $end_date ? $now->diff($end_date)->days : 0,
                'is_active' => $now < $end_date,
                'total_days' => $start_date->diff($end_date)->days,
                'days_used' => $start_date->diff($now)->days
            ];
        }
        
        // Get user's booked classes
        $bookings = $this->Classes_model->get_user_bookings($user_id);
        $data['upcoming_classes'] = [];
        $data['completed_classes'] = [];
        $data['class_stats'] = [];
        
        if ($bookings) {
            $now = time();
            foreach ($bookings as $booking) {
                // Separate upcoming and completed classes
                if (strtotime($booking['schedule']) > $now) {
                    $data['upcoming_classes'][] = $booking;
                } else {
                    $data['completed_classes'][] = $booking;
                }
                
                // Calculate class statistics
                $type = $booking['type'];
                if (!isset($data['class_stats'][$type])) {
                    $data['class_stats'][$type] = [
                        'total' => 0,
                        'upcoming' => 0,
                        'completed' => 0
                    ];
                }
                $data['class_stats'][$type]['total']++;
                if (strtotime($booking['schedule']) > $now) {
                    $data['class_stats'][$type]['upcoming']++;
                } else {
                    $data['class_stats'][$type]['completed']++;
                }
            }
        }
        
        // Sort upcoming classes by schedule
        if (!empty($data['upcoming_classes'])) {
            usort($data['upcoming_classes'], function($a, $b) {
                return strtotime($a['schedule']) - strtotime($b['schedule']);
            });
        }
        
        // Get recent activities (last 5 bookings)
        $data['recent_activities'] = array_slice($bookings, 0, 5);
        
        // Calculate summary statistics
        $data['summary'] = [
            'total_classes_booked' => count($bookings),
            'upcoming_classes' => count($data['upcoming_classes']),
            'completed_classes' => count($data['completed_classes']),
            'class_types_attended' => count($data['class_stats'])
        ];
        
        $this->call->view('user_dashboard', $data);
    }
}
?>
