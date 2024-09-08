<?php

use App\Http\Controllers\AuthenticatorController;
use App\Http\Controllers\ImportExcelController;
use App\Http\Controllers\NumberAssigner;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\FunctionController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    return redirect()->route('index');
})->name('/');

//Language Change
Route::get('lang/{locale}', function ($locale) {
    if (!in_array($locale, ['en', 'de', 'es', 'fr', 'pt', 'cn', 'ae'])) {
        abort(400);
    }
    Session()->put('locale', $locale);
    Session::get('locale');
    return redirect()->back();
})->name('lang');

Route::prefix('dashboard')->group(function () {
    Route::get('/index', [App\Http\Controllers\DashboardController::class, 'index'])->name('index')->middleware('2fa');

    // Route::view('index', 'dashboard.index')->name('index')->middleware('2fa');
    Route::view('dashboard-02', 'dashboard.dashboard-02')->name('dashboard-02');
    Route::view('dashboard-03', 'dashboard.dashboard-03')->name('dashboard-03');
    Route::view('dashboard-04', 'dashboard.dashboard-04')->name('dashboard-04');
    Route::view('dashboard-05', 'dashboard.dashboard-05')->name('dashboard-05');
});
// Route::prefix('admin',)->group(function () {
Route::group(['prefix' => 'admin', 'middleware' => ['auth', '2fa']], function () {
    Route::get('/view-users', [App\Http\Controllers\AdminController::class, 'users'])->name('view-users')->middleware('2fa');
    Route::get('add-users', [App\Http\Controllers\AdminController::class, 'addusers'])->name('users.add');
    Route::get('users-edit/{id}', [App\Http\Controllers\AdminController::class, 'users_edit'])->name('user.edit');
    Route::post('users-add', [App\Http\Controllers\AdminController::class, 'usersadd'])->name('user.add');
    Route::post('users-edit-update', [App\Http\Controllers\AdminController::class, 'usersedit'])->name('user.edit.update');
    Route::get('DeleteUser/{id}', [App\Http\Controllers\AdminController::class, 'DeleteUser'])->name('user.destroy');
    Route::post('commitment-update', [App\Http\Controllers\AdminController::class, 'commitment_update'])->name('commitment.update');
    Route::get('add-commitment/{id}', [App\Http\Controllers\AdminController::class, 'commitment_add'])->name('add.commitment');
    Route::get('view-commitment', [App\Http\Controllers\AdminController::class, 'view_commitment'])->name('view_commitment');
    Route::get('MasterLogin/{id}', [App\Http\Controllers\MasterController::class, 'MasterLogin'])->name('master.login')->middleware('auth');
    //
    Route::get('call-center', [AdminController::class, 'call_center'])->name('call.center');
    Route::get('call-center-edit/{id}', [AdminController::class, 'call_center_edit'])->name('call.center.edit');
    Route::post('call-center-add', [AdminController::class, 'cc_add'])->name('cc.add');
    Route::post('call-center-edit-update', [AdminController::class, 'cc_edit'])->name('cc.edit.update');

});

Route::prefix('widgets')->group(function () {
    Route::view('general-widget', 'widgets.general-widget')->name('general-widget');
    Route::view('chart-widget', 'widgets.chart-widget')->name('chart-widget');
});

Route::prefix('page-layouts')->group(function () {
    Route::view('box-layout', 'page-layout.box-layout')->name('box-layout');
    Route::view('layout-rtl', 'page-layout.layout-rtl')->name('layout-rtl');
    Route::view('layout-dark', 'page-layout.layout-dark')->name('layout-dark');
    Route::view('hide-on-scroll', 'page-layout.hide-on-scroll')->name('hide-on-scroll');
    Route::view('footer-light', 'page-layout.footer-light')->name('footer-light');
    Route::view('footer-dark', 'page-layout.footer-dark')->name('footer-dark');
    Route::view('footer-fixed', 'page-layout.footer-fixed')->name('footer-fixed');
});

Route::prefix('project')->group(function () {
    Route::view('projects', 'project.projects')->name('projects');
    Route::view('projectcreate', 'project.projectcreate')->name('projectcreate');
});

Route::view('file-manager', 'file-manager')->name('file-manager');
Route::view('kanban', 'kanban')->name('kanban');

Route::prefix('ecommerce')->group(function () {
    Route::view('product', 'apps.product')->name('product');
    Route::view('page-product', 'apps.product-page')->name('product-page');
    Route::view('list-products', 'apps.list-products')->name('list-products');
    Route::view('payment-details', 'apps.payment-details')->name('payment-details');
    Route::view('order-history', 'apps.order-history')->name('order-history');
    Route::view('invoice-template', 'apps.invoice-template')->name('invoice-template');
    Route::view('cart', 'apps.cart')->name('cart');
    Route::view('list-wish', 'apps.list-wish')->name('list-wish');
    Route::view('checkout', 'apps.checkout')->name('checkout');
    Route::view('pricing', 'apps.pricing')->name('pricing');
});

