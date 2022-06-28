<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;

use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\SubUnderCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\GalleryCategoryController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\QuestionController;
use App\Http\Controllers\Front\PaymentController;

use App\Http\Controllers\Admin\PeopleController;
use App\Http\Controllers\Admin\SeoController;
use App\Http\Controllers\Admin\ChangePasswordController;
use App\Http\Controllers\Admin\ContactusController;
use App\Http\Controllers\Admin\AskQuestionController;
use App\Http\Controllers\Front\AppointmentController;
use App\Http\Controllers\Admin\OrderQuestionController;
use App\Http\Controllers\Front\IndexController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\EsewaController;
use App\Http\Controllers\EmailController;


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

Route::get('/admin/clear-cache', function() {
  
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
      Artisan::call('view:clear');
          session()->flash('success','Application Cache Clear Succesfully');
        return redirect()->back();
 
});

Route::get('/paypal',function(){
return view('paypal');
});


Route::get('/rece',function(){
  return view('admin.Receipt.reply_question');
  });
  

Auth::routes(['register' => false]);

  
Route::get('/payment-verify',[EsewaController::class,'verifyPayment'])->name('esewa.success');
Route::get('/payment-product',[EsewaController::class,'product_esewa']);




Route::post('/esewa-verify',[PaymentController::class,'esewa_payment']);


  
Route::get('send-mail', function () {
   
    $details = [
        'title' => 'Mail from ItSolutionStuff.com',
        'body' => 'This is for testing email using smtp'
    ];
   
    \Mail::to('devrajchy574@gmail.com')->send(new \App\Mail\FirstEmail($details));
   
    dd("Email is Sent.");
});


Route::post("/product-review", [EmailController::class, "review"]);

Route::get('/direct-paypal',[PaymentController::class,'payment_paypal']);
Route::get('/direct-payment/paypal/success',[PaymentController::class,'success_paypal'])->name('direct-payment.success.paypal');
Route::post('/direct-payment/paypal/cancel',[Paymentontroller::class,'cancel_paypal']);
 
Route::get('/paypal',[PaypalController::class,'payment_paypal'])->name('paypal');
Route::get('/payment/paypal/success',[PaypalController::class,'success_paypal'])->name('payment.success.paypal');
Route::post('/payment/paypal/cancel',[PaypalController::class,'cancel_paypal']);

Route::get('/payment',[PaypalController::class,'payment'])->name('payment');
Route::post('/cancel',[PaypalController::class,'cancel'])->name('payment.cancel');
Route::get('/payment/success',[PaypalController::class,'success'])->name('payment.success');
Route::get('/payment-verify',[EsewaController::class,'verifypayment']);





Route::get('/admin/orderproduct-pdf/{id}',[EmailController::class, 'orderproduct_pdf'])->name('orderproduct.pdf');

Route::get('/admin/questionorder-pdf/{id}',[EmailController::class,'questionorder_pdf'])->name('questionorder.pdf');

Route::get('/question-pdf', [EmailController::class, 'question_pdf'])->name('question.pdf');
Route::get('/generate-pdf', [EmailController::class, 'generatePDF'])->name('generate.pdf');
 Route::get('/checkout/payment_store',[CheckoutController::class,'payment_store'])->name('payment.store'); 
 Route::post('/checkout/delivery_store',[CheckoutController::class,'delivery_place'])->name('delivery.store');
 Route::get('/checkout/payment',[CheckoutController::class,'payment'])->name('payment.type');
 


 Route::get('/checkout/sucess_order',[CheckoutController::class,'success_order'])->name('success.order');
 Route::post('/checkout',[CheckoutController::class,'placeOrder'])->name('checkout.place.order');
 Route::get('/checkout/delivery',[CheckoutController::class,'delivery'])->name('delivery');
 Route::get('/user/dashboard',[IndexController::class,'user_dashboard'])->name('user.dashboard')->middleware('user_login');
 Route::post('/checkout/order',[CheckoutController::class,'placeOrder'])->name('checkout.place.order');
 Route::post('/checkout/order',[IndexController::class,'changePassword'])->name('user.password.change')->middleware('user_login');



 Route::post('/userupdate/{id}',[AppointmentController::class,'update_profile'])->name('user.update');
 Route::get('/checkout',[CheckoutController::class,'getCheckout'])->name('checkout.index');

