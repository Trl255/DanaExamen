<?php

// app/Helpers/info_helper.php
use CodeIgniter\CodeIgniter;

/**
 * Returns CodeIgniter's version.
 */
function ci_version(): string
{
    return CodeIgniter::CI_VERSION;
}

if (!function_exists('baseUrl')) {
function baseUrl()
{ 
    $baseUrl="http://localhost/codeigniter4-framework-2849e7f";
    return $baseUrl;
}
}
?>