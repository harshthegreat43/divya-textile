<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Email;

class EmailController extends Controller
{
    function index(){
        $email = Email::get();
        return view('admin/email/index',compact('email'));
    }

          
    
	function delete($id){
		$email =  Email::find($id);
		$image_path = 'public/email_img/'.$email->image;
		File::delete($image_path);
		Email::destroy($id);
		session()->flash('warning', 'Email has been deleted');
		return redirect('admin/email/');
    }


    
	function status($id,$status){
		$email =  Email::find($id); 
		if($status=='N'){
			$email->status='N';
		}elseif($status=='Y'){
			$email->status='Y';
		}
		$result = $email->save();
		if($result){
    $email = Email::find($id);
    if($email->status=='Y'){
      session()->flash('success', 'Email status has been activated');
      return redirect('admin/email/');
    }
    elseif($email->status=='N'){
      session()->flash('error', 'Email status has been deactivated');
      return redirect('admin/email/');
    }else{

    }
		}
	}
}
