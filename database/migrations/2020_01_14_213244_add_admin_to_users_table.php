<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\User;

class AddAdminToUsersTable extends Migration
{
    const ADMIN_DEFAULT_EMAIL = 'admin@eas.com';

    /**
     * This account creation is used to create skills (using /skills/create), which
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(env('ADMIN_EMAIL') == null) {
            $adminEmail = self::ADMIN_DEFAULT_EMAIL;
        } else {
            $adminEmail = env('ADMIN_EMAIL');
        }

        $user = User::where('email', $adminEmail)->first();

        if($user) {
            return;
        }

        $user = User::create([
            'name' => 'EAS Admin',
            'email' => $adminEmail,
            'password' => Hash::make('admin123'), //need to change once deployed
            'user_type' => '1'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $user = User::where('email', 'admin@eas.com');

        if($user) {
            $user->delete();
        }
    }
}
