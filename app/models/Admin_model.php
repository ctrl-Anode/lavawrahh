<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Admin_model extends Model {
    
    public function get_total_users() {
        $result = $this->db->table('user_info')
            ->select('COUNT(id) as count')
            ->get();
        return $result ? $result['count'] : 0;
    }
    
    public function get_total_classes() {
        $result = $this->db->table('classes')
            ->select('COUNT(id) as count')
            ->get();
        return $result ? $result['count'] : 0;
    }
    
    public function get_total_bookings() {
        $result = $this->db->table('class_bookings')
            ->select('COUNT(id) as count')
            ->get();
        return $result ? $result['count'] : 0;
    }
    
    public function get_recent_memberships() {
        return $this->db->table('user_memberships um')
            ->join('memberships m', 'm.id = um.membership_id')
            ->join('user_info u', 'u.id = um.user_id')
            ->select('um.start_date, m.type, m.duration_months, u.first_name, u.last_name')
            ->order_by('um.start_date', 'DESC')
            ->limit(5)
            ->get_all();
    }
    
    public function get_recent_bookings() {
        return $this->db->table('class_bookings cb')
            ->join('classes c', 'c.id = cb.class_id')
            ->join('user_info u', 'u.id = cb.user_id')
            ->select('cb.booking_date, c.type, c.schedule, u.first_name, u.last_name')
            ->order_by('cb.booking_date', 'DESC')
            ->limit(5)
            ->get_all();
    }
    
    public function get_new_users_this_month() {
        $first_day = date('Y-m-01 00:00:00');
        $result = $this->db->table('user_info')
            ->select('COUNT(id) as count')
            ->where('created_at >= "' . $first_day . '"')
            ->get();
        return $result ? $result['count'] : 0;
    }
    
    public function get_new_bookings_this_month() {
        $first_day = date('Y-m-01 00:00:00');
        $result = $this->db->table('class_bookings')
            ->select('COUNT(id) as count')
            ->where('booking_date >= "' . $first_day . '"')
            ->get();
        return $result ? $result['count'] : 0;
    }
    
    public function get_active_memberships() {
        $result = $this->db->table('user_memberships')
            ->select('COUNT(id) as count')
            ->get();
        return $result ? $result['count'] : 0;
    }

    // New methods for managing booked classes
    public function get_all_booked_classes() {
        return $this->db->table('class_bookings cb')
            ->join('classes c', 'c.id = cb.class_id')
            ->join('user_info u', 'u.id = cb.user_id')
            ->select('cb.id as booking_id, cb.booking_date, 
                     COALESCE(cb.status, "pending") as status,
                     c.id as class_id, c.type, c.description, 
                     c.schedule, c.duration_minutes, c.instructor,
                     u.id as user_id, u.first_name, u.last_name, u.email')
            ->order_by('c.schedule', 'DESC')
            ->get_all();
    }

    public function update_booking_status($booking_id, $status) {
        return $this->db->table('class_bookings')
            ->where('id', $booking_id)
            ->update(['status' => $status]);
    }

    public function delete_booking($booking_id) {
        return $this->db->table('class_bookings')
            ->where('id', $booking_id)
            ->delete();
    }
}
?>
