<?php

namespace App\Http\Controllers;

use Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\ContactUs;
use Illuminate\Support\Facades\Mail;

class ContactPageController extends Controller
{
    public function ContactUsEnqury(Request $request)
    {
        $inputs = Request::all(); 
        $validator = Validator::make($inputs, [
            'Name' => 'required',
            'Email' => 'required',
            'Subject' => 'required',            
            'Message' => 'required'      
        ]);
        if($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $contact = new ContactUs;
        $contact->personName = $inputs['Name'];
        $contact->personEmail = $inputs['Email'];
        $contact->personSubject = $inputs['Subject'];
        $contact->personMessage = $inputs['Message'];
        $contact->save();

        $siteName = getcong('siteName');
        $siteEmail = getcong('siteEmail');
        $data = array(
            'name'=>$contact->personName,
            'email'=>$contact->personEmail,
            'subject'=>$contact->personSubject,
            'Message'=>$contact->personMessage,
            'siteName'=>$siteName,
            'siteEmail'=>$siteEmail
        );

        Mail::send('emails.contact_us', $data, function ($message) use ($data) {
            $message->subject($data['subject']);
            $message->from($data['email'], $data['name']);
            $message->bcc('sudhirkundal007@gmail.com');          
            $message->to($data['siteEmail']);
        });

        return response()->json([
            'successMessage' => 'Your Message Sent Successfully.'
        ]);
    }
}
