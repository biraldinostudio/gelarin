<?php
/*--START HALAMAN FRONTEND (Jobseeker)-------------------------*/
// Home
Breadcrumbs::for('home', function ($trail) {
    //$trail->parent('settings.contact.index');	
    $trail->push(trans('global.Home'), route('home'));
});
// Home > Account
Breadcrumbs::for('account', function ($trail) {
    $trail->parent('home');	
    $trail->push(trans('account.My Account'), route('account'));
});
//Home > Account > Base
Breadcrumbs::for('account.base.edit', function ($trail) {
    $trail->parent('account');	
    $trail->push(trans('account.Basic Information'), route('account.base.edit'));
});

//Home > Account > Aboutme
Breadcrumbs::for('account.aboutme.edit', function ($trail) {
    $trail->parent('account');	
    $trail->push(trans('account.About Me'), route('account.aboutme.edit'));
});

//Home > Account > Base > Address
Breadcrumbs::for('account.address.edit', function ($trail) {
    $trail->parent('account.base.edit');	
    $trail->push(trans('account.Address'), route('account.address.edit'));
});

//Home > Account > Base > Address > Education
Breadcrumbs::for('account.education.edit', function ($trail) {
    $trail->parent('account.address.edit');	
    $trail->push(trans('account.Education'), route('account.education.edit'));
});

//Home > Account > Base > Address > Education > Experience
Breadcrumbs::for('account.experience.index', function ($trail) {
    $trail->parent('account.education.edit');	
    $trail->push(trans('account.Experience'), route('account.experience.index'));
});

//Home > Account > Base > Address > Education > Experience > Job of Interest
Breadcrumbs::for('account.job_interest.edit', function ($trail) {
    $trail->parent('account.experience.index');	
    $trail->push(trans('account.Job Required'), route('account.job_interest.edit'));
});

//Home > Account > Social Media
Breadcrumbs::for('account.socialmedia.edit', function ($trail) {
    $trail->parent('account.base.edit');	
    $trail->push(trans('account.Social Media'), route('account.socialmedia.edit'));
});

//Home > Account > Profile Picture
Breadcrumbs::for('account.photo.edit', function ($trail) {
    $trail->parent('account.base.edit');	
    $trail->push(trans('account.Profile Picture'), route('account.photo.edit'));
});
/*--END HALAMAN FRONTEND (Jobseeker)-------------------------*/



