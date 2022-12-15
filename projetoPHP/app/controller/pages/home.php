<?php 

    namespace App\Controller\Pages;

    use \App\utils\view;
    use \App\model\entidade\empresa;

    class Home extends page{
        
        public static function getHome(){
            $empresa = new empresa;

            $conteudo = view::render('pages/home',[
                'nome'=> $empresa->nome,
            ]);
            return parent::getPage('Home',$conteudo);
        }
    }

?>

