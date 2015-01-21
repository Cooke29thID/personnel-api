<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Demerit_model extends CRUD_Model {
    public $table = 'demerits';
    public $primary_key = 'demerits.id';
    
    public function default_select() {
        $this->db->select('SQL_CALC_FOUND_ROWS demerits.*, members.id AS `member|id`', FALSE)
            ->select($this->virtual_fields['short_name'] . ' AS `member|short_name`', FALSE);
    }
    
    public function default_join() {
        $this->db->join('members', 'members.id = demerits.member_id', 'left')
            ->join('ranks', 'ranks.id = members.rank_id', 'left');
    }
    
    public function default_order_by() {
        $this->db->order_by('demerits.date DESC');
    }
}