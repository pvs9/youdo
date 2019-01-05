<?php

namespace App\Http\Controllers;

use App\User;
use App\Image;
use App\Website;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
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

	public function store($image, Website $website)
	{
		$filename = '/avatars/'.Auth::id().time().'.'.$image->getClientOriginalExtension();
		$modified_image = ImageManager::make($image)->fit(600, 600)->save();
		Storage::disk('public')->put($filename, $modified_image);
		$user = User::where('id', Auth::id())->with('image')->first();
		if ($user->image) {
			Storage::disk('public')->delete($user->image->path);
		}

		$image = new Image;
		$image->path = Storage::disk('public')->url($filename);
		$image->user()->associate($user);
		$image->website()->associate($website);
		$image->save();
	}
}
