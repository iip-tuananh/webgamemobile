<?php
use Illuminate\Database\Seeder;
use App\Model\Common\Permission;
use App\Model\Common\User;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('permission_has_types')->truncate();
        DB::table('permissions')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        Cache::flush('spatie.permission.cache');
        Cache::flush('spatie.role.cache');

        Permission::createRecord(['id' => 1, 'name' => 'Quản lý danh mục đặc biệt', 'display_name' => 'Quản lý danh mục', 'group' => 'Quản lý danh mục đặc biệt'], [User::SUPER_ADMIN, User::QUAN_TRI_VIEN]);
        Permission::createRecord(['id' => 2, 'name' => 'Thêm danh mục đặc biệt', 'display_name' => 'Tạo mới', 'group' => 'Quản lý danh mục đặc biệt'], [User::SUPER_ADMIN, User::QUAN_TRI_VIEN]);
        Permission::createRecord(['id' => 3, 'name' => 'Sửa danh mục đặc biệt', 'display_name' => 'Sửa', 'group' => 'Quản lý danh mục đặc biệt'], [User::SUPER_ADMIN, User::QUAN_TRI_VIEN]);
        Permission::createRecord(['id' => 4, 'name' => 'Xóa danh mục đặc biệt', 'display_name' => 'Xóa', 'group' => 'Quản lý danh mục đặc biệt'], [User::SUPER_ADMIN, User::QUAN_TRI_VIEN]);

		Permission::createRecord(['id' => 5, 'name' => 'Quản lý danh mục sản phẩm', 'display_name' => 'Quản lý danh mục', 'group' => 'Quản lý danh mục sản phẩm'], [User::SUPER_ADMIN, User::QUAN_TRI_VIEN]);
		Permission::createRecord(['id' => 6, 'name' => 'Thêm danh mục sản phẩm', 'display_name' => 'Tạo mới', 'group' => 'Quản lý danh mục sản phẩm'], [User::SUPER_ADMIN, User::QUAN_TRI_VIEN]);
        Permission::createRecord(['id' => 7, 'name' => 'Sửa danh mục sản phẩm', 'display_name' => 'Sửa', 'group' => 'Quản lý danh mục sản phẩm'], [User::SUPER_ADMIN, User::QUAN_TRI_VIEN]);
        Permission::createRecord(['id' => 8, 'name' => 'Xóa danh mục sản phẩm', 'display_name' => 'Xóa', 'group' => 'Quản lý danh mục sản phẩm'], [User::SUPER_ADMIN, User::QUAN_TRI_VIEN]);

		Permission::createRecord(['id' => 9, 'name' => 'Quản lý sản phẩm', 'display_name' => 'Quản lý sản phẩm', 'group' => 'Quản lý sản phẩm'], [User::SUPER_ADMIN, User::QUAN_TRI_VIEN, User::KHACH_HANG]);
		Permission::createRecord(['id' => 10, 'name' => 'Thêm sản phẩm', 'display_name' => 'Tạo mới', 'group' => 'Quản lý sản phẩm'], [User::SUPER_ADMIN, User::QUAN_TRI_VIEN, User::KHACH_HANG]);
        Permission::createRecord(['id' => 11, 'name' => 'Sửa sản phẩm', 'display_name' => 'Sửa', 'group' => 'Quản lý sản phẩm'], [User::SUPER_ADMIN, User::QUAN_TRI_VIEN, User::KHACH_HANG]);
        Permission::createRecord(['id' => 12, 'name' => 'Xóa sản phẩm', 'display_name' => 'Xóa', 'group' => 'Quản lý sản phẩm'], [User::SUPER_ADMIN, User::QUAN_TRI_VIEN, User::KHACH_HANG]);

		Permission::createRecord(['id' => 13, 'name' => 'Quản lý danh mục bài viết', 'display_name' => 'Quản lý danh mục', 'group' => 'Quản lý danh mục bài viết'], [User::SUPER_ADMIN, User::QUAN_TRI_VIEN]);
		Permission::createRecord(['id' => 14, 'name' => 'Thêm danh mục bài viết', 'display_name' => 'Tạo mới', 'group' => 'Quản lý danh mục bài viết'], [User::SUPER_ADMIN, User::QUAN_TRI_VIEN]);
        Permission::createRecord(['id' => 15, 'name' => 'Sửa danh mục bài viết', 'display_name' => 'Sửa', 'group' => 'Quản lý danh mục bài viết'], [User::SUPER_ADMIN, User::QUAN_TRI_VIEN]);
        Permission::createRecord(['id' => 16, 'name' => 'Xóa danh mục bài viết', 'display_name' => 'Xóa', 'group' => 'Quản lý danh mục bài viết'], [User::SUPER_ADMIN, User::QUAN_TRI_VIEN]);

		Permission::createRecord(['id' => 17, 'name' => 'Quản lý bài viết', 'display_name' => 'Quản lý bài viết', 'group' => 'Quản lý bài viết'], [User::SUPER_ADMIN, User::QUAN_TRI_VIEN]);
		Permission::createRecord(['id' => 18, 'name' => 'Thêm bài viết', 'display_name' => 'Tạo mới', 'group' => 'Quản lý bài viết'], [User::SUPER_ADMIN, User::QUAN_TRI_VIEN]);
        Permission::createRecord(['id' => 19, 'name' => 'Sửa bài viết', 'display_name' => 'Sửa', 'group' => 'Quản lý bài viết'], [User::SUPER_ADMIN, User::QUAN_TRI_VIEN]);
        Permission::createRecord(['id' => 20, 'name' => 'Xóa bài viết', 'display_name' => 'Xóa', 'group' => 'Quản lý bài viết'], [User::SUPER_ADMIN, User::QUAN_TRI_VIEN]);

		Permission::createRecord(['id' => 21, 'name' => 'Quản lý đơn hàng', 'display_name' => 'Quản lý đơn hàng', 'group' => 'Quản lý đơn hàng'], [User::SUPER_ADMIN, User::QUAN_TRI_VIEN]);
        Permission::createRecord(['id' => 22, 'name' => 'Đổi trạng thái đơn hàng', 'display_name' => 'Đổi trạng thái', 'group' => 'Quản lý đơn hàng'], [User::SUPER_ADMIN, User::QUAN_TRI_VIEN]);

        Permission::createRecord(['id' => 23, 'name' => 'Cập nhật cấu hình', 'display_name' => 'Cập nhật cấu hình', 'group' => 'Quản lý cấu hình chung'], [User::SUPER_ADMIN, User::QUAN_TRI_VIEN]);

		Permission::createRecord(['id' => 24, 'name' => 'Quản lý tài khoản', 'display_name' => 'Quản lý tài khoản', 'group' => 'Quản lý tài khoản'], [User::SUPER_ADMIN, User::QUAN_TRI_VIEN]);
		Permission::createRecord(['id' => 25, 'name' => 'Thêm tài khoản', 'display_name' => 'Tạo mới', 'group' => 'Quản lý tài khoản'], [User::SUPER_ADMIN, User::QUAN_TRI_VIEN]);
        Permission::createRecord(['id' => 26, 'name' => 'Sửa tài khoản', 'display_name' => 'Sửa', 'group' => 'Quản lý tài khoản'], [User::SUPER_ADMIN, User::QUAN_TRI_VIEN]);
        Permission::createRecord(['id' => 27, 'name' => 'Xóa tài khoản', 'display_name' => 'Xóa', 'group' => 'Quản lý tài khoản'], [User::SUPER_ADMIN, User::QUAN_TRI_VIEN]);

        Permission::createRecord(['id' => 28, 'name' => 'Quản lý chức vụ', 'display_name' => 'Quản lý chức vụ', 'group' => 'Quản lý chức vụ'], [User::SUPER_ADMIN, User::QUAN_TRI_VIEN]);
        Permission::createRecord(['id' => 29, 'name' => 'Thêm chức vụ', 'display_name' => 'Tạo mới', 'group' => 'Quản lý chức vụ'], [User::SUPER_ADMIN, User::QUAN_TRI_VIEN]);
        Permission::createRecord(['id' => 30, 'name' => 'Sửa chức vụ', 'display_name' => 'Sửa', 'group' => 'Quản lý chức vụ'], [User::SUPER_ADMIN, User::QUAN_TRI_VIEN]);
        Permission::createRecord(['id' => 31, 'name' => 'Xóa chức vụ', 'display_name' => 'Xóa', 'group' => 'Quản lý chức vụ'], [User::SUPER_ADMIN, User::QUAN_TRI_VIEN]);
	}
}
