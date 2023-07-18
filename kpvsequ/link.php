<?php
session_start();
date_default_timezone_set('Asia/Taipei');
$date = date('Y-m-d');
$db = new PDO('mysql:host=127.0.0.1;dbname=kpvs','root','');    