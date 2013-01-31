<?php



class User extends AppModel {

	public $name = 'User';

	

	public $validate = array(  

							   'email' => array(

										'valid' => array(

												'rule' => 'email',

												'required' => true,

												'allowEmpty' => false,

												'message' => 'Please enter a valid email address.'

										),

										'duplicate' => array(

												'rule' => 'isUnique',

												'on' => 'create',

												'message' => 'This email has already been taken.'

										)

								),



							   'username' => array(

										'required' => array(

														'rule' => array('alphaNumericDashUnderscore'),

														'message' => 'Alphanumeric, - , _ and dot.'

										),

										'duplicate' => array(

												'rule' => 'isUnique',

												'on' => 'create',

												'message' => 'This username has already been taken.'

										),
										'long' => array(
											'rule'    => array('minLength', 6),
											'message' => 'Must be at least 6 characters long.'
										)

								),


								'password' => array(

													'required' => array(

														'rule' => array('notEmpty'),

														'message' => 'A password is required'

														)

								)

							);	

	public function beforeSave(){

		if(isset($this->data[$this->alias]['password'])){

			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);

		}

		return true;

	}

	/**

     * Creates an activation hash for the current user.

     *

     *  @param Void

     *  @return String activation hash.

    */

   	public function getActivationHash()

    {

        if (!isset($this->id)) {

            return false;

        }

        return substr(Security::hash(Configure::read('Security.salt') . $this->field('created') . date('Ymd')), 0, 8);

    }

	public function alphaNumericDashUnderscore($check) {
        // $data array is passed using the form field name as the key
        // have to extract the value to make the function generic
        $value = array_values($check);
        $value = $value[0];

        return preg_match('|^[0-9a-zA-Z_.-]*$|', $value);
    }

}

