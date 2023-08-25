<style>
    a {
        text-decoration: none;
        color: #39f;
    }
</style>
<?php
session_start();
$db = new PDO('mysql:host=localhost;dbname=web01', 'admin', '1234');
