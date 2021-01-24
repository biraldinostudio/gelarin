<?php

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Vacancy;
use App\Models\CompanyOfficer; //untuk sidebar halaman company
use App\Models\Country;
use App\Models\SubAdmin1;
use App\Models\CategoryType;
use App\Models\Page;
use App\Models\User; //untuk sidebar halaman company
use App\Models\Article;
use App\Models\Company;
use Hashids\Hashids;
//Tambah Kayetanus untuk multi bahasa
Route::get('locale/{locale}', function ($locale) {
    \Session::put('locale', $locale);
    return redirect()->back();
});

//Multi bahasa halaman perusahaan
Route::get('company/locale/{locale}', function ($locale) {
    \Session::put('locale', $locale);
    return redirect()->back();
});

	Route::get('password/locale/{locale}', function ($locale) {
    \Session::put('locale', $locale);
    return redirect()->back();
});
	Route::get('front/locale/{locale}', function ($locale) {
    \Session::put('locale', $locale);
    return redirect()->back();
});

Route::get('', 'HomeController@index')->name('');
Route::get('/home', 'HomeController@index')->name('home');

View::composer('layouts.inc.header', function($view){
    $view->with('menu_working_types', CategoryType::where('active',1)->where('translation_of',1)->where('translation_lang',app()->getLocale())->get());
    $view->with('menu_vacancies1', Category::where('active',1)->where('translation_lang',app()->getLocale())->where('parent_id',0)->where('category_type_id',1)->whereIn('translation_of',[1,6,8,12,9,17,16,11])->get());
    $view->with('menu_vacancies2', Category::where('active',1)->where('translation_lang',app()->getLocale())->where('parent_id',0)->where('category_type_id',1)->whereIn('translation_of',[2,3,5,4,19,14,10,20])->get());
    $view->with('menu_vacancies3', Category::where('active',1)->where('translation_lang',app()->getLocale())->where('parent_id',0)->where('category_type_id',1)->whereIn('translation_of',[7,30,31,15,13,18,21,28])->get());
    $view->with('menu_vacancies4', Category::where('active',1)->where('translation_lang',app()->getLocale())->where('parent_id',0)->where('category_type_id',1)->whereIn('translation_of',[25,29,22,23,24])->get());	
    $view->with('menu_vacancies5', Category::where('active',1)->where('translation_lang',app()->getLocale())->where('parent_id',0)->where('category_type_id',1)->whereIn('translation_of',[26,27,32,33])->get());    
	$view->with('menu_article_types', CategoryType::where('active',1)->where('translation_of',3)->where('translation_lang',app()->getLocale())->get());	
	$view->with('menu_articles1', Category::where('active',1)->where('translation_lang',app()->getLocale())->where('parent_id',0)->where('category_type_id',3)->whereIn('translation_of',[13,93,95,96,98,99,100])->get());
	$view->with('menu_articles2', Category::where('active',1)->where('translation_lang',app()->getLocale())->where('parent_id',0)->where('category_type_id',3)->whereIn('translation_of',[85,92,94,97])->get());
	$view->with('menu_articles3', Category::where('active',1)->where('translation_lang',app()->getLocale())->where('parent_id',0)->where('category_type_id',3)->whereIn('translation_of',[86,88,89,90])->get());
	$view->with('menu_articles4', Category::where('active',1)->where('translation_lang',app()->getLocale())->where('parent_id',0)->where('category_type_id',3)->whereIn('translation_of',[84,87,91])->get());		
    $view->with('crypto', new Hashids());	
});

View::composer('layouts.inc.footer', function($view){
	$view->with('pages', Page::where('active',1)->where('translation_lang',app()->getLocale())->where('parent_id',0)->get());

});

View::composer('auth.popup.register', function($view){
    $view->with('countries', Country::select('active','name','code','id')->where('active','1')->get());
});

Auth::routes();

