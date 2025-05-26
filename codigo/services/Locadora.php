<?php
namespace Services;

use Models\{item, filme, serie, desenho, novela};

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

                if ($dado['tipo']=== 'Filme'){
                    $item = new Filme($dado['titulo'], $dado['tipo']);
                } else if ($dado['tipo']=== 'Serie'){
                    $item = new Serie($dado['titulo'], $dado['tipo']);
                } else if ($dado['tipo']=== 'Novela') {
                    $item = new Novela($dado['titulo'], $dado['tipo']);
                } else {
                    $item = new Desenho($dado['titulo'], $dado['tipo']);
                } 
                $item->setDisponivel($dado['disponivel']);

                $this->itens[] = $item;
            }
        }
    }

    // Salvar veículos
    private function salvarItens(): void {
    $dados = [];

    foreach ($this->itens as $item) {
        $dados[] = [
            'tipo' => ($item instanceof Filme) ? 'Filme' :
                     (($item instanceof Serie) ? 'Serie' :
                     (($item instanceof Novela) ? 'Novela' :
                     (($item instanceof Desenho) ? 'Desenho' : 'desconhecido'))),
            'titulo' => $item->getTitulo(),
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

    // Adicionar novo veículo
    public function adicionarItem(item $item): void{
        $this->itens[] = $item;
        $this->salvarItens();
    }

    

    //Remover veículo
    public function deletarItem(string $titulo, string $genero): string{

        foreach ($this->itens as $key => $item){

            // verifica se modelo e placa correspondem
            if($item->getTitulo() === $titulo && $item->getTipo() === $genero){
                // remove o veículo do array
                unset($this->itens[$key]);

                // reorganizar os indices
                $this->itens = array_values($this->itens);

                // Salvar o novo estado
                $this->salvarItens();
                return "Veículo '{$titulo}' removido com sucesso!";
            }
        }
        return "Item não encontrado!";
    }

    // Alugar veículo por n dias
    public function alugarItem(string $titulo, int $dias = 1): string{

        // percorre a lista de veículos
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

    // Devolver veículo

    public function devolverItem(string $titulo) :string{

        // Percorrer a lista
        foreach($this->itens as $item){

            if($item->getItem() === $titulo && !$item->isDisponivel()){

                // disponibilizar o veículo
                $mensagem = $item->devolver();

                $this->salvarItens();
                return $mensagem;
            }
        }
        return "Item já disponível ou não encontrado.";
    }

    // Retorna a lista de veículos

    public function listarItens():array{
        return $this->itens;
    }


    public function calcularPrevisaoAluguel(int $dias, string $tipo): float {
    switch (strtolower($tipo)) {
        case 'filme':
            return $dias * DIARIA_FILME;
        case 'serie':
            return $dias * DIARIA_SERIE;
        case 'novela':
            return $dias * DIARIA_NOVELA;
        case 'desenho':
            return $dias * DIARIA_DESENHO;
        default:
            return 0;
    }
}

}