Route::prefix('email')->group(function () {
    Route::view('email-application', 'apps.email-application')->name('email-application');
    Route::view('email-compose', 'apps.email-compose')->name('email-compose');
});

Route::prefix('chat')->group(function () {
    Route::view('chat', 'apps.chat')->name('chat');
    Route::view('video-chat', 'apps.video-chat')->name('chat-video');
});

Route::prefix('users')->group(function () {
    Route::view('user-profile', 'apps.user-profile')->name('user-profile');
    Route::view('edit-profile', 'apps.edit-profile')->name('edit-profile');
    Route::view('user-cards', 'apps.user-cards')->name('user-cards');
});


Route::view('bookmark', 'apps.bookmark')->name('bookmark');
Route::view('contacts', 'apps.contacts')->name('contacts');
Route::view('task', 'apps.task')->name('task');
Route::view('calendar-basic', 'apps.calendar-basic')->name('calendar-basic');
Route::view('social-app', 'apps.social-app')->name('social-app');
Route::view('to-do', 'apps.to-do')->name('to-do');
Route::view('search', 'apps.search')->name('search');

Route::prefix('ui-kits')->group(function () {
    Route::view('state-color', 'ui-kits.state-color')->name('state-color');
    Route::view('typography', 'ui-kits.typography')->name('typography');
    Route::view('avatars', 'ui-kits.avatars')->name('avatars');
    Route::view('helper-classes', 'ui-kits.helper-classes')->name('helper-classes');
    Route::view('grid', 'ui-kits.grid')->name('grid');
    Route::view('tag-pills', 'ui-kits.tag-pills')->name('tag-pills');
    Route::view('progress-bar', 'ui-kits.progress-bar')->name('progress-bar');
    Route::view('modal', 'ui-kits.modal')->name('modal');
    Route::view('alert', 'ui-kits.alert')->name('alert');
    Route::view('popover', 'ui-kits.popover')->name('popover');
    Route::view('tooltip', 'ui-kits.tooltip')->name('tooltip');
    Route::view('loader', 'ui-kits.loader')->name('loader');
    Route::view('dropdown', 'ui-kits.dropdown')->name('dropdown');
    Route::view('accordion', 'ui-kits.accordion')->name('accordion');
    Route::view('tab-bootstrap', 'ui-kits.tab-bootstrap')->name('tab-bootstrap');
    Route::view('tab-material', 'ui-kits.tab-material')->name('tab-material');
    Route::view('box-shadow', 'ui-kits.box-shadow')->name('box-shadow');
    Route::view('list', 'ui-kits.list')->name('list');
});

Route::prefix('bonus-ui')->group(function () {
    Route::view('scrollable', 'bonus-ui.scrollable')->name('scrollable');
    Route::view('tree', 'bonus-ui.tree')->name('tree');
    Route::view('bootstrap-notify', 'bonus-ui.bootstrap-notify')->name('bootstrap-notify');
    Route::view('rating', 'bonus-ui.rating')->name('rating');
    Route::view('dropzone', 'bonus-ui.dropzone')->name('dropzone');
    Route::view('tour', 'bonus-ui.tour')->name('tour');
    Route::view('sweet-alert2', 'bonus-ui.sweet-alert2')->name('sweet-alert2');
    Route::view('modal-animated', 'bonus-ui.modal-animated')->name('modal-animated');
    Route::view('owl-carousel', 'bonus-ui.owl-carousel')->name('owl-carousel');
    Route::view('ribbons', 'bonus-ui.ribbons')->name('ribbons');
    Route::view('pagination', 'bonus-ui.pagination')->name('pagination');
    Route::view('breadcrumb', 'bonus-ui.breadcrumb')->name('breadcrumb');
    Route::view('range-slider', 'bonus-ui.range-slider')->name('range-slider');
    Route::view('image-cropper', 'bonus-ui.image-cropper')->name('image-cropper');
    Route::view('sticky', 'bonus-ui.sticky')->name('sticky');
    Route::view('basic-card', 'bonus-ui.basic-card')->name('basic-card');
    Route::view('creative-card', 'bonus-ui.creative-card')->name('creative-card');
    Route::view('tabbed-card', 'bonus-ui.tabbed-card')->name('tabbed-card');
    Route::view('dragable-card', 'bonus-ui.dragable-card')->name('dragable-card');
    Route::view('timeline-v-1', 'bonus-ui.timeline-v-1')->name('timeline-v-1');
    Route::view('timeline-v-2', 'bonus-ui.timeline-v-2')->name('timeline-v-2');
    Route::view('timeline-small', 'bonus-ui.timeline-small')->name('timeline-small');
});

