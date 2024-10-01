<?php

namespace App\Controller;

use App\Entity\Article;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpNotFoundException;

class AdminController extends Controller
{
    public function view(Request $request, Response $response)
    {
        $articles = $this->ci->get('db')->getRepository('App\Entity\Article')->findBy([], [
            'published' => 'DESC'
        ]);

        return $this->renderPage($response, 'admin/view.html', [
            'articles' => $articles
        ]);
    }



    public function create(Request $request, Response $response, $args = []){
        $article = new Article;

        if ($request -> isPost()){
            $article->setName($request->getParam('name'));
            $article->setSlug($request->getParam('slug'));
            $article->setImage($request->getParam('image'));
            $article->setBody($request->getParam('body'));
            $article->setPublished(new \Datetime());

            $this->ci->get('db')->persist($article);
            $this->ci->get('db')->flush();

            return $response -> withRedirect('/admin');
        };

        return $this->renderPage($response, 'admin/create.html', [
            'article' => $article
        ]);
    }

    public function edit(Request $request, Response $response, $args = [])
    {
        $article = $this->ci->get('db')->find('App\Entity\Article', $args['id']);

        if (!$article) {
            throw new HttpNotFoundException($request);
        };

        if ($request -> isPost()){

            if($request->getParam('action') == 'delete'){
                $this->ci->get('db')->remove($article);
                $this->ci->get('db')->flush();

                return $response->withRedirect('/admin');
            };

            $article->setName($request->getParam('name'));
            $article->setSlug($request->getParam('slug'));
            $article->setImage($request->getParam('image'));
            $article->setBody($request->getParam('body'));


            $this->ci->get('db')->persist($article);
            $this->ci->get('db')->flush();
        };

        return $this->renderPage($response, 'admin/edit.html', [
            'article' => $article
        ]);
    }
}
