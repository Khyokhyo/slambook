<?php

class Answer extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'answers';

	protected $guarded = array('id', 'user_id', 'question_id', 'question_user_id');

	/**
     * Get the user id.
     */
	public function user()
    {
        return $this->belongsTo('User');
    }

    /**
     * Get the question.
     */
	public function question()
    {
        return $this->belongsTo('Question');
    }

    /**
     * Get the questioner id.
     */
	public function question_user_id()
    {
        return $this->belongsTo('User', 'question_user_id', 'id');
    }

}