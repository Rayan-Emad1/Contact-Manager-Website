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
        $user = Auth::user();
    
        if (!$user->contact_list) {
            // If the user does not have a contact list, return an empty response or an error message.
            return response()->json([
                'status' => 'Error',
                'message' => 'User does not have a contact list.'
            ], 404);
        }
    
        $contactList = ContactList::find($user->contact_list);
    
        return response()->json([
            'status' => 'Success',
            'contact_list' => $contactList
        ]);
    }

    public function createContact(Request $request) {
        $validator = Validator::make($request->all(), [
            'contact_name' => 'required|string|max:255',
            'contact_number' => 'required|unique:contact_lists|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 400);
        }

        $user = Auth::user();
        $contact = new ContactList();
        
        $contact->user_id = $user->id;
        $contact->contact_name= $request->contact_name;
        $contact->contact_number = $request->contact_number;
        $contact->latitude = $request->latitude;
        $contact->longitude = $request->longitude;

        $contact->save($contact);

        return response()->json([
            'status' => 'Success',
            'contact' => $contact
        ]);
    }
}
