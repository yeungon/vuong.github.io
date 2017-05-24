Strings hay còn gọi là chuỗi , là một trong những kiểu dữ liệu quan trọng và được dùng thông dụng nhất. Việc nắm vững trong việc xử lý chuỗi sẽ giúp ích rất nhiều cho các bạn trong việc lập trình web sau này. Trong bài viết này, mình xin chia sẻ 10 đoạn code xử lý chuỗi thông dụng mà có thể các bạn sẽ cần dùng trong tương lai.


## Tự động loại bỏ html tags từ một chuỗi

Khi người dùng Submit form, các bạn có thể dễ dàng loại bỏ các thẻ html không cần thiết bằng cách sử dụng hàm strip_tags :


$text = strip_tags($input, "");

## Lấy đoạn text nằm giữa $start và $end

Đây có lẽ là một hàm mà bất kì một web developer tương lai nào cũng sẽ phải cần dùng tới . Nó sẽ giúp cho các bạn lấy được đoạn chữ nằm ở giữa 2 chữ khác.


function GetBetween($content,$start,$end){
    $r = explode($start, $content);
    if (isset($r[1])){
        $r = explode($end, $r[1]);
        return $r[0];
    }
    return '';
}
Cách sử dụng như sau :


GetBetween('foo test bar', 'foo', 'bar');
 
// --> returns ' test ';
## Loại bỏ URL từ một chuỗi

Khi bạn cần loại bỏ mọi link có trong chuỗi thì các bạn chỉ cần dùng đoạn code sau :

1
$string = preg_replace('/\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i', '', $string);

## Chuyển đổi strings sang slugs

Bạn muốn tạo slugs (permalinks) dùng cho SEO friendly? từ tiêu đề bài viết. Đoạn code đơn giản sau đây sẽ giúp các bạn làm điều này :


function slug($str){
    $str = strtolower(trim($str));
    $str = preg_replace('/[^a-z0-9-]/', '-', $str);
    $str = preg_replace('/-+/', "-", $str);
    return $str;
}
Và để sử dụng các bạn dùng như sau :


$title = " 10 PHP code snippets ":
$slugs = slug($title);
// xuất ra màn hình sẽ là :  10-php-code-snippets

## Parse CSV files

CSV (Coma separated values) files là một cách dễ dàng nhất để lưu trữ dữ liệu. Đoạn code sau sẽ giúp các bạn phân tích file CSV.


$fh = fopen("contacts.csv", "r");
while($line = fgetcsv($fh, 1000, ",")) {
    echo "Contact: {$line[1]}";
}

##Tìm kiếm 1 chuỗi từ một chuỗi khác

Đoạn code sau sẽ trả về giá trị “true” nếu như chuỗi cần tìm được tìm thấy, và ngược lại nó sẽ trả lại giá trị là “false” .


function contains($str, $content, $ignorecase=true){
    if ($ignorecase){
        $str = strtolower($str);
        $content = strtolower($content);
    }
    return strpos($content,$str) ? true : false;
}

## Lọc lấy emails từ một chuỗi

Đoạn code bên dưới sẽ giúp bạn lọc lấy tất cả các email có trong một chuỗi.


function extract_emails($str){
    // This regular expression extracts all emails from a string:
    $regexp = '/([a-z0-9_\.\-])+\@(([a-z0-9\-])+\.)+([a-z0-9]{2,4})+/i';
    preg_match_all($regexp, $str, $m);
 
    return isset($m[0]) ? $m[0] : array();
}
 
$test_string = 'This is a test string...
 
        test1@example.org
 
        Test different formats:
        test2@example.org;
        <a href="test3@example.org">foobar</a>
        <test4@example.org>
 
        strange formats:
        test5@example.org
        test6[at]example.org
        test7@example.net.org.com
        test8@ example.org
        test9@!foo!.org
 
        foobar
';
 
print_r(extract_emails($test_string));

## Tạo chuỗi ngẫu nhiên

Đoạn code sau phù hợp cho việc tạo captcha

function generate_rand($l){
  $c= "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
  srand((double)microtime()*1000000);
  for($i=0; $i<$l; $i++) {
      $rand.= $c[rand()%strlen($c)];
  }
  return $rand;
 }
## Cách chuỗi tại điểm ngắt dòng.

Đoạn code sau sẽ giúp các bạn cắt chuỗi từ một chuỗi khác với chiều dài chỉ định, và đặc biệt là đoạn chuỗi được lấy ra sẽ chỉ được cắt tại chỗ ngắt dòng, vì thế mà nó không làm chuỗi bị ngắt giữa chừng.


function myTruncate($string, $limit, $break=".", $pad="...") {
    // return with no change if string is shorter than $limit
    if(strlen($string) <= $limit)
        return $string;
 
    // is $break present between $limit and the end of the string?
    if(false !== ($breakpoint = strpos($string, $break, $limit))) {
        if($breakpoint < strlen($string) - 1) {
            $string = substr($string, 0, $breakpoint) . $pad;
        }
    }
    return $string;
}
Và để sử dụng, các bạn khai báo như sau :


$short_string=myTruncate($long_string, 100, ' ');

## Phát hiện  AJAX Request

Hầu hết các JavaScript frameworks như jQuery, mootools sẽ gửi một HTTP_X_REQUESTED_WITH header khi thực thi một đoạn Ajax, và từ đó chúng ta có thể kiểm chứng xem yêu cầu được gửi đó có phải là AJAX request không.


if(!emptyempty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
    //If AJAX Request Then
}else{
//something else
}
Mình hy vọng với những chia sẻ trong bài viết này, sẽ giúp ích các bạn nhiều trong việc sử dụng nó vào các mục đích của mình.

Chúc các bạn thành công !

source: https://www.thuthuatweb.net/php/10-php-code-snippets-khi-lam-viec-voi-chuoi-strings.html
