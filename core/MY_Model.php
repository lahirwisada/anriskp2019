<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends LWS_Model {

    protected $user_detail;
    protected $master_schema;

    function __construct($table_name = '', $schema_name = '') {
        if ($schema_name) {
            $this->schema_name = $schema_name;
        }
        parent::__construct($table_name);
        $this->user_detail = $this->lmanuser->get("user_detail", $this->my_side);
//        $this->master_schema = $this->config->item('application_db_schema_name');
        $this->master_schema = "";
    }

    public function set_user_detail($user_detail) {
        $this->user_detail = $user_detail;
    }

    protected function set_insert_property() {
        parent::set_insert_property();
        $this->{$this->created_by_column_name} = $this->user_detail['username'];
    }

    protected function set_update_property($username = false) {
        parent::set_update_property($this->user_detail['username']);
    }

}
