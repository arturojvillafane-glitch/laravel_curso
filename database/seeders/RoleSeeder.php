<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
class RoleSeeder extends Seeder
{
    public function run(): void
    {
        /*
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Editor']);
        Permission::create(['name' => 'editor.post.index']);
        Permission::create(['name' => 'editor.post.create']);
        Permission::create(['name' => 'editor.post.update']);
        Permission::create(['name' => 'editor.post.destroy']);
        Permission::create(['name' => 'editor.category.index']);
        Permission::create(['name' => 'editor.category.create']);
        Permission::create(['name' => 'editor.category.update']);
        Permission::create(['name' => 'editor.category.destroy']);
        */

         // $role1 = Role::create(['name' => 'Admin']);
    // $role2 = Role::create(['name' => 'Editor']);
    // Permission::create(['name' => 'editor.post.index']);
    // Permission::create(['name' => 'editor.post.create']);
    // Permission::create(['name' => 'editor.post.update']);
    // Permission::create(['name' => 'editor.post.destroy']);
    // Permission::create(['name' => 'editor.category.index']);
    // Permission::create(['name' => 'editor.category.create']);
    // Permission::create(['name' => 'editor.category.update']);
    // Permission::create(['name' => 'editor.category.destroy']);
    
    /*
    Permission::find(1)->assignRole(Role::find(1));
    Permission::find(2)->assignRole(Role::find(2));
    Permission::find(3)->assignRole(Role::find(3));
    */
    
    User::find(11)->givePermissionTo(Permission::find(1));
    }
}
