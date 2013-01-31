<?php    
App::uses('AppController', 'Controller');
App::import('Sanitize');
App::uses('CakeEmail', 'Network/Email');

class UsersController extends AppController {

	public $helpers = array('Html', 'Session','Form','Js','Time','Fck');	

	public $components = array('Auth','Email','Session','RequestHandler','Image');

	public $paginate	= array('limit'=> '10', 'page' => '1');
	
	public $uses = array('User','ChannelPulse','Pulse','Comment');

	public function beforeFilter() {

		if (isset($this->params['admin'])){

			$loggedAdminId = $this->Session->read("adminid");

			if(!$loggedAdminId && $this->params['action']!="admin_login"){

				$this->redirect("/admin/admins/login");

				$this->Session->setFlash('The URL you followed requires you login.');

			}else{

				$this->Auth->allow('*');

			}	

		}else{

			$this->Auth->allow('add','edit','logout','ulist','login','activate','getimage','forgotpassword');

			$this->Auth->logoutRedirect = array('controller' => 'ChannelPulses','action' => 'index'); 

		}

	}

	public function admin_index() {		

		$this->layout = 'admin';

		$this->set('users', $this->paginate());

	}

	public function admin_add() {

		$this->layout = 'admin';

		if ($this->request->is('post')) {

			$this->User->create();

			if(!empty($this->data['User']['image']['name'])){ 			

				$googleimageUrl = $this->Image->upload_image_and_thumbnail($this->data['User']['image'], 250,150, "users",80);

				if(isset($googleimageUrl) && $googleimageUrl!='') {

					 $this->request->data['User']['image'] = $googleimageUrl;

				}

			}else{

				$this->request->data['User']['image'] = '';

			}

			

			if ($this->User->save($this->request->data)) {

				$this->Session->setFlash(__('The user has been saved'));

				$this->redirect(array('controller'=>'users','action' => 'index'));

			} else {

				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));

			}

		}

	}

	function admin_edit($id = null) {

		$this->User->id = $id;

		$this->layout = 'admin';

		if(!empty($this->data)){

			

			if(!empty($this->data['User']['image']['name'])){ 			

				$googleimageUrl = $this->Image->upload_image_and_thumbnail($this->data['User']['image'], 250,150, "users",80);

				if(isset($googleimageUrl) && $googleimageUrl!='') {

					 $this->request->data['User']['image'] = $googleimageUrl;

				}

			}else if(!empty($this->data['User']['oldaddimage'])){

				$this->request->data['User']['image'] = $this->data['User']['oldaddimage'];

			}else{

				$this->request->data['User']['image'] = '';

			}

			$this->User->set($this->request->data);

			if ($this->User->save($this->request->data)) {
				if($this->request->data['User']['password1'] != ''){
					$this->User->saveField('password', $this->request->data['User']['password1']);
				}
				$this->Session->setFlash(__('The user has been saved'));

				$this->redirect(array('controller'=>'users','action' => 'index'));

			} else {

				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));

			

			}

		}else{

			$this->User->id = $id;

			$this->data =  $this->User->read();				

		}

	}

	function admin_activate($id=NULL){
	
				if ($id) {

                $this->User->id = $id;

                if ($this->User->saveField('status', 1)) {
				
					$todate = date('Y-m-d');

					$this->User->saveField('modified', $todate);
					$this->Pulse->updateAll(
						array('Pulse.status' => 1),
						array('Pulse.user_id' => $id)
						);
					$this->Comment->updateAll(
						array('Comment.status' => 1),
						array('Comment.user_id' => $id)
						);


                    $this->redirect('/admin/users/');

                }  

            }

		} //end    



   	function admin_deactivate($id=NULL){

			if($id>0){	

				$this->User->id = $id;

				if ($this->User->saveField('status', 0)) {
				   
					$this->Pulse->updateAll(
						array('Pulse.status' => 0),
						array('Pulse.user_id' => $id)
						);
					$this->Comment->updateAll(
						array('Comment.status' => 0),
						array('Comment.user_id' => $id)
						);
                   $this->redirect('/admin/users/');

                }

			}

		} //end function admin_deactivate

	public function admin_managepulse() {		

		$this->layout = 'admin';

		$this->set('users', $this->paginate());

	}
	function admin_loginas($id=NULL){
		$user = $this->User->findById($id);
		$user = $user['User'];
		$this->Auth->login($user);
		$this->redirect('/');
	}
	
