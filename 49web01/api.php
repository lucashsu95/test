<?php
include 'link.php';
switch ($_GET['id']) {

    case 'insertActive':
        $sql = $db->prepare('insert into active(name,udesc,image,link,date,signUp) values(:name,:udesc,:image,:link,:date,:signUp)');

        $fileName = date('YmdHis');
        $pathOfFile = "img/{$fileName}.jpg";
        move_uploaded_file($_FILES['image']['tmp_name'],$pathOfFile);
        $sql->bindValue('image',$pathOfFile);

        $sql->bindValue('name',$_POST['name']);
        $sql->bindValue('udesc',$_POST['udesc']);
        $sql->bindValue('link',$_POST['link']);
        $sql->bindValue('signUp',$_POST['signUp']);
        $sql->bindValue('date',$_POST['date']);
        $sql->execute();
        break;


}