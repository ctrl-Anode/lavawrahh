<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Memberships_model extends Model {
    public function read(){
        return $this->db->table('memberships')->get_all();
    }

    public function apply($type, $price, $info, $duration_months){
        $userdata = array(
            'type' => $type,
            'price' => $price,
            'info' => $info,
            'duration_months' => $duration_months,
            'status' => 'active'
        );
        return $this->db->table('memberships')->insert($userdata);
    }

    public function get_one($id){
        return $this->db->table('memberships')->where('id', $id)->get();
    }

    public function update($id, $data) {
        // Ensure $data contains all necessary keys to avoid errors
        $userdata = [
            'type' => $data['type'],
            'price' => $data['price'],
            'info' => $data['info'],
            'duration_months' => $data['duration_months'],
            'status' => $data['status']
        ];
    
        // Execute the update query
        return $this->db->table('memberships')->where('id', $id)->update($userdata);
    }
    
    public function delete($id){
        return $this->db->table('memberships')->where('id', $id)->delete();
    }

    public function avail($user_id, $membership_id){
        $userdata = array(
            'user_id' => $user_id,
            'membership_id' => $membership_id,
            'start_date' => date('Y-m-d'),
            'terms_accepted' => 1
        );
        return $this->db->table('user_memberships')->insert($userdata);
    }

    public function mem_delete($id){
        return $this->db->table('user_memberships')->where('id', $id)->delete();
    }

    public function app_read(){
        return $this->db->table('user_memberships um')
            ->join('memberships m', 'm.id = um.membership_id')
            ->join('user_info u', 'u.id = um.user_id')
            ->get_all();
    }
}
?>
