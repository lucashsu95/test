<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>會員管理</title>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/vue/3.2.47/vue.global.js' integrity='sha512-2zwx0mkoR2cxZY0humPK79YhJYgoX5lT+WNqkgTcV7qhVm3+msjlmOgoXnN1cW2r9qqbZez3XhnLZsyW3k8Wtg==' crossorigin='anonymous'></script>
</head>
<body>
    <?php
    include '../link.php';

    $users = $db->query('select * from users')->fetchAll();
    ?>
    <div id="app">
    {{users}}
    </div>
    <script>
        const app = Vue.createApp({
            data(){
                return{

                    users:JSON.parse("<?php echo json_encode($users) ?>"),

                }
            }
        }).mount('#app');
    </script>
</body>
</html>