##CẤU HÌNH XAMPP PHP ĐỂ UPLOAD FILE DUNG LƯỢNG LỚN LÊN SERVER

Cấu hình Xampp PHP để upload file dung lượng lớn lên Server. Mặc định, PHP chỉ cho phép upload file dung lượng tối đa 2MB. Nếu bạn muốn upload file dung lượng lớn hơn thì cần cấu hình Xampp PHP để upload file dung lượng lớn lên Server
1. Cách 1: chỉnh file cấu hình file php.ini của PHP (đường dẫn tới file php.ini trong xampp là xampp\php\php.ini)
a. upload_max_filesize = 10M
b. post_max_size = 10M
    
Tuy nhiên mặc định PHP cho time-out là 30 giây. Nếu bạn cho phép người dùng upload 10M, thì bạn phải chỉnh file cấu hình cho thời gian time-out tăng lên. Giả sử cho tăng lên 5 phút thì bạn chỉnh lại như sau:
max_execution_time = 300

Sau khi cấu hình xong nhớ khởi động lại server để hệ thống cập nhật lại.

2. Cách 2: chỉnh file .htaccess (file .htaccess nằm trong thư mục website)
Nếu bạn sử dụng Apache, bạn có thể chỉnh file .htaccess như sau:
php_value upload_max_filesize 10M
php_value post_max_size 10M
php_value max_execution_time 30

3. Cách 3: chỉnh trong ứng dụng của bạn

Bạn có thể định nghĩa trong ứng dụng của bạn như sau:
ini_set('upload_max_filesize', '10M');
ini_set('post_max_size', '10M');
ini_set('max_execution_time', 300);
 
Chúc bạn thành công!


http://stackoverflow.com/questions/4096582/allowed-memory-size-of-x-bytes-exhausted

The memory must be configured in several places. 
Set memory_limit to 512M:

sudo vi /etc/php5/cgi/php.ini
sudo vi /etc/php5/cli/php.ini
sudo vi /etc/php5/apache2/php.ini Or /etc/php5/fpm/php.ini
Restart service:

sudo service service php5-fpm restart
sudo service service nginx restart
or

sudo service apache2 restart
Finally it should solve the problem of the memory_limit
