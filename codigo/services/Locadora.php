<?php
namespace Services;

use Models\{Item, Filme, Serie, Desenho, Novela};

// classe para gerenciar a locação
class Locadora {
    private array $itens = [];

    public function __construct(){
        $this->carregarItens();
    }

    private function carregarItens(): void {
        if (file_exists(ARQUIVO_JSON)){

            // decodifica o arquivo JSON
            $dados = json_decode(file_get_contents(ARQUIVO_JSON),true);

            foreach ($dados as $dado){

                if ($dado['tipo'] === 'filme'){
                    $item = new Filme($dado['titulo'], $dado['sinopse'], $dado['tipo']);
                } else if ($dado['tipo']=== 'serie'){
                    $item = new Serie($dado['titulo'], $dado['sinopse'], $dado['tipo']);
                } else if ($dado['tipo']=== 'novela') {
                    $item = new Novela($dado['titulo'], $dado['sinopse'], $dado['tipo']);
                } else if ($dado['tipo']=== 'desenho') {
                    $item = new Desenho($dado['titulo'], $dado['sinopse'], $dado['tipo']);
                } 

                $item->setDisponivel($dado['disponivel']);
                $this->itens[] = $item;
            }
        }
    }

    // Salvar item
    private function salvarItens(): void {
    $dados = [];

        foreach ($this->itens as $item) {
            $dados[] = [
                'tipo' => ($item instanceof Filme) ? 'filme' :
                         (($item instanceof Serie) ? 'serie' :
                         (($item instanceof Novela) ? 'novela' :
                         (($item instanceof Desenho) ? 'desenho' : null))),
                'titulo' => $item->getTitulo(),
                'sinopse' => $item->getSinopse(),
                'genero' => $item->getGenero(),
                'disponivel' => $item->isDisponivel()
            ];
        }

        $dir = dirname(ARQUIVO_JSON);

        if (!is_dir($dir)){
            mkdir($dir, 0777, true);
        }

        file_put_contents(ARQUIVO_JSON, json_encode($dados, JSON_PRETTY_PRINT));
        
    }

    // Adicionar novo item
    public function adicionarItem(Item $item): void{
        $this->itens[] = $item;
        $this->salvarItens();
        $_POST = []; // Limpar os dados do formulário após adicionar
    }

    //Remover item
    public function deletarItem(string $titulo, string $genero): string{

        foreach ($this->itens as $key => $item){

            // verifica se o titulo e tipo correspondem
            if($item->getTitulo() === $titulo && $item->getGenero() === $genero){
                // remove o item do array
                unset($this->itens[$key]);

                // reorganizar os indices
                $this->itens = array_values($this->itens);

                // Salvar o novo estado
                $this->salvarItens();
                return "Item '{$titulo}' removido com sucesso!";
            }
        }
        return "Item não encontrado!";
    }

    // Alugar item por n dias
    public function alugarItem(string $titulo, int $dias = 1): string{

        // percorre a lista de itens
        foreach($this->itens as $item){

            if($item->getTitulo() === $titulo && $item->isDisponivel()){

                // calcular valor do aluguel
                $valorAluguel = $item->calcularAluguel($dias);

                // Marcar como alugado
                $mensagem = $item->alugar();

                $this->salvarItens();

                return $mensagem . "Valor do aluguel: R$" . number_format($valorAluguel, 2, ',', '.');
            }
        }
        return "Item não disponível";
    }

    // Devolver item

    public function devolverItem(string $titulo): string{

        // Percorrer a lista
        foreach($this->itens as $item){

            if($item->getTitulo() === $titulo && !$item->isDisponivel()){

                // disponibilizar o item
                $mensagem = $item->devolver();

                $this->salvarItens();
                return $mensagem;
            }
        }
        return "Item já disponível ou não encontrado.";
    }

    // Retorna a lista de itens

    public function listarItens():array{
        return $this->itens;
    }

    // Calcular previsão do valor
    public function calcularPrevisaoAluguel(string $tipo, int $dias): float {

        if($tipo ==='Filme'){
            return (new Filme('','','')) ->calcularAluguel($dias);
        } elseif($tipo === 'Desenho'){
            return (new Desenho('','','')) ->calcularAluguel($dias);
        } elseif($tipo === 'Novela'){
            return (new Novela('','','')) ->calcularAluguel($dias);
        } else {
        return (new Serie('','','')) ->calcularAluguel($dias);
        }
    }
}