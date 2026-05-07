# Hệ Thống Quản Lý Admin CloudJourney

## Thông Tin Đăng Nhập Admin Ban Đầu

**Tên đăng nhập:** `admin`
**Mật khẩu:** `password`
**Email:** `admin@cloudjourney.vn`

> ⚠️ **Lưu ý:** Hãy thay đổi mật khẩu ngay sau lần đăng nhập đầu tiên để bảo mật hệ thống!

---

## Cách Truy Cập Admin Panel

1. Truy cập trang đăng nhập: `http://localhost/login` hoặc `http://yoursite.com/login`
2. Nhập tên đăng nhập: `admin`
3. Nhập mật khẩu: `password`
4. Nhấn "Đăng nhập"
5. Bạn sẽ được chuyển hướng tới Admin Dashboard tại `/admin/index`

---

## Các Tính Năng Quản Lý Admin

### 1. **Quản Lý Người Dùng** (`/admin/users`)

#### Xem Danh Sách Người Dùng
- Hiển thị tất cả người dùng trong hệ thống
- Thông tin gồm: ID, tên đăng nhập, họ tên, email, vai trò, trạng thái, ngày tạo

#### Tạo Admin Mới (`/admin/users/create`)
- Nhấn nút **"Tạo Admin mới"**
- Điền thông tin:
  - **Tên đăng nhập** (3-20 ký tự, chỉ dùng chữ, số, dấu gạch dưới, dấu chấm)
  - **Email** (phải là email hợp lệ)
  - **Họ và tên** (tên đầy đủ)
  - **Mật khẩu** (tối thiểu 8 ký tự)
  - **Xác nhận mật khẩu** (phải trùng với mật khẩu trên)
- Nhấn **"Tạo Admin"**

#### Nâng Cấp User Thành Admin
- Nhấn biểu tượng ⭐ (grade icon) ở cột "Hành động"
- User sẽ được nâng cấp thành Admin ngay lập tức

#### Hạ Admin Xuống Member
- Nhấn biểu tượng ⬇️ (trending_down icon) ở cột "Hành động"
- Admin sẽ bị hạ xuống Member

#### Khóa Tài Khoản User
- Nhấn biểu tượng 🔒 (lock icon) ở cột "Hành động"
- User sẽ bị khóa và không thể đăng nhập
- Sẽ nhận lỗi "Tài khoản của bạn đã bị khóa!" khi cố gắng đăng nhập

#### Mở Khóa Tài Khoản User
- Nhấn biểu tượng 🔓 (lock_open icon) ở cột "Hành động"
- User sẽ được mở khóa và có thể đăng nhập lại

#### Xóa Tài Khoản User
- Nhấn biểu tượng 🗑️ (delete icon) ở cột "Hành động"
- Xác nhận lệnh xóa
- **Cảnh báo:** Hành động này không thể hoàn tác!

---

### 2. **Các Quyền Hạn Admin**

✅ Admin có thể:
- Xem tất cả người dùng trong hệ thống
- Tạo tài khoản admin mới
- Nâng cấp/hạ cấp người dùng
- Khóa/mở khóa tài khoản
- Xóa tài khoản người dùng
- Quản lý tour, đặt tour, liên hệ, tin tức, FAQ, bình luận, đánh giá
- Cài đặt các thông tin chung của website

❌ Member không thể:
- Truy cập Admin Panel
- Quản lý bất kỳ dữ liệu nào của hệ thống

---

### 3. **Bảo Vệ Admin Panel**

Admin Panel được bảo vệ bằng cơ chế kiểm tra vai trò:
- **Nếu chưa đăng nhập**: Sẽ được chuyển hướng tới trang login
- **Nếu là Member**: Sẽ bị cấm truy cập admin pages
- **Nếu là Admin**: Có thể truy cập tất cả các tính năng admin

---

## Cấu Trúc URL Admin

| Chức Năng | URL |
|-----------|-----|
| Dashboard Admin | `/admin/index` |
| Danh sách người dùng | `/admin/users` |
| Tạo admin mới | `/admin/users/create` |
| Lưu admin mới | `/admin/users/store` (POST) |
| Nâng cấp user → admin | `/admin/users/promote?id=X` |
| Hạ admin → member | `/admin/users/demote?id=X` |
| Khóa user | `/admin/users/ban?id=X` |
| Mở khóa user | `/admin/users/unban?id=X` |
| Xóa user | `/admin/users/delete?id=X` |

