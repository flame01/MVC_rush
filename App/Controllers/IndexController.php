<?php
/*
** EPITECH PROJECT, 2020:
** MVC_Rush_PHP
**
** IndexController.php
** File description:
**  This file is in charge of manage the data introduced/showed in index.html.twig
**
*/
namespace App\Controllers;

use WebFramework\AppController;
use WebFramework\Router;
use WebFramework\Request;

use App\Models\User;

class IndexController extends AppController{
  public function index_view(Request $request){
  	//select($table, $values = "*", $condition = null, $multiple = true)
    $articlesList = $this->orm->select("Article", "article_id, title, LEFT(content, 150) AS 'content', created_by, creation_date", "ORDER BY creation_date DESC", true);

    // Render the index_view in index.html.twig
  	return $this->render('index.html.twig', ['base' => $request->base, 'articlesList' => $articlesList, 'session' => $this->session]);
  }
}