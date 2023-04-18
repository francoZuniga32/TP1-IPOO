<?php
include_once 'Viajes.php';
include_once 'Pasajero.php';
include_once 'ResponsableV.php';

$viaje;

do {
    echo "Ingrese una de las siguientes opciones:";
    menu();
    $opcion = intval(trim(fgets(STDIN)));
    switch ($opcion) {
        case 1:
            $viaje = crearVuelo();
            break;
        case 2:
            if(existeViaje($viaje)) $viaje = cargarPasajero($viaje);
            break;
        case 3: 
            if(existeViaje($viaje))$viaje = modificarPasajero($viaje);
            break;
        case 4: 
            if(existeViaje($viaje)) $viaje = mostrarViaje($viaje);
            break;
        case 5:
            if(existeViaje($viaje)) $viaje = cargarResponsable($viaje);
            break;
        case 6:
            if(existeViaje($viaje)) $viaje = modificarResponsable($viaje);
            break;
        case 7:
            $opcion = -1;
            break;
    }
} while ($opcion != -1);

function menu(){
    echo '
    1. Crear un vuelo.
    2. Cargar un pasajero.
    3. Modificar un pasajero.
    4. Mostrar viaje.
    5. Agregar responsable.
    6. Modificar resposable.
    7. Salir.
    ';
}

function crearVuelo(){
    echo "--------------------------\n";
    echo "Ingrese el nro de vuelo:\n";
    $nrovuelo = trim(fgets(STDIN));
    echo "Ingrese el destino\n";
    $destino = trim(fgets(STDIN));
    do {
        echo "Ingrese el maximo de pasajeros\n";
        $cantidadMaximaPasajeros = intval(trim(fgets(STDIN)));
        if($cantidadMaximaPasajeros == 0) echo "Ingrese un numero mayor a cero de pasajeros.\n";
    } while ($cantidadMaximaPasajeros == 0);
    return new Viaje($nrovuelo, $destino, $cantidadMaximaPasajeros);
}

function cargarPasajero($viaje){
    echo "--------------------------\n";
    if($viaje->cantidadAsientosDisponibles() > 0){
        do {
            echo "Ingrese el dni del pasajero\n";
            $dni = intval(trim(fgets(STDIN)));
            $indice = $viaje->buscarPasajero($dni);
            if($indice != -1){
                echo "El pasajero ya esta registrado con el dni: \n".$dni;
            }
        } while ($indice != -1);
        echo "Ingrese el nombre del pasajero\n";
        $nombre = trim(fgets(STDIN));
        echo "Ingrese el apellido del pasajero\n";
        $apellido = trim(fgets(STDIN));
        echo "Ingrese un numero de telefono\n";
        $telefono = trim(fgets(STDIN));

        $viaje->agregarPasajero(new Pasajero($dni,$nombre, $apellido, $telefono));
    }else{
        echo "No quedan asientos disponibles\n";
    }
    return $viaje;
}

function modificarPasajero($viaje){
    echo "--------------------------";
    do{
        echo "Ingrese el dni del pasajero:\n";
        $dni = intval(trim(fgets(STDIN)));
        $indice = $viaje->buscarPasajero($dni);
        if($indice == -1) echo "El pasajero con el dni: ".$dni." no esta registrado\n"; 
    }while($indice == -1);
    $pasajero = $viaje->getPasajero($indice);
    echo "Pasajero:";
    echo "Nombre: ".$pasajero->getNombre()." ; Apellido: ".$pasajero->getApellido()."\n";
    echo "Ingrese el nuevo nombre: \n";
    $nuevoNombre = trim(fgets(STDIN));
    echo "Ingrese el nuevo apellido:\n";
    $nuevoApellido = trim(fgets(STDIN));
    echo "Ingrese el nuevo telefono:\n";
    $nuevoTelefono = trim(fgets(STDIN));
    $viaje->modificarPasajero($indice, $nuevoNombre, $nuevoApellido, $nuevoTelefono);
    return $viaje;
}

function mostrarViaje($viaje){
    echo "--------------------------\n";
    echo "NroViaje:".$viaje->getNroViaje()."\n";
    echo 'Destino: '.$viaje->getDestino()."\n";
    echo 'Cantidad Maxima Pasajeros: '.$viaje->getCapacidadMaxima()."\n";
}

function cargarResponsable($viaje){
    echo "--------------------------\n";
    $responsable = $viaje->getResposable();
    if(!isset( $responsable) ){
        //no tenemos resposable y cargamos los datos solicitados;
        echo "Ingrese el numero de empleado:\n";
        $nroEmpleado = trim(fgets(STDIN));
        echo "Ingrese el numero de licencia:\n";
        $nroLicencia = trim(fgets(STDIN));
        echo "Ingrese el nombre:\n";
        $nombre = trim(fgets(STDIN));
        echo "Ingrese el apellido:\n";
        $apellido = trim(fgets(STDIN));
        echo "Ingrese el telefono: \n";
        $telefono = trim(fgets(STDIN));
        $responsable = new ResposableV($nroEmpleado, $nroLicencia, $nombre, $apellido, $telefono);
        $viaje->setResponsable($responsable);
    }else{
        echo "Ya existe un responsable de vuelo.\n";
    }
    return $viaje;
}

function modificarResponsable($viaje){
    $responsable = $viaje->getResposable();
    if(isset($responsable)){
        echo "Ingrese los nuevos datos de: ".$responsable->getNombre().", ".$responsable->getApellido()."\n";
        echo "Ingrese el nuevo nro de licencia:\n";
        $nroLicencia =  trim(fgets(STDIN));
        echo "Ingrese el nuevo nombre: \n";
        $nombre =  trim(fgets(STDIN));
        echo "Ingrese el nuevo apellido: \n";
        $apellido =  trim(fgets(STDIN));
        echo "Ingrese el nuevo telefono: \n";
        $telefono =  trim(fgets(STDIN));

        $nuevoResponsable = new ResposableV($responsable->getNroEmpleado(), $nroLicencia, $nombre, $apellido, $telefono);
        $viaje->setResponsable($nuevoResponsable);
    }else{
        echo "No existe un responsable de vuelo.\n";
    }
    return $viaje;
}

function existeViaje($viaje){
    if(!isset($viaje)){
        echo "Tiene que crear el viaje primero.\n";
        return false;
    }
    return true;
}
?>