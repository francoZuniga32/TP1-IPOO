<?php

class Viaje {
    private $nroviaje;
    private $destino;
    private $cantidadMaximaPasajeros;
    private $resposable;
    private $pasajeros = [];

    public function __construct($nroviaje, $destino, $cantidadMaximaPasajeros)
    {
        $this->nroviaje = $nroviaje;
        $this->destino = $destino;
        $this->cantidadMaximaPasajeros = $cantidadMaximaPasajeros;
    }

    public function agregarPasajero($pasajero){
        array_push($this->pasajeros, $pasajero);
    }

    public function buscarPasajero($dni){
        $i = 0;
        $indice = -1;
        $control = true;
        while($i < count($this->pasajeros) && $control){
            if($this->pasajeros[$i]->getDni() == $dni){
                $indice = $i;
                $control = false;
            }
            $i++;
        }

        return $indice;
    }  

    public function modificarPasajero($indice, $nuevoNombre, $nuevoApellido, $telefono){
        $this->pasajeros[$indice]->setNombre($nuevoNombre);
        $this->pasajeros[$indice]->setApellido($nuevoApellido);
        $this->pasajeros[$indice]->setTelefono($telefono);
    }

    public function cantidadAsientosDisponibles(){
        return $this->cantidadMaximaPasajeros - count($this->pasajeros);
    }

    public function getPasajero($indice){
        if($indice < count($this->pasajeros)) return $this->pasajeros[$indice];
        else return [];
    }


    public function getNroViaje(){
        return $this->nroviaje;
    }

    public function getDestino(){
        return $this->destino;
    }

    public function getCapacidadMaxima(){
        return $this->cantidadMaximaPasajeros;
    }

    public function getResposable(){
        return $this->resposable;
    }

    public function setResponsable($resposable){
        $this->resposable = $resposable;
    }
}

?>