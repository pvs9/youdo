<?php

namespace App\Http\Controllers;

use App\Mail\ReviewStored;
use App\Resume;
use App\Review;
use App\Http\Requests\StoreReview;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

class ReviewController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function store(StoreReview $request)
	{
		$data = $request->validated();
		$resume = Resume::find($data['resume_id']);
		if($resume->reviews()->where('email', $data['email'])->first()) {
			return response('You have already reviewed this resume!', 401);
		}
		else {
			$review = new Review;
			$review->name = $data['name'];
			$review->email = $data['email'];
			$review->text = $data['text'];
			$review->is_verified = false;
			$review->is_active = false;
			$review->resume()->associate($resume);
			$review->save();

			Mail::to($request->user())->queue(new ReviewStored(Crypt::encryptString($review->id)));

			return 'Review stored';
		}
	}

	public function verify($hash)
	{
		$review = Review::find(Crypt::decryptString($hash));
		if($review) {
			$review->is_verified = true;
			$review->is_active = true;
			$review->save();
			return 'Review verified';
		}
		else return response('Incorrect hash!', 404);
	}

}
