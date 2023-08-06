<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\ContactList;


class UserController extends Controller {



    public function getContactList(Request $request){

        // Fetch all the contact lists with their associated contacts
         $contactLists = ContactList::all();

        return response()->json([
            'status' => 'Success',
            'contact_lists' => $contactLists,
        ]);
    }


    public function createContact(Request $request) {

        $validator = Validator::make($request->all(), [
            'contact_name' => 'required|string|max:255',
            'contact_number' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 400);
        }
        

        $contact = new ContactList();

        $contact->user_id = 1;
        $contact->contact_name= $request->contact_name;
        $contact->contact_number = $request->contact_number;
        $contact->latitude = $request->latitude;
        $contact->longitude = $request->longitude;

        $contact->save();

        return response()->json([
            'status' => 'Success',
            'contact' => $contact
        ]);
    }

}