//FRONTEND
	//SEBELUM LOGIN
		Route::get('/infoCovid19', 'InfoCovid19Controller@index')->name('infoCovid19');	
		//Bagian Daftar (frontend)
		Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
		Route::post('/login', 'Auth\LoginController@login')->name('company.login');
		Route::get('/register', 'Auth\RegisterController@showRegisterForm')->name('register');
		Route::post('/register', 'Auth\RegisterController@register')->name('register');
		Route::get('/success', 'Auth\RegisterController@success')->name('register.success');	

		Route::get('/jobseeker/user/verify/{token}', 'Auth\RegisterController@verifyUser')->name('jobseeker.user.verify');		
		//Bagian Page (frontend)	
		Route::prefix('page')->group(function() {
			Route::get('{slug}', array('as' => 'page.show', 'uses' => 'PageController@show'));				
		});
		
		Route::get('/faq', 'FaqController@index')->name('faq.index');
		Route::post('/faq', 'FaqController@index')->name('faq.index');			

		//Bagian Artikel (frontend)
		Route::prefix('article')->group(function() {
			Route::get('', 'ArticleController@index')->name('article.index');
			Route::post('', 'ArticleController@index')->name('article.index');
			Route::post('', 'ArticleController@index')->name('article.index.search');			
			Route::get('{translation_of}/{slug}', 'ArticleController@indexByCategory')->name('article.byCategory');	//ini untuk lowongan by kategory dari header
			Route::get('detail/{id}/{slug}', 'ArticleController@show')->name('article.detail');		
			Route::get('detail/{category_id}/{category_slug}/{id}/{slug}', 'ArticleController@showByCategory')->name('article.detailByCat');	
			Route::get('lifestyle', 'ArticleController@indexByGroup')->name('article.lifestyle');
			Route::get('technology-knowledge', 'ArticleController@indexByGroup')->name('article.technology');	
			Route::get('social', 'ArticleController@indexByGroup')->name('article.social');	
			Route::get('industry-job', 'ArticleController@indexByGroup')->name('article.industry');				
			Route::get('authors/{id}/{name}', 'ArticleController@showAuthor')->name('article.authors');			
		});
		
		Route::post('comment/reply', 'ArticleCommentController@reply')->name('article.comment.reply');
		Route::post('comment/{id}', 'ArticleCommentController@store')->name('article.comment');		

		View::composer('layouts.inc.sidebarBlog', function($view){
			$view->with('artPopulars', Article::whereActive('1')->whereReviewed('1')->inRandomOrder()->SOrder()->paginate(6));
			$view->with('artRecents', Article::whereActive('1')->whereReviewed('1')->inRandomOrder()->SOrder()->paginate(6));
			$view->with('categories', Category::SCategoryArticle()->where('articles.active','=','1')->where('articles.reviewed','=','1')->get());
		});		


		//Bagian Lowongan Kerja (frontend)
		Route::prefix('vacancies')->group(function() {
			
			Route::get('', 'VacancyController@index')->name('vacancies');
			Route::post('', 'VacancyController@index')->name('vacancies');
			//Route::get('/grid', 'VacancyController@indexGrid')->name('vacancies.grid');	
			Route::get('{translation_of}/{slug}', 'VacancyController@byCategory')->name('');	//ini untuk lowongan by kategory dari header
			Route::get('detail/{id}/{slug}', 'VacancyController@show')->name('vacancies.detail');
			Route::post('detail/{id}/{slug}', 'VacancyController@show')->name('vacancies.detail');	
				
			//Untuk pilih kategori	di halaman create		
			Route::get('vacancies/categories/{code}/subcategories.json', function($code){	
				return \App\Models\Category::select('name','translation_of')->where('active',1)->where('parent_id',$code)->where('translation_lang',app()->getLocale())->get();
			});

		});
		
		Route::prefix('employers')->group(function(){
			Route::get('/pages', 'CompanyController@index')->name('employers.pages.index');			
			Route::get('/profiles/{id}/{slug}', 'CompanyController@show')->name('employers.pages.profiles');			
		});	
			
	//SETELAH LOGIN	
		Route::group(['middleware' => 'auth'], function (){	
			Route::get('/resume', 'ResumeController@create')->name('resume');
			Route::get('/home', 'HomeController@index')->name('home');
			Route::post('/home/contact/send', 'HomeController@contact')->name('home.contact.send');			
			
			//Routing manajemen password (frontend)
			Route::get('/password/change', 'Auth\Password\ChangeController@index')->name('password.change');
			Route::post('/password/change', 'Auth\Password\ChangeController@update')->name('password.change');
			
			//Routing manajemen akun (frontend)
			Route::get('/account', 'AccountController@index')->name('account');
			Route::get('/account/base/edit', 'AccountController@edit')->name('account.base.edit');			
			Route::post('/account/base/update', 'AccountController@update')->name('account.base.update');
			Route::get('/account/aboutme/edit', 'AccountController@edit')->name('account.aboutme.edit');			
			Route::post('/account/aboutme/update', 'AccountController@update')->name('account.aboutme.update');				
			Route::get('/account/address/edit', 'AccountController@edit')->name('account.address.edit');			
			Route::post('/account/address/update', 'AccountController@update')->name('account.address.update');				
			Route::get('/account/education/edit', 'AccountController@edit')->name('account.education.edit');	
			Route::post('/account/education/update', 'AccountController@update')->name('account.education.update');
			Route::post('/account/college/store', 'AccountController@store')->name('account.college.store');			
			Route::post('/account/college/update', 'AccountController@update')->name('account.college.update');			
			Route::get('/account/experience/index', 'AccountController@index')->name('account.experience.index');
			Route::post('/account/experience/store', 'AccountController@store')->name('account.experience.store');
			Route::post('/account/experience/update', 'AccountController@update')->name('account.experience.update');
			Route::post('/account/skill/store', 'AccountController@store')->name('account.skill.store');			
			Route::post('/account/skill/update', 'AccountController@update')->name('account.skill.update');			
			Route::get('/account/job_interest/edit', 'AccountController@edit')->name('account.job_interest.edit');			
			Route::post('/account/job_interest/update', 'AccountController@update')->name('account.job_interest.update');
			Route::get('/account/socialmedia/edit', 'AccountController@edit')->name('account.socialmedia.edit');
			Route::post('/account/socialmedia/update', 'AccountController@update')->name('account.socialmedia.update');
			Route::get('/account/photo/edit', 'AccountController@edit')->name('account.photo.edit');
			Route::post('/account/photo/update', 'AccountController@update')->name('account.photo.update');
			Route::get('/account/cover/edit', 'AccountController@edit')->name('account.cover.edit');			
			Route::post('/account/cover/update', 'AccountController@update')->name('account.cover.update');
			Route::get('/account/resume/edit', 'AccountController@edit')->name('account.resume.edit');			
			Route::post('/account/resume/update', 'AccountController@update')->name('account.resume.update');		
			
			Route::get('account/address/countries/{code}/provinces.json', function($code){
				return \App\Models\SubAdmin1::select('name','country_code','code')->where('country_code',$code)->where('active',1)->get();
			});
			
			Route::get('account/address/provinces/{code}/cities.json', function($code){
				return \App\Models\City::select('name','subadmin1_code','country_code','id')->where('subadmin1_code',$code)->where('active',1)->get();
			});			
						
			Route::get('/account/download_resume', 'AccountController@downloadResume')->name('account.download_resume');
			
			//Routing untuk list member yang terdaftar (Frontend)
			//Route::prefix('members')->group(function(){			
				//Route::get('/profiles/{id}/{name}', 'UserController@show')->name('members.pages.profiles');			
			//});

			Route::prefix('article/authors')->group(function(){			
				Route::get('/profiles/{id}/{name}', 'UserController@authorShow')->name('article.authors.pages.profiles');			
			});				
					
			//Routing manajemen lamaran pekerjaan (frontend)
			Route::prefix('application')->group(function() {
				
				//Routing lamar pekerjaan (frontend)
				Route::get('/download/resume/{id}', 'ManageApplicationController@downloadResume')->name('application.download_resume');				
				Route::get('/apply/{id}/{slug}', 'ManageApplicationController@apply')->name('application.apply');
				Route::post('/apply/{id}/{slug}', 'ManageApplicationController@store')->name('application.apply');
				Route::get('/message/{id}/{slug}/{name}', 'ManageApplicationController@indexMessage')->name('application.message');
				Route::post('message/store/{id}', 'ManageApplicationController@storeMessage')->name('application.message.store');				
				
				//Route::get('/list', 'ManageApplicationController@index')->name('application.list');//Routing list lamaran pekerjaan
				//Route::post('/list', 'ManageApplicationController@index')->name('application.list');// Routing pencarian
				
				Route::get('/list/unprocessed', 'ManageApplicationController@index')->name('application.list.unprocessed');
				Route::get('/list/shortlist', 'ManageApplicationController@index')->name('application.list.shortlist');
				Route::get('/list/interview', 'ManageApplicationController@index')->name('application.list.interview');
				Route::get('/list/not', 'ManageApplicationController@index')->name('application.list.not');
				Route::get('/list/pass', 'ManageApplicationController@index')->name('application.list.pass');
				Route::get('/list/cancel', 'ManageApplicationController@index')->name('application.list.cancel');		

				//Routing batal lamaran kerja (frontend)
				Route::get('application/cancel/{id}', 'ManageApplicationController@edit')->name('application.cancel');
				Route::post('application/cancel/{id}', 'ManageApplicationController@update')->name('application.cancel');

				//Routing hapus lamaran kerja (frontend)
				Route::get('application/delete/{id}', 'ManageApplicationController@destroy')->name('application.delete');		
			});
			
			Route::prefix('manage')->group(function(){
				Route::get('article/trash', 'ManageArticleController@trash')->name('manage.article.trash');					
				Route::resource('article', 'ManageArticleController', [
					'names' => [
						'index' =>'manage.article.index',			
						'create' => 'manage.article.create',				
						'store' => 'manage.article.store',
						//'edit' => 'article.edit',	//Di nonaktifkan untuk menjalankan dynamic lokasi			
						'update' => 'manage.article.update'				
					],
					'only' => ['index','create','store','update']			
				]);
							
				Route::get('article/edit/{id}/{slug}', 'ManageArticleController@edit')->name('manage.article.edit');					
				Route::get('article/pending', 'ManageArticleController@index')->name('manage.article.pending');
				Route::get('article/archived', 'ManageArticleController@index')->name('manage.article.archived');
				Route::get('article/inactived', 'ManageArticleController@index')->name('manage.article.inactived');

				Route::get('article/delete/{id}', 'ManageArticleController@destroy')->name('manage.article.delete');
				Route::get('article/destroy/{id}', 'ManageArticleController@destroy')->name('manage.article.destroy');	
				Route::get('article/restore/{id}', 'ManageArticleController@restore')->name('manage.article.restore');				
			});			
			
			//Bagian Simpan Lowongan (FrontEnd)
			Route::prefix('manage')->group(function() {	
				Route::get('vacancies', 'ManageVacancyController@index')->name('manage.vacancies');
				Route::post('vacancies', 'ManageVacancyController@index')->name('manage.vacancies');		
				Route::get('vacancies/delete/{id}', 'ManageVacancyController@destroy')->name('manage.vacancies.delete');
				Route::get('vacancies/recommendet', 'ManageVacancyController@jobRecommendet')->name('manage.vacancies.recommendet');
				Route::get('vacancies/offer', 'ManageVacancyController@jobOffer')->name('manage.vacancies.offer');				
				Route::get('vacancies/save/{id}/{slug}', 'ManageVacancyController@store')->name('manage.vacancies.store');				
			});
			
			Route::get('extra/gift', 'PageExtraController@index')->name('extra.gift');			
		    			
		});
	
