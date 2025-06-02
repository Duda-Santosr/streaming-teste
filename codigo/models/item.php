<?php
 namespace Models;

 // Classe abstrata para todos os tipos de itens

 abstract class Item {
    protected string $titulo;
    protected string $genero;
    protected string $sinopse;
    protected bool $disponivel;

    public function __construct (string $titulo, string $sinopse, string $genero) {
        $this -> titulo = $titulo;
        $this -> genero = $genero;
        $this -> sinopse = $sinopse;
        $this -> disponivel = true;
    }

    // Função para cálculo de aluguel
    abstract public function calcularAluguel(int $dias) : float;

    public function isDisponivel():bool {
        return $this->disponivel;
    }
    public function getTitulo(): string{
        return $this->titulo;
    }
    public function getGenero(): string{
        return $this->genero;
    }
    public function getSinopse(): string{
        return $this->sinopse;
    }
    public function setDisponivel(bool $disponivel):void{
        $this->disponivel = $disponivel;
    }
 }