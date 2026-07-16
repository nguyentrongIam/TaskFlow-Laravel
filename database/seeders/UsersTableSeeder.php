<?php

namespace Database \ Seeders ;
use Illuminate \ Database \ Seeder ;
use Illuminate \ Support \ Facades \DB;
use Illuminate \ Support \ Facades \ Hash ;
class UsersTableSeeder extends Seeder
{
public function run (): void
{
DB :: table ('users ') -> insert ([
[
'name ' => 'Son Pham ',
'email ' => ' Son@example . com ',
'password ' => Hash :: make (' password123 '),
'role ' => 'admin ',
],
[
'name ' => 'Nam Nguyen ',
'email ' => ' nam@example . com ',
'password ' => Hash :: make (' password123 '),
'role ' => 'staff ',
],
[
'name ' => 'Nu Thi ',
'email ' => ' nu@example . com ',
'password ' => Hash :: make (' password123 '),
'role ' => 'user ',
],
]);
}
}

