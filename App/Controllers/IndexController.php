<?php
namespace App\Controllers;

use WebFramework\AppController;
use WebFramework\Router;
use WebFramework\Request;

use App\Models\User;

class IndexController extends AppController{
  public function index(Request $request){
  	$userList = $this->orm->select("User");
  	return $this->render('index.html.twig', ['base' => $request->base, 'userList' => $userList]);
  }
  
}
