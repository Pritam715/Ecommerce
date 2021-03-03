<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use App\Models\PermissionCategory;
  
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $permissions_by_categories = [
            'Admin' => [
                'admin-view',
                'admin-create',
                'admin-edit',
                'admin-index',
                'admin-approve'
            ],
            'Roles' => [
                'role-view',
                'role-create',
                'role-edit',
                'role-index',
                'role-approve'
            ],
            'Product' => [
                'product-view',
                'product-create',
                'product-edit',
                'product-index',
                'product-approve'
            ],
            'Category'=>[
                'category-view',
                'category-create',
                'category-edit',
                'category-index',
                'category-approve'
            ]
           
        ];

        foreach ($permissions_by_categories as $key => $permissions) {
            $permission_category = PermissionCategory::create([
                'name' => $key
            ]);
            foreach ($permissions as $permission_name) {
                $permission = new Permission();
                $permission->name = $permission_name;
                $permission->permission_category_id = $permission_category->id;
                $permission->save();
            }
        }
    }
}
