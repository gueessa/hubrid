<?php namespace Hybrid\Model;

class Role extends \Eloquent {
	
    /**
     * Users
     * 
     * @return Eloquent 
     */
    public function users()
	{
		return $this->has_many_and_belongs_to('Hybrid\Model\User', 'user_roles');
	}
}