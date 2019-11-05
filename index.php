<?php 

define('ASSET_UPLOAD', dirname(__FILE__).DIRECTORY_SEPARATOR.'_assets'.DIRECTORY_SEPARATOR.'uploads');
define('ASSET_TEMPLATE', dirname(__FILE__).DIRECTORY_SEPARATOR.'_assets'.DIRECTORY_SEPARATOR.'template');

/**
 * set value TRUE, FALSE (boolean)
 */
define('ONCPANEL', FALSE);

define('APPROOT', dirname(__FILE__).DIRECTORY_SEPARATOR);
define('APPPATH', APPROOT);

$view_folder = "";
// The path to the "views" directory
if (!isset($view_folder[0]) && is_dir(APPPATH.'views'.DIRECTORY_SEPARATOR)) {
    $view_folder = APPPATH.'views';
}
elseif(is_dir($view_folder)) {
    if (($_temp = realpath($view_folder)) !== FALSE) {
        $view_folder = $_temp;
    } else {
        $view_folder = strtr(
        rtrim($view_folder, '/\\'), '/\\',
        DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR);
    }
}
elseif(is_dir(APPPATH.$view_folder.DIRECTORY_SEPARATOR)) {
    $view_folder = APPPATH.strtr(
    trim($view_folder, '/\\'), '/\\',
    DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR);
} else {
    header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
    echo 'Your view folder path does not appear to be set correctly. Please open the following file and correct this: '.SELF;
    exit(3); // EXIT_CONFIG
}

define('VIEWPATH', $view_folder.DIRECTORY_SEPARATOR);

require_once APPROOT.'..'.DIRECTORY_SEPARATOR.'lwscodeigniterwrapper_V1.1.0/autoload.php';

/* End of file index.php */
/* Location: ./index.php */