Route::prefix('builders')->group(function () {
    Route::view('form-builder-1', 'builders.form-builder-1')->name('form-builder-1');
    Route::view('form-builder-2', 'builders.form-builder-2')->name('form-builder-2');
    Route::view('pagebuild', 'builders.pagebuild')->name('pagebuild');
    Route::view('button-builder', 'builders.button-builder')->name('button-builder');
});

Route::prefix('animation')->group(function () {
    Route::view('animate', 'animation.animate')->name('animate');
    Route::view('scroll-reval', 'animation.scroll-reval')->name('scroll-reval');
    Route::view('aos', 'animation.aos')->name('aos');
    Route::view('tilt', 'animation.tilt')->name('tilt');
    Route::view('wow', 'animation.wow')->name('wow');
});


Route::prefix('icons')->group(function () {
    Route::view('flag-icon', 'icons.flag-icon')->name('flag-icon');
    Route::view('font-awesome', 'icons.font-awesome')->name('font-awesome');
    Route::view('ico-icon', 'icons.ico-icon')->name('ico-icon');
    Route::view('themify-icon', 'icons.themify-icon')->name('themify-icon');
    Route::view('feather-icon', 'icons.feather-icon')->name('feather-icon');
    Route::view('whether-icon', 'icons.whether-icon')->name('whether-icon');
    Route::view('simple-line-icon', 'icons.simple-line-icon')->name('simple-line-icon');
    Route::view('material-design-icon', 'icons.material-design-icon')->name('material-design-icon');
    Route::view('pe7-icon', 'icons.pe7-icon')->name('pe7-icon');
    Route::view('typicons-icon', 'icons.typicons-icon')->name('typicons-icon');
    Route::view('ionic-icon', 'icons.ionic-icon')->name('ionic-icon');
});

Route::prefix('buttons')->group(function () {
    Route::view('buttons', 'buttons.buttons')->name('buttons');
    Route::view('flat-buttons', 'buttons.flat-buttons')->name('flat-buttons');
    Route::view('edge-buttons', 'buttons.buttons-edge')->name('buttons-edge');
    Route::view('raised-button', 'buttons.raised-button')->name('raised-button');
    Route::view('button-group', 'buttons.button-group')->name('button-group');
});

Route::prefix('forms')->group(function () {
    Route::view('form-validation', 'forms.form-validation')->name('form-validation');
    Route::view('base-input', 'forms.base-input')->name('base-input');
    Route::view('radio-checkbox-control', 'forms.radio-checkbox-control')->name('radio-checkbox-control');
    Route::view('input-group', 'forms.input-group')->name('input-group');
    Route::view('megaoptions', 'forms.megaoptions')->name('megaoptions');
    Route::view('datepicker', 'forms.datepicker')->name('datepicker');
    Route::view('time-picker', 'forms.time-picker')->name('time-picker');
    Route::view('datetimepicker', 'forms.datetimepicker')->name('datetimepicker');
    Route::view('daterangepicker', 'forms.daterangepicker')->name('daterangepicker');
    Route::view('touchspin', 'forms.touchspin')->name('touchspin');
    Route::view('select2', 'forms.select2')->name('select2');
    Route::view('switch', 'forms.switch')->name('switch');
    Route::view('typeahead', 'forms.typeahead')->name('typeahead');
    Route::view('clipboard', 'forms.clipboard')->name('clipboard');
    Route::view('default-form', 'forms.default-form')->name('default-form');
    Route::view('form-wizard', 'forms.form-wizard')->name('form-wizard');
    Route::view('form-two-wizard', 'forms.form-wizard-two')->name('form-wizard-two');
    Route::view('wizard-form-three', 'forms.form-wizard-three')->name('form-wizard-three');
    Route::post('form-wizard-three', function () {
        return redirect()->route('form-wizard-three');
    })->name('form-wizard-three-post');
});

