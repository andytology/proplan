<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;

class HashExistingPasswordsSeeder extends Seeder
{
    public function run()
    {
        $mapping = [
            'ana@admin.com'       => 'admin123',
            'carlos@proplan.com'  => 'jefe123',
            'lucia@proplan.com'   => 'user123',
            'diego@proplan.com'   => 'user123',
            'maria@proplan.com'   => 'user123',
        ];

        foreach ($mapping as $email => $plain) {
            $u = Usuario::where('email',$email)->first();
            if ($u && ! str_starts_with($u->contraseña,'$2y$')) {
                $u->contraseña = Hash::make($plain);
                $u->save();
            }
        }
    }
}
