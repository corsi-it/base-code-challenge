# Michele Capichioni Code Challenge

## Getting Started

### Roles

Create roles

´´´bash
./vendor/bin/sail artisan tinker
´´´

Then write the following code

´´´php
$role = new App\Models\Role();
$role->name = 'admin';
$role->save();

$role = new App\Models\Role();
$role->name = 'user';
$role->save();
´´´

### User

Create admin and user

´´´bash
./vendor/bin/sail artisan tinker
´´´

Then write the following code

´´´php
$user = new App\Models\User();
$user->password = Hash::make('password');
$user->email = 'admin@test.com';
$user->name = 'Admin Test';
$user->role_id = 1;
$user->save();

$user = new App\Models\User();
$user->password = Hash::make('password');
$user->email = 'user@test.com';
$user->name = 'User Test';
$user->role_id = 2;
$user->save();
´´´

