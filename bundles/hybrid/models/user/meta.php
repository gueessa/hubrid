<?php namespace Hybrid\Model\User;

class Meta extends \Eloquent {
    
    /**
     * Table 
     * 
     * @var string
     */
	public static $table = 'user_meta';
    
    /**
     * Users
     * 
     * @return  Eloquent
     */
	public function users()
	{
		return $this->belongs_to('Hybrid\Model\User', 'user_id');
	}
}