Route::prefix('tables')->group(function () {
    Route::view('bootstrap-basic-table', 'tables.bootstrap-basic-table')->name('bootstrap-basic-table');
    Route::view('bootstrap-sizing-table', 'tables.bootstrap-sizing-table')->name('bootstrap-sizing-table');
    Route::view('bootstrap-border-table', 'tables.bootstrap-border-table')->name('bootstrap-border-table');
    Route::view('bootstrap-styling-table', 'tables.bootstrap-styling-table')->name('bootstrap-styling-table');
    Route::view('table-components', 'tables.table-components')->name('table-components');
    Route::view('datatable-basic-init', 'tables.datatable-basic-init')->name('datatable-basic-init');
    Route::view('datatable-advance', 'tables.datatable-advance')->name('datatable-advance');
    Route::view('datatable-styling', 'tables.datatable-styling')->name('datatable-styling');
    Route::view('datatable-ajax', 'tables.datatable-ajax')->name('datatable-ajax');
    Route::view('datatable-server-side', 'tables.datatable-server-side')->name('datatable-server-side');
    Route::view('datatable-plugin', 'tables.datatable-plugin')->name('datatable-plugin');
    Route::view('datatable-api', 'tables.datatable-api')->name('datatable-api');
    Route::view('datatable-data-source', 'tables.datatable-data-source')->name('datatable-data-source');
    Route::view('datatable-ext-autofill', 'tables.datatable-ext-autofill')->name('datatable-ext-autofill');
    Route::view('datatable-ext-basic-button', 'tables.datatable-ext-basic-button')->name('datatable-ext-basic-button');
    Route::view('datatable-ext-col-reorder', 'tables.datatable-ext-col-reorder')->name('datatable-ext-col-reorder');
    Route::view('datatable-ext-fixed-header', 'tables.datatable-ext-fixed-header')->name('datatable-ext-fixed-header');
    Route::view('datatable-ext-html-5-data-export', 'tables.datatable-ext-html-5-data-export')->name('datatable-ext-html-5-data-export');
    Route::view('datatable-ext-key-table', 'tables.datatable-ext-key-table')->name('datatable-ext-key-table');
    Route::view('datatable-ext-responsive', 'tables.datatable-ext-responsive')->name('datatable-ext-responsive');
    Route::view('datatable-ext-row-reorder', 'tables.datatable-ext-row-reorder')->name('datatable-ext-row-reorder');
    Route::view('datatable-ext-scroller', 'tables.datatable-ext-scroller')->name('datatable-ext-scroller');
    Route::view('jsgrid-table', 'tables.jsgrid-table')->name('jsgrid-table');
});

Route::prefix('charts')->group(function () {
    Route::view('echarts', 'charts.echarts')->name('echarts');
    Route::view('chart-apex', 'charts.chart-apex')->name('chart-apex');
    Route::view('chart-google', 'charts.chart-google')->name('chart-google');
    Route::view('chart-sparkline', 'charts.chart-sparkline')->name('chart-sparkline');
    Route::view('chart-flot', 'charts.chart-flot')->name('chart-flot');
    Route::view('chart-knob', 'charts.chart-knob')->name('chart-knob');
    Route::view('chart-morris', 'charts.chart-morris')->name('chart-morris');
    Route::view('chartjs', 'charts.chartjs')->name('chartjs');
    Route::view('chartist', 'charts.chartist')->name('chartist');
    Route::view('chart-peity', 'charts.chart-peity')->name('chart-peity');
});

Route::view('sample-page', 'pages.sample-page')->name('sample-page');
Route::view('internationalization', 'pages.internationalization')->name('internationalization');

// Route::prefix('starter-kit')->group(function () {
// });

Route::prefix('others')->group(function () {
    Route::view('400', 'errors.400')->name('error-400');
    Route::view('401', 'errors.401')->name('error-401');
    Route::view('403', 'errors.403')->name('error-403');
    Route::view('404', 'errors.404')->name('error-404');
    Route::view('500', 'errors.500')->name('error-500');
    Route::view('503', 'errors.503')->name('error-503');
});

// Route::prefix('authentication')->group(function () {
//     Route::view('login', 'authentication.login')->name('login');
//     Route::view('login-one', 'authentication.login-one')->name('login-one');
//     Route::view('login-two', 'authentication.login-two')->name('login-two');
//     Route::view('login-bs-validation', 'authentication.login-bs-validation')->name('login-bs-validation');
//     Route::view('login-bs-tt-validation', 'authentication.login-bs-tt-validation')->name('login-bs-tt-validation');
//     Route::view('login-sa-validation', 'authentication.login-sa-validation')->name('login-sa-validation');
//     Route::view('sign-up', 'authentication.sign-up')->name('sign-up');
//     Route::view('sign-up-one', 'authentication.sign-up-one')->name('sign-up-one');
//     Route::view('sign-up-two', 'authentication.sign-up-two')->name('sign-up-two');
//     Route::view('sign-up-wizard', 'authentication.sign-up-wizard')->name('sign-up-wizard');
//     Route::view('unlock', 'authentication.unlock')->name('unlock');
//     Route::view('forget-password', 'authentication.forget-password')->name('forget-password');
//     Route::view('reset-password', 'authentication.reset-password')->name('reset-password');
//     Route::view('maintenance', 'authentication.maintenance')->name('maintenance');
// });

