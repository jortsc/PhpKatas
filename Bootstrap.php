<?php
/**
 * @author: Jose Manuel Orts
 * @date: 11/09/2018
 */

defined('APPLICATION_PATH') || define('APPLICATION_PATH', realpath(dirname(__DIR__)));
define('APPLICATION_ENV', 'DEVELOPMENT');


set_include_path(
    implode(
        PATH_SEPARATOR,
        [
            realpath(APPLICATION_PATH . '/vendor'),
            get_include_path()
        ]
    )
);


require_once APPLICATION_PATH . '/PhpKatas/vendor/autoload.php';

ini_set('memory_limit', '768M');

echo "lol";
echo APPLICATION_PATH;
