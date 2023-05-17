<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>PDF Clientes</title>

    
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">-->
</head>
<body>
<h1 class="text-3xl text-center font-bold">Lista de Clientes</h1>


<!-- #############################################################3######--> 


<div class="container-fluid">

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
      <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Datos</h6>
      </div>
      <div class="card-body">
          <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                          <th>ID</th>
                          <th>Carnet</th>
                          <th>Nombre</th>
                          <th>A_paterno</th>
                          <th>A_materno</th>
                          <th>Sexo</th>
                          <th>Telefono</th>
                          <th>Direccion</th>
                          <th>Estado</th>
                          <th>F_Registro</th>
                      </tr>
                  </thead>

                  
                  <tbody>

      <!--############################################33#######-->

      @foreach($user as $row)

      <tr>
              <td class="py-3 px-7">{{$row->id}}</td>
              <td class="p-3">{{$row->ci}}</td>
              <td class="p-3 text-center">{{$row->nombre}}</td>
              <td class="p-3 text-center">{{$row->a_paterno}}</td>
              <td class="p-3 text-center">{{$row->a_materno}}</td>
              <td class="p-3 text-center">{{$row->sexo}}</td>
              <td class="p-3 text-center">{{$row->telefono}}</td>
              <td class="p-3 text-center">{{$row->direccion}}</td>
              <td class="p-3 text-center">{{$row->estado}}</td>
              <td class="p-3 text-center">{{$row->created_at}}</td>
       
            </tr>
  
    @endforeach

        <!--################################3#######-->              
                  </tbody>
              </table>
          </div>
      </div>
  </div>

</div>
</body>
</html>