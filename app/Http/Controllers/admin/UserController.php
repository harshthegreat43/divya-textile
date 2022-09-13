<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 
// use Illuminate\Support\Facades\Http;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller{
	
	function profile(){
		return view('admin/user/profile');
}

    
function updateprofile(Request $request){
	$user = Auth::user();
	if($request->input()){
			$validated = $request->validate([
			'name' => 'required',
			'email' => 'required|email',
			'address' => 'required',
			'mobile' => 'required|digits:10|numeric',
			'min_amt' => 'required|numeric',
			'fb_url' => 'url',
			'twitter_url' => 'url',
			'insta_url' => 'url',
			'google_url' => 'url',
			'linkedin_url' => 'url',
		]);
		$user->name=$request->name;
		$user->mobile=$request->mobile;
		$user->min_amt=$request->min_amt;
		$user->fb_url=$request->fb_url;
		$user->twitter_url=$request->twitter_url;
		$user->insta_url=$request->insta_url;
		$user->google_url=$request->google_url;
		$user->linkedin_url=$request->linkedin_url;
		$user->address=$request->address;
		$result = $user->save();
		if($result){
			$user = Auth::user();
			$request->session()->put('user',$user);
			session()->flash('success', 'Profile has been updated');
			return redirect('admin/profile');
		}
	}

}	
function password(Request $request){
	if($request->input()){
		if(($request->password)==($request->confirm_password)){
			$user = Auth::user();
			$pass = Hash::make($request->password);
			$user->password=$pass;
			$result = $user->save();
			if($result){
				Auth::logout();
				$user = Auth::user();
			    session()->flash('success', 'Password has been updated');
			    return redirect('login');
		    }
		}
		else{
			session()->flash('error', 'Password does not match');
		   return redirect('admin/password');
		}
	}
	else{
		return view('admin/user/password');
	}
}

}