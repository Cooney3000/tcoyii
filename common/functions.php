<?php
/**
 * Requires `define('USE_HTTPS', true)` to be in your `index.php` file!
 */
function getUrlScheme()
{
    return (USE_HTTPS === true) ? 'https' : 'http';
}

/**
 * Requires `define('DOMAIN_NAME', 'example.tld')` to be in your `index.php` file!
 */
function getDomain($subDomain = null)
{
    $sub = $subDomain ? $subDomain . '.' : '';
    return getUrlScheme() . '://' . $sub . DOMAIN_NAME;
}