/*--- ------------------------- End of admin section --------------------------------*/
	public function index() {

		$this->User->recursive = 0;

		$this->set('users', $this->paginate());

	}

	public function view($id = null) {

		$this->User->id = $id;

		if (!$this->User->exists()) {

			throw new NotFoundException(__('Invalid user'));

		}

		$this->set('user', $this->User->read(null, $id));

	}

	public function admin_delete($id = null) {

		if($id==null)

		 	die("No ID received");

		 $this->User->id=$id;

		 if($this->User->delete()==false){
		 	$this->Session->setFlash('The User could not be deleted.');
		}else{
			 $this->User->delete(array('User.id' => $id), false);
			 $this->ChannelPulse->deleteAll(array('Pulse.user_id' => $id), false);
			 $this->Pulse->deleteAll(array('Pulse.user_id' => $id), false);
			 $this->Comment->deleteAll(array('Comment.user_id' => $id), false);
		} 

		$this->redirect('/admin/users/');

	}
	public function admin_delete_all_pulses() {		
		 $this->ChannelPulse->deleteAll(array('Pulse.user_id !=' => 0), false);
		 $this->Pulse->deleteAll(array('Pulse.user_id !=' => 0), false);		
		 $this->redirect('/admin/users/managepulse');
	}
/*---------------------------admin section ends -------------------------------------*/

	function add(){	

		if(isset($this->data) && $this->RequestHandler->isAjax()) {	

				configure::write('debug', 0);

				$this->layout 		= 'ajax';  	// uses an empty layout

				$this->autoRender 	= false; 	// renders nothing by default				

				$this->User->create();

				if($this->User->save($this->request->data)) {

				//$this->User->saveField('status', 1);			
 				$this->__sendActivationEmail($this->User->getLastInsertID());
					
					$response	= array(

						'error'		=> 0,

						'message'	=> $this->User->id

					);					

					return json_encode($response);

					

				} else {			
						
						
					$response	= array(

						'error'		=> 1,

						'message'	=> 0

					);					

				}				

				$response['data']['User']	= $this->User->invalidFields();

				if(!empty($response['data']['User']["email"])){

					$response['data']['User']["email"] = 	$response['data']['User']['email'][0];	}

				if(!empty($response['data']['User']["username"])){

					$response['data']['User']["username"] = 	$response['data']['User']['username'][0];}

				if(!empty($response['data']['User']["password"])){

					$response['data']['User']["password"] = 	$response['data']['User']['password'][0];}

				return json_encode($response);

			

		}else{

			if(!empty($this->data['User']['image']['name'])){ 			

				$googleimageUrl = $this->Image->upload_image_and_thumbnail($this->data['User']['image'], 250,182, "users",80);

				if(isset($googleimageUrl) && $googleimageUrl!='') {

					 $this->request->data['User']['image'] = $googleimageUrl;

				

				}else{

					$this->request->data['User']['image'] = '';

				}

				
				
				$this->User->id = $this->data['User']['uid'];



				if ($this->User->saveField('image', $this->request->data['User']['image'])) {


				   $this->Session->setFlash('You have successfully registered. An account activation email has been sent to you. Please also look into the spam folder if you dont recieve the email.');
                   $this->redirect('/');



                }
				 $this->Session->setFlash('You have successfully registered. An account activation email has been sent to you. Please also look into the spam folder if you dont recieve the email.');
				 $this->redirect('/');

			}
			$this->Session->setFlash('You have successfully registered. An account activation email has been sent to you. Please also look into the spam folder if you dont recieve the email.');
			$this->redirect('/');

		}

		

	}

	function __sendActivationEmail($user_id) {
		
        $user = $this->User->findById($user_id);

        if ($user === false) {

            debug(__METHOD__." failed to retrieve User data for user.id: {$user_id}");

            return false;

        }
		

        // Set data for the "view" of the Email


		$email = new CakeEmail();
		$email->emailFormat('both');
		//$email->from('info@retirementpulse.com');
		$email->from(array('info@retirementpulse.com' => 'Retirement Pulse'));
            $email->to($user['User']['email']);
            $email->subject('Registration at Retirement Pulse ');
			/*$trigg = '<img src="http://www.retirementpulse.com/app/webroot/img/email-logo.png"><h1>Thank you for your registration on Retirement Pulse. </h1>Click on the following link to activate your account. If you did not register please ignore this mail.      '.'http://' . env('SERVER_NAME') . '/users/activate/' . $user['User']['id'] . '/' . $this->User->getActivationHash();	*/		
			$trigg = '<table width="650" cellspacing="0" cellpadding="10" border="0" bgcolor="#A5D8E9" style="border:1px solid #e0e0e0">
							<tr><td><img src="http://www.retirementpulse.com/app/webroot/img/email-logo.png"></td></tr>
							<tr><td>
								<table bgcolor="#FFFFFF" style="width:100%;" cellpadding="10">								    
									<tr><td>Dear '.ucfirst($user['User']['username']).',<br> <h3> Thank you for registering with Retirement Pulse </h3></td></tr>
									<tr><td>Click on the following link to activate your account. If you did not register please ignore this mail.</td></tr>
									<tr><td>'.'http://' . env('SERVER_NAME') . '/users/activate/' . $user['User']['id'] . '/' . $this->User->getActivationHash().'</td></tr>
									<tr><td><strong>Regards,<br>Retirement Pulse</strong></td></tr>
								</table>
							</td></tr>							
</table>';
            $email->send($trigg);

           
	}

	function activate($user_id = null, $in_hash = null) {

        $this->User->id = $user_id;

		if ($this->User->exists() && ($in_hash == $this->User->getActivationHash()))    {

			// Update the active flag in the database

			$this->User->saveField('status', 1);
            $user = $this->User->findById($user_id);
			$user = $user['User'];
			$this->Auth->login($user);
	

			// Let the user know they can now log in!

			$this->Session->setFlash('Your account has been activated, and you are logged in now.');

			$this->redirect('/');

		}

    // Activation failed, render '/views/user/activate.ctp' which should tell the user.

	}


	function edit($id = null) {

		if(isset($this->data) && $this->RequestHandler->isAjax()) {	
					

				configure::write('debug', 0);

				$this->layout 		= 'ajax';  	// uses an empty layout

				$this->autoRender 	= false; 	// renders nothing by default				

				$this->User->id =$id;

				if(!empty($this->data['User']['image']['name'])){ 			

				$googleimageUrl = $this->Image->upload_image_and_thumbnail($this->data['User']['image'], 250,182, "users",80);

				if(isset($googleimageUrl) && $googleimageUrl!='') {

					 $this->request->data['User']['image'] = $googleimageUrl;

				}

				}else{

					$this->request->data['User']['image'] = '';

				}

				if($this->User->save($this->request->data)) {
					if($this->request->data['User']['password1'] != ''){
						$this->User->saveField('password', $this->request->data['User']['password1']);
					}
					$this->User->saveField('status', 1);					

					$response	= array(

						'error'		=> 0,

						'message'	=> $this->User->id

					);					

					return json_encode($response);

					

				} else {					

					$response	= array(

						'error'		=> 1,

						'message'	=> 0

					);					

				}				

				$response['data']['User']	= $this->User->invalidFields();

				if(!empty($response['data']['User']["email"])){

					$response['data']['User']["email"] = 	$response['data']['User']['email'][0];	}

				if(!empty($response['data']['User']["username"])){

					$response['data']['User']["username"] = 	$response['data']['User']['username'][0];}

				if(!empty($response['data']['User']["password"])){

					$response['data']['User']["password"] = 	$response['data']['User']['password'][0];}

				return json_encode($response);

			

		}else{

				$this->User->id = $id;

				if(isset($this->params['requested'])) { 

					$this->User->id = $id;

					$thedata =  $this->User->read();

					return $thedata;

				}

				if(!empty($this->data)){			

					if(!empty($this->data['User']['image']['name'])){ 			

						$googleimageUrl = $this->Image->upload_image_and_thumbnail($this->data['User']['image'], 250,150, "users",80);

						if(isset($googleimageUrl) && $googleimageUrl!='') {

							 $this->request->data['User']['image'] = $googleimageUrl;

						}

					}else if(!empty($this->data['User']['oldaddimage'])){

						$this->request->data['User']['image'] = $this->data['User']['oldaddimage'];

					}else{

						$this->request->data['User']['image'] = '';

					}

					$this->User->set($this->request->data);

					if ($this->User->save($this->request->data)) {

						$this->Session->setFlash(__('Your details have been saved successfully.'));

						$this->redirect('/');

					} else {

						$this->Session->setFlash(__('The user could not be saved. Please, try again.'));

					

					}

				}else{

					$this->User->id = $id;

					$this->data =  $this->User->read();				

				}

		}

	}	

	function login(){	

		if(isset($this->data) && $this->RequestHandler->isAjax()) {	

					

				configure::write('debug', 0);

				$this->layout 		= 'ajax';  	// uses an empty layout

				$this->autoRender 	= false; // renders nothing by default
				
				$ifactive = $this->User->find('first',array ("conditions" => array('User.status' => 1, 'User.username' => $this->data['User']['username'])));
				if($this->data['User']['password']== '' || $this->data['User']['username']==''){
					$response	= array(

						'error'		=> 3,

						'message'	=> 'Please proper username and password.'

					);	
				
				}else if(empty($ifactive)){ 
					$response	= array(

						'error'		=> 3,

						'message'	=> 'Your account is de-activated currently. Please try after sometime or contant administrator.'

					);	
				}else{ 
					if($this->Auth->login()) {									

					$response	= array(

						'error'		=> 2,

						'message'	=> true

					);	

					
					return json_encode($response);					

				} else {					

						$response	= array(
	
							'error'		=> 3,
	
							'message'	=> 'Invalid Username or Password!'
	
						);					
	
					}
				}
				return json_encode($response);
		}
	}

	function ulist(){

		$yousers = $this->User->find('first',array ("order" => array('User.id' => 'desc')));

		if($yousers){

		 	return $yousers;

	  	}

	}
	function getimage($id= null){

		$getimg = $this->User->findById($id);

		if($getimg){

		 	return $getimg;

	  	}

	}

	public function logout() {

		$this->redirect($this->Auth->logout());

	}
	public function forgotpassword(){
		if(!empty($this->data)){
			$if_exist = $this->User->find('first',array ("conditions" => array('User.email' => $this->data['User']['email'])));
			if(!empty($if_exist)){
				$this->User->id = $if_exist['User']['id'];
				$pwd_string = $this->randString(8);
				$this->User->saveField('password', $pwd_string);
				$this->__sendForgotEmail($if_exist['User']['id'], $pwd_string);
				
				$this->Session->setFlash(__('Your password has been changed successfully and sent to your Email address.'));
				$this->redirect('/Users/forgotpassword/');
			}else{
				$this->Session->setFlash(__('The Email address you provided is not registered on Retirement Pulse. Please Register Using the Sign-Up link.'));
				$this->redirect('/Users/forgotpassword/');
			}
		}
	}
	function __sendForgotEmail($user_id, $password) {
		
        $user = $this->User->findById($user_id);
		
        if (empty($user)) {

            debug(__METHOD__." failed to retrieve User data for user.id: {$user_id}");

            return false;

        }
		

        // Set data for the "view" of the Email


		$email = new CakeEmail();
		$email->emailFormat('both');
		//$email->from('info@retirementpulse.com');
		$email->from(array('info@retirementpulse.com' => 'Retirement Pulse'));
            $email->to($user['User']['email']);
            $email->subject('Your New Password For Retirement Pulse');
			/*$trigg = 'Your new password has been created successfully. Your new login credentials are: '. PHP_EOL .' Username : '.$user['User']['username'].''. PHP_EOL .' Password : '.$password;	*/	
			$trigg = '<table width="650" cellspacing="0" cellpadding="10" border="0" bgcolor="#A5D8E9" style="border:1px solid #e0e0e0">
							<tr><td><img src="http://www.retirementpulse.com/app/webroot/img/email-logo.png"></td></tr>
							<tr><td>
								<table bgcolor="#FFFFFF" style="width:100%;" cellpadding="10">								    
									<tr><td>Dear '.ucfirst($user['User']['username']).',</td></tr>
									<tr><td>Your new password has been created successfully.</td></tr>
									<tr><td>Your new login credentials are:</td></tr>
									<tr><td>Username : '.$user['User']['username'].'</td></tr>
									<tr><td>Password : '.$password.'</td></tr>
									<tr><td><strong>Regards,<br>Retirement Pulse</strong></td></tr>
								</table>
							</td></tr>							
					 </table>';		
            $email->send($trigg);           
	}
	public function randString( $length ) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";	
		$size = strlen( $chars );
		$str = '';
		for( $i = 0; $i < $length; $i++ ) {
			$str .= $chars[ rand( 0, $size - 1 ) ];
		}
	
		return $str;
    }
}