MySQL cung cấp chuẩn SQL pattern matching dựa trên Regular Expression được mở rộng tương tự như những biểu thức được sử dụng bởi các tiện ích Unix như vi, grep và sed.

LIKE pattern
SQL pattern matching cho phép bạn sử dụng _ để match tất cả các kí tự đơn và % để match một số các kí tự tùy ý (bao gồm cả các kí tự không). Trong MySQL, mặc định các SQL pattern là case-insensitive (không phân biệt chữ hoa, thường). Khi sử dụng các SQL patterns, bạn không sử dụng = hay &lt;&gt;, mà thay vào đó sẽ sử dụng các toán tử so sánh LIKE hoặc NOT LIKE.

Hãy đến với một số ví dụ dưới đây để hiểu rõ hơn về các SQL pattern đã nói ở trên nhé. Giả sử, chúng ta có một bảng pets trong database, bao gồm các records như sau:

name	owner	species	sex	birth
Bowser	Diane	dog	m	2016-08-30
Buffy	Harold	dog	f	2016-05-13
Claws	Gwen	cat	m	2016-07-22
Fluffy	Harold	cat	f	2016-03-18
Whistler	Gwen	bird	m	2016-05-28
<br>

Ví dụ về việc sử dụng LIKE pattern

Để tìm kiếm các thú cưng có tên bắt đầu với b:

sql
mysql> SELECT * FROM pets WHERE name LIKE 'b%';
+--------+--------+---------+------+------------+

| name   | owner  | species | sex  | birth      |

+--------+--------+---------+------+------------+

| Bowser | Diane  | dog     | m    | 2016-08-30 |

| Buffy  | Harold | dog     | f    | 2016-05-13 |

+--------+--------+---------+------+------------+


Để tìm kiếm các thú cưng có tên kết thúc với fy:

sql
mysql> SELECT * FROM pets WHERE name LIKE '%fy';
+--------+--------+---------+------+------------+
| name   | owner  | species | sex  | birth      |
+--------+--------+---------+------+------------+
| Buffy  | Harold | dog     | f    | 2016-05-13 |
| Fluffy | Harold | cat     | f    | 2016-03-18 |
+--------+--------+---------+------+------------+
Để tìm kiếm các thú cưng có tên chứa kí tự w:

sql
  mysql> SELECT * FROM pets WHERE name LIKE '%w%';
  +----------+-------+---------+------+------------+
  | name     | owner | species | sex  | birth      |
  +----------+-------+---------+------+------------+
  | Bowser   | Diane | dog     | m    | 2016-08-30 |
  | Claws    | Gwen  | cat     | m    | 2016-07-22 |
  | Whistler | Gwen  | bird    | m    | 2016-05-28 |
  +----------+-------+---------+------+------------+
  
Để tìm kiếm các thú cưng có tên chứa chính xác 5 kí tự, sử dụng 5 kí tự _ trong SQL pattern như sau:

sql
  mysql> SELECT * FROM pets WHERE name LIKE '_____';
  +----------+-------+---------+------+------------+
  | name     | owner | species | sex  | birth      |
  +----------+-------+---------+------+------------+
  | Buffy    | Harold| dog     | f    | 2016-05-13 |
  | Claws    | Gwen  | cat     | m    | 2016-07-22 |
  +----------+-------+---------+------+------------+
  
REGEXP pattern
MySQL cung cấp một kiểu Pattern Matching khác dựa trên Regular Expression, sử dụng toán tử REGEXP và NOT REGEXP ( hoặc RLIKE và NOT RLIKE, mang nghĩa tương đồng nhau). REGEXP sử dụng vô cùng linh hoạt và mạnh mẽ hơn nhiều so với LIKE.

Bảng dưới đây liệt kê các Pattern có thể được sử dụng cùng với toán tử REGEXP:

