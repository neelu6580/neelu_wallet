<?php

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

//Fund account IPN
Route::get('lang/{locale}', 'LocalizationController@index');
Route::get('ipncoinpaybtc', 'PaymentController@ipnCoinPayBtc')->name('ipn.coinPay.btc');
Route::get('ipncoinpayeth', 'PaymentController@ipnCoinPayEth')->name('ipn.coinPay.eth');
Route::post('ext_transfer', 'UserController@submitpay')->name('submit.pay');
Route::get('single-charge/{id}', 'UserController@scviewlink')->name('scview.link');
Route::get('donation/{id}', 'UserController@dpviewlink')->name('dpview.link');
Route::post('pay-single', 'UserController@Sendsingle')->name('send.single');
Route::post('vcard-single-pay', 'UserController@vCardSendsingle')->name('send.vcard.single');
Route::post('pay-donation', 'UserController@Senddonation')->name('send.donation');
Route::get('subscription/{id}', 'UserController@subviewlink')->name('subview.link');
Route::post('plan_charge', 'UserController@submitplancharge')->name('submit.plancharge');
Route::get('invoice/{id}', 'UserController@Viewinvoice')->name('view.invoice');
Route::post('pay-invoice', 'UserController@Processinvoice')->name('process.invoice');
Route::get('xpay/{id}/{xx}', 'UserController@transferprocess')->name('transfer.process');
Route::post('submit_merchant', 'UserController@Paymerchant')->name('pay.merchant');
Route::get('buy-product/{id}', 'UserController@buyproduct')->name('product.link');
Route::post('buyproduct', 'UserController@acquireproduct')->name('pay.product');
Route::get('error', 'UserController@transfererror')->name('transfererror');
Route::get('vcard-single-charge/{id}', 'TransferController@scviewlink')->name('vcard-single-charge');


Route::get('/easy_track/{id}', 'UserController@easy_track')->name('easy_track');

// Front end routes
Route::get('/', 'FrontendController@index')->name('home');
Route::get('/faq', 'FrontendController@faq')->name('faq');
Route::get('/about', 'FrontendController@about')->name('about');
Route::get('/blog', 'FrontendController@blog')->name('blog');
Route::get('/terms', 'FrontendController@terms')->name('terms');
Route::get('/privacy', 'FrontendController@privacy')->name('privacy');
Route::get('/page/{id}', 'FrontendController@page');
Route::get('/single/{id}/{slug}', 'FrontendController@article');
Route::get('/cat/{id}/{slug}', 'FrontendController@category');
Route::get('/contact', 'FrontendController@contact')->name('contact');
Route::post('/contact', ['uses' => 'FrontendController@contactSubmit', 'as' => 'contact-submit']);
Route::post('/about', 'FrontendController@subscribe')->name('subscribe');

// 3-11-2020 static webpages
Route::get('/facebook', 'FrontendController@facebook');
Route::get('/productpaymentform', 'FrontendController@productpaymentform');
Route::get('/chatapps', 'FrontendController@chatapps');
Route::get('/instagram', 'FrontendController@instagram');
Route::get('/webplugin', 'FrontendController@webplugin');
Route::get('/paymenturl', 'FrontendController@paymenturl');
Route::get('/ecomsolution', 'FrontendController@ecomsolution');
Route::get('/costing', 'FrontendController@costing');
Route::get('/security', 'FrontendController@security');
// 3-11-2020 static webpages

// User routes
Auth::routes();

Route::post('login', 'Auth\LoginController@submitlogin')->name('submitlogin');

// 9-11-2020
Route::post('loginphone', 'Auth\LoginController@submitloginphone')->name('submitloginphone');
// 9-11-2022

