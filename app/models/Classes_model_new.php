<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Classes_model extends Model {
    public function read(){
        return $this->db->table('classes')->get_all();
    }

    public function create($type, $description, $duration_minutes, $price, $instructor, $schedule){
        $userdata = array(
            'type' => $type,
            'description' => $description,
            'duration_minutes' => $duration_minutes,
            'price' => $price,
            'instructor' => $instructor,
            'schedule' => $schedule
        );
        return $this->db->table('classes')->insert($userdata);
    }

    public function get_one($id){
        return $this->db->table('classes')->where('id', $id)->get();
    }

    public function update($id, $data) {
        // Ensure $data contains all necessary keys to avoid errors
        $userdata = [
            'type' => $data['type'],
            'description' => $data['description'],
            'duration_minutes' => $data['duration_minutes'],
            'price' => $data['price'],
            'instructor' => $data['instructor'],
            'schedule' => $data['schedule'],
        ];
    
        // Execute the update query
        return $this->db->table('classes')->where('id', $id)->update($userdata);
    }
    
    public function delete($id){
        return $this->db->table('classes')->where('id', $id)->delete();
    }

    public function avail($class_id, $user_id){
        $data = array(
            'user_id' => $user_id,
            'class_id' => $class_id,
            'booking_date' => date('Y-m-d H:i:s'),
            'terms_accepted' => 1
        );
        return $this->db->table('class_bookings')->insert($data);
    }

    public function class_manage(){
        return $this->db->table('class_bookings cb')
            ->join('classes c', 'c.id = cb.class_id')
            ->join('user_info u', 'u.id = cb.user_id')
            ->select('cb.*, c.type, c.description, c.duration_minutes, c.price, c.instructor, c.schedule, u.first_name, u.last_name')
            ->get_all();
    }

    public function get_user_bookings($user_id){
        return $this->db->table('class_bookings cb')
            ->join('classes c', 'c.id = cb.class_id')
            ->where('cb.user_id', $user_id)
            ->select('cb.*, c.type, c.description, c.duration_minutes, c.price, c.instructor, c.schedule')
            ->get_all();
    }
}
