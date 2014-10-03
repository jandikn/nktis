<?php

namespace App;

use Nette,
	Nette\Application\Routers\RouteList,
	Nette\Application\Routers\Route,
	Nette\Application\Routers\SimpleRouter;


/**
 * Router factory.
 */
class RouterFactory
{

	/**
	 * @return \Nette\Application\IRouter
	 */
	public function createRouter()
	{
		$router = new RouteList();
		$router[] = new Route('projekty', 'Project:default');
		$router[] = new Route('archiv', 'Project:archive');
		$router[] = new Route('fakturace', 'Project:invoice');
		$router[] = new Route('novy-projekt-preklad', 'Project:translation');
		$router[] = new Route('novy-projekt-korektura', 'Project:proofreading');
		$router[] = new Route('novy-projekt-tlumoceni', 'Project:interpretation');
		$router[] = new Route('editace-projektu', 'Project:edit');
                
                $router[] = new Route('prekladatele', 'Translator:default');
                $router[] = new Route('prekladatele-blacklist', 'Translator:blacklist');
                $router[] = new Route('novy-prekladatel', 'Translator:new');
                $router[] = new Route('editace-prekladatele', 'Translator:edit');
                
                $router[] = new Route('zakaznici', 'Customer:default');
                $router[] = new Route('zakaznici-blacklist', 'Customer:blacklist');
                $router[] = new Route('novy-zakaznik', 'Customer:new');
                $router[] = new Route('editace-zakaznika', 'Customer:edit');
                
                $router[] = new Route('jazyky', 'Language:default');
                $router[] = new Route('novy-jazyk', 'Language:new');
                $router[] = new Route('editace-jazyka', 'Language:edit');
                
                $router[] = new Route('obory', 'Field:default');
                $router[] = new Route('novy-obor', 'Field:new');
                $router[] = new Route('editace-oboru', 'Field:edit');
                
                $router[] = new Route('nk-v-cislech', 'Numbers:default');
                
                $router[] = new Route('ukoly', 'Task:default');
                $router[] = new Route('novy-ukol', 'Task:new');
                $router[] = new Route('editace-ukolu', 'Task:edit');
                
                $router[] = new Route('muj-profil', 'MyProfile:default');
                $router[] = new Route('muj-profil-editace', 'MyProfile:edit');
    	
		$router[] = new Route('<presenter>/<action>[/<id>]', 'Project:default');
		return $router;
	}

}
