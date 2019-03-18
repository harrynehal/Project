<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    public $components = ['Cookie'];
        
    /**
     * login method
     */
    public function login()
    {
        if ($this->Auth->user()) {
            $this->redirect(array('users' => false,'action' => 'index'));            
        }
        
        if ($this->request->is('post')) { //pr($this->request->data);die;
			if($this->request->data('username') != 'admin') {
				$this->Flash->error(__('Invalid username or password, try again'));
				return $this->redirect($this->Auth->redirectUrl());
			}
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }

        $this->viewBuilder()->setLayout('login');
        $this->set('title', 'Login');
        
    }
    
    public function logout() {
        $this->redirect($this->Auth->logout());
    }
    
    public function index() {
        $this->set('title', 'Users');
        //$this->User->recursive = -1;
        $this->loadModel('Users');
        $users = $this->Users->find()
                ->where(['Users.role !=' => 'admin'])
                ->all()->toArray();
        //pr($users);die;
        $this->set(compact('users'));
    }
    
    public function add() {
        $this->loadModel('Users');
        $User = $this->Users->newEntity();
        if ($this->request->is('post')) {//
            $User = $this->Users->patchEntity($User, $this->request->getData());
            //pr($this->request->getData());die;
            $User->pass = $this->request->data('password');
           // pr($User);die;
            if($this->Users->save($User)) {
                $this->Flash->success(__('The User has been saved.'));
                return $this->redirect(['action' => 'index']);
}
            $this->Flash->error(__('The User could not be saved. Please, try again.'));
        }
        $users = 1;
        $this->set(compact('users'));
    }
}
