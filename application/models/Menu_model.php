<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
     public function getSubMenu()
     {
          $this->db->select('*', 'user_menu.menu');
          $this->db->from('user_sub_menu');
          $this->db->join('user_menu', 'user_menu.id = user_sub_menu.menu_id');
          return $this->db->get()->result_array();
          // $query = "SELECT `user_sub_menu`.*, `user_menu`.`menu`
          //           FROM `user_sub_menu` JOIN `user_menu`
          //           ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
          // ";
          // return $this->db->query($query)->result_array();
     }

     public function getMenu()
     {
          $this->db->select('*');
          $this->db->from('user_menu');
          return $this->db->get()->result_array();
          // $query = "SELECT * FROM `user_menu`";
          // return $this->db->query($query)->result_array();
     }

     public function getSessionEmail()
     {
          return $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
     }

     public function insertMenu($data)
     {
          $this->db->insert('user_menu', $data);
     }
}
