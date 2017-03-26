<?php
/**
 * (c) Tasklist App: The Simple task list.
 *
 * PHP version 5.6
 *
 * @author  Ge Bender <gesianbender@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 * @link    http://tasklist.gebender.com.br
 */
namespace App\Controller;
use Buzz\Browser;

class AppController extends Controller
{

    public function home()
    {
    	$browser = new Browser();
    	$browser->getLastRequest();
    	$response = $browser->get($this->app['config']['apiAddress'].'/tasks');
		$tasks = $response->getContent();
		
		$this->setVar('apiAddress', $this->app['config']['apiAddress']);
    	$this->setVar('tasks', json_decode($tasks));
    	return $this->render('home.phtml');
    }
    
    public function postTask()
    {
    	$browser = new Browser();
    	$browser->getLastRequest();
    
    	$headers = array(
    			'Content-Type' => 'application/json'
    	);
    	
    	if ($_POST['id']) { 
    		$response = $browser->put($this->app['config']['apiAddress'].'/tasks/'.$_POST['id'], $headers, json_encode($_POST));
    	} else {
    		$response = $browser->post($this->app['config']['apiAddress'].'/tasks', $headers, json_encode($_POST));
    	}
    	
    	
    	return '';
    }
    
    public function loadTask($id) {
    	$browser = new Browser();
    	$browser->getLastRequest();
    	$response = $browser->get($this->app['config']['apiAddress'].'/tasks/'.$id);
    	$task = $response->getContent();
    	$this->setVar('taskToEdit', json_decode($task));
    	
    	return $this->home();    	
    }

    public function viewTask($id) {
    	$browser = new Browser();
    	$browser->getLastRequest();
    	$response = $browser->get($this->app['config']['apiAddress'].'/tasks/'.$id);
    	$task = $response->getContent();
    	$this->setVar('taskToView', json_decode($task));
    	
    	return $this->home();    	
    }

    public function deleteTask($id) {
    	$browser = new Browser();
    	$browser->getLastRequest();
    	$response = $browser->delete($this->app['config']['apiAddress'].'/tasks/'.$id);
    	$task = $response->getContent();
    	
    	return $this->home();    	
    }
    
    
}
