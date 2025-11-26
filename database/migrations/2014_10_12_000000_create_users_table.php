<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('is_admin')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });

        $data = array(
            [
                'name' => 'Alanna Crooks',
                'email' => 'mark14@example.com',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 'oCfUTSup20',
            ],
            [
                'name' => 'Abraham Huel',
                'email' => 'bartell.adolfo@example.net',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 'XuBFrUC9Kg',
            ],
            [
                'name' => 'Arden Sanford',
                'email' => 'domenico.howell@example.net',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 'ZXIuePaokt',
            ],
            [
                'name' => 'Alessandra Vandervort',
                'email' => 'hbednar@example.org',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 'SSdRAeGOD1',
            ],
            [
                'name' => 'Alec Lehner II',
                'email' => 'juliet.white@example.com',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 'b9JnTLMaA3',
            ],
            [
                'name' => 'Carolina Grady',
                'email' => 'wmedhurst@example.net',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 'HWFVW3ggpw',
            ],
            [
                'name' => 'Mrs. Frida Feil',
                'email' => 'vbins@example.com',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => '6uIqa4bHQ7',
            ],
            [
                'name' => 'Olin Jacobson',
                'email' => 'owuckert@example.org',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 'p3w5TZfm0I',
            ],
            [
                'name' => 'Mathias Appelmans',
                'email' => 'math.appelmans@gmail.com',
                'password' => Hash::make("password"),
                'remember_token' => '3XkhiKXqyf',
            ],
            [
                'name' => 'Coy Kuhlman',
                'email' => 'kasandra.veum@example.org',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 'WZumOLoTVi',
            ]
        );
        foreach ($data as $d){
            $user = new User();
            $user->name =$d['name'];
            $user->email = $d['email'];
            $user->password = $d['password'];
            $user->remember_token = $d['remember_token'];
            $user->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
