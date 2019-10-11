<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Elink_main
 *
 * @author lahir
 */
class Elink_homepage extends Lws_Modular {
    public function __construct($cmodul_name = FALSE, $header_title = FALSE) {
        parent::__construct($cmodul_name, $header_title);
        $this->_layout = "evolo";
    }
}