Route::get('login', 'Auth\LoginController@login')->name('login');
Route::post('2fa', 'Auth\faController@submitfa')->name('submitfa');
Route::get('2fa', 'Auth\faController@faverify')->name('2fa');
Route::post('register', 'Auth\RegisterController@submitregister')->name('submitregister');
Route::get('register', 'Auth\RegisterController@register')->name('register');
Route::get('/forget', 'UserController@forget')->name('forget');
Route::get('/r_pass', 'UserController@r_pass')->name('r_pass');
Route::group(['prefix' => 'user', ], function () {
    Route::get('authorization', 'UserController@authCheck')->name('user.authorization');   
    Route::post('verification', 'UserController@sendVcode')->name('user.send-vcode');
    Route::post('smsVerify', 'UserController@smsVerify')->name('user.sms-verify');
    Route::get('verify-email', 'UserController@sendEmailVcode')->name('user.send-emailVcode');
    Route::post('postEmailVerify', 'UserController@postEmailVerify')->name('user.email-verify'); 
     Route::post('postMobileVerify', 'UserController@postMobileVerify')->name('user.mobile-verify'); 
        Route::group(['middleware'=>'auth:user'], function() {
            Route::middleware(['CheckStatus', 'Tfa'])->group(function () {
                Route::middleware(['Banks'])->group(function () {
                    Route::post('card', 'UserController@card')->name('card');
                    Route::post('crypto', 'UserController@crypto')->name('crypto');
                    Route::get('dashboard', 'UserController@dashboard')->name('user.dashboard');
                    Route::get('single-charge', 'UserController@transactionssc')->name('user.transactionssc');
                    Route::get('donation', 'UserController@transactionsd')->name('user.transactionsd');
                    Route::get('invoice-log', 'UserController@invoicelog')->name('user.invoicelog');
                    Route::get('deposit-log', 'UserController@depositlog')->name('user.depositlog');
                    Route::get('bank-transfer', 'UserController@banktransfer')->name('user.banktransfer');
                    Route::get('charges', 'UserController@charges')->name('user.charges');
                    Route::post('withdraw-update', 'UserController@withdrawupdate');
                    Route::get('profile', 'UserController@profile')->name('user.profile');
                    
                    Route::get('vcard_form', 'UserController@VcardForm')->name('user.vcard_form');
                    Route::post('vcard_profile', 'UserController@VcardProfile')->name('user.vcard_profile');
                    Route::get('vcard_list', 'UserController@VcardList')->name('user.vcard_list');
                    Route::get('vcard_editprofile/{id}', 'UserController@VcardEditProfile')->name('user.vcard_editprofile');
                    Route::post('vcard_update', 'UserController@VcardUpdate')->name('user.vcard_update');
                    Route::get('vcard_delete/{id}', 'UserController@VcardDelete')->name('user.vcard_delete');
                    Route::get('register_form', 'NewController@RegisterForm')->name('user.register_form');
                    Route::post('signup', 'NewController@RegisterFormDetails')->name('user.signup');
                    


                    Route::post('kyc', 'UserController@kyc');
                    Route::post('account', 'UserController@account');
                    Route::post('social', 'UserController@social')->name('user.social');
                    Route::post('avatar', 'UserController@avatar');
                    Route::post('delaccount', 'UserController@delaccount')->name('delaccount');
                    Route::get('deposit-verify/{id}', 'UserController@userDataUpdate')->name('deposit.verify');
                    Route::post('standverify', 'UserController@standverify');
                    
                    Route::get('upgrade', 'UserController@upgrade')->name('user.upgrade');
                    
                    //Products
                        Route::get('product', 'UserController@product')->name('user.product');
                        Route::get('list', 'UserController@list')->name('user.list');
                        Route::post('add-product', 'UserController@submitproduct')->name('submit.product');
                        Route::get('edit-product/{id}', 'UserController@Editproduct')->name('edit.product');
                        Route::get('orders/{id}', 'UserController@orders')->name('orders');
                        Route::post('description_update', 'UserController@Descriptionupdate')->name('product.description.submit');
                        Route::post('feature_update', 'UserController@Featureupdate')->name('product.feature.submit');
                        Route::post('add-product-image', 'UserController@submitproductimage')->name('submit.product.image');
                        Route::get('delete-product-image/{id}', 'UserController@deleteproductimage')->name('delete.product.image');
                        Route::get('delete-product/{id}', 'UserController@Destroyproduct')->name('delete.product');
                    //End

                    //Merchant
                        Route::get('merchant', 'UserController@merchant')->name('user.merchant');
                        Route::get('sender_log', 'UserController@senderlog')->name('user.senderlog');
                        Route::get('add-merchant', 'UserController@addmerchant')->name('user.add-merchant');
                        Route::get('merchant-documentation', 'UserController@merchant_documentation')->name('user.merchant-documentation');
                        Route::post('add-merchant', 'UserController@submitmerchant')->name('submit.merchant');
                        Route::get('edit-merchant/{id}', 'UserController@Editmerchant')->name('edit.merchant');
                        Route::get('log-merchant/{id}', 'UserController@Logmerchant')->name('log.merchant');
                        Route::get('delete-merchant/{id}', 'UserController@Destroymerchant')->name('delete.merchant');
                        Route::get('cancel_merchant/{id}', 'UserController@Cancelmerchant')->name('cancel.merchant');
                        Route::post('editmerchant', 'UserController@updatemerchant')->name('update.merchant');
                    //End                
                    
                    //Invoice
                        Route::get('invoice', 'UserController@invoice')->name('user.invoice');
                        Route::get('preview-invoice/{id}', 'UserController@previewinvoice')->name('preview.invoice');
                        Route::get('add-invoice', 'UserController@addinvoice')->name('user.add-invoice');
                        Route::post('add-invoice', 'UserController@submitinvoice')->name('submit.invoice');
                        Route::post('add-preview', 'UserController@submitpreview')->name('submit.preview');
                        Route::get('edit-invoice/{id}', 'UserController@Editinvoice')->name('edit.invoice');
                        Route::get('delete-invoice/{id}', 'UserController@Destroyinvoice')->name('delete.invoice');
                        Route::get('submit_invoice/{id}', 'UserController@Payinvoice')->name('pay.invoice');
                        Route::get('reminder/{id}', 'UserController@Reminderinvoice')->name('reminder.invoice');
                        Route::get('paid/{id}', 'UserController@Paidinvoice')->name('paid.invoice');
                        Route::post('editinvoice', 'UserController@updateinvoice')->name('update.invoice');
                    //End
                    
                    //VIRTUAL CARD
                        Route::get('virtualcard', 'VirtualCardController@virtualcard')->name('user.virtualcard');
                        Route::get('virtualtransactions/{id}', 'VirtualCardController@virtualtransactions')->name('user.virtualtransactions');
                        Route::get('virtual_card/{id}', 'VirtualCardController@getCardsList')->name('user.virtual_card');
                        Route::post('create_new', 'VirtualCardController@createCard')->name('user.create_new');
                        Route::post('update_virtual_card', 'VirtualCardController@updateVirtualCard')->name('user.update_virtual_card');
                        Route::post('pause_virtual_card','VirtualCardController@pausedVirtualCard')->name('user.pause_virtual_card');
                        Route::post('close_virtual_card','VirtualCardController@closeVirtualCard')->name('user.close_virtual_card');
                        Route::post('open_virtual_card','VirtualCardController@openVirtualCard')->name('user.open_virtual_card');
                        Route::post('check_wallet_balance','VirtualCardController@checkWalletBalance')->name('user.check_wallet_balance');
                        
                    //INSTANT ISSUE    
                        Route::get('instant_issue', 'VirtualCardController@instantIssue')->name('user.instant_issue');
                         Route::get('instant_issue_designs/{id}', 'VirtualCardController@instantIssueDesigns')->name('user.instant_issue_designs');
                         Route::get('select_plan/{id}/{id1}', 'VirtualCardController@selectVcardPlan')->name('user.select_plan');
                         Route::get('complete_order/{id}/{id1}/{id2}', 'VirtualCardController@completeOrder')->name('user.complete_order');
                         Route::get('vcard_orders', 'VirtualCardController@vCardOrders')->name('user.vcard_orders');
                        
                    //Dashboard 
                    Route::get('newdashboard', 'VirtualCardController@newdashboard')->name('user.newdashboard');
                    //End
                     
                    //Bank
                        Route::get('bank', 'UserController@bank')->name('user.bank');
                        Route::post('add_bank', 'UserController@Createbank');
                        Route::post('edit_bank', 'UserController@Updatebank');
                        Route::get('bank/delete/{id}', 'UserController@Destroybank')->name('bank.delete');
                        Route::get('bank/default/{id}', 'UserController@Defaultbank')->name('bank.default');
                    //End

                    //Send money
                        Route::get('transfer', 'UserController@ownbank')->name('user.ownbank');
                        Route::post('transfer', 'UserController@submitownbank')->name('submit.ownbank');
                        Route::post('local_preview', 'UserController@submitlocalpreview')->name('submit.localpreview');
                        Route::get('local_preview', 'UserController@localpreview')->name('user.localpreview');
                        Route::get('send_money/{id}', 'UserController@Sendpay')->name('send.pay');
                        Route::get('received/{id}', 'UserController@Receivedpay')->name('received.pay');
                    //End

                    //Request money
                        Route::get('request', 'UserController@request')->name('user.request');
                        Route::post('request', 'UserController@submitrequest')->name('submit.request');
                    //End                
                    
                    //Payment link
                        Route::get('sc-links', 'UserController@sclinks')->name('user.sclinks');
                        Route::get('sc-links/{id}', 'UserController@sclinkstrans')->name('user.sclinkstrans');
                        Route::get('unsclinks/{id}', 'UserController@unsclinks')->name('sclinks.unpublish');
                        Route::get('psclinks/{id}', 'UserController@psclinks')->name('sclinks.publish'); 
                        Route::post('editsclinks', 'UserController@updatesclinks')->name('update.sclinks');
                        Route::get('dp-links', 'UserController@dplinks')->name('user.dplinks');
                        Route::get('dp-links/{id}', 'UserController@dplinkstrans')->name('user.dplinkstrans');
                        Route::get('undplinks/{id}', 'UserController@undplinks')->name('dplinks.unpublish');
                        Route::get('pdplinks/{id}', 'UserController@pdplinks')->name('dplinks.publish'); 
                        Route::post('editdplinks', 'UserController@updatedplinks')->name('update.dplinks');
                        Route::post('single_charge', 'UserController@submitsinglecharge')->name('submit.singlecharge');
                        Route::post('donation_page', 'UserController@submitdonationpage')->name('submit.donationpage');
                        Route::get('delete-link/{id}', 'UserController@Destroylink')->name('delete.user.link');
                        Route::post('donation', 'UserController@submitdonation')->name('submit.donation');
                    //End

                    //Plans
                        Route::get('plan', 'UserController@plans')->name('user.plan');
                        Route::get('unplan/{id}', 'UserController@unplan')->name('plan.unpublish');
                        Route::get('pplan/{id}', 'UserController@pplan')->name('plan.publish');
                        Route::post('plan', 'UserController@submitplan')->name('submit.plan');
                        Route::post('updateplan', 'UserController@updateplan')->name('update.plan');
                        Route::get('plan-sub/{id}', 'UserController@plansub')->name('user.plansub');
                        Route::get('subs', 'UserController@subscriptions')->name('user.sub');
                    //End


                    Route::get('ticket', 'UserController@ticket')->name('user.ticket');
                    Route::get('open-ticket', 'UserController@openticket')->name('open.ticket');
                    Route::post('submit-ticket', 'UserController@submitticket')->name('submit-ticket');
                    Route::get('ticket/delete/{id}', 'UserController@Destroyticket')->name('ticket.delete');
                    Route::get('reply-ticket/{id}', 'UserController@Replyticket')->name('ticket.reply');
                    Route::post('reply-ticket', 'UserController@submitreply');
                    Route::get('fund', 'UserController@fund')->name('user.fund');
                    Route::get('preview', 'UserController@depositpreview')->name('user.preview');
                    Route::post('fund', 'UserController@fundsubmit')->name('fund.submit');
                    Route::get('bank_transfer', 'UserController@bank_transfer')->name('user.bank_transfer');
                    Route::post('bank_transfer', 'UserController@bank_transfersubmit')->name('bank_transfersubmit');
                    Route::get('withdraw', 'UserController@withdraw')->name('user.withdraw');
                    Route::post('withdraw', 'UserController@withdrawsubmit')->name('withdraw.submit');
                    Route::post('password', 'UserController@submitPassword')->name('change.password');
                    Route::get('deposit-confirm', 'PaymentController@depositConfirm')->name('deposit.confirm');
                    Route::post('2fa', 'UserController@submit2fa')->name('change.2fa');
                    Route::get('audit', 'UserController@audit')->name('user.audit');
                });
                Route::post('add_bank', 'UserController@Createbank')->name('add.bank');
                Route::get('no-bank', 'UserController@nobank')->name('user.nobank');
                
               
    
            });
        });
    Route::get('logout', 'UserController@logout')->name('user.logout');
});