Pattern	Matching với
^	Phần đầu của pattern
$	Phần kết thúc của pattern
.	Bất kỳ ký tự nào
[...]	Bất kỳ ký tự nào được liệt kê trong dấu ngoặc vuông. Để đặt tên cho một khoảng các ký tự, sử dụng dấu nối -.<br> Ví dụ, [a-z] match bất kỳ chữ cái nào, [0-9] match bất kỳ chữ số nào.
[^...]	Bất kỳ ký tự nào không được liệt kê trong dấu ngoặc vuông
a*	0 hoặc nhiều ký tự a
a+	1 hoặc nhiều ký tự a
a?	0 hoặc 1 ký tự a
a{n}	n ký tự a
a{m,n}	Từ m tới n ký tự a. a? có thể được viết là a{0,1}
<br>
> MySQL coi ký tự &quot;\&quot; như là một "escape character". Vì vậy mà nếu bạn chọn sử dụng ký tự &quot;\&quot; như một phần pattern của bạn trong regular expression thì bạn sẽ cần escape nó với một ký tự &quot;\\&quot;.

> Một REGEXP pattern sẽ match thành công nếu pattern đó match với bất kỳ nơi nào trong giá trị đang được thử nghiệm. Khác với LIKE pattern, nó thành công chỉ khi mà pattern đó match với toàn bộ giá trị thử nghiệm.
>
<br>

Ví dụ về việc sử dụng REGEXP pattern

Những câu truy vấn sử dụng LIKE đã được ví dụ ở trên sẽ được viết lại với REGEXP như sau:

Để tìm kiếm các thú cưng có tên bắt đầu với b:

sql
mysql> SELECT * FROM pets WHERE name REGEXP '^b';
+--------+--------+---------+------+------------+
| name   | owner  | species | sex  | birth      |
+--------+--------+---------+------+------------+
| Bowser | Diane  | dog     | m    | 2016-08-30 |
| Buffy  | Harold | dog     | f    | 2016-05-13 |
+--------+--------+---------+------+------------+
Nếu như bạn muốn toán tử REGEXP trở thành case-sensitive ( phân biệt chữ hoa, chữ thường), sử dụng keyword BINARY. Query này sẽ chỉ match những cái tên bắt đầu với chữ cái b thường:

sql
mysql> SELECT * FROM pets WHERE name REGEXP BINARY '^b';
Để tìm kiếm các thú cưng có tên kết thúc với fy:

sql
  mysql> SELECT * FROM pets WHERE name REGEXP 'fy$';
 +--------+--------+---------+------+------------+
| name   | owner  | species | sex  | birth      |
+--------+--------+---------+------+------------+
| Buffy  | Harold | dog     | f    | 2016-05-13 |
| Fluffy | Harold | cat     | f    | 2016-03-18 |
+--------+--------+---------+------+------------+
  
Để tìm kiếm các thú cưng có tên chứa kí tự w:

sql
  mysql> SELECT * FROM pets WHERE name REGEXP 'w';
  +----------+-------+---------+------+------------+
  | name     | owner | species | sex  | birth      |
  +----------+-------+---------+------+------------+
  | Bowser   | Diane | dog     | m    | 2016-08-30 |
  | Claws    | Gwen  | cat     | m    | 2016-07-22 |
  | Whistler | Gwen  | bird    | m    | 2016-05-28 |
  +----------+-------+---------+------+------------+
  
Để tìm kiếm các thú cưng có tên chứa chính xác 5 kí tự:

sql
  mysql> SELECT * FROM pets WHERE name REGEXP '^.{5}$';
  +----------+-------+---------+------+------------+
  | name     | owner | species | sex  | birth      |
  +----------+-------+---------+------+------------+
  | Buffy    | Harold| dog     | f    | 2016-05-13 |
  | Claws    | Gwen  | cat     | m    | 2016-07-22 |
  +----------+-------+---------+------+------------+
  
<br>
<br>
Trên đây, mình đã giới thiệu cho các bạn các Pattern Matching sử dụng trong MySQL. Nó thực sự vô cùng hữu dụng cho những bài toán truy vấn tìm kiếm đối với MySQL. Hi vọng sẽ giúp ích cho bạn đọc ^^.

Tài liệu tham khảo
https://dev.mysql.com/doc/mysql-tutorial-excerpt/5.5/en/pattern-matching.html
http://www.daharveyjr.com/mysql-regexp-regular-expression-operators/

link: http://laptrinhx.com/topic/27290/pattern-matching-in-mysql
