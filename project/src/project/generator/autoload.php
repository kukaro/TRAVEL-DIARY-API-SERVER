<?php
spl_autoload_register(function($className) {
    include __DIR__ . '/'.str_replace('\\', '/', $className) . '.php';
});
?>
