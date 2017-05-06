<?php

//MAY 2017  _autoload function

//Khai báo hàm __autoload
function __autoload($className)
{
    echo 'Bạn vừa khởi tạo class: '. $className;
}
//Khai báo class ConNguoi
class ConNguoi
{
    //Khai báo hàm khởi tạo
    public function __construct()
    {
        echo 'Class ConNguoi';
    }
}
//Khởi tạo class ConNguoi
$connguoi = new ConNguoi();
//Kết Quả: Class ConNguoi

/* source: https://toidicode.com/ham-autoload-trong-php-123.html
-Vì hàm __autoload() sẽ tự động được gọi khi chúng ta khởi tạo một đối tượng không xác định được, 
nên nó được ứng dụng vào việc tạo ra các ứng dụng autoloading classes.
--Như vậy mình đã giới thiệu xong đến các bạn về hàm __autoload() trong PHP rồi, theo như thống kê, 
nếu chúng ta sử dụng nhiều hơn 1 lần include (require) thì dùng __autoload() sẽ nhanh hơn, 
còn nếu chỉ include (require) 1 lần thì __autoload() chậm hơn 1 tí nhưng không đáng kể. 


*/



?>











