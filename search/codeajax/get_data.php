<?php
// Require Lib
require "database.php";
require "pagination.php";

// Lấy thong tin lọc
$username = isset($_GET['username']) ? $_GET['username'] : '';

// Lấy trang hiện tại
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// Khởi tạo đối tượng Pagination mới
$pagination = new Pagination();

// Kết nối db
connect();

// Cấu hình thông số phân trang
$pagination->init(array(
    'current_page'  => $page,
    'total_record'  => count_all_member($username),
    'link_full'     => 'get_data.php?page={page}&username='.$username,
    'link_first'    => 'get_data.php'
));

// Lấy limit và Start
$limit = $pagination->get_config('limit');
$start = $pagination->get_config('start');

// Lấy danh sách người dùng
$data = get_all_member($username, $limit, $start);

// Ngắt kết nối
disconnect();

// Trả kết quả cho client
die (json_encode(array(
    'data' => $data,
    'paging' => $pagination->html()
)));

?>






