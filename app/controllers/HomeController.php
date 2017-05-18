<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function getLogin()
	{
		return View::make('home.login');
	}

	public function postLogin()
	{
		$input = Input::all();

		$rules = array('email' => 'required', 'password' => 'required');
		
		$v = Validator::make($input, $rules);

		if($v->fails())
		{

			return Redirect::to('/')->withErrors($v);

		} else {

			$credentials = array('email' => $input['email'], 'password' => $input['password']);

			if(Auth::attempt($credentials))
			{
				$newReq = Requests::where('receiver_id',Auth::user()->getAuthIdentifier())
								->where('request_status',1)->where('request_type', 1)->count();

				return Redirect::to('home')->with('newReq', $newReq);
			
			} else {

				return Redirect::to('/');
			}
		}
	}

	public function getRegister()
	{
		return View::make('home.register');
	}

	public function postRegister()
	{
		$input = Input::all();

		$rules = array(
			'username' => 'required',
			'email' => 'required|unique:users|email',
			'password' => 'required'
			);
		
		$v = Validator::make($input, $rules);

		if($v->passes())
		{
			$password = $input['password'];
			$password = Hash::make($password);

			$user = new User();
			$user->username = $input['username'];
			$user->email = $input['email'];
			$user->password = $password;
			if($user->save()){

				$user_details = new UserDetails();

				$user_details->date_of_birth = date('Y-m-d',strtotime($input['date_of_birth']));
				$user_details->city = $input['city'];
				$user_details->school = $input['school'];
				$user_details->college = $input['college'];
				$user_details->university = $input['university'];
				$user_details->user_id = $user->id;
				$user_details->save();


				$questions = new Question();

				$questions->questions = "Your hobby";
				$questions->user_id = $user->id;
				$questions->save();

				return Redirect::to('/');
			}


		} else {

			return Redirect::to('register')->withInput()->withErrors($v);
		}
	}

	public function getIndex()
	{
		$names = Requests::where('sender_id',Auth::user()->getAuthIdentifier())->where('request_status', 2)->with('user_receiver')->get();

		$newReq = Requests::where('receiver_id',Auth::user()->getAuthIdentifier())
								->where('request_status',1)->where('request_type', 1)->count();

		return View::make('authorised.index')->with('names', $names)->with('newReq', $newReq);		
	}

	public function getHome()
	{
		$newReq = Requests::where('receiver_id',Auth::user()->getAuthIdentifier())
								->where('request_status',1)->where('request_type', 1)->count();

		return View::make('authorised.home')->with('newReq', $newReq);		
	}

	public function getSlams()
	{
		$newReq = Requests::where('receiver_id',Auth::user()->getAuthIdentifier())
								->where('request_status',1)->where('request_type', 1)->count();
		
		$id = Requests::where('sender_id',Auth::user()->getAuthIdentifier())->where('request_status', 2)
						 		->get();

		$id = Requests::where('sender_id',Auth::user()->getAuthIdentifier())->where('request_status', 2)
						 		->min('receiver_id');

		if(empty($id))
		return View::make('authorised.error')->with('newReq', $newReq);
		
		$name = User::where('id', $id)->first();
		$answers = Answer::where('question_user_id',Auth::user()->getAuthIdentifier())
						 ->where('user_id', $id)->with('user')->with('question')->get();

   		$next = Requests::where('sender_id',Auth::user()->getAuthIdentifier())->where('request_status', 2)
   						->where('receiver_id', '>', $id)->min('receiver_id');

		return View::make('authorised.slams')->with('newReq', $newReq)->with('answers', $answers)
						->with('name', $name)->with('next', $next);
	}

	public function postSlams($id)
	{
		$newReq = Requests::where('receiver_id',Auth::user()->getAuthIdentifier())
								->where('request_status',1)->where('request_type', 1)->count();
	
		$name = User::where('id', $id)->first();
		$answers = Answer::where('question_user_id',Auth::user()->getAuthIdentifier())
						 ->where('user_id', $id)->with('user')->with('question')->get();

   		$next = Requests::where('sender_id',Auth::user()->getAuthIdentifier())->where('request_status', 2)
   						->where('receiver_id', '>', $id)->min('receiver_id');

   		$prev = Requests::where('sender_id',Auth::user()->getAuthIdentifier())->where('request_status', 2)
   						->where('receiver_id', '<', $id)->max('receiver_id');

		return View::make('authorised.slams')->with('newReq', $newReq)->with('answers', $answers)
						->with('name', $name)->with('next', $next)->with('prev', $prev);		
	}

	public function getPages($id)
	{
		$newReq = Requests::where('receiver_id',Auth::user()->getAuthIdentifier())
								->where('request_status',1)->where('request_type', 1)->count();
		$name = User::where('id', $id)->first();
		$answers = Answer::where('question_user_id',Auth::user()->getAuthIdentifier())
						 ->where('user_id', $id)->with('user')->with('question')->get();
		$has = Requests::where('receiver_id', $id)->where('sender_id', Auth::user()->getAuthIdentifier())
					   ->where('request_status', 2)->first();

		return View::make('authorised.pages')->with('answers', $answers)->with('name', $name)->with('has', $has)->with('newReq', $newReq);	
	}

	public function postPages($id)
	{
		$newReq = Requests::where('receiver_id',Auth::user()->getAuthIdentifier())
								->where('request_status',1)->where('request_type', 1)->count();

		Requests::where('receiver_id', $id)->where('sender_id', Auth::user()->getAuthIdentifier())
						 ->update(array('request_status' => 1, 'request_type' => 1));

		$names = Requests::where('sender_id',Auth::user()->getAuthIdentifier())->where('request_status', 2)->with('user_receiver')->get();

		return View::make('authorised.index')->with('names', $names)->with('newReq', $newReq);	
	}

	public function deletePages($id)
	{
		$newReq = Requests::where('receiver_id',Auth::user()->getAuthIdentifier())
								->where('request_status',1)->where('request_type', 1)->count();

		Answer::where('question_user_id',Auth::user()->getAuthIdentifier())
						 ->where('user_id', $id)->delete();

		Requests::where('receiver_id', $id)->where('sender_id', Auth::user()->getAuthIdentifier())->delete();

		$names = Requests::where('sender_id',Auth::user()->getAuthIdentifier())->where('request_status', 2)->with('user_receiver')->get();

		return View::make('authorised.index')->with('names', $names)->with('newReq', $newReq);	
	}

	public function getEditProfile()
	{
		$newReq = Requests::where('receiver_id',Auth::user()->getAuthIdentifier())
								->where('request_status',1)->where('request_type', 1)->count();
		$details = UserDetails::where('user_id',Auth::user()->getAuthIdentifier())->with('user')->first();
		return View::make('authorised.editProfile')->with('details',$details)->with('newReq', $newReq);
	}

	public function putEditProfile()
	{
		$newReq = Requests::where('receiver_id',Auth::user()->getAuthIdentifier())
								->where('request_status',1)->where('request_type', 1)->count();
		$input = Input::all();

		$i = Auth::user()->getAuthIdentifier();

		$rules = array(
			'username' => 'required'
			);
		
		$v = Validator::make($input, $rules);

		if($v->passes())
		{
	        $username = $input['username'];

	        $date_of_birth = date('Y-m-d',strtotime($input['date_of_birth']));
	        $city = $input['city'];
	        $school = $input['school'];
	        $college = $input['college'];
	        $university = $input['university'];

	        User::where('id',Auth::user()->getAuthIdentifier())->update(array(
	            'username' => $username
        	));

	        UserDetails::where('user_id',Auth::user()->getAuthIdentifier())->update(array(
	            'date_of_birth' => $date_of_birth,
	            'city' => $city,
	            'school' => $school,
	            'college' => $college,
	            'university' => $university
        	));

			return Redirect::to('home')->with('message', 'Your profile has been successfully edited')->with('newReq', $newReq);

		} else {

			return Redirect::to('editProfile')->withInput()->withErrors($v)->with('newReq', $newReq);
		}
	}

	public function getSetQuestions()
	{
		$newReq = Requests::where('receiver_id',Auth::user()->getAuthIdentifier())
								->where('request_status',1)->where('request_type', 1)->count();
		$query = DB::table('questions');
		$query->where('user_id', '=' ,Auth::user()->getAuthIdentifier());
		$results = $query->get();

		return View::make('authorised.setQuestions')->with('results', $results)->with('newReq', $newReq);
	}

	public function postSetQuestions()
	{
		$newReq = Requests::where('receiver_id',Auth::user()->getAuthIdentifier())
								->where('request_status',1)->where('request_type', 1)->count();
		$input = Input::all();
		$rules = array('question' => 'required');
		
		$v = Validator::make($input, $rules);

		if($v->passes())
		{
			$questions = new Question();

			$questions->questions = $input['question'];
			$questions->user_id = Auth::user()->id;
			$questions->save();

			$query = DB::table('questions');
		    $query->where('user_id', '=' ,Auth::user()->getAuthIdentifier());
		    $results = $query->get();

			return View::make('authorised.setQuestions')->with('results', $results)->with('newReq', $newReq);
		}
		else
			return Redirect::to('setQuestions')->withErrors($v)->with('newReq', $newReq);
	}

	public function deleteQuestions($id)
	{
		$newReq = Requests::where('receiver_id',Auth::user()->getAuthIdentifier())
								->where('request_status',1)->where('request_type', 1)->count();
		Question::where('id', $id)->delete();

        return Redirect::to('setQuestions')->with('newReq', $newReq);
	}

	public function getSearch()
	{
		$newReq = Requests::where('receiver_id',Auth::user()->getAuthIdentifier())
								->where('request_status',1)->where('request_type', 1)->count();
		return View::make('authorised.search')->with('newReq', $newReq);
	}

	public function postSearch()
	{
		$newReq = Requests::where('receiver_id',Auth::user()->getAuthIdentifier())
								->where('request_status',1)->where('request_type', 1)->count();

		$input = Input::all();

		$rules = array('username' => 'required');
		
		$v = Validator::make($input, $rules);

		if($v->passes())
		{
			$q = $input['username'];

		    $searchTerms = explode(' ', $q);

		    $query = DB::table('users');

		    foreach($searchTerms as $term)
		    {
		        $query->where('username', 'LIKE', '%'. $term .'%');
		    }

		   	$results = $query->get();


			return View::make('authorised.search')->with('results', $results)->with('newReq', $newReq);
		}
		else
			return Redirect::to('search')->withErrors($v)->with('newReq', $newReq);
	}

	public function getProfile()
	{
		$newReq = Requests::where('receiver_id',Auth::user()->getAuthIdentifier())
								->where('request_status',1)->where('request_type', 1)->count();
		return View::make('authorised.profile')->with('newReq', $newReq);
	}

	public function postProfile($id)
	{
		$newReq = Requests::where('receiver_id',Auth::user()->getAuthIdentifier())
								->where('request_status',1)->where('request_type', 1)->count();
		$user = User::find($id);
		$details = UserDetails::where('user_id', $id)->first();
		$has = Requests::where('receiver_id', $id)->where('sender_id', Auth::user()->getAuthIdentifier())->first();
		$self = strcmp(Auth::user()->getAuthIdentifier(),$id);

		if(!empty($has))
			$flag = 1;
		else
			$flag = 0;
		$input = Input::get('send');

		if((!empty($input)) && (empty($has)) && ($self!=0)) {

			$request = new Requests();

			$request->sender_id = Auth::user()->getAuthIdentifier();
			$request->receiver_id = $id;
			$request->request_type = 1;
			$request->request_status = 1;
			$request->save();

			$flag = 1;
		}

		return View::make('authorised.profile')->with('user', $user)->with('details', $details)
		->with('has', $has)->with('self', $self)->with('flag',$flag)->with('newReq', $newReq);
	}

	public function getRequests()
	{
		$results = Requests::where('receiver_id',Auth::user()->getAuthIdentifier())
								->where('request_status',1)->with('user_sender')->get();

		Requests::where('receiver_id',Auth::user()->getAuthIdentifier())
								->where('request_status',1)->update(array('request_type' => 2));

		$newReq = Requests::where('receiver_id',Auth::user()->getAuthIdentifier())
								->where('request_status',1)->where('request_type', 1)->count();

		return View::make('authorised.requests')->with('results', $results)->with('newReq', $newReq);
	}

	public function getRequestProfile($sender_id)
	{
		$newReq = Requests::where('receiver_id',Auth::user()->getAuthIdentifier())
								->where('request_status',1)->where('request_type', 1)->count();
		$results = Requests::where('sender_id', $sender_id)->where('receiver_id', Auth::user()->getAuthIdentifier())
								->where('request_status',1)->with('user_sender')->first();

		return View::make('authorised.requestProfile')->with('results', $results)->with('newReq', $newReq);
	}

	public function deleteRequests($id)
	{
		$newReq = Requests::where('receiver_id',Auth::user()->getAuthIdentifier())
								->where('request_status',1)->where('request_type', 1)->count();
								
        Requests::where('id', $id)->delete(array());
        return Redirect::to('requests')->with('newReq', $newReq);
	}

	public function acceptRequest($id, $sender_id)
	{
		$newReq = Requests::where('receiver_id',Auth::user()->getAuthIdentifier())
								->where('request_status',1)->where('request_type', 1)->count();
		$results = Question::where('user_id', $sender_id)->with('user')->get();
		$requests = Requests::where('sender_id', $sender_id)->where('receiver_id', Auth::user()->getAuthIdentifier())
								->where('request_status',1)->with('user_sender')->first();

		Requests::where('id', $id)->update(array('request_status' => 2));

		return View::make('authorised.questions')->with('results', $results)->with('requests', $requests)->with('newReq', $newReq);
	}

	public function getQuestions($sender_id)
	{
		$newReq = Requests::where('receiver_id',Auth::user()->getAuthIdentifier())
								->where('request_status',1)->where('request_type', 1)->count();
		$results = Question::where('user_id', $sender_id)->with('user')->get();
		$requests = Requests::where('sender_id', $sender_id)
							->where('receiver_id', Auth::user()->getAuthIdentifier())->with('user_sender')->first();

		return View::make('authorised.questions')->with('results', $results)->with('requests', $requests)->with('newReq', $newReq);
	}

	public function getWrite($ques_id)
	{
		$newReq = Requests::where('receiver_id',Auth::user()->getAuthIdentifier())
								->where('request_status',1)->where('request_type', 1)->count();
		$question = Question::where('id', $ques_id)->first();
		$ans = Answer::where('question_id', $ques_id)->where('user_id', Auth::user()->getAuthIdentifier())->first();
		$has = Answer::where('question_id', $ques_id)->where('user_id', Auth::user()->getAuthIdentifier())->first();

        return View::make('authorised.write')->with('question', $question)->with('has', $has)->with('ans', $ans)->with('newReq', $newReq);
	}

	public function postAnswer($id, $user_id)
	{
		$newReq = Requests::where('receiver_id',Auth::user()->getAuthIdentifier())
								->where('request_status',1)->where('request_type', 1)->count();
		$input = Input::get('answer');

		$has = Answer::where('question_id', $id)->where('user_id', Auth::user()->getAuthIdentifier())
										 ->where('question_user_id', $user_id)->first();
        
        if(empty($has)){
        	$answer =  new Answer();

	        $answer->answers = $input;
	        $answer->user_id = Auth::user()->getAuthIdentifier();
	        $answer->question_id = $id;
	        $answer->question_user_id = $user_id;
	        $answer->save();
	    }

        $results = Question::where('user_id', $user_id)->with('user')->get();
		$requests = Requests::where('sender_id', $user_id)
							->where('receiver_id', Auth::user()->getAuthIdentifier())->with('user_sender')->first();

       return View::make('authorised.questions')->with('results', $results)->with('requests', $requests)->with('newReq', $newReq);
	}

	public function putAnswer($id, $user_id)
	{
		$newReq = Requests::where('receiver_id',Auth::user()->getAuthIdentifier())
								->where('request_status',1)->where('request_type', 1)->count();
		$input = Input::get('answer');

		$has = Answer::where('question_id', $id)->where('user_id', Auth::user()->getAuthIdentifier())
										 ->where('question_user_id', $user_id)->first();
        
        if(!empty($has)){

        	Answer::where('question_id', $id)->where('user_id', Auth::user()->getAuthIdentifier())
										 ->where('question_user_id', $user_id)->update(array('answers' => $input));
	    }

        $results = Question::where('user_id', $user_id)->with('user')->get();
		$requests = Requests::where('sender_id', $user_id)
							->where('receiver_id', Auth::user()->getAuthIdentifier())->with('user_sender')->first();

       return View::make('authorised.questions')->with('results', $results)->with('requests', $requests)->with('newReq', $newReq);
	}

	public function logout()
	{
		Auth::logout();
		return Redirect::to('/');
	}
}
