<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Conecta a la base de datos  con usuario, contraseña y nombre de la BD
$username = "andreacordon";
$password = "N2l@7nu1";
$database = "andreacordon";

$mysqli = new mysqli("localhost", $username, $password, $database);
mysqli_set_charset($mysqli,'UTF8');

//*LISTAR CON ID COMO PARAMETRO:

// Consulta datos y recepciona una clave para consultar dichos datos con dicha clave
if (isset($_GET["detallesUsuario"])){
    $sqlEmpleaados = mysqli_query($conexionBD,"SELECT * FROM usuarios WHERE id=".$_GET["detallesUsuario"]);
    if(mysqli_num_rows($sqlEmpleaados) > 0){
        $empleaados = mysqli_fetch_all($sqlEmpleaados,MYSQLI_ASSOC);
        echo json_encode($empleaados);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}

if (isset($_GET["detallesCliente"])){
    $sqlEmpleaados = mysqli_query($conexionBD,"SELECT * FROM clientes WHERE id=".$_GET["detallesCliente"]);
    if(mysqli_num_rows($sqlEmpleaados) > 0){
        $empleaados = mysqli_fetch_all($sqlEmpleaados,MYSQLI_ASSOC);
        echo json_encode($empleaados);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}

if (isset($_GET["detallesPoliza"])){
    $sqlEmpleaados = mysqli_query($conexionBD,"SELECT * FROM polizas WHERE id=".$_GET["detallesPoliza"]);
    if(mysqli_num_rows($sqlEmpleaados) > 0){
        $empleaados = mysqli_fetch_all($sqlEmpleaados,MYSQLI_ASSOC);
        echo json_encode($empleaados);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}

//polizas de 1 cliente:
if (isset($_GET["damePolizasCliente"])){
    $sqlEmpleaados = mysqli_query($conexionBD,"SELECT * FROM polizas WHERE cliente_id=".$_GET["damePolizasCliente"]);
    if(mysqli_num_rows($sqlEmpleaados) > 0){
        $empleaados = mysqli_fetch_all($sqlEmpleaados,MYSQLI_ASSOC);
        echo json_encode($empleaados);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}

//*BORRAR

//borrar pero se le debe de enviar una clave ( para borrado )
if (isset($_GET["borrarUsuario"])){
    $sqlEmpleaados = mysqli_query($conexionBD,"DELETE FROM usuarios WHERE id=".$_GET["borrarUsuario"]);
    if($sqlEmpleaados){
        echo json_encode(["success"=>1]);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}

if (isset($_GET["borrarPoliza"])){
    $sqlEmpleaados = mysqli_query($conexionBD,"DELETE FROM polizas WHERE id=".$_GET["borrarPoliza"]);
    if($sqlEmpleaados){
        echo json_encode(["success"=>1]);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}

if (isset($_GET["borrarCliente"])){
    $sqlEmpleaados = mysqli_query($conexionBD,"DELETE FROM clientes WHERE id=".$_GET["borrarCliente"]);
    if($sqlEmpleaados){
        echo json_encode(["success"=>1]);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}

//*INSERTAR:

//Inserta un nuevo registro y recepciona en método post los datos de nombre y email
if(isset($_GET["insertarUsuario"])){
    $data = json_decode(file_get_contents("php://input"));
    $nombre=$data->nombre;
    $email=$data->email;
    $pass=$data->pass;
        if(($email!="")&&($nombre!="")&&($pass!="")){
            
    $sqlEmpleaados = mysqli_query($conexionBD,"INSERT INTO usuarios(nombre,email,pass) VALUES('$nombre','$email','$pass') ");
    echo json_encode(["success"=>1]);
        }
    exit();
}

if(isset($_GET["insertarPoliza"])){
    $data = json_decode(file_get_contents("php://input"));
    $importe=$data->importe;
    $fecha=$data->fecha;
    $estado=$data->estado;
    $observaciones=$data->observaciones;
    $cliente_id=$data->cliente_id;
        if(($fecha!="")&&($importe!="")&&($estado!="")&&($observaciones!="")&&($cliente_id!="")){
            
    $sqlEmpleaados = mysqli_query($conexionBD,"INSERT INTO polizas(importe,fecha,estado,observaciones,cliente_id) VALUES('$importe','$fecha','$estado','$observaciones','$cliente_id') ");
    echo json_encode(["success"=>1]);
        }
    exit();
}

if(isset($_GET["insertarCliente"])){
    $data = json_decode(file_get_contents("php://input"));
    $nombre=$data->nombre;
    $apellidos=$data->apellidos;
    $tlf=$data->tlf;
    $municipio=$data->municipio;
    $cp=$data->cp;
    $provincia=$data->provincia;
    $tipo=$data->tipo;
        if(($nombre!="")&&($apellidos!="")&&($tlf!="")&&($municipio!="")&&($cp!="")&&($provincia!="")&&($tipo!="")){
            
    $sqlEmpleaados = mysqli_query($conexionBD,"INSERT INTO clientes(nombre,apellidos,tlf,municipio,cp,provincia,tipo) 
    VALUES('$nombre','$apellidos','$tlf','$municipio','$cp','$provincia','$tipo') ");
    echo json_encode(["success"=>1]);
        }
    exit();
}

//*ACTUALIZAR:

// Actualiza datos pero recepciona datos de nombre, correo y una clave para realizar la actualización
if(isset($_GET["editarUsuario"])){
    
    $data = json_decode(file_get_contents("php://input"));

    $id=(isset($data->id))?$data->id:$_GET["editarUsuario"];
    $nombre=$data->nombre;
    $email=$data->email;
    $pass=$data->pass;

    $sqlEmpleaados = mysqli_query($conexionBD,"UPDATE usuarios SET nombre='$nombre',email='$email',pass='$pass' WHERE id='$id'");
    echo json_encode(["success"=>1]);
    exit();
}

if(isset($_GET["editarCliente"])){
    
    $data = json_decode(file_get_contents("php://input"));

    $id=(isset($data->id))?$data->id:$_GET["editarCliente"];
    $nombre=$data->nombre;
    $apellidos=$data->apellidos;
    $tlf=$data->tlf;
    $municipio=$data->municipio;
    $cp=$data->cp;
    $provincia=$data->provincia;
    $tipo=$data->tipo;

    $sqlEmpleaados = mysqli_query($conexionBD,"UPDATE clientes SET 
    nombre='$nombre',apellidos='$apellidos',tlf='$tlf',municipio='$municipio',cp='$cp',provincia='$provincia',tipo='$tipo' WHERE id='$id'");
    echo json_encode(["success"=>1]);
    exit();
}

if(isset($_GET["editarPoliza"])){
    
    $data = json_decode(file_get_contents("php://input"));

    $id=(isset($data->id))?$data->id:$_GET["editarPoliza"];
    $importe=$data->importe;
    $fecha=$data->fecha;
    $estado=$data->estado;
    $observaciones=$data->observaciones;
    $cliente_id=$data->cliente_id;

    $sqlEmpleaados = mysqli_query($conexionBD,"UPDATE polizas SET importe='$importe',fecha='$fecha',estado='$estado',observaciones='$observaciones',cliente_id='$cliente_id' WHERE id='$id'");
    echo json_encode(["success"=>1]);
    exit();
}

//*LISTAR TODOS LOS RESULTADOS

if (isset($_GET["dameProvincias"])){
    $sqlEmpleaados = mysqli_query($conexionBD,"SELECT * FROM provincias");
    if(mysqli_num_rows($sqlEmpleaados) > 0){
        $empleaados = mysqli_fetch_all($sqlEmpleaados,MYSQLI_ASSOC);
        echo json_encode($empleaados);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}

if (isset($_GET["dameNombreProvincias"])){
    $sqlEmpleaados = mysqli_query($conexionBD,"SELECT * FROM provincias WHERE provincia=".$_GET["dameNombreProvincias"]);
    if(mysqli_num_rows($sqlEmpleaados) > 0){
        $empleaados = mysqli_fetch_all($sqlEmpleaados,MYSQLI_ASSOC);
        echo json_encode($empleaados);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}

if (isset($_GET["dameMunicipios"])){
    $sqlEmpleaados = mysqli_query($conexionBD,"SELECT * FROM municipios WHERE provincia=".$_GET["dameMunicipios"]);
    if(mysqli_num_rows($sqlEmpleaados) > 0){
        $empleaados = mysqli_fetch_all($sqlEmpleaados,MYSQLI_ASSOC);
        echo json_encode($empleaados);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}

if (isset($_GET["dameClientes"])){
    $sqlEmpleaados = mysqli_query($conexionBD,"SELECT * FROM clientes");
    if(mysqli_num_rows($sqlEmpleaados) > 0){
        $empleaados = mysqli_fetch_all($sqlEmpleaados,MYSQLI_ASSOC);
        echo json_encode($empleaados);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}

if (isset($_GET["damePolizas"])){
    $sqlEmpleaados = mysqli_query($conexionBD,"SELECT * FROM polizas ORDER BY fecha DESC");
    if(mysqli_num_rows($sqlEmpleaados) > 0){
        $empleaados = mysqli_fetch_all($sqlEmpleaados,MYSQLI_ASSOC);
        echo json_encode($empleaados);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}

if (isset($_GET["dameUsuarios"])){
    $sqlEmpleaados = mysqli_query($conexionBD,"SELECT * FROM usuarios");
    if(mysqli_num_rows($sqlEmpleaados) > 0){
        $empleaados = mysqli_fetch_all($sqlEmpleaados,MYSQLI_ASSOC);
        echo json_encode($empleaados);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}