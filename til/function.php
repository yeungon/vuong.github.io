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

//Thông thường, để khởi tạo 2 class trên trong file index.php thì chúng ta phải include từng file class như sau:

<?php 
//Nhúng file ConNguoi
include_once 'NguoiLon.php';
//Nhúng file ConNguoi
include_once 'TreCon.php';

//Khởi tạo 2 class
$nguoilon = new NguoiLon();
//Kết Quả: Class NguoiLon
$trecon = new TreCon();
//Kết Quả: Class TreCon

// +Nhưng nếu chúng ta sử dụng  hàm __autoload() thì sẽ chỉ phải khai báo ngắn gọn như sau:

<?php 
//khai báo hàm __autoload
function __autoload($className)
{
    //kiểm tra xem file tồn tại không
    if(file_exists($className . '.php')){
        //Nếu tồn tại thì nhúng file vào.
        include_once $className . '.php';
    }
}
//Khởi tạo 2 class
$nguoilon = new NguoiLon();
//Kết Quả: Class NguoiLon
$trecon = new TreCon();
//Kết Quả: Class TreCon


/* Autoload khi gọi phương thức tĩnh.

-Và hàm __autoload() này cũng được gọi khi chúng ta gọi phương thức tĩnh không xác định.

VD: Chúng ta có 2 file ConNguoi.php và một file index.php ở cùng thư mục.

+File ConNguoi.php, chứa class ConNguoi có nội dung như sau:

*/
<?php 
class ConNguoi
{
    private static $name = 'ConNguoi';
    public function __construct()
    {
        
    }
    public static function getName()
    {
    	echo static::$name;
    }

}
//File index.php, có nội dung như sau:

<?php 
//khai báo hàm __autoload
function __autoload($className)
{
    //kiểm tra xem file tồn tại không
    if(file_exists($className . '.php')){
        //Nếu tồn tại thì nhúng file vào.
        include_once $className . '.php';
    }
}
ConNguoi::getName();

//Kết Quả: ConNguoi

?>











