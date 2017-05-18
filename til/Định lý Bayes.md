Định lý Bayes là 1 định lý cơ bản được sử dụng rất nhiều trong lý thuyết máy học. 

P(A |B ) = P(B | A).P(A) / P(B ) 
- P(A): Xác suất của sự kiện A xảy ra
- P(B ): Xác suất của sự kiện B xảy ra
- P(B|A),P(B|A): Xác suất (có điều kiện) của sự kiện B xảy ra,nếu biết rằng sự kiện A đã xảy ra
- P(A|B): Xác suất (có điều kiện) của sự kiện A xảy ra, nếu biết rằng sự kiện B đã xảy ra
→ Các phương pháp suy diễn dựa trên xác suất sẽ sử dụng xác suất có điều kiện (posterior probability) này!

Eg. Giả sử chúng ta dự đoán một người sau có chơi tennis hay không? dựa vào tập dữ liệu sau đây.



- Sự kiện A: Anh ta chơi tennis
- Sự kiện B: Ngoài trời là nắng và Gió là mạnh

- Xác suất P(A): Xác suất rằng anh ta chơi tennis (bất kể Ngoài trời như thế nào và Gió ra sao)
- Xác suất P(B ): Xác suất rằng Ngoài trời là nắng và Gió là mạnh P(B|A): Xác suất rằng Ngoài trời là nắng và Gió là mạnh, nếu biết rằng anh ta chơi tennis
- P(A|B): Xác suất rằng anh ta chơi tennis, nếu biết rằng Ngoài trời là nắng và Gió là mạnh

=> Giá trị xác suất có điều kiện này sẽ được dùng để dự đoán xem anh ta có chơi tennis hay không?
============

Phân loại Naive Bayes

- Biểu diễn bài toán phân loại (classification problem)
—- +) Một tập học D_train, trong đó mỗi ví dụ học x ược biểu diễn là một vectơ n chiều: (x1, x2, … , xn)
—- +) Một tập xác định các nhãn lớp: C={c1 , c2 , …, cm }
—- +) Với một ví dụ (mới) z, z sẽ được phân vào lớp nào?

- Mục tiêu: Xác định phân lớp có thể (phù hợp) nhất đối với z
—- +) Cmap = argmax P(ci | z) với c∈C
—- +) Cmap = argmax P(ci |z1 ,z2 ,…,zn)
—- +) Cmap = argmax [ P(z1 ,z2 ,..., zn | ci ).P(ci) ] / P(z1 ,z2 ,…, zn) (bởi định lý Bayes)

Eg: Một sinh viên trẻ với mức thu nhập trung bình và mức đánh giá tín dụng bình thường sẽ mua một máy tính hay không?



- Biểu diễn bài toán phân loại
—- +) z= (Age=Young, Income = Medium, Student = Yes, Credit_Rating = Fair)
—- +) Có 2 phân lớp có thể: c1 (“Mua máy tính”) và c2 (“Không mua máy tính”)

- Tính giá trị xác suất trước cho mỗi phân lớp
—- +) P(c1 ) = 9/14
—- +) P(c2 ) = 5/14

- Tính giá trị xác suất của mỗi giá trị thuộc tính đối với mỗi phân lớp
—- +) P(Age = Young|c1 ) = 2/9; P(Age = Young|c2 ) = 3/5
—- +) P(Income = Medidium|c1 ) = 4/9; P(Income = Medium|c2 ) = 2/5
—- +) P(Student=Yes|c1 ) = 6/9; P(Student=Yes|c2 ) = 1/5
—- +) P(Credit_Rating=Fair|c1 ) = 6/9; P(Credit_Rating=Fair|c2 ) = 2/5

- Tính toán xác suất có thể xảy ra (likelihood) của ví dụ đối với mỗi phân lớp
—- +)Đối với phân lớp c1
——– +) P(z|c1 ) = P(Age=Young|c1 ).P(Income=Medium|c1 ).P(Student=Yes|c1 ).
——– +) P(Credit_Rating=Fair|c1 ) = (2/9).(4/9).(6/9).(6/9) = 0.044

- Đối với phân lớp c2
—- +) P(z|c2 ) = P(Age=Young|c2 ).P(Income=Medium|c2 ).P(Student=Yes|c2 ).
—- +) P(Credit_Rating=Fair|c2 ) = (3/5).(2/5).(1/5).(2/5) = 0.019

- Xác định phân lớp có thể nhất (the most probable class)
——– +) Đối với phân lớp c1: P(c1 ).P(z|c1 ) = (9/14).(0,044) = 0.028
——– +) Đối với phân lớp c2: P(c2 ).P(z|c2 ) = (5/14).(0.019) = 0.007

→Kết luận: Anh ta (z) sẽmua một máy tính

SOURCE: http://viet.jnlp.org/kien-thuc-co-ban-ve-xu-ly-ngon-ngu-tu-nhien/machine-learning-trong-nlp/dhinh-ly-baye

##NGÔN NGỮ c++11
