<?php

// Khai báo biến toàn cục kết nối
global $conn;
 
// Hàm kết nối database
function connect(){
    global $conn;
    $conn = mysqli_connect('localhost', 'root', '', 'search') or die ('{error:"bad_request"}');
}
 
// Hàm đóng kết nối
function disconnect(){
    global $conn;
    if ($conn){
        mysqli_close($conn);
    }
}
 
// Hàm đếm tổng số thành viên
function count_all_member($username = '')
{
    global $conn;
    
    if ($username){
        $query = mysqli_query($conn, 'select count(*) as total from member where username like \'%'.mysql_escape_string($username).'%\'');
    }
    else{
        $query = mysqli_query($conn, 'select count(*) as total from member');
    }
    
    if ($query){
        $row = mysqli_fetch_array($query, MYSQLI_ASSOC);
        return $row['total'];
    }
    return 0;
}
 
// Lấy danh sách thành viên
function get_all_member($username = '', $limit = 10, $start = 0)
{
    global $conn;
    
    if ($username){
        $sql = 'select * from member  where username like \'%'.mysql_escape_string($username).'%\' limit '.(int)$start . ','.(int)$limit;
    }
    else{
        $sql = 'select * from member limit '.(int)$start . ','.(int)$limit;
    }
    
    $query = mysqli_query($conn, $sql);
     
    $result = array();
     
    if ($query)
    {
        while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
            $result[] = $row;
        }
    }
     
    return $result;
}

?>
