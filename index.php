<?php
require_once('plugins/my-plugin.php');
session_start();
?>
<?php
/*
* Data is fetched from controller and displayed to views
* All data obtained will be transferred to index
* This is the default page to display data
*/
$uri =  $_SERVER['REQUEST_URI'];
/*
-- đăng ký đường dẫn
-- sau khi đăng ký thì lấy uri về và gọi hàm so sánh với thằng uri nhập
-- nếu trùng thì return về trang controller ngược lại thì return lỗi
-- mặc định nếu không có giá trị truyền thì là trang chủ*/

// if (isset($_GET['controller'])) {
//     $controller = $_GET['controller'];
//     if (isset($_GET['action'])) {
//         $action = $_GET['action'];
//     } else {
//         $action = 'index';
//     }
// } else {
//     $controller = 'pages';
//     $action     =  'index';
// }

// require_once("routers/base-route.php");
?>
