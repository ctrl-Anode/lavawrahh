<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Terms_model extends Model {
    public function read(){
        return $this->db->table('terms_and_conditions')->get_all();
    }

    public function create($termText, $status){
        $userdata = array(
            'text' => $termText,
            'status' => $status
        );
        return $this->db->table('terms_and_conditions')->insert($userdata);
    }

    public function get_one($id){
        return $this->db->table('terms_and_conditions')->where('id', $id)->get();
    }

    public function update($id, $data) {
        // Ensure $data contains all necessary keys to avoid errors
        $userdata = [
            'text' => $data['text'],
            'status' => $data['status'],
        ];
    
        // Execute the update query
        return $this->db->table('terms_and_conditions')->where('id', $id)->update($userdata);
    }
    
    public function delete($id){
        return $this->db->table('terms_and_conditions')->where('id', $id)->delete();
    }
}
?>