Route::get('check_sms_by_firebase', 'UserController@getTokenByFirebase')->name('check_sms_by_firebase');
Route::post('check_usermobile', 'User\ResetPasswordController@checkUserMobile')->name('check_usermobile');
Route::get('user-password/reset-byphone', 'User\ResetPasswordController@resetbyPhone')->name('user.password.reset-byphone');
Route::get('user-password/reset', 'User\ForgotPasswordController@showLinkRequestForm')->name('user.password.request');
Route::post('user-password/email', 'User\ForgotPasswordController@sendResetLinkEmail')->name('user.password.email');
Route::get('user-password/reset/{token}', 'User\ResetPasswordController@showResetForm')->name('user.password.reset');
Route::post('user-password/reset', 'User\ResetPasswordController@reset');
Route::get('admin', 'Auth\AdminController@adminlogin')->name('admin.loginForm');
Route::post('admin', 'Auth\AdminController@submitadminlogin')->name('admin.login');

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
    Route::get('/logout', 'AdminController@logout')->name('admin.logout');
    Route::get('/dashboard', 'AdminController@dashboard')->name('admin.dashboard');
    //VIRTUAL CARDS
    Route::get('/virtual_cards', 'AdminController@virtualCards')->name('admin.virtual_cards');
    Route::get('/virtual_cards_transactions', 'AdminController@virtualtransactions')->name('admin.virtual_cards_transactions');
    Route::post('pause_virtual_card','AdminController@pausedVirtualCard')->name('admin.pause_virtual_card');
    Route::post('close_virtual_card','AdminController@closeVirtualCard')->name('admin.close_virtual_card');
    Route::post('open_virtual_card','AdminController@openVirtualCard')->name('admin.open_virtual_card');
    Route::get('delete_virtual_card/{id}','AdminController@deleteVirtualCard')->name('admin.delete_virtual_card');
    Route::get('list_virtual_card','VirtualCardController@getVirtualCardsList')->name('admin.delete_virtual_card');
    Route::get('virtualtransactions/{id}', 'AdminController@virtualtransactions')->name('admin.virtualtransactions');
    Route::get('vcard_orders', 'AdminController@vCardOrders')->name('admin.vcard_orders');

    Route::post('edit_virtual_card','AdminController@editVirtualCard')->name('admin.edit_virtual_card');
    
    //VIRTUAL CARDS SUBSCRIPTION PLAN
    Route::get('/subscription_list', 'AdminController@virtualCardSubscriptionList')->name('admin.subscription_list');
    Route::post('add_virtual_card_subsription','AdminController@addVirtualCardSubsription')->name('admin.add_virtual_card_subsription');
    Route::post('edit_virtual_card_subsription','AdminController@editVirtualCardSubsription')->name('admin.edit_virtual_card_subsription');
    Route::get('delete_virtual_card_plan/{id}','AdminController@deleteVirtualCardPlan')->name('admin.delete_virtual_card_plan');
    
    Route::get('/card_type_list', 'AdminController@cardTypeList')->name('admin.card_type_list');
    Route::post('add_virtual_card_type','AdminController@addVirtualCardType')->name('admin.add_virtual_card_type');
    Route::post('edit_virtual_card_type','AdminController@editVirtualCardType')->name('admin.edit_virtual_card_type');
    Route::get('delete_virtual_card_type/{id}','AdminController@deleteVirtualCardType')->name('admin.delete_virtual_card_type');
    
    Route::get('/card_design_list', 'AdminController@cardDesignList')->name('admin.card_design_list');
    Route::post('add_virtual_card_design','AdminController@addVirtualCardDesign')->name('admin.add_virtual_card_design');
    Route::post('edit_virtual_card_design','AdminController@editVirtualCardDesign')->name('admin.edit_virtual_card_design');
    Route::get('delete_virtual_card_design/{id}','AdminController@deleteVirtualCardDesign')->name('admin.delete_virtual_card_design');
    
    
    

    
    //Easypost Carrier Module
    Route::get('carriers', 'AdminController@carriers')->name('admin.carriers');
    Route::get('carriers/edit/{courierId}', 'AdminController@carriersEdit')->name('admin.carriers.edit');
    Route::post('carriers/update/{courierId}', 'AdminController@carriersUpdate')->name('admin.carriers.update');
    
    //Blog controller
    Route::post('/createcategory', 'PostController@CreateCategory');
    Route::post('/updatecategory', 'PostController@UpdateCategory');
    Route::get('/post-category', 'PostController@category')->name('admin.cat');
    Route::get('/unblog/{id}', 'PostController@unblog')->name('blog.unpublish');
    Route::get('/pblog/{id}', 'PostController@pblog')->name('blog.publish');
    Route::get('blog', 'PostController@index')->name('admin.blog');
    Route::get('blog/create', 'PostController@create')->name('blog.create');
    Route::post('blog/create', 'PostController@store')->name('blog.store');
    Route::get('blog/delete/{id}', 'PostController@destroy')->name('blog.delete');
    Route::get('category/delete/{id}', 'PostController@delcategory')->name('blog.delcategory');
    Route::get('blog/edit/{id}', 'PostController@edit')->name('blog.edit');
    Route::post('blog-update', 'PostController@updatePost')->name('blog.update');

    //Web controller
    Route::post('social-links/update', 'WebController@UpdateSocial')->name('social-links.update');
    Route::get('social-links', 'WebController@sociallinks')->name('social-links'); 

    Route::post('about-us/update', 'WebController@UpdateAbout')->name('about-us.update');
    Route::get('about-us', 'WebController@aboutus')->name('about-us'); 

    Route::post('privacy-policy/update', 'WebController@UpdatePrivacy')->name('privacy-policy.update');
    Route::get('privacy-policy', 'WebController@privacypolicy')->name('privacy-policy');

    Route::post('terms/update', 'WebController@UpdateTerms')->name('terms.update');
    Route::get('terms', 'WebController@terms')->name('admin.terms'); 

    Route::post('/createfaq', 'WebController@CreateFaq');   
    Route::post('faq/update', 'WebController@UpdateFaq')->name('faq.update');
    Route::get('faq/delete/{id}', 'WebController@DestroyFaq')->name('faq.delete');
    Route::get('faq', 'WebController@faq')->name('admin.faq');   
    
    Route::post('/createservice', 'WebController@CreateService');   
    Route::post('service/update', 'WebController@UpdateService')->name('service.update');
    Route::get('service/edit/{id}', 'WebController@EditService')->name('brand.edit');
    Route::get('service/delete/{id}', 'WebController@DestroyService')->name('service.delete');
    Route::get('service', 'WebController@services')->name('admin.service'); 
    
    Route::post('/createpage', 'WebController@CreatePage');
    // 3-11-2020
    Route::get('page/add', 'WebController@addPage')->name('page.add');
    Route::get('page/edit/{id}', 'WebController@editPage')->name('page.edit');
    // 3-11-2020
    Route::post('page/update', 'WebController@UpdatePage')->name('page.update');
    Route::get('page/delete/{id}', 'WebController@DestroyPage')->name('page.delete');
    Route::get('page', 'WebController@page')->name('admin.page'); 
    Route::get('/unpage/{id}', 'WebController@unpage')->name('page.unpublish');
    Route::get('/ppage/{id}', 'WebController@ppage')->name('page.publish');    
    
    Route::post('/createreview', 'WebController@CreateReview');   
    Route::post('review/update', 'WebController@UpdateReview')->name('review.update');
    Route::get('review/edit/{id}', 'WebController@EditReview')->name('review.edit');
    Route::get('review/delete/{id}', 'WebController@DestroyReview')->name('review.delete');
    Route::get('review', 'WebController@review')->name('admin.review'); 
    Route::get('/unreview/{id}', 'WebController@unreview')->name('review.unpublish');
    Route::get('/preview/{id}', 'WebController@preview')->name('review.publish');    
    
    Route::post('/createbrand', 'WebController@CreateBrand');   
    Route::post('brand/update', 'WebController@UpdateBrand')->name('brand.update');
    Route::get('brand/edit/{id}', 'WebController@EditBrand')->name('brand.edit');
    Route::get('brand/delete/{id}', 'WebController@DestroyBrand')->name('brand.delete');
    Route::get('brand', 'WebController@brand')->name('admin.brand'); 
    Route::get('/unbrand/{id}', 'WebController@unbrand')->name('brand.unpublish');
    Route::get('/pbrand/{id}', 'WebController@pbrand')->name('brand.publish');
    
    Route::post('createbranch', 'WebController@CreateBranch');   
    Route::post('branch/update', 'WebController@UpdateBranch')->name('branch.update');
    Route::get('branch/delete/{id}', 'WebController@DestroyBranch')->name('branch.delete');
    Route::get('branch', 'WebController@branch')->name('admin.branch');

    Route::get('currency', 'WebController@currency')->name('admin.currency');
    Route::get('pcurrency/{id}', 'WebController@pcurrency')->name('change.currency'); 
    
    Route::get('logo', 'WebController@logo')->name('admin.logo');
    Route::post('light-logo', 'WebController@light')->name('light.logo');
    Route::post('dark-logo', 'WebController@dark')->name('dark.logo');
    Route::post('updatefavicon', 'WebController@UpdateFavicon');

    Route::get('home-page', 'WebController@homepage')->name('homepage');   
    Route::post('home-page/update', 'WebController@Updatehomepage')->name('homepage.update');
    Route::post('section1/update', 'WebController@section1');
    Route::post('section2/update', 'WebController@section2');
    Route::post('section3/update', 'WebController@section3');
    Route::post('section7/update', 'WebController@section7');
    Route::post('settlement', 'SettingController@SettlementUpdate')->name('admin.settlement.update'); 

    //Withdrawal controller
    Route::get('withdraw-log', 'WithdrawController@log')->name('admin.withdraw.log');
    Route::get('withdraw/delete/{id}', 'WithdrawController@delte')->name('withdraw.delete');
    Route::get('approvewithdraw/{id}', 'WithdrawController@approve')->name('withdraw.approve');
    Route::get('declinewithdraw/{id}', 'WithdrawController@decline')->name('withdraw.decline');   
    
    //Deposit controller
    Route::get('bank-transfer', 'DepositController@banktransfer')->name('admin.banktransfer');
    Route::get('bank_transfer/delete/{id}', 'DepositController@DestroyTransfer')->name('banktransfer.delete');
    Route::post('bankdetails', 'DepositController@bankdetails');
    Route::get('deposit-log', 'DepositController@depositlog')->name('admin.deposit.log');
    Route::get('deposit-method', 'DepositController@depositmethod')->name('admin.deposit.method');
    Route::post('storegateway', 'DepositController@store');
    Route::get('approvebk/{id}', 'DepositController@approvebk')->name('deposit.approvebk');
    Route::get('declinebk/{id}', 'DepositController@declinebk')->name('deposit.declinebk');
    Route::get('deposit/delete/{id}', 'DepositController@DestroyDeposit')->name('deposit.delete');
    Route::get('approvedeposit/{id}', 'DepositController@approve')->name('deposit.approve');
    Route::get('declinedeposit/{id}', 'DepositController@decline')->name('deposit.decline');

    //Setting controller
    Route::get('settings', 'SettingController@Settings')->name('admin.setting');
    Route::post('settings', 'SettingController@SettingsUpdate')->name('admin.settings.update');      
    Route::post('charges', 'SettingController@charges')->name('admin.charges.update');      
    Route::post('features', 'SettingController@features')->name('admin.features.update');      
    Route::post('account', 'SettingController@AccountUpdate')->name('admin.account.update');
    Route::get('charges', 'TransferController@charges')->name('admin.charges');
    Route::get('sc-links', 'TransferController@sclinks')->name('admin.sclinks');
    Route::get('vcard-sc-links', 'TransferController@vcardSClinks')->name('admin.vcardsclinks');
    Route::get('dp-links', 'TransferController@dplinks')->name('admin.dplinks');
    Route::get('delete-link/{id}', 'TransferController@Destroylink')->name('delete.link');
    Route::get('unlinks/{id}', 'TransferController@unlinks')->name('links.unpublish');
    Route::get('plinks/{id}', 'TransferController@plinks')->name('links.publish');
    Route::get('links/{id}', 'TransferController@linkstrans')->name('admin.linkstrans'); 
    Route::post('vcard_single_charge', 'TransferController@addPaymentLink')->name('admin.vcard_single_charge');
    Route::post('vcard_single_charge_edit', 'TransferController@editPaymentLink')->name('admin.vcard_single_charge_edit');
    Route::get('delete_virtual_card_paylink/{id}', 'TransferController@deletePaymentLink')->name('admin.delete_virtual_card_paylink');


    //Transfer controller
    Route::get('transfer', 'TransferController@Ownbank')->name('admin.ownbank');  
    Route::get('transfer/delete/{id}', 'TransferController@Destroyownbank')->name('transfer.delete');    
    
    //Request Money controller
    Route::get('request', 'TransferController@Requestmoney')->name('admin.request');  
    Route::get('request/delete/{id}', 'TransferController@Destroyrequest')->name('request.delete');     
    
    //Invoice controller
    Route::get('invoice', 'TransferController@invoice')->name('admin.invoice');  
    Route::get('invoice/delete/{id}', 'TransferController@Destroyinvoice')->name('invoice.delete');      
    
    Route::get('product', 'TransferController@product')->name('admin.product');  
    Route::get('product/delete/{id}', 'TransferController@Destroyproduct')->name('product.delete'); 
    Route::get('unproduct/{id}', 'TransferController@unproduct')->name('product.unpublish');
    Route::get('pproduct/{id}', 'TransferController@pproduct')->name('product.publish');    
    Route::get('orders/{id}', 'TransferController@orders')->name('admin.orders');  
    
    Route::get('plan', 'TransferController@plans')->name('admin.plan');
    Route::get('plan-sub/{id}', 'TransferController@plansub')->name('admin.plansub');
    Route::get('unplan/{id}', 'TransferController@unplan')->name('plan.unpublish');
    Route::get('pplan/{id}', 'TransferController@pplan')->name('plan.publish');
    
    //User controller
    Route::get('staff', 'AdminController@Staffs')->name('admin.staffs');  
    Route::get('new-staff', 'AdminController@Newstaff')->name('new.staff');  
    Route::post('new-staff', 'AdminController@Createstaff')->name('create.staff');  
    Route::get('users', 'AdminController@Users')->name('admin.users');  
    Route::get('messages', 'AdminController@Messages')->name('admin.message');  
    Route::get('unblock-staff/{id}', 'AdminController@Unblockstaff')->name('staff.unblock');
    Route::get('block-staff/{id}', 'AdminController@Blockstaff')->name('staff.block');    
    Route::get('unblock-user/{id}', 'AdminController@Unblockuser')->name('user.unblock');
    Route::get('block-user/{id}', 'AdminController@Blockuser')->name('user.block');
    Route::get('manage-user/{id}', 'AdminController@Manageuser')->name('user.manage');
    Route::get('manage-staff/{id}', 'AdminController@Managestaff')->name('staff.manage');
    Route::get('user/delete/{id}', 'AdminController@Destroyuser')->name('user.delete');
    Route::get('staff/delete/{id}', 'AdminController@Destroystaff')->name('staff.delete');
    Route::get('email/{id}/{name}', 'AdminController@Email')->name('admin.email');
    Route::post('email_send', 'AdminController@Sendemail')->name('user.email.send');    
    Route::get('promo', 'AdminController@Promo')->name('admin.promo');
    Route::post('promo', 'AdminController@Sendpromo')->name('user.promo.send');
    Route::get('message/delete/{id}', 'AdminController@Destroymessage')->name('message.delete');
    Route::get('ticket', 'AdminController@Ticket')->name('admin.ticket');
    Route::get('ticket/delete/{id}', 'AdminController@Destroyticket')->name('ticket.delete');
    Route::get('close-ticket/{id}', 'AdminController@Closeticket')->name('ticket.close');
    Route::get('manage-ticket/{id}', 'AdminController@Manageticket')->name('ticket.manage');
    Route::post('reply-ticket', 'AdminController@Replyticket')->name('ticket.reply');
    Route::post('profile-update', 'AdminController@Profileupdate');
    Route::post('staff-update', 'AdminController@Staffupdate')->name('staff.update');
    Route::get('approve-kyc/{id}', 'AdminController@Approvekyc')->name('admin.approve.kyc');
    Route::post('reject-kyc/{id}', 'AdminController@Rejectkyc')->name('admin.reject.kyc');
    Route::post('password', 'AdminController@staffPassword')->name('staff.password');
    Route::post('request-password/{id}', 'AdminController@requestPassword')->name('admin.request.password');

    //Merchant controller
    Route::get('merchant-log', 'MerchantController@merchantlog')->name('merchant.log');
    Route::get('transfer-log/{id}', 'MerchantController@transferlog')->name('transfer.log');
    Route::get('merchant/delete/{id}', 'MerchantController@Destroymerchant')->name('merchant.delete');
});