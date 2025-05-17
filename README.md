# Hướng dẫn sử dụng Git và GitHub

## 1. Khởi tạo Git và đẩy folder lên GitHub

```bash
# Di chuyển đến thư mục dự án
cd duong_dan/ten_folder

# Khởi tạo Git
git init

# Thêm tất cả file vào Git
git add .

# Commit lần đầu
git commit -m "Initial commit"

# Kết nối đến repository trên GitHub
git remote add origin https://github.com/ThanzhChuq/do-an-phan-mem

# Đẩy lên GitHub (nhánh main)
git push -u origin main

## 1. Khởi tạo Git và đẩy folder lên GitHub

```bash
## Tạo folder mới, ví dụ: assets/
mkdir assets

# Thêm file vào để Git nhận diện folder
touch assets/.gitkeep

# Thêm vào Git và đẩy lên
git add assets/
git commit -m "Thêm folder assets"
git push


## 3. Sửa folder (sửa file bên trong folder)

# Sau khi sửa xong
git add assets/info.txt
git commit -m "Cập nhật nội dung file info.txt"
git push

## 4. Xóa folder
rm -r assets/

# Cập nhật thay đổi vào Git
git rm -r assets/
git commit -m "Xóa folder assets"
git push
