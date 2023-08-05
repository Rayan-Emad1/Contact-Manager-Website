<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\ContactList;

class UserController extends Controller
{

    // API to get or create the contact list for the user
    public function getOrCreateContactList(Request $request)
    {
        $user = Auth::user();

        if ($user->contact_list) {
            $contactList = ContactList::find($user->contact_list);
        } else {
            // If the user does not have a contact list, create a new one
            $contactList = new ContactList();
            $contactList->contact_name = $user->name;
            $contactList->contact_number = $user->phone_number;
            // You can set latitude and longitude here if available.
            $contactList->save();

            // Update the user with the contact_list foreign key
            $user->contact_list = $contactList->id;
            $user->save();
        }

        return response()->json([
            'status' => 'Success',
            'contact_list' => $contactList
        ]);
    }

    // API to create a new contact in the user's contact list
    public function createContact(Request $request)
    {
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

        // Check if the user already has a contact list
        if (!$user->contact_list) {
            // If not, create a new contact list for the user
            $contactList = new ContactList();
            $contactList->contact_name = $user->name;
            $contactList->contact_number = $user->phone_number;
            // You can set latitude and longitude here if available.
            $contactList->save();

            // Update the user with the contact_list foreign key
            $user->contact_list = $contactList->id;
            $user->save();
        } else {
            // If the user already has a contact list, retrieve it.
            $contactList = ContactList::find($user->contact_list);
        }

        // Create a new contact in the contact list
        $contact = new ContactList();
        $contact->contact_name = $request->contact_name;
        $contact->contact_number = $request->contact_number;
        // You can set latitude and longitude here if available.
        $contactList->contacts()->save($contact);

        return response()->json([
            'status' => 'Success',
            'contact' => $contact
        ]);
    }
}
