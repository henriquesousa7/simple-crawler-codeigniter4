<?php 

namespace App\Controllers;

require '/var/www/html/simpleProject/vendor/autoload.php';


use App\Models\Database;
use App\Models\SearchEG;
use CodeIgniter\Controller;

use \GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class Cursos extends Controller{

    public function index(){

        $database = new Database();

        if(!empty($database->getCursos())){
            $database->emptyTable();
            $database->simpleQuery("ALTER TABLE cursos AUTO_INCREMENT = 1");
        }
        
        $client = new Client();
        $crawler = new Crawler();

        $searchEG = new SearchEG($client, $crawler);

        $cursos = $searchEG->search('https://www.alura.com.br/cursos-online-programacao/php');

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

    public function exportCSV(){

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=cursos.csv');

        $database = new Database();
        $data = $database->getCursos();

        if(!empty($data)){

            $fp = fopen('php://output', 'w');

            foreach($data as $curso){
                fputcsv($fp, $curso);
            }

        }
        fclose($fp);
    }

}