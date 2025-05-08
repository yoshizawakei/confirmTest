<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/", [ContactController::class, "index"]);
Route::post("/confirm", [ContactController::class, "confirm"]);
Route::post("/contacts", [ContactController::class, "store"]);
Route::get("/contacts", [ContactController::class, "index"]);

Route::middleware("auth")->group(function () {
    Route::get("/admin", [AuthController::class, "index"]);
});
Route::post("/logout", [AuthController::class, "logout"]);
Route::get("/admin/search", [AuthController::class, "search"]);
Route::get("/admin/reset", [AuthController::class, "reset"]);
Route::post("/admin/contacts/{contact}/details", [AuthController::class, "showContactDetails"])->name("admin.contacts.details");
Route::delete("/delete", [AuthController::class, "destroy"]);
Route::get("/export", [AuthController::class, "exportContacts"]);