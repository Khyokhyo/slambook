<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Auth\Reminders\RemindableTrait;;

class User extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	protected $guarded = array('id', 'password');

    protected $with = ['user_details'];

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	/**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {
        return $this->remember_token;
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string  $value
     * @return void
     */
    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    /**
     * Get details of the user.
     */
    public function user_details()
    {
        return $this->hasOne('UserDetails','user_id','id');
    }

    /**
     * Get details of the request sender.
     */
    public function request_sender()
    {
        return $this->hasMany('Requests', 'sender_id');
    }

    /**
     * Get details of the request receiver.
     */
    public function request_receiver()
    {
        return $this->hasMany('Requests', 'receiver_id');
    }

    /**
     * Get details of the question.
     */
    public function question()
    {
        return $this->hasMany('Question');
    }

    /**
     * Get details of the answer.
     */
    public function answer()
    {
        return $this->hasMany('Answer', 'user_id', 'id');
    }

    /**
     * Get details of the answer.
     */
    public function question_user()
    {
        return $this->hasMany('Answer', 'question_user_id', 'id');
    }

}