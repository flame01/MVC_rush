<?php
/*
** EPITECH PROJECT, 2020:
** MVC_Rush_PHP
**
** ArticleController.php
** File description:
**  This file is in charge of manage the data introduced/showed in register.html.twig
**
*/
namespace App\Controllers;

use WebFramework\AppController;
use WebFramework\Router;
use WebFramework\Request;

use App\Models\User;

class ArticleController extends AppController {
	public function article_view(Request $request) {
    	$article_id = $request->params['id'];

    	$articleInfo = $this->orm->select("Article", "*", "WHERE article_id = '$article_id'", false);
    	// Render the article_view in article.html.twig
  		return $this->render('article.html.twig', ['article' => $articleInfo, 'session' => $this->session]);
	}
}