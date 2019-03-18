<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\ORM\Query;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');
        
        $this->loadComponent('Auth', [
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'username' => 'username',
                        'password' => 'password'
                    ]
                ]
            ],
            'loginAction' => [
                'controller' => 'Users',
                'action' => 'login'
            ],
             //use isAuthorized in Controllers
            'authorize' => ['Controller'],
             // If unauthorized, return them to page they were just on
            'unauthorizedRedirect' => $this->referer()
        ]);

        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
    }
    
    public function isAuthorized($user = null)
    {
        return true;
    }
    
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        
    }
    
    public function beforeRender(Event $event)
    {
        if(strpos($this->request->url, '.json') !== false) {
			if($this->request->url == 'api/login.json') {
                $this->loadModel('Users');//pr($this->request->data());die;
                $hasher = new \Cake\Auth\DefaultPasswordHasher();
                //echo $hasher->check('admin', '$2y$10$fIMuJZSO0cyyCb1ddJpur.eLL6Xp1rnTPO9wJSyd7B4wIVPCDtl6G');die;
                $users = $this->Users->find()
                ->where(['Users.username' => $this->request->data('username'), 'Users.role' => 'user'])
                ->first();
                //pr($users);die;
                if(!empty($users)) {
                    if($hasher->check($this->request->data('password'), $users['password'])) {
						$this->response->statusCode(200);
                        $response['status'] = 'success';
                        $response['data'] = $users;
                    } else {
						$this->response->statusCode(400);
                        $response['status'] = 'error';
                        $response['message'] = 'Invalid Username and password';
					}
                } else {
					$this->response->statusCode(400);
                    $response['status'] = 'error';
                    $response['message'] = 'Invalid Username and password';
                }
            
                //response
                $this->set('response', $response);
                $this->set('_serialize', array('response'));
                
                //pr($users);die;
                
			}
			if($this->request->url == 'api/events.json') {
				$this->loadModel('Events');
				$event = $this->Events->find()
                ->all();//pr($event);die;
                if(!empty($event)) {
					$this->response->statusCode(200);
					$response['status'] = 'success';
					$response['path'] = '/uploads/image/';
                    $response['data'] = $event;
				}
				//pr($response);die;
				//response
                $this->set('response', $response);
                $this->set('_serialize', array('response'));
				//echo json_encode($response);die;
			}
            
        } else {
            if ($this->Auth->user() && !$this->request->is('ajax')) {
				$this->viewBuilder()->setLayout('inner');            
            }
            
		}
	}
}
