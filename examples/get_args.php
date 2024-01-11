<?php

require_once 'vendor/autoload.php';

\Lum\CLI\Util::parse_get_args();

echo json_encode($_GET, JSON_PRETTY_PRINT)."\n";
