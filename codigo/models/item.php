<?php
namespace Models;

// Classe abstrata para todos os tipos de itens

abstract class Item {
    protected string $titulo;
    protected string $genero;
    protected string $sinopse;
    protected bool $disponivel;
    protected ?string $imagem;

    public function __construct(string $titulo, string $sinopse, string $genero, ?string $imagem = null) {
        $this->titulo = $titulo;
        $this->genero = $genero;
        $this->sinopse = $sinopse;
        $this->disponivel = true;
        $this->imagem = $imagem;
    }

    // Função para cálculo de aluguel
    abstract public function calcularAluguel(int $dias): float;

    public function isDisponivel(): bool {
        return $this->disponivel;
    }

    public function getTitulo(): string {
        return $this->titulo;
    }

    public function getGenero(): string {
        return $this->genero;
    }

    public function getSinopse(): string {
        return $this->sinopse;
    }

    public function setDisponivel(bool $disponivel): void {
        $this->disponivel = $disponivel;
    }

    public function getImagem(): string {
        if ($this->imagem === null || empty($this->imagem)) {
            return 'img/no-image.jpg';
        }
        // Remove barras invertidas e normaliza o caminho
        $path = str_replace('\\', '/', $this->imagem);
        // Remove ./ do início se existir
        $path = preg_replace('/^\.\//', '', $path);
        return $path;
    }

    public function setImagem(?string $imagem): void {
        if ($imagem !== null) {
            // Normaliza o caminho antes de salvar
            $imagem = str_replace('\\', '/', $imagem);
            // Remove ./ do início se existir
            $imagem = preg_replace('/^\.\//', '', $imagem);
            $this->imagem = $imagem;
        } else {
            $this->imagem = null;
        }
    }
}