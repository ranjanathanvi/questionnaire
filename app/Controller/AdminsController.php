<?php



class AdminsController extends AppController {

		

		public $name = 'Admins';	

		public $helpers = array('Html', 'Session','Form');	

		public $uses = array('Admin');

		var $layout = 'admin';

		

		function beforeFilter() {    

			if ($this->action != 'admin_forgotpassword'){

                    $loggedAdminId = $this->Session->read("adminid");

                    if(!$loggedAdminId && $this->params['action']!="admin_login"){

                            $this->redirect("/admin/admins/login");

							$this->Session->setFlash('The URL you followed requires you login.');

                    }else if($loggedAdminId && $this->params['action']=="admin_login"){

                            $this->redirect("/admin/admins/dashboard");

                    }

            }			

		}

		

		
		function index() {

            $this->layout = 'admin';

            $this->redirect("/admin/admins/login");

		}
		function admin_index() {

            $this->layout = 'admin';

            $this->redirect("/admin/admins/dashboard");

		}

		

		

		function admin_dashboard() {

        	$this->layout = 'admin';

        }

		

		

		 function admin_login() {

            $this->layout = 'admin_login';

            if(!empty($this->data))

            { 

                $username = $this->data['Admin']['username'];

                $password = $this->data['Admin']['password'];

                $adminCheck = $this->Admin->find('first',array('conditions' => array('username' => $username, 'password' => $password)));

				

                if(is_array($adminCheck) &&  !empty($adminCheck))

                {

                    $this->Session->write("adminid",$adminCheck['Admin']['id']);
  $this->Session->write("username",$adminCheck['Admin']['username']);
					$this->Session->setFlash('You have successfully logged in.'); 

                    $this->redirect('/admin/admins/dashboard');

                }else{

                    $this->Session->setFlash('Invalid username or password.'); 

                    $this->redirect('/admin/admins/login');

                }

            }

        }

				

		

		function admin_logout(){

			$this->Session->delete('adminid');

			$this->Session->setFlash('You have successfully logged out.'); 

			$this->redirect('/admin/admins/login');			

		}

		

		

		function admin_forgotpassword(){

            $this->layout = 'admin_login';            

            $conditions1 = array();



            if(isset($this->data) && !empty($this->data)){           

				$conditions1[]="Admin.email = '" . $this->data["Admin"]["email"] . "'";

				if($this->Admin->isEmailExist($conditions1) == true){

						$this->Session->setFlash("Email doesn't exist."); 

				}

				else{

					

		   			// condition for checking existing email address==========================

					if(isset($this->data)){

						$email = $this->data['Admin']['email'];

						$adminCheck = $this->Admin->find('first',array('conditions' => array('email' => $email)));

						if(is_array($adminCheck) &&  !empty($adminCheck)){

						    $adminid = $adminCheck['Admin']['id'];

						    $this->Admin->sendPasswordEmail($adminid);

						    $this->Session->setFlash('Your password has been sent to your email.');							   

						}else{

							$this->Session->setFlash("You've entered invalid email.");

						}

					} //========= condition end for checking existing email address===========

			   }// end else

            }//end of main if

     	 } // end admin_forgotpassword function

		 

		 

		 

		 function admin_changepassword(){

				$this->layout = 'admin';

				$msgString='';

				$conditions1 = array();

	

			   if(isset($this->data) && !empty($this->data)){ 	

					$uid = $this->Admin->findById($this->data['Admin']['id']);

					

					if($this->data['Admin']['old_password']!= $uid['Admin']['password'])

					{

						$msgString = "Old password is incorrect.<br/>";
						$this->Session->setFlash($msgString);
						$this->redirect(array('controller'=>'admins','action' => 'changepassword'));

					}

					if(empty($this->data["Admin"]["old_password"])){

						$msgString = "Please enter old password.<br/>";
						$this->Session->setFlash($msgString);
						$this->redirect(array('controller'=>'admins','action' => 'changepassword'));

					}

		

					elseif(strlen($this->data["Admin"]["password"])<6){

						$msgString = "New password must be at least 6 characters.<br/>";
						$this->Session->setFlash($msgString);
						$this->redirect(array('controller'=>'admins','action' => 'changepassword'));
					}

		

					if(empty($this->data["Admin"]["confirm_password"])){

						$msgString = "Please enter confirm password.<br/>";
						$this->Session->setFlash($msgString);
						$this->redirect(array('controller'=>'admins','action' => 'changepassword'));
					}

					$password = $this->data["Admin"]["password"];

					$confirmpassword = $this->data["Admin"]["confirm_password"];

		

					if($password!=$confirmpassword)

					{

						$msgString = "New Password &amp; Confirm Password doesn't Match.<br/>";		
						$this->Session->setFlash($msgString);
						$this->redirect(array('controller'=>'admins','action' => 'changepassword'));					

					}

					else{ 

						$this->request->data['Admin']['password'] = $password;

						$this->request->data['Admin']['id'] = $uid['Admin']['id'];		

						

						if($this->Admin->save($this->data)) { 

							$this->Session->setFlash('Password is changed successfully.');

							//$this->redirect('/admin/admins/login');		

						}

		

				 	}// end else

	

			}//end of main if



      	}

// end admin_changepassword function





        function admin_changeemail()

        {

				$this->layout = 'admin';

					

				if(isset($this->data))

				{

					$msgstring = '';

					if(empty($this->data['Admin']['email'])){

						$msgstring .= "Please Enter Email"."<br/>";

					}

					elseif($this->Admin->checkEmail($this->data["Admin"]["email"]) == false){

						$msgstring .="Email Not Valid.<br>";

					}

	

					if($msgstring == ''){

						if($this->Admin->save($this->data))

							$this->Session->setFlash('Email saved successfully');

					}

					else{

						$this->Session->setFlash($msgstring);

					}

				}

				else{

					$this->Admin->id = 1;

					$this->data =  $this->Admin->read();

				}

        }


}

