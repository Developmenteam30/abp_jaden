<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Model {

    public $site_setting;

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_entries($id = null)
    {
        if($id){
            $this->db->where('id', $id);
        }
        $query = $this->db->get('users');
        if($id){
            return $query->result();
        }else{
            return $query->row();
        }
    }

    public function delete_entries($id)
    {
        if($id){
            $this->db->where('id', $id);
            $query = $this->db->delete('users');
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function insert_entry()
    {
        $data = new \stdClass();
        $data->category    = $_POST['category'];
        $data->description  = $_POST['description'];
        $data->questions    = $_POST['questions'];
        if(isset($_POST['password'])){
            $data->password    = md5($_POST['password']);
        }
        $data->time     = time();

        $query = $this->db->insert('users', $data);
        if($query){
            $last_id = $this->db->insert_id();
        }else{
            $last_id = FALSE;
        }
        return $last_id;
    }

    public function update_entry()
    {
        $data = new \stdClass();
        $data->category    = $_POST['category'];
        $data->description  = $_POST['description'];
        $data->questions    = $_POST['questions'];
        if(isset($_POST['password'])){
            $data->password    = md5($_POST['password']);
        }
        $data->time     = time();

        $query = $this->db->update('users', $data, array('id' => $_POST['id']));
        if($query){
            $last_id = TRUE;
        }else{
            $last_id = FALSE;
        }
        return $last_id;
    }
    
}