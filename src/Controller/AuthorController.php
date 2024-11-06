<?php

namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpNotFoundException;


class AuthorController extends Controller {
	public function author(Request $request, Response $response, $args = []) {
		$article = $this->ci->get('db')->find('App\Entity\Article', $args['id']);

		if (!$author) {
            throw new HttpNotFoundException($request);
        };

        $dql = "SELECT a FROM App\Entity\Article a
        WHERE a.author = :author
        ORDER BY a.published DESC";

        $query = $this->ci->get('db')->createQuery($dql);
        $query->setParameter('author', $author);
        $articles = $query->getResult();

		return $this->renderPage($response, 'author.html', [
			'author' => $author,
			'articles' => $author->getArticles()
		]);
	}
}