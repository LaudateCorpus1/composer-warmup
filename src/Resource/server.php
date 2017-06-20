<?php

if (extension_loaded('newrelic')) {
    newrelic_ignore_transaction();
}

if (isset($_GET['file'])) {
    opcache_compile_file($_GET['file']);
}
