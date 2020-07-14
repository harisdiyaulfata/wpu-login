<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
     // load model
     public function __construct()
     {
          parent::__construct();
          $this->load->model('Menu_model', 'menu');
     }

     public function index()
     {
          $data['title'] = 'Menu Management';
          $data['user'] = $this->menu->getSessionEmail();
          // $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

          $data['menu'] = $this->menu->getMenu();
          // $data['menu'] = $this->db->get('user_menu')->result_array();
          $this->form_validation->set_rules('menu', 'Menu', 'required');

          if ($this->form_validation->run() == false) {
               $this->load->view('templates/header', $data);
               $this->load->view('templates/sidebar', $data);
               $this->load->view('templates/topbar', $data);
               $this->load->view('menu/index', $data);
               $this->load->view('templates/footer');
          } else {
               $data = array(
                    'menu' => $this->input->post('menu')
               );
               $this->menu->insertMenu($data);
               // $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
               $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New menu added!</div>');
               redirect('menu');
          }
     }

     public function submenu()
     {
          $data['title'] = 'Submenu Management';
          $data['user'] = $this->menu->getSessionEmail();
          // $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

          $data['subMenu'] = $this->menu->getSubMenu();
          $data['menu'] = $this->menu->getMenu();

          $this->load->view('templates/header', $data);
          $this->load->view('templates/sidebar', $data);
          $this->load->view('templates/topbar', $data);
          $this->load->view('menu/submenu', $data);
          $this->load->view('templates/footer');
     }
}