// routes for admin and b2b
Route::middleware(['auth','is_admin','user_login'])->group(function () {
 
            Route::group(['prefix' => '/admin'], function () {
            Route::get('/', [HomeController::class, 'index'])->name('admin.dashboard');


            Route::get('/all/newsletter',[OrderController::class,'newsletter']);

            Route::delete('/delete/newsletter/{id}',[OrderController::class,'newsletter_destroy']);
      Route::delete('/delete/order/{id}',[OrderController::class,'cancel_order']);

            
            Route::get('/orderquestion/view/{id}',[OrderQuestionController::class,'view_order']);

              
            Route::get('/appointments/view/{id}',[AppointmentController::class,'view_appointment']);

              
            Route::get('/product/review/', [ProductController::class,'review']);
            Route::get('/order/question/delivery', [OrderQuestionController::class,'delivery']);
            Route::get('/product/pending/{id}', [OrderController::class, 'pending_product']);
            Route::get('/product/processing/{id}', [OrderController::class, 'process_product']);
            Route::get('/product/completed/{id}', [OrderController::class, 'completed_product']);
            Route::get('/product/cancel/{id}', [OrderController::class, 'cancel_product']);

  
              
            Route::get('/product/pending/view/{id}', [OrderController::class, 'view_pending_product']);
            Route::get('/product/processing/view/{id}', [OrderController::class, 'view_processing_product']);
            Route::get('/product/completed/view/{id}', [OrderController::class, 'view_completed_product']);
            Route::get('/product/cancel/view/{id}', [OrderController::class, 'view_cancel_product']);


            Route::get('/products/pending',[OrderController::class,'pending']);
            Route::get('/products/processing',[OrderController::class,'process']);
            Route::get('/products/completed',[OrderController::class,'completed']);
            Route::get('/products/cancel',[OrderController::class,'cancel']);



            Route::put('/ask_question/reply/{id}',[AskQuestionController::class,'reply_askquestion']);
         Route::get('/appointments',[AppointmentController::class,'index']);
         Route::get('/appointments/reply',[AppointmentController::class,'reply']);

            Route::get('/appo',[AppointmentController::class,'appointment_search']);
            Route::get('/change-password', [ChangePasswordController::class, 'index'])->name('change.password');
            Route::post('/change-password', [ChangePasswordController::class, 'store'])->name('change.password');
            Route::resource('/setting', SettingController::class);
            Route::get('/profile', [HomeController::class, 'show']);
            Route::get('/profilechange', [HomeController::class, 'changeprofile']);
            Route::put('/profile/update/{user}', [HomeController::class, 'updateprofile']);
                Route::post('/review/status/{id}', [ProductController::class, 'review_status']);
                 Route::get('/review/show/{id}', [ProductController::class, 'review_show']);
                 Route::get('/review/reply/{id}', [ProductController::class, 'review_reply']);
                   Route::delete('/review/delete/{id}', [ProductController::class, 'review_delete']);
            Route::post('/product/status/{id}',[ProductController::class, 'status']);
            Route::post('/subundercategory/status/{id}',[SubUnderCategoryController::class,'status']);
            Route::post('/subcategory/status/{id}', [SubCategoryController::class, 'status']);
            Route::post('/category/status/{id}', [CategoryController::class, 'status']);
            Route::post('/gallerycategory/status/{id}', [GalleryCategoryController::class, 'status']);
            Route::post('/blogcategory/status/{id}', [BlogCategoryController::class, 'status']);

            Route::post('/page/status/{id}', [PageController::class, 'status']);
            Route::post('/media/status/{id}', [MediaController::class, 'status']);
            Route::post('/blog/status/{id}', [BlogController::class, 'status']);
            Route::post('/people/status/{id}', [PeopleController::class, 'status']);
            Route::get('/subcategoryid/{catgeory_id}',[SubCategoryController::class,'category_id']);

           Route::get('/search_product',[ContactController::class,'searchproduct']);
           Route::get('/search/product',[ContactController::class,'search_product']);
           
           
             Route::get('/search/service_product',[ContactController::class,'service_product']);
             
               Route::get('/searchproduct',[ContactController::class,'search_variantproduct']);
           
             Route::get('/search_order',[ContactController::class,'search_order']);
            Route::get('/search_appo',[ContactController::class,'search_appo']);
            Route::get('/order',[ContactController::class,'order_question']);
            Route::get('/appo',[ContactController::class,'appo']);
            Route::resource('/page', PageController::class);
            Route::resource('/category',CategoryController::class);
            Route::resource('/subcategory',SubcategoryController::class);
            Route::resource('/subundercategory',SubUnderCategoryController::class);
            
            Route::resource('/productcategory',ProductCategoryController::class);
            Route::resource('/page', PageController::class);
            Route::resource('/product',ProductController::class);
            Route::resource('/categoryblog',CategoryBlogController::class);
                        
            Route::resource('/media', MediaController::class);
            Route::resource('/tag', TagController::class);
            Route::resource('/blog', BlogController::class);
            Route::resource('/people', PeopleController::class);
            Route::resource('/logistic', LogisticController::class);
            Route::resource('/contact', ContactController::class);
            Route::resource('roles', RoleController::class);
            Route::resource('users', UserController::class);
            Route::resource('permissions', PermissionController::class);
            Route::resource('/contactus', ContactusController::class);
            Route::resource('/seo', SeoController::class);
            Route::resource('/gallerycategory',GalleryCategoryController::class);
            Route::resource('/blogcategory',BlogCategoryController::class);
            Route::resource('/ask_question',AskQuestionController::class);
            Route::resource('/order_question',OrderQuestionController::class);
            Route::resource('/appointments',AppointmentController::class);
 

        
     
    });
    // end of route group for admin
    // start of auth user Route

  
    Route::get('/profile',[IndexController::class,'profile'])->name('user.profile');
    Route::post('/profile/update',[IndexController::class,'profileUpdate'])->name('user.profile.update');
    Route::post('/profile/password',[IndexController::class,'changePassword'])->name('user.profile.changePassword');
   
    // end of auth user route
});




        
    Route::get('/sendmail', [IndexController::class,'sendmail']);

