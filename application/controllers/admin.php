<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('grocery_CRUD');
        
        // Load user library and pass it third-party (forum) cookie
        // Normally done by MY_Controller, but this is not a sub-class of that
        $this->load->library('user', array('cookie' => $this->input->cookie(config_item('third_party_cookie'))));
        
        
        if( ! $this->user->permission('admin')) {
            die('Permission denied');
        }
    }
	
	private function output($output, $method = '') {
	    $output->method = $method;
	    $this->load->view('admin.php', $output);
	}
	
	public function abilities()
	{
	    $this->grocery_crud->set_table('abilities');
        $output = $this->grocery_crud->render();
 
        $this->output($output, 'abilities');
	}
	
	public function assignments()
	{
	    $this->grocery_crud->set_table('assignments')
	        ->columns('id', 'member_id', 'unit_id', 'position_id', 'access_level', 'start_date', 'end_date')
	        ->fields('member_id', 'unit_id', 'position_id', 'access_level', 'start_date', 'end_date')
	        ->set_relation('member_id', 'members', '{last_name}, {first_name} {middle_name}')->display_as('member_id', 'Member')
	        ->set_relation('unit_id', 'units', 'abbr')->display_as('unit_id', 'Unit')
	        ->set_relation('position_id', 'positions', 'name')->display_as('position_id', 'Position');
        $output = $this->grocery_crud->render();
 
        $this->output($output, 'assignments');
	}
	
	public function attendance()
	{
	    $this->grocery_crud->set_table('attendance')
	        ->set_relation('event_id', 'events', '{datetime} {title}')->display_as('event_id', 'Event')
	        ->set_relation('member_id', 'members', '{last_name}, {first_name} {middle_name}')->display_as('member_id', 'Member');
        $output = $this->grocery_crud->render();
 
        $this->output($output, 'attendance');
	}
	
	public function awardings()
	{
	    $this->grocery_crud->set_table('awardings')
	        ->set_relation('member_id', 'members', '{last_name}, {first_name} {middle_name}')->display_as('member_id', 'Member')
	        ->set_relation('award_id', 'awards', 'title')->display_as('award_id', 'Award');
        $output = $this->grocery_crud->render();
 
        $this->output($output, 'awardings');
	}
	
	public function awards()
	{
	    $this->grocery_crud->set_table('awards');
        $output = $this->grocery_crud->render();
 
        $this->output($output, 'awards');
	}
	
	public function class_permissions()
	{
	    $this->grocery_crud->set_table('class_permissions')
	        ->set_relation('ability_id', 'abilities', 'abbr')->display_as('ability_id', 'Ability');
        $output = $this->grocery_crud->render();
 
        $this->output($output, 'class_permissions');
	}
	
	public function countries()
	{
	    $this->grocery_crud->set_table('countries');
        $output = $this->grocery_crud->render();
 
        $this->output($output, 'countries');
	}
	
	public function demerits()
	{
	    $this->grocery_crud->set_table('demerits')
	        ->set_relation('member_id', 'members', '{last_name}, {first_name} {middle_name}')->display_as('member_id', 'Member')
	        ->set_relation('author_member_id', 'members', '{last_name}, {first_name} {middle_name}')->display_as('author_member_id', 'Author');
        $output = $this->grocery_crud->render();
 
        $this->output($output, 'demerits');
	}
	
	public function discharges()
	{
	    $this->grocery_crud->set_table('discharges')
	        ->set_relation('member_id', 'members', '{last_name}, {first_name} {middle_name}')->display_as('member_id', 'Member');
        $output = $this->grocery_crud->render();
 
        $this->output($output, 'discharges');
	}
	
	public function enlistments()
	{
	    $this->grocery_crud->set_table('enlistments')
	        ->set_relation('member_id', 'members', '{last_name}, {first_name} {middle_name}')->display_as('member_id', 'Member')
	        ->set_relation('liaison_member_id', 'members', '{last_name}, {first_name} {middle_name}')->display_as('liaison_member_id', 'Liaison')
	        ->set_relation('unit_id', 'units', 'abbr')->display_as('unit_id', 'TP')
	        ->set_relation('country_id', 'countries', 'abbr')->display_as('country_id', 'Country');
        $output = $this->grocery_crud->render();
 
        $this->output($output, 'enlistments');
	}
	
	public function events()
	{
	    $this->grocery_crud->set_table('events')
	        ->set_relation('unit_id', 'units', 'abbr')->display_as('unit_id', 'Unit')
	        ->set_relation('server_id', 'servers', 'name')->display_as('server_id', 'Server')
	        ->set_relation('reporter_id', 'members', '{last_name}, {first_name} {middle_name}')->display_as('reporter_id', 'Reporter');
        $output = $this->grocery_crud->render();
 
        $this->output($output, 'events');
	}
	
	public function finances()
	{
	    $this->grocery_crud->set_table('finances')
	        ->set_relation('member_id', 'members', '{last_name}, {first_name} {middle_name}')->display_as('member_id', 'Member');
        $output = $this->grocery_crud->render();
 
        $this->output($output, 'finances');
	}
	
	public function loa()
	{
	    $this->grocery_crud->set_table('loa')
	        ->set_relation('member_id', 'members', '{last_name}, {first_name} {middle_name}')->display_as('member_id', 'Member');
        $output = $this->grocery_crud->render();
 
        $this->output($output, 'loa');
	}
    
    public function members()
	{
        $crud = new grocery_CRUD();
        $crud->set_model('My_Grocery_model');
        
	    $crud->set_table('members')
	        ->set_subject('Member')
	        ->columns('id', 'last_name', 'first_name', 'middle_name', 'rank_id', 'primary_assignment_id', 'country_id', 'steam_id', 'units', 'classes')
	        ->fields('id', 'last_name', 'first_name', 'middle_name', 'rank_id', 'primary_assignment_id', 'country_id', 'city', 'steam_id', 'email')
	        ->set_relation('country_id', 'countries', 'abbr')->display_as('country_id', 'Country')
	        ->set_relation('rank_id', 'ranks', 'abbr')->display_as('rank_id', 'Rank')
	        ->callback_column('steam_id', array($this, '_callback_members_steam_id'));
	    $crud->set_relation_n_n('units', 'assignments', 'units', 'member_id', 'unit_id', 'abbr', null, '(start_date <= CURDATE() OR start_date IS NULL) AND (end_date > CURDATE() OR end_date IS NULL)');
	    $crud->set_relation_n_n('classes', 'assignments', 'units', 'member_id', 'unit_id', 'class', null, '(start_date <= CURDATE() OR start_date IS NULL) AND (end_date > CURDATE() OR end_date IS NULL)');
        $output = $crud->render();
 
        $this->output($output, 'members');
	}
	
	public function _callback_members_steam_id($value, $row) {
	    return $value ? '<a href="http://steamcommunity.com/profiles/' . $value . '" target="_blank">' . $value . '</a>' : '';
	}
	
	public function notes()
	{
	    $this->grocery_crud->set_table('notes')
	        ->set_relation('subject_member_id', 'members', '{last_name}, {first_name} {middle_name}')->display_as('subject_member_id', 'Subject')
	        ->set_relation('author_member_id', 'members', '{last_name}, {first_name} {middle_name}')->display_as('author_member_id', 'Author');
        $output = $this->grocery_crud->render();
 
        $this->output($output, 'notes');
	}
	
	public function positions()
	{
	    $this->grocery_crud->set_table('positions');
        $output = $this->grocery_crud->render();
 
        $this->output($output, 'positions');
	}
	
	public function promotions()
	{
	    $this->grocery_crud->set_table('promotions')
	        ->set_relation('member_id', 'members', '{last_name}, {first_name} {middle_name}')->display_as('member_id', 'Member')
	        ->set_relation('old_rank_id', 'ranks', 'abbr')->display_as('old_rank_id', 'Old Rank')
	        ->set_relation('new_rank_id', 'ranks', 'abbr')->display_as('new_rank_id', 'New Rank');
        $this->grocery_crud->callback_after_insert(array($this, '_callback_promotions_after_change'));
	    $this->grocery_crud->callback_after_update(array($this, '_callback_promotions_after_change'));
	    $this->grocery_crud->callback_before_delete(array($this, '_callback_promotions_before_delete'));
        $output = $this->grocery_crud->render();
 
        $this->output($output, 'promotions');
	}
	
	function _callback_promotions_after_change($data, $id = null) {
        $this->load->model('member_model');
        $this->load->model('promotion_model');
        
	    // Update member's rank to last one TODO: What about when the user has no promotions? (PFC demoted to Pvt)
        if($newest = nest($this->promotion_model->where('promotions.member_id', $data['member_id'])->limit(1)->get()->row_array())) {
            if(isset($newest['new_rank']['id'])) { // Make sure the query actually got a valid result
                $this->member_model->save($data['member_id'], array('rank_id' => $newest['new_rank']['id']));
            }
        }
	}
	
	// This one has to be done before because after, the promotion record doesn't exist so we don't know which member to update...ugh
	function _callback_promotions_before_delete($id) {
        $this->load->model('member_model');
        $this->load->model('promotion_model');
	    $data = (array) $this->promotion_model->get_by_id($id);
        
	    // Update member's rank to last one TODO: What about when the user has no promotions? (PFC demoted to Pvt)
        if($data['member_id'] && $newest = nest($this->promotion_model->where(array('promotions.member_id' => $data['member_id'], 'promotions.id !=' => $data['id']))->limit(1)->get()->row_array())) {
            if(isset($newest['new_rank']['id'])) { // Make sure the query actually got a valid result
                $this->member_model->save($data['member_id'], array('rank_id' => $newest['new_rank']['id']));
            }
        }
	}
	
	public function qualifications()
	{
	    $this->grocery_crud->set_table('qualifications')
	        ->set_relation('member_id', 'members', '{last_name}, {first_name} {middle_name}')->display_as('member_id', 'Member')
	        ->set_relation('standard_id', 'standards', '({weapon}:{badge}) {description}')->display_as('standard_id', 'Standard')
	        ->set_relation('author_member_id', 'members', '{last_name}, {first_name} {middle_name}')->display_as('author_member_id', 'Author');
        $output = $this->grocery_crud->render();
 
        $this->output($output, 'qualifications');
	}
	
	public function ranks()
	{
	    $this->grocery_crud->set_table('ranks');
        $output = $this->grocery_crud->render();
 
        $this->output($output, 'ranks');
	}
	
	public function schedules()
	{
	    $this->grocery_crud->set_table('schedules')
	        ->set_relation('unit_id', 'units', 'abbr')->display_as('unit_id', 'Unit')
	        ->set_relation('server_id', 'servers', 'name')->display_as('server_id', 'Server');
        $output = $this->grocery_crud->render();
 
        $this->output($output, 'schedules');
	}
	
	public function servers()
	{
	    $this->grocery_crud->set_table('servers');
        $output = $this->grocery_crud->render();
 
        $this->output($output, 'servers');
	}
	
	public function standards()
	{
	    $this->grocery_crud->set_table('standards');
        $output = $this->grocery_crud->render();
 
        $this->output($output, 'standards');
	}
	
	public function units()
	{
	    $this->grocery_crud->set_table('units');
        $output = $this->grocery_crud->render();
 
        $this->output($output, 'units');
	}
	
	public function unit_permissions()
	{
	    $this->grocery_crud->set_table('unit_permissions')
	        ->set_relation('unit_id', 'units', 'abbr')->display_as('unit_id', 'Unit')
	        ->set_relation('ability_id', 'abilities', 'abbr')->display_as('ability_id', 'Ability');
        $output = $this->grocery_crud->render();
 
        $this->output($output, 'unit_permissions');
	}
}