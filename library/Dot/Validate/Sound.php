<?php
/**
 * DotBoost Technologies Inc.
 * DotKernel Application Framework
 *
 * @category   DotKernel
 * @copyright  Copyright (c) 2009-2015 DotBoost Technologies Inc. (http://www.dotboost.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @version    $Id: User.php 980 2015-06-11 13:38:03Z gabi $
 */

 /**
 * Validate User
 * @category   DotKernel
 * @package    DotLibrary
 * @subpackage DotValidate
 * @see		   Dot_Validate
 * @author     DotKernel Team <team@dotkernel.com>
 */

class Dot_Validate_Sound extends Dot_Validate
{
	/**
	 * Validate user options
	 * Is an array with the following keys
	 * 			- who: string - for which type of user the validation is made (user, admin, ...)
	 * 			- action: string - from which action is called the validation(login, add, update, activate, ...)
	 * 			- values: array - what should validate
	 * 			- userId: integer - used for checking the uniqueness of the user(by username or email)
	 * @var array
	 * @access private
	 */
	private $_options = array('who' => 'user',
														'action' => '',
														'values' => array(),
														'userId' => 0);
	/**
	 * Valid data after validation
	 * @var array
	 * @access private
	 */
	private $_data = array();
	/**
	 * Errors found on validation
	 * @var array
	 * @access private
	 */
	private $_error = array();
	/**
	 * Constructor
	 * @access public
	 * @param array $options [optional]
	 * @return Dot_Validate
	 */
	public function __construct($options = array())
	{
		$this->option = Zend_Registry::get('option');
		foreach ($options as $key =>$value)
		{
			$this->_options[$key] = $value;
		}
	}
	/**
	 * Check if data is valid
	 * @access public
	 * @return bool
	 */
	public function isValid()
	{
		$this->_data = array();
		$this->_error = array();
		$values = $this->_options['values'];
		
		if(array_key_exists('title', $values)){

	      $validatorChain = new Zend_Validate();
	      $validatorChain->addValidator(
	     	new Zend_Validate_StringLength( ['min' => 3,
	      								 'max' => 30]
	      								)
	      );
	      $this->_callFilter($validatorChain,$values['title']);
		}
		if(array_key_exists('description', $values)){

	      $validatorChain = new Zend_Validate();
	      $validatorChain->addValidator(
	     	new Zend_Validate_StringLength( ['min' => 5,
	      								 'max' => 100]
	      								)
	      );
	      $this->_callFilter($validatorChain,$values['description']);
		}
		if(array_key_exists('tags', $values)){

	      $validatorChain = new Zend_Validate();
	      $validatorChain->addValidator(
	     	new Zend_Validate_StringLength( ['min' => 5,
	      								 'max' => 50]
	      								)
	      );
	      $this->_callFilter($validatorChain,$values['tags']);
		}
	
		
		if(empty($this->_error))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	/**
	 * Get valid data
	 * @access public
	 * @return array
	 */
	public function getData()
	{
		return $this->_data;
	}
	/**
	 * Get errors encounter on validation
	 * @access public
	 * @return array
	 */
	public function getError()
	{
		return $this->_error;
	}
	/**
	 * Check if user already exists - email, username, and return error
	 * @access private
	 * @param string $field
	 * @param string $value
	 * @return array
	 */
	private function _validateUnique($field, $value)
	{
		$error = array();
		//email is unique, check if exists
		$exists = $this->_getUserBy($field, $value);
		if($this->_options['userId'] > 0)
		{
			$currentUser = $this->_getUserBy('id', $this->_options['userId']);
			$uniqueCondition = (is_array($exists) && $exists[$field] != $currentUser[$field]);
		}
		else
		{
			$uniqueCondition = (false != $exists);
		}
		if($uniqueCondition)
		{
			$error[$field] = $value . $this->option->errorMessage->userExists;
		}
		return $error;
	}
	/**
	 * Get admin by field
	 * @access public
	 * @param string $field
	 * @param string $value
	 * @return array
	 */
	public function _getUserBy($field = '', $value = '')
	{
		$db = Zend_Registry::get('database');
		$select = $db->select()
									->from($this->_options['who'])
									->where($field.' = ?', $value)
									->limit(1);
		$result = $db->fetchRow($select);
		return $result;
	}
	/**
	 * Call filter method from DotFilter
	 * @access private
	 * @param Zend_Validate $validator
	 * @param array $values
	 * @return void
	 */
	private function _callFilter($validator, $values)
	{
		$dotFilter = new Dot_Filter(array('validator' => $validator, 'values' => $values));
		$dotFilter->filter();
		$this->_data = array_merge($this->_data, $dotFilter->getData());
		$this->_error = array_merge($this->_error, $dotFilter->getError());
	}
}