<?php

    function outputOrderRow($file, $title, $quantity, $price) {
        $imgURL="images/books/tinysquare/".$file;
        $totalPrice=$quantity*$price;
        echo "<tr>";
        //TODO
//        echo"<td><img src=\".$imgURL.\"></td>";//图像
        echo"<td><img src=\"$imgURL\"></td>";//图像
        echo"<td>$title</td>";//品名
        echo"<td>$quantity</td>";//数量
        echo"<td>$price</td>";//单价
        echo"<td>$totalPrice</td>";//总价
        echo "</tr>";
    }
?>