<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{
	public $username;
	public $password;
	public $rememberMe;
	public $serverConnection;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username, password, serverConnection', 'required'),
			// rememberMe needs to be a boolean
			array('rememberMe', 'boolean'),
			// password needs to be authenticated
			array('password', 'authenticate'),
			array('serverConnection', 'authenticateConnection'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'rememberMe'=>'Remember me next time',
			'serverConnection'=>'Connect to Server',
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			if(!$this->_identity->authenticate())
				$this->addError('password','Incorrect username or password.');
		}
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$this->_identity->serverConnection = $this->serverConnection;
			$duration=$this->rememberMe ? 3600*24*7 : 0; // 7 days
			Yii::app()->user->login($this->_identity,$duration);
			return true;
		}
		else
			return false;
	}
	
	public function authenticateConnection($attribute, $params)
	{
		if (!$this->hasErrors())
		{
			if ((int)$this->serverConnection === 1)
			{
				$taxValid = TaxConnectionChecking::taxValid($this->_identity->id);
				if (!$taxValid)
					$this->addError('serverConnection', 'No Primary Connection Available.');
			}
			else if ((int)$this->serverConnection === 2)
			{
				$taxSecondaryValid = TaxConnectionChecking::taxSecondaryValid($this->_identity->id);
				$nonTaxValid = TaxConnectionChecking::nonTaxValid($this->_identity->id);
				
				if (!($taxSecondaryValid || $nonTaxValid))
					$this->addError('serverConnection', 'No Secondary Connection Available.');
			}
			else
			{
				$this->addError('serverConnection', 'No Connection Available.');
			}
		}
	}
}
