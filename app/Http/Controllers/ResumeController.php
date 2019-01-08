<?php

namespace App\Http\Controllers;

use App\Resume;
use App\Http\Requests\GetResume;
use App\Http\Requests\StoreResume;
use App\Mail\ResumeStored;
use Illuminate\Support\Facades\Mail;


class ResumeController extends Controller
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

	public function get(GetResume $request)
	{
		$data = $request->validated();
		$resumes = Resume::whereHas('website', function ($query) use ($request){
			$query->where('id', $request->session()->get('website')->id);
		})
			->where('is_paid', true)->where('is_active', true)
			->with('user', 'reviews', 'categories')
			->byExperience($data['filters']['experience'])
			->paginate(10);
	}

	public function store(StoreResume $request)
	{
		$data = $request->validated();
		$resume = new Resume;
		$resume->experience = $data['experience'];
		$resume->is_urgent = $data['is_urgent'];
		$resume->with_loaders = $data['is_urgent'];
		$resume->is_paid = false;
		$resume->is_active = false;
		$resume->user()->associate($request->user());
		$resume->website()->associate($request->session()->get('website'));
		$resume->save();

		foreach ($data['categories'] as $category) {
			$resume->categories()->attach($category->id,['price' => $category->price]);
		}
		$resume->save();

		Mail::to($request->user())->queue(new ResumeStored($resume));
	}

	public function update($id, StoreResume $request)
	{
		$resume = Resume::where('id', $id)->with('user', 'website');
		if ($resume) {
			if ($resume->user->is($request->user()) || $request->user()->role == 2) {
				if ($resume->website->is($request->session()->get('website'))) {
					$data = $request->validated();
					$resume->experience = $data['experience'];
					$resume->is_urgent = $data['is_urgent'];
					$resume->with_loaders = $data['is_urgent'];

					if ($request->user()->role == 2) {
						$resume->is_active = $data['is_active'];
					}

					$resume->categories()->detach();
					foreach ($data['categories'] as $category) {
						$resume->categories()->attach($category->id,['price' => $category->price]);
					}

					$resume->save();
					return view('home');
				}
				else {
					return response('Incorrect website!', 401);
				}
			}
			else {
				return response('Unauthorised changes!', 403);
			}
		}
		else {
			return response('Resume not found!', 404);
		}
	}
}
