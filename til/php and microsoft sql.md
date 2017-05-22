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

==============

Bài này là một kinh nghiệm nho nhỏ của tôi trong quá trình thực hiện một số dự án gần đây. Nhiều bạn sẽ cho rằng tôi “điên” nên mới sử dụng SQL Server để làm việc với PHP mà không sử dụng MySQL trong bộ LAMP. Thực ra tôi không điên mà đôi lúc do nhu cầu của dự án hoặc do yêu cầu chuyển đổi dữ liệu từ mã nguồn này sang mã nguồn khác khiến chúng ta phải thực hiện việc thao tác “ngược đời” này. Nhờ vậy, tôi mới có thêm chút kinh nghiệm để chia sẻ với mọi người.

Câu chuyện của tôi bắt đầu cách đây không lâu khi tôi nhận nhiệm vụ chuyển đổi và thiết kế lại cơ sở dữ liệu từ MS SQL Server sang MySQL. May mắn cho tôi là trước đây, thời gian ở trường tôi thường làm việc với cơ sở dữ liệu MS SQL Server 2008 nên việc tương tác với MS SQL Server không khó. Cái khó là thời gian 5 năm qua tôi chưa code một dòng .NET nào nên giờ quên sạch nếu không muốn nói là mù tịt. Thế là đành phải tìm cách sử dụng ngôn ngữ mình biết nhiều nhất(PHP) để làm việc với SQL Server.

Để thao tác với MS SQL Server trên nền PHP, bạn cần phải bổ sung cho PHP của bạn thêm sức mạnh để đọc và hiểu. May mắn cho chúng ta là anh Gate đẹp trai không đến mức ghét PHP nên đã chuẩn bị sẵn cho chúng ta bộ Extension để PHP có thể làm việc được với hệ quản trị cơ sở dữ liệu SQL Server của anh ấy. Trọng tâm của bộ driver này là PDO_SQLSRV giúp đóng vai trò như một API để thao tác với MS SQL Server.

Sơ đồ cấu trúc điều khiển của PHP_PDO_3
Để PHP có thể thao tác được với SQL Server, bạn cần bổ sung vào thư viện Extension của PHP thêm một bộ Driver tên Microsoft Drivers 3.0 for PHP for SQL Server. Bạn chú ý, chúng ta có 2 version 2.0 và 3.0 của bộ thư viện này. Bộ 3.0 sử dụng cho PHP phiên bản từ 5.3.6 trở về sau. Còn nếu bạn sử dụng phiên bản dưới 5.3.6 thì chúng ta download SQLSRV20.EXE nhé.

Sau khi download về bạn giải nén file và chép tất cả các file DLL nhận được vào thư mục

Ổ_chứa\AppServ\php5\ext\

Đây là thư mục chứa tất cả các Extension của PHP. Ở đây tôi sử dụng AppServ nên đường dẫn của tôi có kiểu như vậy, nếu bạn sử dụng XAMP hoặc WAMP thì đường dẫn có khác tí nhưng tôi chắc rằng bạn sẽ tìm ra nơi chúng ta bổ sung các file Extension mới down về dễ dàng.

Bước tiếp theo, chúng ta cấu hình cho file php.ini để kích hoạt các Extension mới bổ sung như sau:

Bạn mở file php.ini và tìm đến đoạn

;extension=php_bz2.dll
extension=php_curl.dll
Bổ sung vào trên nó đoạn code sau:

extension=php_pdo.dll
extension=php_sqlsrv_52_ts_vc6.dll
extension=php_pdo_sqlsrv_52_ts_vc6.dll
Đoạn mã này sẽ giúp cho PHP nhận và sử dụng được các Extension mà chúng ta mới thêm vào như tôi đã nói ở trên.

Vậy là chúng ta đãu hình xong cho PHP. Từ giờ bạn có thể kết nối với MS SQL Server thông qua PHP và bộ driver do Microsoft cung cấp.

Dưới đây là đoạn code mà tôi đã viết để lấy dữ liệu từ MS SQL Server bằng cách sử dụng nhiều quyền truy cập Windows Authentication, hi vọng như một ví dụ cho bạn khi tương tác.


//SQL Server Connector
/* Specify the server and connection string attributes. */
$serverName = "(local)";
$connectionInfo = array( "Database"=>"database_name",  "CharacterSet" => "UTF-8");

/* Connect using Windows Authentication. */
$conn = sqlsrv_connect( $serverName, $connectionInfo);
if( $conn === false )
{
     echo "Unable to connect.</br>";
     die( print_r( sqlsrv_errors(), true));
}



//MySQL Connector
$dbhandle = mysql_connect($hostname, $username, $password)
  or die("Unable to connect to MySQL");
  
$selected = mysql_select_db($mysql_databasename,$dbhandle)
  or die("Could not select examples");
  
  

	$tsql = "SELECT *  FROM table_name";
	
	$stmt = sqlsrv_query( $conn, $tsql);
	if( $stmt === false )
	{
		 echo "Error in executing query.</br>";
		 die( print_r( sqlsrv_errors(), true));
	}

	while( $result = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
			echo $result["User"];
	}

Ngoài ra bạn có thể tìm thấy rất nhiều sample khác được cung cấp trong Manual đi kèm với gói download mà bạn đã download về.

Ghi lại để nhớ và sử dụng khi cần nhé các bạn.

và hãy comment nếu bạn thấy bài viết này có ích cho bạn.

source: https://nhanweb.com/lam-viec-voi-ms-sql-server-bang-php.html
