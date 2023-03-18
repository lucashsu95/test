<nav>
    <div class="nav-left"><a href="/test/53web03">LOGO</a></div>
    <div class="nav-right">
        <?php
        if($_SESSION['user']['role'] === '管理員'){
            ?>
            <a href="/test/53web03/user/user.php">會員管理</a>
            <a href="/test/53web03/shop/shop.php">上架商品</a>
        <?php
        }
        ?>
        <a href="/test/53web03/logout.php">登出</a>
    </div>
</nav>