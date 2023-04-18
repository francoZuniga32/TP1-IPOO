<?php
class ResposableV {
    private $nroEmpleado;
    private $nroLicencia;
    private $nombre;
    private $apellido;

    public function __construct($nroEmpleado, $nroLicencia, $nombre, $apellido){
        $this->nroEmpleado = $nroEmpleado;
        $this->nroLicencia = $nroLicencia;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function setApellido($apellido){
        $this->apellido = $apellido;
    }

    public function getNroEmpleado(){
        return $this->nroEmpleado;
    }

    public function getNroLicencia(){
        return $this->nroLicencia;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getApellido(){
        return $this->apellido;
    }

}
?>