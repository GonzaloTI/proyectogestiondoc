<?php

namespace Database\Seeders;

use App\Models\abogado;
use App\Models\almacen;
use App\Models\cliente;
use App\Models\factura;
use App\Models\Producto;
use Illuminate\Database\Seeder;

use App\Models\proveedor;
use App\Models\compra;
use App\Models\juece;
use App\Models\User;
use App\Models\rol;
use App\Models\suministro;
use App\Models\venta;
use App\Models\vista;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(){
        // \App\Models\User::factory(10)->create();
        $user = new User;
        $user->name = 'admin';
        $user->carnet = '1234';
        $user->email =  'admin@juridico.com';
        $user->password = '1234';
        $user->role = 'admin';
        $user->save();


        $user = new User;
        $user->name = 'abogado1';
        $user->carnet = '456546';
        $user->email =  'abogado1@gmail.com';
        $user->password = '1234';
        $user->role = 'abogado';
        $user->save();


        $user = new User;
        $user->name = 'abogado2';
        $user->carnet = '4565654';
        $user->email =  'abogado2@gmail.com';
        $user->password = '1234';
        $user->role = 'abogado';
        $user->save();

        $user = new User;
        $user->name = 'juez1';
        $user->carnet = '53452324';
        $user->email =  'juez1@gmail.com';
        $user->password = '1234';
        $user->role = 'juez';
        $user->save();
    


        $rols = new rol;
        $rols->descripcion = 'abogado';
        $rols->save();

        $rols = new rol;
        $rols->descripcion = 'juez';
        $rols->save();

        $rols = new rol;
        $rols->descripcion = 'admin';
        $rols->save();

        $user = new cliente;
        $user->ci = '88000';
        $user->nombre = 'joaquin';
        $user->a_paterno =  'chumacero';
        $user->a_materno= 'yupanqui';
        $user->sexo= 'm';
        $user->telefono = '12345678';
        $user->direccion = 'av. brasil';
        $user->estado = 'h';
        $user->save();

        $user = new cliente;
        $user->ci = '99000';
        $user->nombre = 'saturnino';
        $user->a_paterno =  'mamani';
        $user->a_materno= 'yupanqui';
        $user->sexo= 'm';
        $user->telefono = '12345678';
        $user->direccion = 'av. brasil 2';
        $user->estado = 'h';
        $user->save();

        $user = new vista;
        $user->ci = '99000';
        $user->nombre = 'saturnino';
        $user->a_paterno =  'mamani';
        $user->a_materno= 'mamani';
        $user->sexo= 'm';
        $user->telefono = '1234578';
        $user->direccion = 'av. bush nro 34';
        $user->estado = 'h';
        $user->save();
        $user = new vista;
        $user->ci = '44000';
        $user->nombre = 'ana maria';
        $user->a_paterno =  'torrez';
        $user->a_materno= 'mamani';
        $user->sexo= 'f';
        $user->telefono = '12345678';
        $user->direccion = 'av.santos dumont nro 364';
        $user->estado = 'h';
        $user->save();
        $user = new vista;
        $user->ci = '77000';
        $user->nombre = 'joaquin';
        $user->a_paterno =  'chumacero';
        $user->a_materno= 'yupanqui';
        $user->sexo= 'm';
        $user->telefono = '5324132';
        $user->direccion = 'av. banzer nro 34';
        $user->estado = 'h';
        $user->save();

        $user = new juece;
        $user->ci = '88000';
        $user->nombre = 'pedro';
        $user->a_paterno =  'paredez';
        $user->a_materno= 'cruz';
        $user->sexo= 'm';
        $user->telefono = '54136452';
        $user->direccion = 'av. brasil 2';
        $user->estado = 'h';
        $user->user_id = '4';
        $user->save();

        $user = new abogado;
        $user->ci = '3300111';
        $user->nombre = 'roberto';
        $user->a_paterno =  'dominguez';
        $user->a_materno= 'paz';
        $user->sexo= 'm';
        $user->telefono = '43656435';
        $user->direccion = 'av. 2 julio ';
        $user->estado = 'h';
        $user->user_id = '2';
        $user->save();

        $user = new abogado;
        $user->ci = '2200555';
        $user->nombre = 'pablo';
        $user->a_paterno =  'cortez';
        $user->a_materno= 'vallejos';
        $user->sexo= 'm';
        $user->telefono = '75643';
        $user->direccion = 'av.los pinos';
        $user->estado = 'h';
        $user->user_id = '3';
        $user->save();

    }




}
