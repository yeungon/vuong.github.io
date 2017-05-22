<?php
/* 6 steps to work with mysql and php VUONG MAY 2017 -SELF-TAUGHT

https://www.qhonline.edu.vn/video-traininge0a0bc94e5z53.html

1) connect
- create a variable 
$a = mysql_connect ();
2) select a database 
- mysql_select_db ('tendatabase', $a)
3) querry
- create another variable 
$b= mysql_querry ();

4) count the number of record (from the variable created in the previous step)
mysql_num_row ($b);

5) fetching data to php: 2 ways

noted:
1) using echo && print to extract data

2) using while loop to extract more record in the data

example: 
$b= mysql_querry (); // in the step 3

while (mysql_fetch_assoc($b)){echo

/print}

- mysql_fetch_array ();
- mysql-fetch_assoc (); // should use this one instead of the first one because it is more accurate.

6) close mysql
mysql_close ($a); close the previous variable

*/




// mysqli
$mysqli = new mysqli("example.com", "user", "password", "database");
$result = $mysqli->query("SELECT 'Hello, dear MySQL user!' AS _message FROM DUAL");
$row = $result->fetch_assoc();
echo htmlentities($row['_message']);

/***
Với MySQLi có 2 cách viết khác nhau và bạn không cần phải chỉ ra loại database vì chúng ta chỉ có thể làm việc với MySQL 
khi sử dụng thư viện này:


***/

// mysqli: procedural
$mysqli = mysqli_connect('localhost','username','password','database');

// mysqli: object oriented
$mysqli = new mysqli('localhost','username','password','database');
//

// PDO
$pdo = new PDO('mysql:host=example.com;dbname=database', 'user', 'password');
/* 5 đối số, số đầu: loại database, 2 số sau: host và database, 2 cái cuối là tên đăng nhập và mật khẩu
Hãy dừng lại để phân tích, nó thực sự rất đơn giản: bạn chỉ cần định tên của các trình điều khiển
(trong trường hợp này là mysql), tiếp theo là các giá trị tương ứng kèm theo (connection string) 
  để kết nối với trình điều khiển tương ứng. Điều hữu dụng hơn của phương án sử dụng PDO so với mysql_connect là gì ? 
  Đó là một khi bạn cần kết nối với trình điều khiển khác (ví dụ như SQLite chẳng hạn),
bạn chỉ cần cập nhật lại DSN hay còn gọi là Data Source Name phù hợp là xong. 
  Chúng ta sẽ không cần phải phụ thuộc vào MySQL quá nhiều và cũng không cần phải sử dụng các hàm 
  riêng biệt chỉ dành cho MySQL như mysql_connect làm gì.

Nếu có lỗi kết nối, thay vì sử dụng hàm die() như đoạn mã đầu tiên, chúng ta sẽ đưa vào khối try/catch để bắt lỗi như sau:


try {
    $conn = new PDO('mysql:host=localhost;dbname=myDatabase', $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
Bạn lưu ý rằng chế độ bắt lỗi trong DPO mặc định là PDO::ERRMODE_SILENT. Với thiết lập này không thay đổi, bạn sẽ cần tự lấy lỗi thông qua những câu truy vấn của mình.

?
1
2
echo $conn->errorCode();
echo $conn->errorInfo();
Đó là môi trường thực tế, còn trong môi trường của nhà phát triển, bạn sẽ cần dừng kịch bản lại ngay và sửa lỗi. Trong trường hợp này chúng ta cần thay đổi sang tùy chọn PDO::ERRMODE_EXCEPTION,. Hãy tham khảo một vài tùy chọn sau:

– PDO::ERRMODE_SILENT
– PDO::ERRMODE_WARNING
– PDO::ERRMODE_EXCEPTION


https://nhanweb.com/su-dung-php-ket-noi-voi-mysql-ban-da-biet-het-ve-no-chua.html
*/
$statement = $pdo->query("SELECT 'Hello, dear MySQL user!' AS _message FROM DUAL");
$row = $statement->fetch(PDO::FETCH_ASSOC);
echo htmlentities($row['_message']);

// mysql

$c = mysql_connect("example.com", "user", "password");
mysql_select_db("database");
$result = mysql_query("SELECT 'Hello, dear MySQL user!' AS _message FROM DUAL");
$row = mysql_fetch_assoc($result);
echo htmlentities($row['_message']);

// source: http://php.net/manual/en/mysqlinfo.api.choosing.php
// more: http://php.net/manual/en/mysqli.quickstart.prepared-statements.php

// Recommended API

//It is recommended to use either the mysqli or PDO_MySQL extensions.
// It is not recommended to use the old mysql extension for new development, as it was deprecated in PHP 5.5.0 and was removed in PHP 7. 
// A detailed feature comparison matrix is provided below. The overall performance of all three extensions is considered to be about the same. 
// Although the performance of the extension contributes only a fraction of the total run time of a PHP web request. Often, the impact is as low as 0.1%.
?>

