<?php

define('MULTISITE', (bool) getenv('MULTISITE'));
define('SUBDOMAIN_INSTALL', (bool) getenv('SUBDOMAIN_INSTALL'));

define('DOMAIN_CURRENT_SITE', getenv('DOMAIN_CURRENT_SITE'));
define('PATH_CURRENT_SITE', getenv('PATH_CURRENT_SITE'));

define('SITE_ID_CURRENT_SITE', intval( getenv('SITE_ID_CURRENT_SITE') ));
define('BLOG_ID_CURRENT_SITE', intval( getenv('BLOG_ID_CURRENT_SITE') ));