Route::get('foo', function () {
    return config('mail.from.address');
});

//COMPANY
	Route::prefix('company')->group(function() {
		
		//Register dan Login Perusahaan (CompanEnd)
		Route::get('/login', 'Company\Auth\CompanyLoginController@showCompanyLoginForm')->name('company.login');
		Route::post('/login', 'Company\Auth\CompanyLoginController@login')->name('company.login');
		Route::get('/register', 'Company\Auth\CompanyRegisterController@showCompanyRegisterForm')->name('company.register');
		Route::post('/register', 'Company\Auth\CompanyRegisterController@register')->name('company.register');
		Route::get('/success', 'Company\Auth\CompanyRegisterController@success')->name('company.register.success');	
		
		//Logout company (CompanEnd)
		/*Route::get('/logout', function(){
			Session::flush();
			Auth::logout();
			return Redirect::to("/company/login")->with('status', trans('auth.You are out of your session. See you again!'));
		});*/

		Route::get('/company/user/verify/{token}', 'Company\Auth\CompanyRegisterController@verifyUser')->name('company.user.verify');		
		Route::get('/company/staff/verify/{token}', 'Company\Account\StaffMailVerify@verifyUser')->name('company.staff.verify');		
		
		//Reset Password Perusahaan (CompanEnd)
		Route::post('/password/email','Company\Auth\ForgotPasswordController@sendResetLinkEmail')->name('company.password.email');
		Route::get('/password/reset','Company\Auth\ForgotPasswordController@showLinkRequestForm')->name('company.password.request');
		Route::post('/password/reset','Company\Auth\ResetPasswordController@reset');
		Route::get('/password/reset/{token}','Company\Auth\ResetPasswordController@showResetForm')->name('company.password.reset');
		
		Route::get('/password/change', 'Company\Auth\Password\ChangeController@index')->name('company.password.change');
		Route::post('/password/change', 'Company\Auth\Password\ChangeController@update')->name('company.password.change');		
		
		
		Route::group(['middleware' => 'companypage'], function (){
		
			//View composer header bagian company
			View::composer('layouts.company.inc.header', function($view){	
				$view->with('menu_article_types', CategoryType::where('active',1)->where('translation_of',3)->where('translation_lang',app()->getLocale())->get());	
				$view->with('menu_articles1', Category::where('active',1)->where('translation_lang',app()->getLocale())->where('parent_id',0)->where('category_type_id',3)->whereIn('translation_of',[13,93,95,96,98,99,100])->get());
				$view->with('menu_articles2', Category::where('active',1)->where('translation_lang',app()->getLocale())->where('parent_id',0)->where('category_type_id',3)->whereIn('translation_of',[85,92,94,97])->get());
				$view->with('menu_articles3', Category::where('active',1)->where('translation_lang',app()->getLocale())->where('parent_id',0)->where('category_type_id',3)->whereIn('translation_of',[86,88,89,90])->get());
				$view->with('menu_articles4', Category::where('active',1)->where('translation_lang',app()->getLocale())->where('parent_id',0)->where('category_type_id',3)->whereIn('translation_of',[84,87,91])->get());				
			});			
			//View composer sidebar bagian company
			View::composer('layouts.company.inc.sidebar', function($view){
				//$checkAccess=CompanyOfficer::SCompAccessStaff()->first();
				$checkAccess=CompanyOfficer::where('user_id',auth()->user()->id)->first();
				if($checkAccess->vacancy_access=='1'){
					$view->with(
						'countVacActives',Vacancy::SActive()->SReviewed()->where('company_id',auth()->user()->companyofficer->company->id)->get()
					);
					$view->with(
						'countVacPendings',Vacancy::SActive()->SUnReviewed()->where('company_id',auth()->user()->companyofficer->company->id)->get()
					);		
					$view->with(
						'countVacExpires',Vacancy::SExpire()->SReviewed()->where('company_id',auth()->user()->companyofficer->company->id)->get()
					);
					$view->with(
						'countVacInactives',Vacancy::SInActive()->where('company_id',auth()->user()->companyofficer->company->id)->get()
					);		
				}	
				else{
					$view->with(
						'countVacActives',Vacancy::where('user_id',auth()->user()->id)->SActive()->SReviewed()->get()
					);
					$view->with(
						'countVacPendings',Vacancy::where('user_id',auth()->user()->id)->SActive()->SUnReviewed()->get()
					);		
					$view->with(
						'countVacExpires',Vacancy::where('user_id',auth()->user()->id)->SExpire()->SReviewed()->get()
					);
					$view->with(
						'countVacInactives',Vacancy::where('user_id',auth()->user()->id)->SInActive()->get()
					);		
				}

				if($checkAccess->user_management=='1'){
					$view->with(
						'countCompStaffs',CompanyOfficer::where('company_id',auth()->user()->companyOfficer->company_id)->where('company_officers.type','=','Staff')->select('id')->count()
					);	
				}
				
				if($checkAccess->add_articles=='1'){
					$view->with(
						'countMyArticleActives',Article::where('user_id',auth()->user()->id)->whereActive('1')->whereReviewed('1')->count()
					);
					$view->with(
						'countMyArticlePendings',Article::where('user_id',auth()->user()->id)->whereActive('1')->whereReviewed('0')->count()
					);
					$view->with(
						'countMyArticleInactives',Article::where('user_id',auth()->user()->id)->whereActive('0')->count()
					);					
				}				
			});
			//View composer footer2 bagian company
			View::composer('layouts.company.inc.footer', function($view){
				$view->with('pages', Page::where('active',1)->where('translation_lang',app()->getLocale())->where('parent_id',0)->get());

			});		
				
			Route::get('/home', 'Company\HomeController@index')->name('company.home');
			Route::get('/dashboard', 'Company\HomeController@dashboard')->name('company.dashboard');		
			Route::post('/home/contact/send', 'Company\HomeController@contact')->name('company.home.contact.send');

			View::composer('layouts.company.inc.sidebarBlog', function($view){
				$view->with('artPopulars', Article::whereActive('1')->whereReviewed('1')->inRandomOrder()->SOrder()->paginate(6));
			});
			View::composer('layouts.company.inc.sidebarBlog', function($view){
				$view->with('artRecents', Article::whereActive('1')->whereReviewed('1')->inRandomOrder()->SOrder()->paginate(6));
			});
			View::composer('layouts.company.inc.sidebarBlog', function($view){
				$view->with('categories', Category::SCategoryArticle()->where('articles.active','=','1')->where('articles.reviewed','=','1')->get());
			});
	
			Route::prefix('talents')->group(function(){			
				Route::get('/pages', 'Company\UserController@index')->name('talents.pages.index');
				Route::get('/download/resume/{id}', 'Company\UserController@downloadResume')->name('talents.download.resume');					
				Route::get('/profiles/{id}/{name}', 'Company\UserController@show')->name('talents.pages.profiles');			
			});				
			
			
			Route::get('/faq', 'Company\FaqController@index')->name('company.faq.index');
			Route::post('/faq', 'Company\FaqController@index')->name('company.faq.index');					

			//Bagian Profile edit (CompanyEnd)	
				Route::get('account/index', 'Company\Account\ProfileController@index')->name('account.index');				
				Route::get('account/edit', 'Company\Account\ProfileController@edit')->name('account.edit');
				Route::post('account/update}', 'Company\Account\ProfileController@update')->name('account.update');	

				//untuk halaman pilih wilayah di halamana profile (CompanEnd)
				Route::get('account/sub_admin1s/{code}/cities.json', function($code){
					return \App\Models\City::select('name','country_code','id')->where('subadmin1_code',$code)->where('active',1)->get();
				});	

			//Pengaturan
			Route::prefix('settings')->group(function() {
				//Address
				Route::get('/address/trash', 'Company\Settings\AddressController@trash')->name('settings.address.trash');	
				Route::resource('address', 'Company\Settings\AddressController', [
					'names' => [
						'index' => 'settings.address.index',				
						'create' => 'settings.address.create',
						'store' => 'settings.address.store',					
						//'edit' => 'settings.address.edit',//Di nonaktifkan untuk menjalankan dynamic lokasi				
						'update' => 'settings.address.update'						
					],
					'only' => ['index','create','store','edit','update']			
				]);
				Route::get('address/edit/{id}','Company\Settings\AddressController@edit')->name('settings.address.edit');			
				
				Route::get('settings/address/updateActive/{id}','Company\Settings\AddressController@updateActive')->name('settings.address.updateActive');			
					
				Route::get('/settings/address/delete/{id}', 'Company\Settings\AddressController@destroy')->name('settings.address.delete');
				
				Route::get('/settings/address/destroy/{id}', 'Company\Settings\AddressController@destroy')->name('settings.address.destroy');				

				Route::get('/settings/address/restore/{id}', 'Company\Settings\AddressController@restore')->name('settings.address.restore');					
					
				//Pilih kota dibagian create/edit alamat perusahaan
				Route::get('provinces/{code}/cities.json', function($code){
					return \App\Models\City::select('name','country_code','id')->where('subadmin1_code',$code)->where('active',1)->get();
				});

				//untuk halaman pilih wilayahdi halamana edit (CompanEnd)	
				Route::get('address/edit/sub_admin1s/{code}/cities.json', function($code){
					//return \App\Models\City::select('name','country_code','id')->where('subadmin1_code',$code)->where('active',1)->get();
					return \App\Models\City::select('subadmin1_code','name','country_code','id')->where('subadmin1_code',$code)->where('active',1)->get();				
				});	

				//Legal
				Route::get('/legal/trash', 'Company\Settings\LegalController@trash')->name('settings.legal.trash');	
				Route::resource('legal', 'Company\Settings\LegalController', [
					'names' => [
						'index' => 'settings.legal.index',				
						'create' => 'settings.legal.create',
						'store' => 'settings.legal.store',			
						'update' => 'settings.legal.update'						
					],
					'only' => ['index','create','store','update']			
				]);
				Route::get('/legal/download_file/{id}', 'Company\Settings\LegalController@downloadFile')->name('settings.legal.download_file');				
				Route::get('legal/edit/{id}','Company\Settings\LegalController@edit')->name('settings.legal.edit');
				Route::get('/settings/legal/delete/{id}', 'Company\Settings\LegalController@destroy')->name('settings.legal.delete');
				Route::get('/settings/legal/destroy/{id}', 'Company\Settings\LegalController@destroy')->name('settings.legal.destroy');
				Route::get('/settings/legal/restore/{id}', 'Company\Settings\LegalController@restore')->name('settings.legal.restore');				
					
			});
			
			/*Route::resource('settings', 'Company\Settings\BaseController', [
				'names' => [
					'index' => 'settings.index',				
					//'edit' => 'settings.edit',				
					//'update' => 'settings.update'				
				],
				'only' => ['index','edit','update']			
			]);*/
			Route::get('/settings', 'Company\Settings\BaseController@index')->name('settings.index');			
			Route::get('/settings/{id}/edit', 'Company\Settings\BaseController@edit')->name('settings.edit');
			Route::post('/settings/update/{id}', 'Company\Settings\BaseController@update')->name('company.settings.update');			
			
			//BAGIAN MANAJEMEN DATA COMPANY (CompanyEnd)
			Route::prefix('manage')->group(function(){
				
				//Bagian Manajemen Akun Staff
				Route::resource('account/staff', 'Company\Account\StaffController', [
					'names' => [
						'index' =>'account.staff.list',			
						'create' => 'account.staff.create',				
						'store' => 'account.staff.store',
						'edit' => 'account.staff.edit',				
						'update' => 'account.staff.update'				
					],
					'only' => ['index','create','store','edit','update']			
				]);
				Route::get('account/staff/trash', 'Company\Account\StaffController@trash')->name('account.staff.trash');				
				Route::get('account/staff/cancel/{id}', 'Company\Account\StaffController@editCancel')->name('account.staff.cancel');
				Route::post('account/staff/cance/update/{id}', 'Company\Account\StaffController@updateCancel')->name('account.staff.cancel.update');
				
				Route::get('account/staff/delete/{id}', 'Company\Account\StaffController@destroy')->name('account.staff.delete');
				Route::post('account/staff/destroy/{id}', 'Company\Account\StaffController@destroy')->name('account.staff.cancel.destroy');			
				
				//Manajemen Application (CompanyEnd)
				Route::prefix('application')->group(function() {
					Route::get('unprocessed/{id}/{slug}', 'Company\ApplicationController@index')->name('unprocessed');
					Route::get('shortlist/{id}/{slug}', 'Company\ApplicationController@index')->name('shortlist');
					Route::get('interview/{id}/{slug}', 'Company\ApplicationController@index')->name('interview');	
					Route::get('pass/{id}/{slug}', 'Company\ApplicationController@index')->name('pass');	
					Route::get('not/{id}/{slug}', 'Company\ApplicationController@index')->name('not');																				
					Route::post('update/shortlist/{id}', 'Company\ApplicationController@update')->name('update.shortlist');
					Route::post('update/interview/{id}', 'Company\ApplicationController@update')->name('update.interview');
					Route::post('update/pass/{id}', 'Company\ApplicationController@update')->name('update.pass');
					Route::post('update/not/{id}', 'Company\ApplicationController@update')->name('update.not');
					Route::get('detail/{id}/{name}', 'Company\ApplicationController@show')->name('detail');
					Route::get('message/{id}/{title}/{name}', 'Company\ApplicationController@indexMessage')->name('message');
					Route::post('message/store/{application_id}', 'Company\ApplicationController@storeMessage')->name('message.store');
					Route::get('download/resume/{id}/{name}', 'Company\ApplicationController@downloadResume')->name('download_resume');					
				});				
				
				//Manajemen Lowongan (CompanEnd)
				Route::resource('vacancies', 'Company\VacancyController', [
					'names' => [
						'index' =>'vacancies.active',			
						'create' => 'vacancies.create',				
						'store' => 'vacancies.store',
						//'edit' => 'vacancies.edit',	//Di nonaktifkan untuk menjalankan dynamic lokasi			
						'update' => 'vacancies.update'				
					],
					'only' => ['index','create','store','edit','update']			
				]);	
				Route::get('vacancies/edit/{id}', 'Company\VacancyController@edit')->name('vacancies.edit');		

				//Untuk pilih kategori	di halaman create (CompanEnd)	
				Route::get('vacancies/categories/{code}/subcategories.json', function($code){	
					return \App\Models\Category::select('name','translation_of')->where('active',1)->where('parent_id',$code)->where('translation_lang',app()->getLocale())->get();
				});

				//Untuk pilih kategori	di halaman edit (CompanEnd)
				Route::get('vacancies/edit/categories/{code}/subcategories.json', function($code){	
					return \App\Models\Category::select('name','translation_of')->where('active',1)->where('parent_id',$code)->where('translation_lang',app()->getLocale())->get();
				});		
						
				//untuk create wilayah(CompanEnd)	
				Route::get('vacancies/sub_admin1s/{code}/cities.json', function($code){
					return \App\Models\City::select('subadmin1_code','name','country_code','id')->where('subadmin1_code',$code)->where('active',1)->get();
				});	
						
				//untuk edit wilayah (CompanEnd)	
				Route::get('vacancies/edit/sub_admin1s/{code}/cities.json', function($code){
					return \App\Models\City::select('subadmin1_code','name','country_code','id')->where('subadmin1_code',$code)->where('active',1)->get();
				});	
				Route::get('vacancies/trash', 'Company\VacancyController@trash')->name('vacancies.trash');			
				Route::get('vacancies/pending', 'Company\VacancyController@index')->name('vacancies.pending');
				Route::get('vacancies/expire', 'Company\VacancyController@index')->name('vacancies.expire');
				Route::get('vacancies/inactive', 'Company\VacancyController@index')->name('vacancies.inactive');		
					
				Route::get('vacancies/cancel/{id}', 'Company\VacancyController@editCancel')->name('vacancies.cancel');
				Route::post('vacancies/cancel/{id}', 'Company\VacancyController@updateCancel')->name('vacancies.cancel');		
					
				Route::get('vacancies/delete/{id}', 'Company\VacancyController@destroy')->name('vacancies.delete');
				Route::get('vacancies/destroy/{id}', 'Company\VacancyController@destroy')->name('vacancies.destroy');
				Route::get('vacancies/restore/{id}', 'Company\VacancyController@restore')->name('vacancies.restore');
				
			Route::get('detail/{id}/{slug}', 'Company\VacancyController@show')->name('company.vacancies.detail');
			Route::post('detail/{id}/{slug}', 'Company\VacancyController@show')->name('company.vacancies.detail');				
				
				
				//Manajemen Artikel (CompanyEnd)
				Route::resource('article', 'Company\ManageArticleController', [
					'names' => [
						'index' =>'company.article.active',			
						'create' => 'company.article.create',				
						'store' => 'company.article.store',
						//'edit' => 'vacancies.edit',	//Di nonaktifkan untuk menjalankan dynamic lokasi			
						'update' => 'company.article.update'				
					],
					'only' => ['index','create','store','update']			
				]);
				Route::get('article/trash', 'Company\ManageArticleController@trash')->name('company.article.trash');				
				Route::get('article/edit/{id}/{slug}', 'Company\ManageArticleController@edit')->name('company.article.edit');				
				Route::get('article/pending', 'Company\ManageArticleController@index')->name('company.article.pending');
				Route::get('article/inactive', 'Company\ManageArticleController@index')->name('company.article.inactive');
				Route::get('article/delete/{id}', 'Company\ManageArticleController@destroy')->name('company.article.delete');
				Route::get('article/destroy/{id}', 'Company\ManageArticleController@destroy')->name('company.article.destroy');	
				Route::get('article/restore/{id}', 'Company\ManageArticleController@restore')->name('company.article.restore');
				Route::get('article/detail/{id}/{slug}', 'Company\ManageArticleController@show')->name('company.article.detail');
				Route::get('{translation_of}/{slug}', 'Company\ManageArticleController@indexByCategory')->name('company.article.byCategory');
				Route::get('detail/{category_id}/{category_slug}/{id}/{slug}', 'Company\ArticleController@showByCategory')->name('company.article.detailByCat');
			});
			
		Route::post('comment/reply', 'Company\ArticleCommentController@reply')->name('company.article.comment.reply');
		Route::post('comment/{id}', 'Company\ArticleCommentController@store')->name('company.article.comment');			
				
			Route::get('testimonial', 'Company\TestimonialController@edit')->name('company.testimonial');
			Route::post('testimonial/store', 'Company\TestimonialController@store')->name('company.testimonial.store');			
			Route::post('testimonial/update', 'Company\TestimonialController@update')->name('company.testimonial.update');				

			Route::post('vacancyoffer/store', 'Company\VacancyOfferController@store')->name('company.vacancyoffer.store');

			
			Route::prefix('page')->group(function() {
				//Route::get('company/page/{slug}', array('as' => 'page.show', 'uses' => 'PageController@show'));
				Route::get('{slug}', 'Company\PageController@show')->name('company.page.show');			
			});
			//BAGIAN ARTICLE PUBLIC (Admin)
			Route::get('article', 'Company\ArticleController@index')->name('company.article.index');			
			Route::get('article/byCategory', 'Company\ArticleController@indexByCategory')->name('company.article.byCategory');
			Route::get('article/{translation_of}/{slug}', 'Company\ArticleController@indexByCategory')->name('company.article.byCategory');	//ini untuk lowongan by kategory dari header			
			Route::get('article/detail/{id}/{slug}', 'Company\ArticleController@show')->name('company.article.detail');		
			Route::get('article/detail/{category_id}/{category_slug}/{id}/{slug}', 'Company\ArticleController@showByCategory')->name('company.articl.detailByCat');

			//Route::prefix('company.article/authors')->group(function(){			
				Route::get('article/authors/profiles/{id}/{name}', 'Company\UserController@authorShow')->name('company.article.authors.pages.profiles');			
			//});				
		});
	});

