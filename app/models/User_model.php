<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class User_model extends Model {
    public function read(){
        return $this->db->table('user_info')->get_all();
    }

    public function get_user($id) {
        return $this->db->table('user_info')->where('id', $id)->get();
    }

    public function update_user($id, $data) {
        $data['updated_at'] = date('Y-m-d H:i:s');
        return $this->db->table('user_info')->where('id', $id)->update($data);
    }

    public function delete($id){
        return $this->db->table('user_info')->where('id', $id)->delete();
    }

    public function get_active_membership($user_id) {
        return $this->db->table('user_memberships um')
            ->join('memberships m', 'm.id = um.membership_id')
            ->join('user_info u', 'u.id = um.user_id')
            ->where('um.user_id', $user_id)
            ->where('m.status', 'active')
            ->order_by('um.start_date', 'DESC')
            ->get();
    }
}
?>
