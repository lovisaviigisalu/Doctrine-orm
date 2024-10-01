<?php

namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpNotFoundException;


class ArticleController extends Controller
{
    public function view(Request $request, Response $response, $args = [])
    {
    
        $article = $this->ci->get('db')->getRepository('App\Entity\Article')->findOneBy([
                'slug' => $args['slug']
        ]);
        
        if(!$article){
            throw new HttpNotFoundException($request);
        };

        return $this->renderPage($response, 'article.html', [ 
            'article' => $article
        ]);
    }

    public function viewPK(Request $request, Response $response)
    {
    
        $article = $this->ci->get('db')->find('App\Entity\Article', 1);
        
        return $this->renderPage($response, 'article.html', [ 
            'article' => $article
        ]);
    }
}
