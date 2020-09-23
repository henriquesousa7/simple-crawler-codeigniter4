<?php 

namespace App\Models;

use CodeIgniter\Model;
use GuzzleHttp\ClientInterface;
use Symfony\Component\DomCrawler\Crawler;

class Buscador extends Model{

    private $httpClient;
    private $crawler;

    public function __construct(ClientInterface $httpClient, Crawler $crawler){

        $this->httpClient = $httpClient;
        $this->crawler = $crawler;
    
    }

    public function buscar(string $url): array{
        
        $response = $this->httpClient->request('GET', $url);

        $html = $response->getBody();
        
        $this->crawler->addHtmlContent($html);

        $elementosCursos = $this->crawler->filter('span.card-curso__nome');
        $cursos = [];

         foreach($elementosCursos as $elemento){
            array_push($cursos, $elemento->textContent);
        }

        return $cursos;

    }

}