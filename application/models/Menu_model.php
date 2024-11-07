<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    public function getSubMenu()
    {
        $query = "SELECT `user_sub_menus`.*, `user_menus`.`menu`
                    FROM `user_sub_menus` JOIN `user_menus`
                    ON `user_sub_menus`.`menu_id` = `user_menus`.`id`
                    ORDER BY id DESC
        ";

        return $this->db->query($query)->result_array();
    }
}
