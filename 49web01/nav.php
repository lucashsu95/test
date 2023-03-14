<nav>
    <div class='nav-left'>
        <a href="/test/49web01">
            <?php echo $_SESSION['user']['role'] === '管理員' ? '管理員專區' : '會員專區'?>
        </a>
    </div>
    <div class='nav-right'>
        <ul>
            <?php
                if($_SESSION['user']['role'] === '管理員'){
            ?>
            <li><a href="/test/49web01/user/user.php">會員管理</a></li>
            <li><a href="/test/49web01/gaming/manage.php">電腦活動管理精靈</a></li>
            <?php }  ?>
            <li><a href="/test/49web01/logout.php">登出</a></li>
        </ul>
    </div>
</nav>