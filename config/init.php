<?php
//REGEX
define('REGEX_CATEGORY', '^.{2,30}$');
define('REGEX_REGISTRATION', '^[A-Za-z]{2}-\d{3}-[A-Za-z]{2}$');

define('REGEX_MILEAGE', '^[0-9]{0,6}$');
//CONFIG
define('DSN', 'mysql:dbname=rent_my_ride;host=localhost');
define('USER', 'mehdi_user');
define('PASSWORD', 'unLj8nFQ1OwIT2zS');

//CONSTRAINT
define('ARRAY_TYPES', ['image/jpeg', 'image/png']);
define('UPLOAD_MAX_SIZE', 2*1024*1024); 
?>