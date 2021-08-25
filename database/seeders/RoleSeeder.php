<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Funcionalidad INFO: https://youtu.be/r5Zs9CGB754?list=PLZ2ovOgdI-kX3XFj77zlvSQYhJyJSYQWr&t=372 */

        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Publicador']);

        Permission::create(['name' => 'admin.home', 'description' => 'Ver el dashboard'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.users.index', 'description' => 'Ver listado de usuarios'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.edit', 'description' => 'Asignar un rol'])->syncRoles([$role1]);
        
        Permission::create(['name' => 'admin.categories.index', 'description' => 'Ver listado de categorías'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.categories.create', 'description' => 'Crear categorías'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.categories.edit', 'description' => 'Editar categorías'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.categories.destroy', 'description' => 'Eliminar categorías'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.subcategories.index', 'description' => 'Ver listado de Subcategorías'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.subcategories.create', 'description' => 'Crear Subcategorías'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.subcategories.edit', 'description' => 'Editar Subcategorías'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.subcategories.destroy', 'description' => 'Eliminar Subcategorías'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.tags.index', 'description' => 'Ver listado de etiquetas'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.tags.create', 'description' => 'Crear etiquetas'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.tags.edit', 'description' => 'Editar etiquetas'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.tags.destroy', 'description' => 'Eliminar etiquetas'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.posts.index', 'description' => 'Ver listados de publicaciones'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.posts.create', 'description' => 'Crear publicaciones'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.posts.edit', 'description' => 'Editar publicaciones'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.posts.destroy', 'description' => 'Eliminar publicaciones'])->syncRoles([$role1, $role2]);
        
        /* PUBLISHER */
        Permission::create(['name' => 'publisher.index', 'description' => 'Publicador: Ver Dashboard'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'publisher.posts.create', 'description' => 'Publicador: Crear publicaciones'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'publisher.posts.edit', 'description' => 'Publicador: Editar publicaciones'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'publisher.posts.files', 'description' => 'Publicador: Subir imagenes'])->syncRoles([$role1, $role2]);
        
        Permission::create(['name' => 'publisher.orders.index', 'description' => 'Publicador: Listar ordenes'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'publisher.orders.show', 'description' => 'Publicador: Ver, editar y eliminar ordenes'])->syncRoles([$role1, $role2]);
        
        Permission::create(['name' => 'publisher.categories.index', 'description' => 'Publicador: Listar categorias'])->syncRoles([$role1]);
        Permission::create(['name' => 'publisher.categories.show', 'description' => 'Publicador: Ver, editar y eliminar categorias'])->syncRoles([$role1]);
        
        Permission::create(['name' => 'publisher.brands.index', 'description' => 'Publicador: Ver, editar y eliminar marcas'])->syncRoles([$role1]);

    }
}
