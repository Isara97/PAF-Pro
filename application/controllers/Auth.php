<?php


class Auth extends CI_Controller
{


    public function login()
    {

      $this->form_validation->set_rules('username', 'Username', 'required');
      $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
      if($this->form_validation->run() == TRUE)
      {
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $this->db->select('*');
        $this->db->from('users');
        $this->db->where(array('username'=>$username, 'password' =>$password));

        $query = $this->db->get();

        $user = $query->row();

        if ($user->email)
        {
          $this->session->set_flashdata("Success", "You are logged in");

          $_SESSION['user_logged'] = TRUE;
          $_SESSION['username'] = $user->username;

          redirect("auth/login", "refresh");
        }else{
          $this->session->set_flashdata("error", "No Such account exists in database");
          redirect("auth/login", "referesh");
        }


      }

      $this->load->view('login');
    }
    public function register()
    {



        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('password', 'Confirm Password', 'required|min_length[6] |matches[password]');
        if($this->form_validation->run()  !== FALSE){


          $data = array(
            'username'=>$_POST['username'],
            'name'=>$_POST['name'],
            'email'=>$_POST['email'],
            'password'=>md5($_POST['password']),
            'register_date'=>date('Y-m-d')
          );
          $this->db->insert('users',$data);

          $this->session->set_flashdata("Success","Your account has been registered. You can login now");
          redirect("auth/login", "refresh");

        }

      $this->load->view('register');
    }
}
