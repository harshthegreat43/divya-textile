<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Http;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller{
	
	function login(Request $request){
		if($request->email!=null && $request->password!=null){
			if(Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password, 'role_id' => '1'], $request->get('remember'))) {
				$user = Auth::user();
					$request->session()->put('user',$user);
					return redirect('admin/dashboard');
			}else{
				session()->flash('error', 'Invalid email or password');
				return redirect('login');
			}
		}else{
			return view('login');
		}
	}


	
	function signin(Request $request){
		$user = User::where('role_id','1')->get()->first();
		$free_delivery = $user->min_amt;
		if($request->mobile!=null && $request->password!=null){
			$validated = $request->validate([
				'mobile' => 'required|digits:10|numeric',
				'password' => 'required',
			]);
			if(Auth::guard('web')->attempt(['mobile' => $request->mobile, 'password' => $request->password, 'role_id' => '2'], $request->get('remember'))) {
				$customer = Auth::user();
					$request->session()->put('customer',$customer);
					return redirect('/');
			}else{
				session()->flash('error', 'Mobile or Password Incorrect!');
				return redirect(\URL::previous());
			}
		}else{
			return view('web/signin',compact('free_delivery'));
		}
	}


	
	function profileupdate(Request $request){
		$user = User::where('id','1')->get()->first();
		$free_delivery = $user->min_amt;
		if($request->input()){
			$validated = $request->validate([
				'name' => 'required',
				'email' => 'required',
				'mobile' => 'required|digits:10|numeric',
				'email' => 'required',
				'address' => 'required',
				'password' => 'required',
			]);
			$customer = User::where('id',$request->id)->get()->first();
			$customer->name=strtolower($request->name);
			$customer->email=$request->email;
			$customer->mobile=$request->mobile;
			$customer->address=strtolower($request->address);
			$result = $customer->save();
			if($result){
					$customer = User::where('id',$request->id)->get()->first();;
						$request->session()->put('customer',$customer);
						return redirect('/');
			}
		}else{
			return view('web/profile',compact('free_delivery'));
		}
	}


	
	function signup(Request $request){
		$user = User::where('id','1')->get()->first();
		$free_delivery = $user->min_amt;
		if($request->input()){
			$validated = $request->validate([
				'name' => 'required',
				'email' => 'required',
				'mobile' => 'required|digits:10|numeric',
				'email' => 'required',
				'password' => 'required',
				'address' => 'required',
			]);
			$mobile = User::where('mobile',$request->mobile)->get()->first();
			if($mobile!=null){
				session()->flash('error', 'Phone number already exists. Try with different number or Sign IN!');
				return redirect(\URL::previous());
			}
			$customer = new User();
			$customer->name=strtolower($request->name);
			$customer->email=$request->email;
			$customer->mobile=$request->mobile;
			$customer->password=Hash::make($request->password);
			$customer->address=strtolower($request->address);
			$result = $customer->save();
			if($result){
				if(Auth::guard('web')->attempt(['mobile' => $request->mobile, 'password' => $request->password, 'role_id' => '2'], $request->get('remember'))) {
					$customer = Auth::user();
						$request->session()->put('customer',$customer);
						return redirect('/');
				}
			}
		}else{
			return view('web/signup',compact('free_delivery'));
		}
	}



	public function logout() {
		Auth::logout();
		return redirect('login');
	}



	public function signout() {
		Auth::logout();
		session()->forget('customer');
		return redirect('/');
	}


}