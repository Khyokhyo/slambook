<?php

class Requests extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'requests';

	protected $guarded = array('id', 'sender_id', 'receiver_id');

	/**
     * Get user id for sender.
     */
	public function user_sender()
    {
        return $this->belongsTo('User', 'sender_id');
    }

    /**
     * Get user id for receiver.
     */
	public function user_receiver()
    {
        return $this->belongsTo('User', 'receiver_id');
    }

}