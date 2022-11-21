<?php 
    include "connect.php"; 
    function formatMoney($number, $fractional=false) {
        if ($fractional) {
            $number = sprintf('%.2f', $number);
        }
        while (true) {
            $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
            if ($replaced != $number) {
                $number = $replaced;
            } else { break; }
        }
        return $number;
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?=$_GET["pname"]?></title>
        <style>
            body {
                margin: 0;
                font-family: Arial, Helvetica, sans-serif;
            }

            .headertop {
                overflow: hidden;
                background: #f1f1f1;
                padding-right: 10px;
            }

            .headertop a {
                float: left;
                color: black;
                text-align: center;
                padding: 12px;
                text-decoration: none;
                font-size: 13px; 
                line-height: 10px;
                border-radius: 4px;
            }

            .headertop a:hover {
                background-color: #ddd;
            }

            .headertop-right {
                float: right;
            }

            /* The container */
            .container {
                display: block;
                position: relative;
                padding-left: 35px;
                margin-bottom: 12px;
                cursor: pointer;
                font-size: 22px;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }

            /* Hide the browser's default checkbox */
            .container input {
                position: absolute;
                opacity: 0;
                cursor: pointer;
                height: 0;
                width: 0;
            }

            /* Create a custom checkbox */
            .checkmark {
                position: absolute;
                top: 0;
                left: 0;
                height: 25px;
                width: 25px;
                background-color: #eee;
            }

            /* On mouse-over, add a grey background color */
            .container:hover input ~ .checkmark {
                background-color: #ccc;
            }

            /* When the checkbox is checked, add a black background */
            .container input:checked ~ .checkmark {
                background-color: black;
            }

            /* Create the checkmark/indicator (hidden when not checked) */
            .checkmark:after {
                content: "";
                position: absolute;
                display: none;
            }

            /* Show the checkmark when checked */
            .container input:checked ~ .checkmark:after {
                display: block;
            }

            /* Style the checkmark/indicator */
            .container .checkmark:after {
                left: 9px;
                top: 5px;
                width: 5px;
                height: 10px;
                border: solid white;
                border-width: 0 3px 3px 0;
                -webkit-transform: rotate(45deg);
                -ms-transform: rotate(45deg);
                transform: rotate(45deg);
            }

            .button {
                background-color: white;
                border: 2px solid #555555;
                color: black;
                padding: 16px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
                transition-duration: 0.4s;
                cursor: pointer;
                border-radius: 12px;
            }

            .button1:hover {
                background-color: #555555;
                color: white;
            }

        </style>
    </head>
    <body>
        <div class="headertop">
            <div class="headertop-right">
                <a href="home.php">หน้าหลัก</a>
                <a href="signin.php">ตะกร้าสินค้า</a>
            </div>
        </div>

        <?php
            $stmt = $pdo->prepare("SELECT * FROM product WHERE pid = ?");
            $stmt->bindParam(1, $_GET["pid"]);       
            $stmt->execute();
            $row = $stmt->fetch();
        ?>
        <div style="display:flex">
            <div style="padding: 80px 10px 80px 80px">
                <img src='img/<?=$row["pid"]?>.jpg' width='450'>
            </div>
            <div style="padding: 80px 80px 80px 10px">
                <img src='img/<?=$row["pid"]?>-<?=$row["pid"]?>.jpg' width='450'>
            </div>
            <div style="padding: 80px 50px 80px 5px">
                <h1><?=$row["pname"]?></h1>
                <h3><?=$row["ptype"]?></h3>
                <?=$row["pdetail"]?><br><br>
                ราคา <?=formatMoney($row["price"]);?> บาท
                <br><br>เลือกไซส์<br><br>
                <form>
                    <label class="container">US 8
                        <input type="radio" id="8" name="size" value="8">
                        <span class="checkmark"></span>
                    </label>
                    <label class="container">US 9
                        <input type="radio" id="9" name="size" value="9">
                        <span class="checkmark"></span>
                    </label>
                    <label class="container">US 10
                        <input type="radio" id="10" name="size" value="10">
                        <span class="checkmark"></span>
                    </label>
                    <label class="container">US 11
                        <input type="radio" id="11" name="size" value="11">
                        <span class="checkmark"></span>
                    </label>
                    <label class="container">US 12
                        <input type="radio" id="12" name="size" value="12">
                        <span class="checkmark"></span>
                    </label><br>
                    <input type="submit" class="button button1" value="เพิ่มสินค้าในตะกร้า">
                </form>
            </div>
        </div>
    </body>
</html>
