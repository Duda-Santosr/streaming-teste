<?php
namespace Models;
use Interfaces\Locavel;

//classe que representa as motos
class Serie extends Item implements Locavel {

    public function calcularAluguel(int $dias):float{
        return $dias * DIARIA_SERIE;
    }

    public function alugar():string{
        if($this->disponivel){
            $this ->disponivel = false;
            return "Serie '{$this->titulo}' alugada com sucesso!";
        }
        return "Serie '{$this->titulo}' não está disponível.";
    }
    
    public function devolver() : string{
        if(!$this->disponivel){
            $this ->disponivel = true;
            return "Serie '{$this->titulo}' devolvida com sucesso!";
        }
        return "Serie '{$this->titulo}' já está disponível.";
    }

}