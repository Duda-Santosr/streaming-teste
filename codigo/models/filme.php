<?php
namespace Models;
use Interfaces\Locavel;

// Classe que representa um carro

class Filme extends Item implements Locavel {

    public function calcularAluguel(int $dias):float {
        return $dias * DIARIA_FILME;
    }

    public function alugar(): string {
        if ($this->disponivel){
            $this->disponivel = false;
            return "Filme '{$this->titulo}' alugado com sucesso!";
        }
        return "Filme '{$this->titulo}' não está disponível.";
    } 

    public function devolver(): string {
        if (!$this->disponivel){
            $this->disponivel = true;
            return "Filme '{$this->titulo}' devolvido com sucesso!";
        }
        return "Filme '{$this->titulo}' já está disponível.";
    } 

}