//normal user routes
Route::group(['prefix' => '/'], function () {
    Auth::routes();
  

 Route::get('/cart/{id}/',[CartController::class,'add'])->name('addto.cart');
//   Route::get('/cartt/{id}/{quantity}/',[CartController::class,'add']);
 
 
 
    Route::get('/', [IndexController::class, 'index']);
 
    Route::get('/cart',[CartController::class,'index'])->name('cart');
    Route::get('/cart/destroy/{id}',[CartController::class,'destroy'])->name('remove.cart');
  
      Route::get('/change-qty/{product}',[CartController::class,'changeQty'])->name('change_qty');


       Route::get('/user/login',[LoginController::class,'user_login'])->name('user.login.form');
       Route::get('/user/register',[LoginController::class,'user_register'])->name('user.register.form');
       Route::post('/user/register',[GuestController::class,'user_register'])->name('user.register');
       Route::post('/user_login', [LoginController::class,'login'])->name('user.login');

        
  //google login//     
Route::get('/login/google/', [LoginController::class,'redirectToGoogle'])->name('login.google');

Route::get('/login/google/callback',[LoginController::class, 'handleGoogleCallback']);

//end google login//


  //facebook login//     
  Route::get('/login/facebook/', [LoginController::class, 'redirectToFacebook'])->name('login.facebook');
  Route::get('/login/facebook/callback', [LoginController::class, 'handleFacebookCallback']);
  //end facebook login//



Route::get('/sub_service/{sub_service}',[IndexController::class,'subservice_slug']);
   Route::get('/ask_question/order',[QuestionController::class,'order_question'])->name('order.question');
    Route::get('/askquestion/{catgeory_id}',[CartController::class,'question']);
    Route::get('/ask_question',[CartController::class,'ask_question'])->name('ask.question');
   Route::post('/ask_question',[QuestionController::class,'fillup_question'])->name('ask.question');
   Route::get('/ask_question/paynow',[QuestionController::class,'paynow'])->name('ask.question.paynow');
   Route::get('/ask_question/paynow/cash',[QuestionController::class,'pay_now'])->name('cash');

   

    Route::get('/search_singleorder/{search_date}/',[AppointmentController::class,'single_search']);

    Route::get('/search_order/{start_orderdate}/{end_orderdate}',[AppointmentController::class,'order_search']);
    
  Route::get('/single_appointment/{single_date}',[AppointmentController::class,'single_searchappo']);
    Route::get('/search_appointment/{start_date}/{end_date}',[AppointmentController::class,'appointment_search'])->name('appoinment.search');
    Route::get('/book_appointment',[IndexController::class,'book_appointment'])->name('book.appointment');
    Route::post('/appointment',[AppointmentController::class,'appointment'])->name('appointment');
     Route::post('/newsletter',[AppointmentController::class,'newsletter'])->name('newsletter.store');
 
    Route::post('/create', [IndexController::class, 'store']);
    Route::get('/search', [IndexController::class, 'search'])->name('search');
   
    Route::get('/about/{slug}', [IndexController::class, 'readabout'])->name('readabout');
    Route::get('/single-photo/{category_id}',[IndexController::class, 'singlephoto'])->name('single.photo');   
    
    Route::get('/{slug}', [IndexController::class, 'subservices'])->name('page.slug');
    Route::get('/blog/tags/{tag}', [IndexController::class,'tags'])->name('tags.group');
    Route::get('/{subchild_slug}', [IndexController::class, 'support'])->name('page.support');
    Route::get('/blog/{blogslug}', [IndexController::class,'blog_detail'])->name('blog.detail');
    Route::get('/blog/category/{id}',[IndexController::class,'categorydetail'])->name('category.slug');
    Route::get('/product/category/{slug}',[IndexController::class,'product_category'])->name('product.category');

 Route::get('/product/search',[IndexController::class,'search_product'])->name('search_product');
     

Route::get('/product/{slug}',[IndexController::class,'product_slug'])->name('product.slug');

Route::get('/{name}/{slug}',[IndexController::class,'subcat_slug'])->name('sub.slug');

Route::get('/{name}/{slug}/{subundercat_slug}',[IndexController::class,'subundercat_slug'])->name('subundercat.slug');





});





