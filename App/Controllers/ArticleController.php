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
    	$commentsList = $this->orm->select("Comment", "*", "WHERE article_id = '$article_id'", true);
    	// Render the article_view in article.html.twig
  		return $this->render('article.html.twig', ['article' => $articleInfo, 'comments' => $commentsList, 'session' => $this->session, 'error' => $this->flashError]);
	}



	public function publish_article_view(Request $request){
		return $this->render('writeArticle.html.twig', ['session' => $this->session, 'error' => $this->flashError]);
	}



	public function check_article($title, $content){
		$err = "";

		if(strlen($title) < 15 || strlen($content) < 50){
			if(strlen($title) < 15){
				$err .= "Title should have more than 15 characters.";
			}
			if(strlen($content) < 50){
				$err .= "Title should have more than 50 characters.";
			}
			throw new \Exception($err);
		}
		return true;
	}

	public function addToDB($title, $content, $username){
		$query = "INSERT INTO Article(title, content, created_by) VALUES ('$title', '$content', '$username');";
    	$this->orm->persist($query);
    	$this->orm->flush();
	}

	public function publish_article(Request $request){
		$title = $request->params["title"];
		$content = $request->params["content"];
		try{
			if($this->check_article($title, $content)){
				//add article to DB.
				$this->addToDB($title, $content, $this->session->get("username"));
				//redirect to index
        		$this->redirect('index', '302');
			}


		}catch (\Exception $e) {
      		$this->flashError->set($e->getMessage());
      		//redirect to article-new
        		$this->redirect('article-new', '302');
		}
		//return $this->render('writeArticle.html.twig', ['session' => $this->session]);
	}

	public function check_comment($comment){
		$err = "";

		if(strlen($comment) < 10){
			$err .= "Comment must have at least 10 characters.";
			throw new \Exception($err);
		}
		return true;
	}

	public function comment_on_article(Request $request){
		$comment = $request->params["comment"];
		$article_id = $request->params["article_id"];
		$commented_by = $this->session->get("username");
		try{
			if($this->check_comment($comment)){
				$query = "INSERT INTO Comment(content, article_id, commented_by) VALUES ('$comment', '$article_id', '$commented_by');";
    			$this->orm->persist($query);
    			$this->orm->flush();
    			$this->redirect('/article?id='.$article_id, '302');
			}

		} catch (\Exception $e){
			$this->flashError->set($e->getMessage());
      		//redirect to article-new
        	$this->redirect('article?id='.$article_id, '302');
		}
	}

}