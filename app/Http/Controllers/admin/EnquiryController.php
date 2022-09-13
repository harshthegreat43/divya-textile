<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\Models\Enquiry;

class EnquiryController extends Controller
{
    function index(){
		$enquiry = Enquiry::get();
		return view('admin/enquiry/index',compact('enquiry'));
	}

          
    
	function delete($id){
		$enquiry =  Enquiry::find($id);
		Enquiry::destroy($id);
		session()->flash('warning', 'Enquiry has been deleted');
		return redirect('admin/enquiry/');
	}
}