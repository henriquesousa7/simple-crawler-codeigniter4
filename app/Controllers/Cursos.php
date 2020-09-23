<?php 

namespace App\Controllers;

require '/var/www/html/simpleProject/vendor/autoload.php';

use App\Models\Buscador;
use App\Models\Database;
use CodeIgniter\Controller;

use \GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class Cursos extends Controller{

    public function index(){

        $database = new Database();

        if(!empty($database->getCursos())){
            $database->emptyTable();
        }
        
        $client = new Client();
        $crawler = new Crawler();
        $buscador = new Buscador($client, $crawler);

        $cursos = $buscador->buscar('https://www.alura.com.br/cursos-online-programacao/php');

        if(!empty($cursos)){
            foreach ($cursos as $curso) {

                $database->insert([
                    'nome' => $curso
                ]);
                
            }  
            echo view('mainViews/header');
            echo view('mainViews/main');
            echo view('mainViews/footer');
        }else{
            echo view('mainViews/header');
            echo view('mainViews/error');
            echo view('mainViews/footer');
        }
    }

    public function view(){

        $database = new Database();

        $data = [
            'cursos' => $database->getCursos()
        ];

        echo view('mainViews/header');
        echo view('mainViews/view', $data);
        echo view('mainViews/footer');
    }

}

?>
