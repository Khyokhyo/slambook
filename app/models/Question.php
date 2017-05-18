<?php

class Question extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'questions';

	protected $guarded = array('id', 'user_id');

	/**
     * Get the user id.
     */
	public function user()
    {
        return $this->belongsTo('User');
    }

    /**
     * Get details of the answer.
     */
    public function answer()
    {
        return $this->hasMany('Answer');
    }

}