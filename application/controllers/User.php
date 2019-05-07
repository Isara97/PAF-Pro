<?php

class User extends CI_Controller
{

  public function _construct()
  {
    parent::_construct();
    if (!isset($_SESSION['user_logged']))
    {
      $this->session->set_flashdata("error", "Please Login first to view this page");
      redirect("auth/login");
    }
  }
  public function profile()
  {
    $this->load->view('profile');
  }
}
