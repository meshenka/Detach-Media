<?php
defined('ABSPATH') or die("No direct load please !");

require_once dirname(__FILE__).'/DetachMedia.php';

$plugin = new DetachMedia();
$plugin->hookIn();
