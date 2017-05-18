<?php

class UserDetails extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user_details';

	protected $guarded = array('user_id');

	/**
     * Get the user id.
     */
	public function user()
    {
        return $this->belongsTo('User','user_id','id');
    }

}