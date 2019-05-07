<?php
  class User_model extends CI_Model{
    public function register($enc_password){

      $data = array(

              'username' => $this->input->post('username'),
              'name' => $this->input->post('name'),
              'email' => $this->input->post('email'),
              'password' => $enc_password

      );
            return $this->db->insert('users', $data);
      
    }
  }
