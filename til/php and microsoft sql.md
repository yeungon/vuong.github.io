Thông thường, người ta sử dụng bộ đôi : PHP & MySQL hoặc ASP.NET & SQL Server. Nhưng đôi khi cũng gặp một vài trường hợp ngoại lệ, cần kết nối PHP với SQL Server. Bài viết này ghi lại các thủ tục cần thiết để kết nối từ PHP đến SQL Server. Ở đây tôi sử dụng WAMP và SQL Server Express để làm ví dụ.

Lưu ý :

Nhóm (1) : PHP phiên bản 5.2.3 trở xuống, ta chỉ có thể kết nối với SQL Server 2005 trở xuống.
Nhóm (2) : PHP phiên bản 5.2.4 trở lên, ta có thể kết nối với SQL Server 2005 hoặc 2008 đều được.
Với nhóm (1) : PHP 5.2.3 & SQL Server 2005 :

Ta chỉ cần bật extension mssql là kết nối được. Thao tác cụ thể như sau :

1. Vào chỉnh sửa file php.ini, tìm và bỏ dấu “;” phía trước dòng :
;extension=php_mssql.dll
2. Tìm và sửa thành “On ” :
mssql.secure_connection = On
Vậy là xong, restart lại Apache Service ( hoặc click vào Restart All Service cho nhanh ) (*)

Với nhóm (2) PHP 5.2.4 trở lên, ta cần sử dụng một cái gọi là “Driver” của Microsoft viết ra nhằm phục vụ việc kết nối này. Ta có thể tìm với từ khóa “SQL Server Driver for PHP”. Khi thực hiện bài viết này, bộ Driver này đã có phiên bản 2.0beta. Nhưng xài phiên bản 1.1 cho “stable” :-D. Thao tác cụ thể như sau :

1. Tải gói SQL Server Driver for PHP và chạy file vừa tải về. Giải nén ra một thư mục nào đó. Nó gồm khá nhiều file.
2. Mở file “SQLServerDriverForPHP_Readme.htm” vừa mới giải nén ra để xem hướng dẫn cài đặt driver.
3. Ở đây có bảng phân chia rất rõ ràng các “loại” PHP : VC6 hay VC9 , Thread safe hay non-Thread safe, khi nào thì sử dụng file .dll nào.
3.1 Nếu đang sử dụng PHP 5.2.x thì phải xem đang sử dụng loại PHP nào : Thread safe hoặc non-Thread safe. Để biết loại nào, bạn dựa vào file php5*.dll có trong thư mục chứa PHP ( trong  thư mục cài đặt wamp )
3.2 Nếu đang sử dụng PHP 5.3 thì cũng tương tự đối với PHP 5.2 : xem đang sử dụng “loại” PHP nào và chọn file tương ứng.
Với WAMP 2.0i thì PHP 5.3 được Compile bởi VC6 và ở dạng Thread safe nên ở đây ta sử dụng file “php_sqlsrv_53_ts_vc6.dll”
4. Copy file “” vào thư mục ext của PHP ( ../wamp/bin/php/ext ). Vào file PHP.ini để bật extension vừa copy vào, thêm một dòng như sau :
extension=php_sqlsrv_53_ts_vc6.dll

( ghi chú : bạn cần sửa tên file lại cho phù hợp)

5. Restart lại WebService ( Restart All Service )
6. Hoàn tất. (*)
(*) Lưu ý : File “ntwdblib.dll” phải tồn tại trong thư mục ../wamp/bin/apache/apache.xxx/bin và thư mục ../wamp/bin/php/php.xxx/ – nếu không có bạn cần copy bỏ vào.

source: https://ducquyen.wordpress.com/2011/05/23/k%E1%BA%BFt-n%E1%BB%91i-php-v%E1%BB%9Bi-sql-server/
