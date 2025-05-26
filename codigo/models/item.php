<?php
 namespace Models;

 // Classe abstrata para todos os tipos de itens

 abstract class Item {
    protected string $titulo;
    protected string $genero;
    protected bool $disponivel;

    public function __construct (string $titulo, string $genero){
        $this -> titulo = $titulo;
        $this -> genero = $genero;
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
    public function setDisponivel(bool $disponivel):void{
        $this->disponivel = $disponivel;
    }
    protected string $imagem = '';

public function setImagem(string $imagem): void {
    $this->imagem = $imagem;
}

public function getImagem(): string {
    return $this->imagem;
}

 }