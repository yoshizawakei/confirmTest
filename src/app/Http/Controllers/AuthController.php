<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Pagination\CursorPaginator;

class AuthController extends Controller
{
    public function index()
    {
        $contacts = Contact::with("category")->paginate(7);
        $categories = Category::all();
        return view("admin.index", compact("contacts", "categories"));
    }

    public function logout(Request $request)
    {
        auth()->logout();
        return redirect("/login");
    }

    public function search(Request $request)
    {
        $query = Contact::with("category");

        if ($request->filled("keyword")) {
            $query->keywordSearch($request->keyword);
        }
        if ($request->filled("inquiry_type")) {
            $query->CategorySearch($request->inquiry_type);
        }
        if ($request->filled("gender")) {
            $query->GenderSearch($request->gender);
        }
        if ($request->filled("search_date")) {
            $query->DateSearch($request->search_date);
        }

        $contacts = $query->paginate(7);
        $categories = Category::all();

        return view("admin.index", compact("contacts", "categories"));

    }

    public function reset(Request $request)
    {
        $contacts = Contact::with("category")->paginate(7);
        $categories = Category::all();
        return view("admin.index", compact("contacts", "categories"));
    }

    public function showContactDetails(Request $request, Contact $contact)
    {
        return view("admin.index", ["contacts" => Contact::with("category")->paginate(7), "categories" => Category::all()->toArray(), "model_contact" =>$contact]);
    }

    public function destroy(Request $request)
    {
        Contact::find($request->id)->delete();
        return redirect("/admin");
    }


}
