<?php
namespace Models;
use Interfaces\Locavel;

//classe que representa as motos
class Desenho extends Item implements Locavel {

    public function calcularAluguel(int $dias):float{
        return $dias * DIARIA_DESENHO;
    }

    public function alugar():string{
        if($this->disponivel){
            $this ->disponivel = false;
            return "Desenho '{$this->titulo}' alugada com sucesso!";
        }
        return "Desenho '{$this->titulo}' não está disponível.";
    }
    
    public function devolver() : string{
        if(!$this->disponivel){
            $this ->disponivel = true;
            return "Desenho '{$this->titulo}' devolvida com sucesso!";
        }
        return "Desenho '{$this->titulo}' já está disponível.";
    }

}