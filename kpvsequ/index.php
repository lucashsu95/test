<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>


    <div class="container text-center min-vh-100 d-flex flex-column justify-content-center" style="max-width:800px">
        <div class="row">
            <div class="col">
                <h1>
                    <img src="./images/repairing-service.png" style="height: 50px;margin-right:20px">設備報修系統
                </h1>
                <hr>
                <h3>
                    請選擇想報條的項目
                </h3>
            </div>
        </div>
        <div class="row my-md-3 fs-5">
            <div class="col">
                <a class="link" href="./repair/addrepair.php?type=learn"><span class="fs-4">教學</span>設備報修系統</a>
            </div>
            <div class="col">（設備組）</div>
            <div class="col">
                <a class="link" href="./repair/recordrepair.php">檢視已報修的記錄</a>
            </div>
        </div>
        <div class="row fs-5">
            <div class="col">
                <a class="link" href="./repair/addrepair.php?type=school"><span class="fs-4">校園</span>設備報修系統</a>
            </div>
            <div class="col">（總務處）</div>
            <div class="col">
                <a class="link" href="./repair/recordrepair.php">檢視已報修的記錄</a>
            </div>
        </div>
    </div>




</body>

</html>