Route::group(['prefix' => 'authentication'], function () {

    // Route::prefix('authentication')->group(function () {
    Route::get('login', [AuthenticatorController::class, 'AuthenticationMaster'])->name('login');
    Route::get('2fa', [AuthenticatorController::class, 'index'])->name('2fa.index')->middleware('auth');
    Route::post('2fa-store', [AuthenticatorController::class, 'store'])->name('2fa.post');
    Route::get('2fa/reset', [AuthenticatorController::class, 'resend'])->name('2fa.resend');
    // Route::get('2fa', [App\Http\Controllers\TwoFAController::class, 'index'])->name('2fa.index');
    // Route::post('2fa', [App\Http\Controllers\TwoFAController::class, 'store'])->name('2fa.post');
    // Route::get('2fa/reset', [App\Http\Controllers\TwoFAController::class, 'resend'])->name('2fa.resend');


    // Route::get('login', 'AuthenticatorController@AuthenticationMaster')->name('login');
    // Route::view('login', 'authentication.login')->name('login');
    // Route::view('login-one', 'authentication.login-one')->name('login-one');
    // Route::view('login-two', 'authentication.login-two')->name('login-two');
    // Route::view('login-bs-validation', 'authentication.login-bs-validation')->name('login-bs-validation');
    // Route::view('login-bs-tt-validation', 'authentication.login-bs-tt-validation')->name('login-bs-tt-validation');
    // Route::view('login-sa-validation', 'authentication.login-sa-validation')->name('login-sa-validation');
    // Route::view('sign-up', 'authentication.sign-up')->name('sign-up');
    // Route::view('sign-up-one', 'authentication.sign-up-one')->name('sign-up-one');
    // Route::view('sign-up-two', 'authentication.sign-up-two')->name('sign-up-two');
    // Route::view('sign-up-wizard', 'authentication.sign-up-wizard')->name('sign-up-wizard');
    // Route::view('unlock', 'authentication.unlock')->name('unlock');
    // Route::view('forget-password', 'authentication.forget-password')->name('forget-password');
    // Route::view('reset-password', 'authentication.reset-password')->name('reset-password');
    // Route::view('maintenance', 'authentication.maintenance')->name('maintenance');
});

Route::view('comingsoon', 'comingsoon.comingsoon')->name('comingsoon');
Route::view('comingsoon-bg-video', 'comingsoon.comingsoon-bg-video')->name('comingsoon-bg-video');
Route::view('comingsoon-bg-img', 'comingsoon.comingsoon-bg-img')->name('comingsoon-bg-img');

Route::view('basic-template', 'email-templates.basic-template')->name('basic-template');
Route::view('email-header', 'email-templates.email-header')->name('email-header');
Route::view('template-email', 'email-templates.template-email')->name('template-email');
Route::view('template-email-2', 'email-templates.template-email-2')->name('template-email-2');
Route::view('ecommerce-templates', 'email-templates.ecommerce-templates')->name('ecommerce-templates');
Route::view('email-order-success', 'email-templates.email-order-success')->name('email-order-success');


Route::prefix('gallery')->group(function () {
    Route::view('index', 'apps.gallery')->name('gallery');
    Route::view('with-gallery-description', 'apps.gallery-with-description')->name('gallery-with-description');
    Route::view('gallery-masonry', 'apps.gallery-masonry')->name('gallery-masonry');
    Route::view('masonry-gallery-with-disc', 'apps.masonry-gallery-with-disc')->name('masonry-gallery-with-disc');
    Route::view('gallery-hover', 'apps.gallery-hover')->name('gallery-hover');
});

Route::prefix('blog')->group(function () {
    Route::view('index', 'apps.blog')->name('blog');
    Route::view('blog-single', 'apps.blog-single')->name('blog-single');
    Route::view('add-post', 'apps.add-post')->name('add-post');
});


Route::view('faq', 'apps.faq')->name('faq');

Route::prefix('job-search')->group(function () {
    Route::view('job-cards-view', 'apps.job-cards-view')->name('job-cards-view');
    Route::view('job-list-view', 'apps.job-list-view')->name('job-list-view');
    Route::view('job-details', 'apps.job-details')->name('job-details');
    Route::view('job-apply', 'apps.job-apply')->name('job-apply');
});

Route::prefix('learning')->group(function () {
    Route::view('learning-list-view', 'apps.learning-list-view')->name('learning-list-view');
    Route::view('learning-detailed', 'apps.learning-detailed')->name('learning-detailed');
});

Route::prefix('maps')->group(function () {
    Route::view('map-js', 'apps.map-js')->name('map-js');
    Route::view('vector-map', 'apps.vector-map')->name('vector-map');
});

Route::prefix('editors')->group(function () {
    Route::view('summernote', 'apps.summernote')->name('summernote');
    Route::view('ckeditor', 'apps.ckeditor')->name('ckeditor');
    Route::view('simple-mde', 'apps.simple-mde')->name('simple-mde');
    Route::view('ace-code-editor', 'apps.ace-code-editor')->name('ace-code-editor');
});

Route::view('knowledgebase', 'apps.knowledgebase')->name('knowledgebase');
Route::view('support-ticket', 'apps.support-ticket')->name('support-ticket');
Route::view('landing-page', 'pages.landing-page')->name('landing-page');

