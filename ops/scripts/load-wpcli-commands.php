<?php
/** Loads custom wp-cli commands from this directory. */
foreach ( glob(dirname(__FILE__) . '/*-command.php') as $command ) {
    require_once $command;
}