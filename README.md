# Ứng dụng quản lý chi tiêu
Phần Backend:
+ Bộ khung có dựng sẵn route,form, validation and authentication
+ tích hợp bộ chạy env, migrations
``` 
php migrations.php
```
để chạy các file mục migrations.
set up thông tin db trong .env copy từ .env.example
+ chạy `composer install` để cài vendor hoặc `composer update` cập nhật thêm thư mục vendor
+ đăng ký route vào mục routes/route.php