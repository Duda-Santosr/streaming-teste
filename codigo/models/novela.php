<?php
namespace Models;
use Interfaces\Locavel;

//classe que representa as motos
class Novela extends Item implements Locavel {

    public function calcularAluguel(int $dias):float{
        return $dias * DIARIA_NOVELA;
    }

    public function alugar():string{
        if($this->disponivel){
            $this ->disponivel = false;
            return "Novela '{$this->titulo}' alugada com sucesso!";
        }
        return "Novela '{$this->titulo}' não está disponível.";
    }
    
    public function devolver() : string{
        if(!$this->disponivel){
            $this ->disponivel = true;
            return "Novela '{$this->titulo}' devolvida com sucesso!";
        }
        return "Novela '{$this->titulo}' já está disponível.";
    }

}