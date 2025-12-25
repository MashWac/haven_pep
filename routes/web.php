<?php

use App\Http\Controllers\admin\adminAuthorsController;
use App\Http\Controllers\admin\booksController as AdminBooksController;
use App\Http\Controllers\admin\courseController;
use App\Http\Controllers\admin\dashboardController;
use App\Http\Controllers\admin\myProfileController;
use App\Http\Controllers\admin\salesController;
use App\Http\Controllers\admin\SystemSettingsController;
use App\Http\Controllers\admin\usersController;
use App\Http\Controllers\auth\AuthenticationController;
use App\Http\Controllers\client\booksController;
use App\Http\Controllers\client\cartController;
use App\Http\Controllers\client\coursesController;
use App\Http\Controllers\client\instructorController;
use App\Http\Controllers\client\userController;
use Bryceandy\Laravel_Pesapal\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;
use Termwind\Components\Raw;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [instructorController::class, 'index']);

Route::get('/book_listings', [booksController::class, 'index']);
Route::get('/book_summary/{id}', [booksController::class, 'bookSummary']); 


Route::get('/courses', [coursesController::class, 'index']);
Route::get('/course_details/{id}',[coursesController::class,'courseDetails']);



Route::get('/login', [AuthenticationController::class, 'login']); 
Route::get('/register', [AuthenticationController::class, 'register']);
Route::post('/register_member', [AuthenticationController::class, 'registerUser']);
Route::post('/login_user', [AuthenticationController::class, 'loginUser']);
Route::get('/logout', [AuthenticationController::class, 'logoutUser']);
Route::get('/password_reset', [AuthenticationController::class, 'passwordReset']);
Route::post('/send_password_reset_link', [AuthenticationController::class, 'sendPasswordResetLink']);
Route::get('/password_reset_form/{token}', [AuthenticationController::class, 'passwordResetForm']);




Route::get('/my_profile', [userController::class, 'myProfile']);
Route::get('/orders/receipt/{id}', [userController::class, 'downloadReceipt']);
Route::get('/courses/continue/{id}',[userController::class, 'progressWithCourse']);
Route::post('/course/update_progress',[userController::class,'']);
Route::get('/course/get_video_url/{course_id}/{lesson_number}',[userController::class,'fetchVideoUrl']);
Route::get('/course/get_pptx_url/{course_id}/{lesson_number}',[userController::class,'fetchPptxUrl']);



Route::get('/cart', [CartController::class, 'index']);
Route::post('/cart/add', [CartController::class, 'add']);
Route::patch('/cart/update', [CartController::class, 'update']);
Route::post('/cart/remove', [CartController::class, 'remove']);


Route::post('/checkout', [cartController::class, 'Checkout']);

Route::post('pesapal/iframe',[PaymentController::class,'store'])->name('payment.store')->middleware('config');
Route::get('pesapal-ipn-listener',[ cartController::class,'paymentSuccess']);




Route::middleware(['admin_only'])->group(function () {


Route::get('/admin_dashboard', [dashboardController::class, 'index']);



Route::get('/admin_books', [AdminBooksController::class, 'index']);
Route::get('/admin_add_book', [AdminBooksController::class, 'addBook']);
Route::post('/insert_book', [AdminBooksController::class, 'insertBook']);
Route::get('/admin_book/edit/{id}', [AdminBooksController::class, 'editBook']);
Route::put('/admin_books/update/{id}', [AdminBooksController::class, 'updateBook']);
Route::delete('/admin_book/delete/{id}', [AdminBooksController::class, 'deleteBook']);

Route::get('/admin_book_categories', [AdminBooksController::class, 'bookCategories']);
Route::get('/add_book_category', [AdminBooksController::class, 'addBookCategories']);
Route::post('/insert_book_category', [AdminBooksController::class, 'insertBookCategory']);
Route::get('/admin_book_categories/edit/{id}', [AdminBooksController::class, 'editBookCategories']);
Route::put('/update_book_category/{id}', [AdminBooksController::class, 'updateBookCategory']);
Route::delete('/admin_book_categories/delete/{id}', [AdminBooksController::class, 'deleteBookCategory']);

Route::get('/admin_sales', [salesController::class, 'index']);
Route::get('admin_sales/details/{id}',[salesController::class,'saleDetails']);


Route::get('/admin_courses', [courseController::class, 'index']);
Route::get('/admin_add_course', [courseController::class, 'addCourse']);
Route::post('/insert_course', [courseController::class, 'insertCourse']);
Route::get('/admin_course/edit/{id}', [courseController::class, 'editCourse']);
Route::put('/admin_courses/update/{id}', [courseController::class, 'updateCourse']);
Route::delete('/admin_course/delete/{id}', [courseController::class, 'deleteCourse']);



Route::get('/admin_course_categories', [courseController::class, 'adminCourseCategories']);
Route::get('/add_course_category', [courseController::class, 'addCourseCategories']);
Route::post('/insert_course_category', [courseController::class, 'insertCourseCategory']);
Route::get('/admin_course_categories/edit/{id}', [courseController::class, 'editCourseCategories']);
Route::put('/update_course_category/{id}', [courseController::class, 'updateCourseCategory']);
Route::delete('/admin_course_categories/delete/{id}', [courseController::class, 'deleteCourseCategory']);

Route::get('/admin_users', [usersController::class, 'index']);

Route::get('/admin_profile', [myProfileController::class, 'index']);

Route::put('/update_instructor_profile/{id}', [myProfileController::class, 'update']);


Route::get('/admin_authors', [adminAuthorsController::class, 'index']);
Route::get('/admin_authors/create', [adminAuthorsController::class, 'addAuthor']);
Route::post('/insert_author', [adminAuthorsController::class, 'insertAuthor']);
Route::get('/admin_authors/edit/{id}', [adminAuthorsController::class, 'editAuthor']);
Route::put('/admin_authors/update/{id}', [adminAuthorsController::class, 'updateAuthor']);
Route::delete('/admin_authors/delete/{id}', [adminAuthorsController::class, 'deleteAuthor']);



Route::get('admin_settings',[SystemSettingsController::class,'index']);
Route::put('admin_settings/update',[SystemSettingsController::class,'update']);

});