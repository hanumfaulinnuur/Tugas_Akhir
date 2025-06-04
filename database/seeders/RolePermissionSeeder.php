<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name'=>'tambah-user']);
        Permission::create(['name'=>'edit-user']);
        Permission::create(['name'=>'hapus-user']);
        Permission::create(['name'=>'lihat-user']);
    
        Permission::create(['name'=>'tambah-surat']);
        Permission::create(['name'=>'edit-surat']);
        Permission::create(['name'=>'hapus-surat']);
        Permission::create(['name'=>'lihat-surat']);
        Permission::create(['name'=>'buat-surat']);

        Role::create(['name'=>'admin']);
        Role::create(['name'=>'kepala_sekolah']);
        Role::create(['name'=>'guru']);

        $roleAdmin = Role::findByName('admin');
        $roleAdmin->givePermissionTo('tambah-user');
        $roleAdmin->givePermissionTo('edit-user');
        $roleAdmin->givePermissionTo('hapus-user');
        $roleAdmin->givePermissionTo('lihat-user');
        $roleAdmin->givePermissionTo('tambah-surat');
        $roleAdmin->givePermissionTo('edit-surat');
        $roleAdmin->givePermissionTo('hapus-surat');
        $roleAdmin->givePermissionTo('lihat-surat');
        $roleAdmin->givePermissionTo('buat-surat');

        $roleKepala_sekolah = Role::findByName('kepala_sekolah');
        $roleKepala_sekolah->givePermissionTo('lihat-surat');

        $roleGuru = Role::findByName('guru');
        $roleGuru->givePermissionTo('lihat-surat');


    }
}
