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

    public function exportContacts()
    {
        $contacts = Contact::query();
        

        $contacts = Contact::with("category")->get();
        $csvData = "ID,カテゴリー,姓,名,性別,メールアドレス,電話番号,住所,住所その他,問い合わせ内容,問い合わせ日\n";
        foreach ($contacts as $contact) {
            $csvData .= sprintf(
                "%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s\n",
                str_replace(",", " ", $contact->id),
                str_replace(",", " ", $contact->category->content),
                str_replace(",", " ", $contact->name_first),
                str_replace(",", " ", $contact->name_last),
                str_replace(",", " ", $contact->gender),
                str_replace(",", " ", $contact->email),
                str_replace(",", " ", $contact->tel),
                str_replace(",", " ", $contact->address),
                str_replace(",", " ", $contact->building),
                str_replace(",", " ", $contact->detail),
                str_replace(",", " ", $contact->created_at),
            );
        }

        $filename = "contacts_" . date("YmdHis") . ".csv";
        $headers = [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
        ];
        return response($csvData, 200, $headers)
            ->header("Content-Type", "text/csv")
            ->header("Content-Disposition", "attachment; filename=$filename");
    }

}