Route::prefix('layouts')->group(function () {
    Route::view('compact-sidebar', 'admin_unique_layouts.compact-sidebar'); //default //Dubai
    Route::view('box-layout', 'admin_unique_layouts.box-layout');    //default //New York //
    Route::view('dark-sidebar', 'admin_unique_layouts.dark-sidebar');

    Route::view('default-body', 'admin_unique_layouts.default-body');
    Route::view('compact-wrap', 'admin_unique_layouts.compact-wrap');
    Route::view('enterprice-type', 'admin_unique_layouts.enterprice-type');

    Route::view('compact-small', 'admin_unique_layouts.compact-small');
    Route::view('advance-type', 'admin_unique_layouts.advance-type');
    Route::view('material-layout', 'admin_unique_layouts.material-layout');

    Route::view('color-sidebar', 'admin_unique_layouts.color-sidebar');
    Route::view('material-icon', 'admin_unique_layouts.material-icon');
    Route::view('modern-layout', 'admin_unique_layouts.modern-layout');
});

Route::get('layout-{light}', function ($light) {
    session()->put('layout', $light);
    session()->get('layout');
    if ($light == 'vertical-layout') {
        return redirect()->route('pages-vertical-layout');
    }
    return redirect()->route('index');
    return 1;
});
Route::get('/clear-cache', function () {
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "Cache is cleared";
})->name('clear.cache');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'LoadData'], function () {
    Route::post('/AgentLoadData', [App\Http\Controllers\DashboardController::class, 'AgentLoadData'])->name('agent.LoadData');
    Route::post('/ActivatorLoadData', [App\Http\Controllers\DashboardController::class, 'ActivatorLoadData'])->name('activator.LoadData');
    Route::post('/AdminLoadData', [App\Http\Controllers\DashboardController::class, 'AdminLoadData'])->name('admin.LoadData');
    Route::post('/VerificationLoadData', [App\Http\Controllers\DashboardController::class, 'VerificationLoadData'])->name('verification.LoadData');
    // Route::post('/LeadLoadData', [App\Http\Controllers\DashboardController::class, 'LeadLoadData'])->name('agent.LeadLoadData');
    Route::post('/ActivatorPreCheckData', [App\Http\Controllers\DashboardController::class, 'ActivatorPreCheckData'])->name('activator.PreCheckLeads');
    // Route::post('/VerificationPendingLead', [App\Http\Controllers\DashboardController::class, 'VerificationPendingLead'])->name('verification.PendingLeads');
    // Route::post('/ActivatorPreCheckData', [App\Http\Controllers\DashboardController::class, 'VerificationLoad'])->name('verification.PreCheckLeads');



});
Route::group(['prefix' => 'lead', 'middleware' => ['auth','2fa']], function () {
    Route::get('/add-data', [App\Http\Controllers\LeadController::class, 'AddDataHW'])->name('add-lead-data');
    // Route::post('/AdminLoadData', [App\Http\Controllers\DashboardController::class, 'AdminLoadData'])->name('admin.LoadData');
    Route::post('/LeadLoadData', [App\Http\Controllers\DashboardController::class, 'LeadLoadData'])->name('agent.LeadLoadData');
    Route::get('view-lead/{id}', [LeadController::class, 'ViewLead'])->name('view.lead');
    Route::post('ChatRequest', [LeadController::class, 'ChatRequest'])->name('chat.post');

});

