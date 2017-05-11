<!DOCTYPE html>
<html>
    <head>
        <title>Tìm kiếm theo ajax</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
        <style>
            html{width:900px; margin:0px auto}
            input{padding: 5px}
            li{float:left; margin: 3px; border: solid 1px gray;}
            a{padding: 5px;}
            span{display:inline-block; padding: 0px 3px; background: blue; color:white}
            li{list-style: none; padding: 0px 5px}
        </style>
        <script language="javascript">
            $(document).ready(function()
            {
                // Biến lưu trữ thông số tìm kiếm
                var data = {
                    username : '', // tên đăng nhập
                    page : 1 // trang cần đến, dùng trong trường hợp có phân trang
                };
                
                // Khi nhập dữ liệu thì gọi ajax
                $('#q').keyup(function(){   
                    data.username = $(this).val();
                    search();
                });
                
                // Hàm xử lý khi click vào phân trang
                $('#content').on('click', 'a', function (){
                   data.page = $(this).attr('title');
                   search();
                   return false;
                });
                
                // Hàm gửi ajax
                function search()
                {
                    $.ajax({
                        url : 'get_data.php',
                        data : data,
                        type : 'get',
                        dataType : 'json',
                        success : function (result)
                        {
                            // Nếu dữ liệu trả về đúng thì mới xử lý
                            if (result.hasOwnProperty('data') && result.hasOwnProperty('paging'))
                            {
                                var html = '<table border="1" cellspacing="0" cellpadding="5">';
                                    html += '<tr style="font-weight:bold">';
                                        html += '<td>Username</td>';
                                        html += '<td>Email</td>';
                                    html += '</tr>';
                                    
                                    // Lặp qua từng record và gán html
                                    $.each(result['data'], function (index, item){
                                        html += '<tr>';
                                            html += '<td>'+item.username+'</td>';
                                            html += '<td>'+item.email+'</td>';
                                        html += '</tr>';
                                    });

                                html += '</table>';
                                
                                // Thêm html paging
                                html += result['paging'];
                                
                                // Gán kết quả vào div#content
                                $('#content').html(html);
                            }
                        }
                    });
                }
            });
        </script>
    </head>
    <body>
        <input type="text" id="q" value="" placeholder="Nhập nội dung muốn tìm kiếm" size="50"/>
        <div id="content" style="margin-top: 20px;"></div>
    </body>
</html>
