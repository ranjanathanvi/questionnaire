<?php



class Admin extends AppModel {

    	public $name = 'Admin';	

		var $validate = array(					

			'email' => array(

				'rule' => 'email',

				'message' => 'Please enter valid email'

			),		

		);

		

		

		function checkEmail($email_address = null){



			if(preg_match("/^[a-zA-Z]*\w+(\.\w+)*\@\w+(\.[0-9a-zA-Z]+)*\.[a-zA-Z]{2,4}$/", $email_address) === 0)

			{

				return false;

			}

			else

			{

				return true;

			}

		}

		

		

		function isEmailExist($conditions = null){

			$result=$this->find('count',array('conditions'=>$conditions));

			if($result){

				return false;

			}else{

				return true;

			}

		} //end function isEmailExist()

		

		

		function isPasswordExist($conditions = null){

			$result=$this->find('count',array('conditions'=>$conditions));

			if($result){

				return false;

			}else{

				return true;

			}

		} //end function isPasswordExist()

		

		

		function sendPasswordEmail($adminid = null){



                App::import("Model","Admin");

                $admin=   new Admin();



                $adminInfo =   $admin->find("Admin.id=".$adminid);              

				$to = $adminInfo['Admin']['email'];

				$username =   $adminInfo['Admin']['username'];

                $password =   $adminInfo['Admin']['password'];

                

                $message    =   "<strong>Account Details</strong><br />";



				$subject = 'Login Details';

				

                $messageToSend = 'Username: '.$username.'<br />';

				$messageToSend .= 'Password: '.$password.'<br />';



                $headers  = "MIME-Version: 1.0\r\n";

                $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

                $headers .= "From: ".SITE_TITLE." <Administrator>\r\n";

                mail($to, $subject, $messageToSend, $headers);

        }

		

	

	

}