Route::group(['prefix' => 'call','middleware'=>'auth'], function () {
    //    ROLE
    // Route::get('my-call-log', 'NumberController@my_call_log')->name('my_call_log')->middleware('auth');
    Route::get('fne-call-log-future', [NumberAssigner::class, 'fne_call_log_future'])->name('fne_call_log_future');
    Route::get('fne-call-log', [NumberAssigner::class, 'fne_call_log'])->name('fne_call_log');
    Route::get('used-fne-call-log', [NumberAssigner::class, 'used_fne_call_log'])->name('used_fne_call_log');
    Route::get('order-call-log', [NumberAssigner::class, 'order_call_log'])->name('order_call_log');
    Route::get('used-work-call-log', [NumberAssigner::class, 'used_work_call_log'])->name('used_work_call_log');

    Route::get('my-call-log-jee', [NumberAssigner::class, 'my_call_log_4g'])->name('my_call_log_4g');
    Route::get('my-call-log', [NumberAssigner::class, 'my_call_log'])->name('my_call_log');
    Route::get('tl-call-log', [NumberAssigner::class, 'tl_call_log'])->name('tl_call_log');
    Route::get('cancel-call-log', [NumberAssigner::class, 'cancel_call_log'])->name('cancel_call_log');
    Route::get('MyLogDashboard', [NumberAssigner::class, 'MyLogDashboard'])->name('MyLogDashboard');
    Route::get('MyLogDashboardExpired', [NumberAssigner::class, 'MyLogDashboardExpired'])->name('MyLogDashboardExpired');

    Route::get('my-call-log-expired', [NumberAssigner::class, 'my_call_log_expired'])->name('my_call_log_expired');

    Route::post('submit_feedback_number', [NumberAssigner::class, 'submit_feedback_number'])->name('number.feedback.submit');

    Route::post('submit_feedback_number_fne', [NumberAssigner::class, 'submit_feedback_number_fne'])->name('number.feedback.submit.fne');



    Route::post('submit_feedback_number_tl', [NumberAssigner::class, 'submit_feedback_number_tl'])->name('number.feedback.submit.tl');
    Route::post('loadmnpdatacc', [NumberAssigner::class, 'loadmnpdatacc'])->name('loadmnpdatacc');
    Route::get('call-table-data/{status}', [NumberAssigner::class, 'dashboard_status'])->name('mnp.status');
    Route::get('agent-log', [NumberAssigner::class, 'agent_mnp_log'])->name('agent_mnp_log');
    // Route::get('agent-log', [NumberAssigner::class, 'agent_mnp_log'])->name('agent_mnp_log');
    Route::get('FollowUpDashboard', [NumberAssigner::class, 'FollowUpDashboard'])->name('FollowUpDashboard');
    Route::get('add-dnc-number-agent', [ImportExcelController::class, 'dnc_add_number_agent'])->name('add.dnc.number.agent');
    Route::post('add-dnc', [ImportExcelController::class, 'submit_dnc_number'])->name('submit_dnc_number');
    // Route::get('/add-dnc-number-agent', 'ImportExcelController@dnc_add_number_agent')->name('add.dnc.number.agent')->middleware('auth');
    // Route::post('/add-dnc', 'NumberController@submit_dnc_number')->name('submit_dnc_number')->middleware('auth');
    // Route::get('/FollowUpDashboard', 'MNPDashboardController@admin_dashboard')->name('MNPDashboard')->middleware('auth');;

    // Route::get('/MNP-table-data/{status}', 'MNPDashboardController@dashboard_status')->name('mnp.status')->middleware('auth');;
    // Route::get('/agent-mnp-log', 'MNPDashboardController@agent_mnp_log')->name('agent_mnp_log')->middleware('auth');;


    //
    // Route::get('/MNP-Dashboard', 'MNPDashboardController@admin_dashboard')->name('MNPDashboard')->middleware('auth');;
    // Route::get('/MNP-user-Dashboard', 'MNPDashboardController@user_dashboard')->name('UserDashboard')->middleware('auth');;
    // Route::get('/MNP-table-data/{status}', 'MNPDashboardController@dashboard_status')->name('mnp.status')->middleware('auth');;

    // Route::get('/MasterMNPDashboard', 'MNPDashboardController@MasterMNPDashboard')->name('MasterMNPDashboard')->middleware('auth');;
    // Route::post('/mnp-admin-load', 'MNPDashboardController@mnploadajax')->name('mnpload.ajax')->middleware('auth');;
    // Route::get('/agent-mnp-log', 'MNPDashboardController@agent_mnp_log')->name('agent_mnp_log')->middleware('auth');;

    // Route::get('/MNPCallCenterData/{cc}', 'MNPDashboardController@mnpcallcenterdata')->name('mnpcallcenterdata')->middleware('auth');;
    // Route::post('/loadmnpdatacc', 'MNPDashboardController@loadmnpdatacc')->name('loadmnpdatacc')->middleware('auth');;
    //
});

