<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
}

class Model_Backbone_Role extends Backbone_Role {

    public function __construct() {
        parent::__construct();
        $this->primary_key = "id_role";
    }

    public function get_public_role() {
        return $this->get_detail("is_public_role = '1' and ".$this->record_active_column_name." = '1'");
    }
    
    public function get_all($searchable_fields = array(), $conditions = FALSE, $show_detailed = FALSE, $show_all = TRUE, $record_active = 1, $record_active_exists = TRUE, $force_limit = FALSE, $force_offset = FALSE, $order_by = NULL) {
        return parent::get_all(array("nama_role"), FALSE, TRUE, FALSE, 1, TRUE );
    }

}

?>
