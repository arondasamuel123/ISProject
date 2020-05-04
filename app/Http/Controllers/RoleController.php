<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Freelancer;
use App\Client;
use Illuminate\Support\Facades\Auth;
class RoleController extends Controller
{
    
    public function index() {

        return User::latest()->paginate(10);
    }


    public function login(Request $request) {

        //$user = User::where('email', $request->email)->first();
        
        $credentials = $request->only('email', 'password');
       

        

        if(Auth::attempt($credentials)) {
            $user = Auth::user();
             $id = $user->id;
             $freelancer = Freelancer::where('user_id', "=", $id)->first();
             $client = Client::where('user_id', "=", $id)->first();
             
             
            

         
            if (!$user->admin == 1) {
                if($freelancer ) {
                    if ($freelancer->status == 1) {
                        //$approved = true;
                        return redirect()->to('/fdashboard');
                    }else {
                    
                        return redirect()->to('/napproval');
                    }
                  
                }
                if($client) {
                    if($client->status == 1) {
                        return redirect()->to('/cdashboard');
                    }else {
                        return redirect()->to('/napproval');
                    }
                }
                else if(!$freelancer && $user->user_type == "Freelancer") {
                    return redirect()->to('/freelancer');
                }
                else if(!$client && $user->user_type == "Client") {
                    return redirect()->to('/client');
                } 
            }else {
                return redirect()->to('/home');
            }
            

            

            
         

            

        } else {
            return back()
            ->with('flash_message', 'The email or password is incorrect, please try again')
            ->with('flash_type', 'alert-danger');
        }
    }


    public function destroy($id) {
        $user = User::findOrFail($id);
        
        $user->delete();

        return ['message'=>'User Deleted'];
    }

}