---

## Hướng Dẫn Bảo Mật

1. **Thay đổi mật khẩu admin ban đầu**
   - Đăng nhập với tài khoản `admin / password`
   - Vào trang profile (nếu có)
   - Thay đổi mật khẩu thành một mật khẩu mạnh

2. **Tạo nhiều admin accounts**
   - Để tránh bị lộ mật khẩu, tạo nhiều tài khoản admin khác nhau
   - Mỗi admin có thể sử dụng riêng tài khoản của mình

3. **Không chia sẻ tài khoản admin**
   - Mỗi admin nên có tài khoản riêng
   - Dễ dàng theo dõi ai đã thực hiện hành động gì

4. **Kiểm tra log activities (nếu có)**
   - Theo dõi các hoạt động của admin
   - Phát hiện các hành động bất thường

---

## Các Thay Đổi Kỹ Thuật

### Database
- Bảng `users` đã có sẵn cột `role` (enum: 'admin', 'member')
- Bảng `users` đã có sẵn cột `status` (enum: 'active', 'banned')

### Models
- **User Model** có các method mới:
  - `createAdmin()` - Tạo admin mới
  - `promoteToAdmin()` - Nâng cấp member → admin
  - `demoteToMember()` - Hạ admin → member
  - `ban()` - Khóa tài khoản
  - `unban()` - Mở khóa tài khoản
  - `delete()` - Xóa tài khoản

### Controllers
- **AdminController** có các method mới:
  - `users()` - Danh sách người dùng
  - `users_create()` - Form tạo admin
  - `users_store()` - Xử lý lưu admin mới
  - `users_promote()` - Nâng cấp user
  - `users_demote()` - Hạ admin
  - `users_ban()` - Khóa user
  - `users_unban()` - Mở khóa user
  - `users_delete()` - Xóa user

### Views
- **Admin Layout** được cập nhật thêm menu "Quản lý người dùng"
- **Admin Users Index** - Hiển thị danh sách người dùng với các nút hành động
- **Admin Users Create** - Form tạo admin mới

### Routing
- Router (`index.php`) được cập nhật hỗ trợ nested routes như `/admin/users/create`

---

## Troubleshooting

### 1. Lỗi: "Cannot redeclare Validator::passwordMatch()"
**Giải pháp:** File `config/Validator.php` đã bị fix - phương thức trùng lặp được xóa.

### 2. Lỗi: "Tài khoản của bạn đã bị khóa!"
**Giải pháp:** Admin cần mở khóa tài khoản trước khi user có thể đăng nhập lại.

### 3. Lỗi: "Tên đăng nhập hoặc email đã tồn tại!"
**Giải pháp:** Sử dụng tên đăng nhập và email chưa tồn tại trong hệ thống.

### 4. Lỗi: "Đã xảy ra lỗi, vui lòng thử lại!"
**Giải pháp:** Kiểm tra:
- Kết nối database có bình thường?
- Các trường bắt buộc có được điền đầy đủ?
- Database có đủ dung lượng?

---

## FAQ

**Q: Có thể xóa tài khoản admin duy nhất không?**
A: Có, hệ thống cho phép xóa tất cả tài khoản. Khuyến nghị: Luôn giữ ít nhất 1 tài khoản admin.

**Q: Mất access vào admin, phải làm gì?**
A: Liên hệ quản trị viên database để reset tài khoản hoặc import lại SQL file.

**Q: Có thể khôi phục tài khoản đã xóa không?**
A: Không, hãy backup database trước khi xóa tài khoản.

**Q: Admin A xem được tài khoản của Admin B không?**
A: Có, tất cả admin đều có quyền quản lý tất cả tài khoản user và admin khác.

---

## Liên Hệ & Hỗ Trợ

Nếu gặp vấn đề, vui lòng liên hệ:
- **Email:** support@cloudjourney.vn
- **Điện thoại:** 0901234567
- **Địa chỉ:** Đại học Bách Khoa, TP.HCM

---

**Phiên bản:** 1.0
**Ngày cập nhật:** May 7, 2026
**Tác giả:** CloudJourney Development Team
