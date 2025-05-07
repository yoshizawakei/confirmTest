<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::with("category")->get();
        $categories = Category::all();
        return view('contacts.index', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $validated = $request->validated();
        $validated["tel"] = $validated["phone1"] . $validated["phone2"] .  $validated["phone3"];
        session(["validatedContact" => $validated]);
        $contactData = $validated;
        $categoryName = Category::find($contactData['category_id'])->content;
        return view('contacts.confirm', compact('contactData', 'categoryName'));
    }

    public function store(Request $request)
    {
        if ($request->input("action") === "send") {
            $validatedContact = session("validatedContact");
            if (!$validatedContact) {
                return redirect("contacts.index");
            }
            Contact::create($validatedContact);
            session()->forget("validatedContact");
            return view("contacts.thanks");
        } elseif($request->input("action") === "back") {
            $validatedContact = session("validatedContact");
            if (!$validatedContact) {
                return redirect("contacts.index");
            }
            $categories = Category::all();
            return view('contacts.index', compact('validatedContact', 'categories'));
        }
    }
}