Route::group(['prefix' => 'verification', 'middleware' => 'auth'], function () {
    Route::get('verification-lead/{id}', [\App\Http\Controllers\VerificationController::class, 'VerificationLead'])->name('verification.lead');
    Route::get('precheck-lead/{id}', [\App\Http\Controllers\VerificationController::class, 'PreCheckLead'])->name('precheck.lead');
    Route::post('verifyLead', [VerificationController::class, 'verifyLead'])->name('verifyLead');

});
Route::group(['prefix' => 'Uploader', 'middleware' => 'auth'], function () {
    Route::post('okprechecklead', [VerificationController::class, 'okprechecklead'])->name('okprechecklead');
    Route::post('RejectLeads', [VerificationController::class, 'RejectLeads'])->name('RejectLeads');



});
Route::group(['prefix' => 'Uploader', 'middleware' => 'auth'], function () {
    //    ROLE
    // Route::post('MyWhatsApp', 'Wha@MyWhatsApp')->name('my_call_log')->middleware('auth');
    // Route::get('/NumberAssignerManager', 'NumberAssigner@NumberAssignerManager')->name('NumberAssignerManager')->middleware('auth');

    Route::get('NumberAssignerManager', [NumberAssigner::class, 'NumberAssignerManager'])->name('NumberAssignerManager');
    Route::get('NumberAssignerManager4g', [NumberAssigner::class, 'NumberAssignerManager4g'])->name('NumberAssignerManager4g');
    Route::get('NumberAssignerManagerFNE', [NumberAssigner::class, 'NumberAssignerManagerFNE'])->name('NumberAssignerManagerFNE');
    Route::get('NumberAssignerManagerFNEFuture', [NumberAssigner::class, 'NumberAssignerManagerFNEFuture'])->name('NumberAssignerManagerFNEFuture');
    Route::get('NumberAssignerManagerReady', [NumberAssigner::class, 'NumberAssignerManagerReady'])->name('NumberAssignerManagerReady');
    Route::get('NumberAssignerUser', [NumberAssigner::class, 'NumberAssignerUser'])->name('NumberAssignerUser');
    Route::get('NumberAssignerUserFNE', [NumberAssigner::class, 'NumberAssignerUserFNE'])->name('NumberAssignerUserFNE');
    Route::get('NumberAssignerUserOrder', [NumberAssigner::class, 'NumberAssignerUserOrder'])->name('NumberAssignerUserOrder');
    Route::post('bulk_importer/assigner', [NumberAssigner::class, 'assigner'])->name('bulk.assigner');
    Route::post('bulk_importer/assignerfne', [NumberAssigner::class, 'assignerfne'])->name('bulk.assigner.fne');
    Route::post('bulk_importer/assigner-user', [NumberAssigner::class, 'assigner_user'])->name('bulk.assigner.user');
    Route::post('bulk_importer/assigner-user-fne', [NumberAssigner::class, 'assigner_user_fne'])->name('bulk.assigner.user.fne');
    // Route::post('/bulk_importer/assigner', 'NumberAssigner@assigner')->name('bulk.assigner')->middleware('auth');
    // Route::post('/bulk_importer/assigner-user', 'NumberAssigner@assigner_user')->name('bulk.assigner.user')->middleware('auth');
    // Route::get('MyLogDashboard', [NumberAssigner::class, 'my_call_log'])->name('my_call_log');
    // Route::post('submit_feedback_number', [NumberAssigner::class, 'submit_feedback_number'])->name('number.feedback.submit');
    Route::post('GiveMeNewNumber', [NumberAssigner::class, 'GiveMeNewNumber'])->name('GiveMeNewNumber');
    Route::post('ClearDuplicate', [NumberAssigner::class, 'ClearDuplicate'])->name('ClearDuplicate');
    Route::post('GiveMeNewNumber4g', [NumberAssigner::class, 'GiveMeNewNumber4g'])->name('GiveMeNewNumber4g');
    Route::post('ClearDuplicate4g', [NumberAssigner::class, 'ClearDuplicate4g'])->name('ClearDuplicate4g');
    Route::get('ClearDuplicatefne', [NumberAssigner::class, 'ClearDuplicatefne'])->name('ClearDuplicatefne');
});



Route::get('ScanWhatsApp', [FunctionController::class, 'ScanWhatsApp'])->name('ScanWhatsApp');
Route::get('TransferNumber', [NumberAssigner::class, 'TransferNumber'])->name('TransferNumber');
Route::get('ImportExcel', [ImportExcelController::class, 'ImportExcel'])->name('ImportExcel');
Route::post('import', [ImportExcelController::class, 'import'])->name('import.excel');
Route::get('ImportExcel4g', [ImportExcelController::class, 'ImportExcel4g'])->name('ImportExcel4g');
Route::post('import4g', [ImportExcelController::class, 'import4g'])->name('import.excel4g');
//
Route::get('ImportExcelEti', [ImportExcelController::class, 'ImportExcelEti'])->name('ImportExcelEti');
Route::post('importEti', [ImportExcelController::class, 'importEti'])->name('import.excel.eti');

//
Route::get('SendTemplateWhatsApp', [ImportExcelController::class, 'SendTemplateWhatsApp'])->name('SendTemplateWhatsApp');
Route::post('SendTemplateWhatsAppSubmit', [ImportExcelController::class, 'SendTemplateWhatsAppSubmit'])->name('SendTemplateWhatsAppSubmit');
//
Route::get('ImportExcelCMID', [ImportExcelController::class, 'ImportExcelCMID'])->name('ImportExcelCMID');
Route::post('importCMID', [ImportExcelController::class, 'importCMID'])->name('import.excel.cmid');
//
Route::get('ImportExcelFNE', [ImportExcelController::class, 'ImportExcelFNE'])->name('ImportExcelFNE');
Route::post('importFNE', [ImportExcelController::class, 'importFNE'])->name('import.excelFNE');



Route::get('test', [TestController::class, 'Test'])->name('Test');




Route::post('CheckLogInfo', [FunctionController::class, 'CheckLogInfo'])->name('CheckLogInfo');

Route::post('home-wifi-submit', [LeadController::class, 'HomeWifiSubmit'])->name('HomeWifiSubmit');
Route::post('home-wifi-submit-verified', [LeadController::class, 'HomeWifiSubmitWhatsApp'])->name('HomeWifiSubmitWhatsApp');

Route::post('PlanChange', [FunctionController::class, 'PlanChange'])->name('PlanChange');
Route::post('PlanCheck', [FunctionController::class, 'PlanCheck'])->name('PlanCheck');
Route::post('UnMaskNumber', [FunctionController::class, 'UnMaskNumber'])->name('UnMaskNumber');
