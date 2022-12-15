<?php 

namespace App\model\entidade;

use \WilliamCosta\DatabaseManager\Database;

class eventos {

    public $id;

    public $nome;

    public $carga_horaria;

    public $valor;

    public $data_inicio;

    public $data_fim;

    public $descricao;

    public function cadastrar() {

        // Pode ser usado timestamp no banco
        // $this->data = date("Y-m-d H:i:s");

        // Inserindo informações da inscrição nos eventos
        $this->id = (new Database('tblevento'))->insert([
            'NOME_EVENTO' => $this->nome,
            'CARGA_HORARIA' => $this->carga_horaria,
            'VALOR_EVENTO' => $this->valor,
            'DATA_EVENTO_INICIO' => $this->data_inicio = date("Y-m-d H:i:s"),
            'DATA_EVENTO_FIM' => $this->data_fim = date("Y-m-d H:i:s"),
            'DESCRICAO_EVENTO' => $this->descricao,
        ]);

        return true;

    }

    // Reponsavel pelo retorno das incrições '*' pegar todos os campos
    public static function getEventos($where = null, $order = null, $limit = null, $field = '*') {
        return (new Database('tblevento'))->select($where,$order,$limit,$field);
    }

}

?>