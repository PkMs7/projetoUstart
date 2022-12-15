<?php 

    namespace App\Controller\Pages;

    use \App\utils\view;
    // as = Criado um alias.
    use \App\model\entidade\eventos as entidade_eventos;

    class Eventos extends page {

        // Consultas no banco de dados, obter o render das Eventos
        private static function getEventosLista() {
            $lista = '';
            $result = entidade_eventos::getEventos(null,'DATA_EVENTO_INICIO DESC');

            while ($eventos = $result->fetchObject(entidade_eventos::class)){

                $lista .= view::render('pages/listas/lista_eventos',[
                    'evento_nome'=> $eventos ->NOME_EVENTO,
                    'evento_descricao'=> $eventos ->DESCRICAO_EVENTO,
                    'evento_valor'=> $eventos ->VALOR_EVENTO,
                    'evento_carga_horaria' => $eventos ->CARGA_HORARIA,
                    'evento_data' => date('d/m/Y H:i:s',strtotime($eventos ->DATA_EVENTO_INICIO)),
                ]);

            }

            return $lista;
        }
        
        public static function getEventos(){

            $conteudo = view::render('pages/eventos',[
                'lista_eventos'=> self::getEventosLista()
            ]);
            
            return parent::getPage('Eventos',$conteudo);
        }
        // Cadastrar as inscrições
        public static function inserir_eventos($request) {
            // Dados recebidos pelo metodo post
            $postVars = $request->getPostvars();

            $eventos = new entidade_eventos;

            // Recomendado fazer validações se o dado vier inconsistente.
            $eventos->nome = $postVars['nome'];
            $eventos->carga_horaria = $postVars['carga-horaria'];
            $eventos->valor = $postVars['valor'];
            $eventos->data_inicio = $postVars['data-inicio'];
            $eventos->data_fim = $postVars['data-fim'];
            $eventos->descricao = $postVars['descricao'];

            $eventos->cadastrar();
            
            return self::getEventos();
        }

    }

?>