//Untuk direct halaman pagi yang tidak punya akses	
Route::get('/blank_page', function(){
   return abort(404);
});



// BAGIAN ADMIN (PIHAk GELARIN)
Route::prefix('backstart')->group(function() {
	
	
View::composer('layouts.admin.inc.sidebarLeft', function($view){
    $view->with('countUser', User::select('id')->whereType('Member')->where('active',1)->count());
    $view->with('countCompany', Company::select('id')->where('active',1)->count());
    $view->with('countVacancy', Vacancy::select('id')->where('active',1)->where('reviewed',1)->count());	
});		
	Route::get('/', function () {
    	return view('admin.auth.login');
	});
	Route::get('/admin/login', 'Admin\Auth\AdminLoginController@showLoginForm')->name('admin.login');
	Route::post('/admin/login', 'Admin\Auth\AdminLoginController@login')->name('admin.login');

    Route::post('/password/email','Admin\Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset','Admin\Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset','Admin\Auth\ResetPasswordController@reset');
    Route::get('/password/reset/{token}','Admin\Auth\ResetPasswordController@showResetForm')->name('admin.password.reset');

	Route::group(['middleware' => 'adminMiddle'], function (){
	
		Route::get('/home', 'Admin\HomeController@index')->name('admin.home');
		View::composer('layouts.admin.inc.sidebarLeft', function($view){
			$view->with('vacancyNewCounts',Vacancy::Select('reviewed')->where('reviewed','=','0')->count());
		});
		
		Route::get('/page/active', 'Admin\PageController@index')->name('admin.page.active');
		Route::get('/page/inactive', 'Admin\PageController@index')->name('admin.page.inactive');		
		Route::get('/page/edit/{id}', 'Admin\PageController@edit')->name('admin.page.edit');
		Route::post('/page/update/{id}', 'Admin\PageController@update')->name('admin.page.update');

		Route::get('/faq/active', 'Admin\FaqController@index')->name('admin.faq.active');
		Route::get('/faq/inactive', 'Admin\FaqController@index')->name('admin.faq.inactive');
		Route::get('/faq/create', 'Admin\FaqController@create')->name('admin.faq.create');
		Route::post('/faq/store', 'Admin\FaqController@store')->name('admin.faq.store');		
		Route::get('/faq/edit/{id}', 'Admin\FaqController@edit')->name('admin.faq.edit');
		Route::post('/faq/update/{id}', 'Admin\FaqController@update')->name('admin.faq.update');
		
		Route::post('/faq/delete_image', 'Admin\FaqController@delete_image')->name('admin.faq.delete_image');		
		
		//MANAJEMEN  PEKERJAAN (Admin)
		//Route::get('/vacancies/index', 'Admin\VacancyController@index')->name('admin.vacancies.index');		
		Route::get('/vacancies/reviewed', 'Admin\VacancyController@index')->name('admin.vacancies.reviewed');
		Route::get('/vacancies/inactived', 'Admin\VacancyController@index')->name('admin.vacancies.inactived');
		Route::get('/vacancies/expired', 'Admin\VacancyController@index')->name('admin.vacancies.expired');		
		Route::get('/vacancies/trash', 'Admin\VacancyController@index')->name('admin.vacancies.trash');

		Route::resource('vacancies', 'Admin\VacancyController', [
			'names' => [
				'index' =>'admin.vacancies.index',			
				'create' => 'admin.vacancies.create',				
				'store' => 'admin.vacancies.store',
				//'edit' => 'article.edit',	//Di nonaktifkan untuk menjalankan dynamic lokasi			
				'update' => 'admin.vacancies.update'				
			],
			'only' => ['index','create','store','update']			
		]);
		
		Route::get('vacancies/sub_admin1s/{code}/cities.json', function($code){
			return \App\Models\City::select('subadmin1_code','name','country_code','id')->where('subadmin1_code',$code)->where('active',1)->get();
		});
		Route::get('vacancies/categories/{code}/subcategories.json', function($code){	
			return \App\Models\Category::select('name','translation_of')->where('active',1)->where('parent_id',$code)->where('translation_lang',app()->getLocale())->get();
		});		
		
		//Manajemen User (Admin)
		Route::get('/user/index', 'Admin\UserController@index')->name('admin.user.index');
		
		//MANAJEMEN COMPANY (Admin)
		//Route::get('/company', 'Admin\CompanyController@index')->name('admin.company.index');
		Route::resource('company', 'Admin\CompanyController', [
			'names' => [
				'index' =>'admin.company.index',			
				'create' => 'admin.company.create',				
				'store' => 'admin.company.store',
				//'edit' => 'article.edit',	//Di nonaktifkan untuk menjalankan dynamic lokasi			
				'update' => 'admin.company.update'				
			],
			'only' => ['index','create','store','update']			
		]);
	});	
	Route::get('company/sub_admin1s/{code}/cities.json', function($code){
		return \App\Models\City::select('subadmin1_code','name','country_code','id')->where('subadmin1_code',$code)->where('active',1)->get();
	});	
							
	Route::get('/logout', function(){
    	Session::flush();
   	 	Auth::logout();
    	return Redirect::to("/backstart")->with('status', 'Anda sudah keluar dari sessi" Sampai jumpa lagi');
	});
});

//Logout company
Route::get('/logout', function(){

	 
    if (Auth::guard('companypage')->check()) {
    Session::flush();
   	 Auth::logout();		
    return Redirect::to("/company/login")->with('status', trans('auth.You are out of your session. See you again!'));
    }
    if (Auth::guard('adminMiddle')->check()) {
    Session::flush();
   	 Auth::logout();		
    return Redirect::to("/backstart")->with('status', trans('auth.You are out of your session. See you again!'));
    }	
	
    Session::flush();
   	 Auth::logout();		
     // Auth::guard('user')->logout();
  return Redirect::to("/login")->with('status', trans('auth.You are out of your session. See you again!'));	  
 
});