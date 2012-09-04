<?php namespace Hybrid\Model;

class User extends \Eloquent {
    
    /**
     * Meta
     * 
     * @return  Eloquent
     */
	public function meta()
	{
		return $this->has_many('Hybrid\Model\User\Meta');
	}
	
    /**
     * Roles
     * 
     * @return  Eloquent
     */
	public function roles()
	{
		return $this->has_many_and_belongs_to('Hybrid\Model\Role', 'user_roles');
	}
}