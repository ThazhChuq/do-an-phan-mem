# Dự Án Hệ Thống Đăng Nhập và Đăng Ký

## Giới thiệu
Dự án này là một ứng dụng PHP đơn giản cho phép người dùng **đăng ký**, **đăng nhập** và **đăng xuất**. Hệ thống sử dụng cơ sở dữ liệu MySQL để lưu trữ thông tin người dùng, bao gồm tên đăng nhập và mật khẩu (được mã hóa).

### Các tính năng chính:
- **Đăng ký** người dùng mới.
- **Đăng nhập** cho phép người dùng truy cập vào hệ thống.
- **Đăng xuất** người dùng khi họ muốn thoát khỏi hệ thống.
- **Cơ sở dữ liệu MySQL** để lưu trữ thông tin người dùng.
- **Bảo mật** mật khẩu sử dụng hàm `password_hash` và `password_verify` để mã hóa và kiểm tra mật khẩu.
