<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\IndexController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AgentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\VisitedController;
use PhpOffice\PhpSpreadsheet\Shared\OLE\PPS\Root;
use App\Http\Controllers\Admin\ActualityController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\ReseauDistController;
use App\Http\Controllers\Admin\TemoignageController;
use App\Http\Controllers\EspaceClient\RdvController;
use App\Http\Controllers\Admin\FormuleProdController;
use App\Http\Controllers\Admin\SouscritionController;
use App\Http\Controllers\Sinistre\SinistreController;
use App\Http\Controllers\Admin\ReseauInterneController;
use App\Http\Controllers\EspaceClient\CustomerController;
use App\Http\Controllers\EspaceClient\CustomerLoginController;
use App\Http\Controllers\EspaceClient\DemandePrestationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware('guest:web', 'PreventBackHistory')->group(function(){
    // Admin auth routes
    Route::get('admin/showLoginForm', [AdminLoginController::class, 'showLoginForm'])->name('Admin.showLoginForm');
    Route::post('admin/login', [AdminLoginController::class, 'login'])->name('Admin.Login');
    
    // admin customer visited routes
    Route::post('admin/isVisited',[VisitedController::class, 'visitedByCustomer'])->name('admin.isVisited');
    
    // User routes
    Route::get('/',[IndexController::class, 'index'])->name('index');
    Route::get('home/about',[IndexController::class, 'about'])->name('home.about');

    // home reseau routes
    Route::get('home/reseau',[IndexController::class, 'reseau'])->name('home.reseau');
    Route::get('/get-reseaux', [IndexController::class, 'getReseaux']);

    // home product routes
    Route::get('home/products',[IndexController::class, 'all_products'])->name('home.all_products');
    Route::get('home/reseaux/products/{uuid}',[IndexController::class, 'products'])->name('home.reseaux.products');
    Route::get('home/products/formule_product/details/{uuid}',[IndexController::class, 'product_details'])->name('home.formule_product.details');

    //home actuality routes
    Route::get('home/actuality/',[IndexController::class, 'actuality'])->name('home.actuality');
    Route::get('home/actuality-by-product/{product_uuid}',[IndexController::class, 'actualityByProduct'])->name('home.actuality.actualityByProduct');
    Route::get('home/actuality/details/{uuid}',[IndexController::class, 'actuality_details'])->name('home.actuality.details');


    //home actuality comment routes
    Route::post('home/actuality/comment/add',[ActualityController::class, 'comment_store'])->name('home.actuality.comment_store');



    Route::get('home/assistance',[IndexController::class, 'assistance'])->name('home.assistance');

    Route::post('/admin/mail/newsletter/store',[SouscritionController::class,'newsletterStore'])->name('admin.newsletterStore.store');
    Route::get('/admin/mail/mail',[SouscritionController::class,'mail'])->name('admin.mail');

    Route::post('admin/mail/add',[SouscritionController::class,'store'])->name('admin.subscription.store');

    Route::post('admin/home/assistance/addCourrier',[AdminController::class, 'assistanceStore'])->name('admin.assistance.addCourrier');
    Route::post('admin/home/assistance/deleteCourrier/{uuid}',[AdminController::class, 'assistanceDestroy'])->name('admin.assistance.deleteCourrier');


    Route::get('admin/product/test',[ProductController::class, 'test'])->name('admin.test');

});

Route::get('home/invitation',[IndexController::class, 'invitation'])->name('invitation');

Route::middleware('auth:web', 'PreventBackHistory')->group(function(){
    
    Route::get('/admin',[AdminController::class, 'index'])->name('index.dashboard');
    
    Route::post('admin/logout', [AdminLoginController::class, 'logout'])->name('Admin.logout');
    // Admin routes
    Route::get('/admin/home/accueil',[AdminController::class, 'accueil'])->name('admin.accueil');
    Route::get('/admin/home/about',[AdminController::class, 'about'])->name('admin.about');
    Route::post('/admin/home/about/{uuid}',[AdminController::class, 'aboutUpdate'])->name('admin.about.aboutUpdate');
    Route::post('/admin/home/about/teams/add',[AdminController::class, 'AddTeam'])->name('admin.about.AddTeam');
    Route::post('/admin/home/about/teams/update/{uuid}',[AdminController::class, 'updateTeam'])->name('admin.about.updateTeam');
    Route::get('/admin/home/reseau',[AdminController::class, 'reseau'])->name('admin.reseau');

    Route::get('admin/home/assistance',[AdminController::class, 'assistance'])->name('admin.assistance');

    // admin Product routes
    Route::get('admin/product/list',[ProductController::class, 'index'])->name('admin.product_list');
    Route::post('admin/product/add',[ProductController::class, 'store'])->name('admin.product.store');
    Route::get('admin/product/show/{uuid}',[ProductController::class, 'show'])->name('admin.product.show');
    Route::post('admin/product/update/{uuid}',[ProductController::class, 'update'])->name('admin.product.update');
    Route::post('admin/product/destroy/{uuid}',[ProductController::class, 'destroy'])->name('admin.product.destroy');

    // admin reseau_distribution routes
    Route::get('admin/product/reseau_distribution',[ReseauDistController::class, 'index'])->name('admin.reseau_distribution');
    Route::post('admin/product/reseau_distribution/add', [ReseauDistController::class, 'store'])->name('products.reseau_dist.store');
    Route::get('admin/product/reseau_distribution/show/{uuid}', [ReseauDistController::class, 'show'])->name('products.reseau_dist.show');
    Route::post('admin/product/reseau_distribution/update/{uuid}', [ReseauDistController::class, 'update'])->name('products.reseau_dist.update');
    Route::post('admin/product/reseau_distribution/destroy/{uuid}', [ReseauDistController::class, 'destroy'])->name('products.reseau_dist.destroy');
    Route::post('admin/product/remove/reseau/{uuid}', [ReseauDistController::class, 'removeProdInReseau'])->name('products.removeProdInReseau');



    // admin formule_product routes
    Route::get('admin/product/product_formul',[FormuleProdController::class, 'index'])->name('admin.product_formul');
    Route::post('admin/product/product_formul/add',[FormuleProdController::class, 'store'])->name('admin.prod_formul.store');
    Route::get('admin/product/product_formul/show/{uuid}',[FormuleProdController::class, 'show'])->name('admin.prod_formul.show');
    Route::post('admin/product/product_formul/update/{uuid}',[FormuleProdController::class, 'update'])->name('admin.prod_formul.update');
    Route::post('admin/product/product_formul/destroy/{uuid}',[FormuleProdController::class, 'destroy'])->name('admin.prod_formul.destroy');

    // admin soscription routes
    Route::get('admin/mail',[SouscritionController::class,'index'])->name('admin.subscription');

    Route::get('/admin/mail/presous/show/{uuid}',[SouscritionController::class,'showpreSouscription'])->name('admin.subscription.show');
    Route::get('/admin/mail/showContact/show/{uuid}',[SouscritionController::class,'showContact'])->name('admin.subscription.show');


    Route::get('/admin/mail/newsletter',[SouscritionController::class,'newsletter'])->name('admin.newsletter');

    Route::post('admin/product/subscription/approuvedMessage/{uuid}',[SouscritionController::class,'approuvedMessage'])->name('admin.subscription.approuvedMessage');
    Route::post('admin/product/subscription/dismissMessage/{uuid}',[SouscritionController::class,'dismissMessage'])->name('admin.subscription.dismissMessage');
    Route::post('admin/product/subscription/destroy/{uuid}',[SouscritionController::class,'destroy'])->name('admin.subscription.destroy');


    // admin temoignage routes
    Route::get('admin/temoignage',[TemoignageController::class, 'index'])->name('admin.temoignage');
    Route::post('admin/temoignage/add',[TemoignageController::class, 'store'])->name('admin.temoignage.store');
    Route::get('admin/temoignage/show/{uuid}',[TemoignageController::class, 'show'])->name('admin.temoignage.show');
    Route::post('admin/temoignage/update/{uuid}',[TemoignageController::class, 'update'])->name('admin.temoignage.update');
    Route::post('admin/temoignage/destroy/{uuid}',[TemoignageController::class, 'destroy'])->name('admin.temoignage.destroy');



    // admin actuality routes
    Route::get('admin/actuality',[ActualityController::class, 'index'])->name('admin.actuality');
    Route::post('admin/actuality/add',[ActualityController::class, 'store'])->name('admin.actuality.store');
    Route::get('admin/actuality/show/{uuid}',[ActualityController::class,'show'])->name('admin.actuality.show');
    Route::post('admin/actuality/update/{uuid}',[ActualityController::class,'update'])->name('admin.actuality.update');
    Route::post('admin/actuality/destroy/{uuid}',[ActualityController::class,'destroy'])->name('admin.actuality.destroy');

    Route::post('admin/DeleteImgByActuality/{uuid}',[ActualityController::class,'DeleteImgByActuality'])->name('admin.ImgByActuality.delete');


    Route::get('admin/reseau_interne',[ReseauInterneController::class, 'index'])->name('admin.reseau_interne');
    Route::post('admin/reseau_interne/add',[ReseauInterneController::class, 'store'])->name('admin.reseau_interne.store');
    Route::get('admin/reseau_interne/show/{uuid}',[ReseauInterneController::class,'show'])->name('admin.reseau_interne.show');
    Route::post('admin/reseau_interne/update/{uuid}',[ReseauInterneController::class,'update'])->name('admin.reseau_interne.update');
    Route::post('admin/reseau_interne/destroy/{uuid}',[ReseauInterneController::class,'destroy'])->name('admin.reseau_interne.destroy');

    // admin actuality comment routes
    Route::get('admin/actuality/comment/show',[ActualityController::class, 'comment_view'])->name('admin.actuality.comment_show');
    Route::post('admin/actuality/comment/approved/{uuid}',[ActualityController::class, 'comment_approved'])->name('admin.actuality.comment_approved');
    Route::post('admin/actuality/comment/destroy/{uuid}',[ActualityController::class, 'comment_destroy'])->name('admin.actuality.comment_destroy');

    // admin agent routes
    Route::get('admin/agent',[AgentController::class, 'index'])->name('admin.agent');
    Route::post('admin/agent/add',[AgentController::class, 'store'])->name('admin.agent.store');
    Route::get('admin/agent/show/{uuid}',[AgentController::class,'show'])->name('admin.agent.show');
    Route::post('admin/agent/update/{uuid}',[AgentController::class,'update'])->name('admin.agent.update');
    Route::post('admin/agent/destroy/{uuid}',[AgentController::class,'destroy'])->name('admin.agent.destroy');

    Route::get('admin/typePrestation',[DemandePrestationController::class, 'typePrestation'])->name('customer.typePrestation');
    Route::post('admin/typePrestation/add',[DemandePrestationController::class, 'typePrestationAdd'])->name('customer.typePrestation.add');
    // Route::get('Admin/typePrestation/show/{uuid}',[DemandePrestationController::class, 'typePrestationShow'])->name('typePrestation.show');
    Route::post('admin/typePrestation/update/{uuid}',[DemandePrestationController::class, 'typePrestationUpdate'])->name('customer.typePrestation.update');
    Route::post('admin/typePrestation/destroy/{uuid}',[DemandePrestationController::class, 'typePrestationDestroy'])->name('customer.typePrestation.destroy');

    

});
Route::prefix('settings')->name('setting.')->group(function(){
    Route::middleware('auth:web','PreventBackHistory')->group(function(){
    // management users routes
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::post('/users-store', [UserController::class, 'store'])->name('users.store');
    Route::post('/users-update/{uuid}', [UserController::class, 'update'])->name('users.update');
    Route::post('/users-destroy/{uuid}', [UserController::class, 'destroy'])->name('users.destroy');

    // Role Permission
    Route::get('/role', [RoleController::class, 'index'])->name('role');
    Route::post('/role-create', [RoleController::class, 'store'])->name('role.store');
    Route::post('/role-edit/{id}', [RoleController::class, 'update'])->name('role.edit');
    Route::post('/role-destroy/{id}', [RoleController::class, 'destroy'])->name('role.destroy');
    Route::get('/permission/{id}', [RoleController::class, 'permission'])->name('permission');
    Route::post('/permission-create', [RoleController::class, 'permissionStore'])->name('permission.store');
    Route::post('/group-create', [RoleController::class, 'groupStore'])->name('group.store');

    Route::post('/role-permission/{id}', [RoleController::class, 'rolePermissionSave'])->name('permission.save');

    });
    
});

// customer routes
# la route "simple-qrcode"
Route::get('prestation/getInfoPrestation/{id}', [DemandePrestationController::class, 'getInfoPrestation'])->name('getInfoPrestation');
Route::get('sinistre/getInfoSinistre/{id}', [SinistreController::class, 'getInfoSinistre'])->name('getInfoSinistre');

Route::get('storage/prestations/{file}', function ($file) {
    $path = base_path(env('UPLOAD_PRESTATION_FILE') . $file);

    if (!file_exists($path)) {
        abort(404);
    }

    $fileContents = file_get_contents($path);
    $mimeType = mime_content_type($path);

    return Response::make($fileContents, 200, ['Content-Type' => $mimeType]);
    
})->where('file', '.*');

Route::get('storage/sinistre/{file}', function ($file) {
    $path = base_path(env('UPLOAD_SINISTRE_FILE') . $file);

    if (!file_exists($path)) {
        abort(404);
    }

    $fileContents = file_get_contents($path);
    $mimeType = mime_content_type($path);

    return Response::make($fileContents, 200, ['Content-Type' => $mimeType]);
    
})->where('file', '.*');


Route::get('get-police/{file}', function ($file) {
    $path = base_path(env('GET_CUSTOMER_CP') . $file);

    if (!file_exists($path)) {
        abort(404);
    }

    $fileContents = file_get_contents($path);
    $mimeType = mime_content_type($path);

    return Response::make($fileContents, 200, ['Content-Type' => $mimeType]);
    
})->where('file', '.*');

Route::get('storage/demande_comptes/{file}', function ($file) {
    $path = base_path(env('UPLOAD_DEMANDE_COMPTE_FILE') . $file);

    if (!file_exists($path)) {
        abort(404);
    }

    $fileContents = file_get_contents($path);
    $mimeType = mime_content_type($path);

    return Response::make($fileContents, 200, ['Content-Type' => $mimeType]);
    
})->where('file', '.*');

Route::post('/etat-cotisation/clear-folder', [CustomerController::class, 'clearEtatCotisationFolder'])->name('etatCotisation.clearFolder');

Route::prefix('espace-client', 'PreventBackHistory')->name('customer.')->group(function(){
    Route::middleware(['guest:customer', 'PreventBackHistory'])->group(function(){
        // customer Login routes
        Route::get('/loginForm',[CustomerLoginController::class, 'showLoginForm'])->name('loginForm');
        Route::post('login',[CustomerLoginController::class,'login'])->name('login');
        Route::post('loginByUrl', [CustomerLoginController::class, 'loginByUrl'])->name('loginByUrl');
        Route::get('/csrf-token', function () {
            return response()->json(['token' => csrf_token()]);
        });     
        
        // customer register routes
        Route::get('/registerForm',[CustomerLoginController::class,'create'])->name('registerForm');
        Route::get('/registerMail',[CustomerLoginController::class,'registerMail'])->name('registerMail');
        Route::post('register',[CustomerLoginController::class,'register'])->name('register');
        Route::get('/registerForm/addContrat/{id}',[CustomerLoginController::class,'createAddContrat'])->name('registerForm.addContrat');
        Route::post('/register/addContrat',[CustomerLoginController::class,'AddContrat'])->name('register.addContrat');
        Route::post('/register/demandeCompte',[CustomerLoginController::class,'demandeCompte'])->name('register.demandeCompte');

        // customer update compte routes
        Route::post('updateCompte/',[CustomerLoginController::class,'updateCompte'])->name('updateCompte');
        
        // customer reset password routes
        Route::post('/reinitialiser-password',[CustomerLoginController::class,'resetPassFirstLogin'])->name('resetPassFirstLogin');
        Route::post('/reset-password-send-mail',[CustomerLoginController::class,'resetPassSendMail'])->name('resetPassSendMail');
        Route::get('/reset-password-form/{token}',[CustomerLoginController::class,'resetPassForm'])->name('resetPassForm');
        Route::post('/reset-password/{token}',[CustomerLoginController::class,'resetPass'])->name('resetPass');
        Route::post('/destroyToken',[CustomerLoginController::class,'destroyToken'])->name('destroyToken');
        
        Route::post('/getcustomer',[CustomerLoginController::class, 'getcustomer'])->name('getcustomer');

        // // customer forgot password routes
        // Route::get('/mot-de-passe-oublie',[CustomerForgotPasswordController::class, 'forgot'])->name('customer.forgot');
        // Route::post('/mot-de-passe-oublie',[CustomerForgotPasswordController::class,'sendResetLinkEmail'])->name('customer.forgot.sendResetLinkEmail');
        // Route::get('/mot-de-passe-oublie/reinitialiser/{token}',[CustomerResetPasswordController::class,'reset'])->name('customer.reset');
        // Route::post('/mot-de-passe-oublie/reinitialiser/{token}',[CustomerResetPasswordController::class,'reset'])->name('customer.reset.post');

        // customer impor
        Route::post('/import-customers', [CustomerLoginController::class, 'import'])->name('import');
        Route::post('/import-customers-cp', [CustomerLoginController::class, 'importCP'])->name('import.cp');
        Route::post('/auto-import-cp', [CustomerLoginController::class, 'autoImportCP'])->name('auto.import.cp');
        


        Route::post('/clear-contract-session', function () {
            Session::forget('contractDetails');
            return response()->json(['message' => 'Session cleared']);
        })->name('clear.contractDetails.session');
    });

    

    Route::middleware('auth:customer', 'PreventBackHistory')->group(function(){
        // Route::post('api/fetch-contract-details', [CustomerController::class, 'fetchContractDetails'])->name('fetch.contract.details');
        Route::get('accueil',[CustomerController::class, 'index'])->name('dashboard');
        Route::post('accueil/addContrat',[CustomerController::class, 'AddContratByAuthCustomer'])->name('dashboard.addContrat');
        Route::get('etat-cotisation/',[CustomerController::class, 'etatCotisation'])->name('etatCotisation');
        Route::get('police/',[CustomerController::class, 'police'])->name('police');
        Route::post('get-police/',[CustomerController::class, 'getPolice'])->name('police.get');
        Route::post('generate-etat-cotisation/',[CustomerController::class, 'generateEtatCotisation'])->name('cotisation.etat');
        Route::post('logout',[CustomerLoginController::class, 'logout'])->name('logout');

        // customer prestation routes
        Route::get('prestation',[DemandePrestationController::class, 'index'])->name('prestation');
        Route::post('/fetch-contract-details', [DemandePrestationController::class, 'fetchContractDetails'])->name('fetch.contract.Details');
        Route::get('prestation/selectPrestation',[DemandePrestationController::class, 'selectPrestation'])->name('selectPrestation');
        Route::get('prestation/reprise-demande',[DemandePrestationController::class, 'repriseDemande'])->name('repriseDemande');
        Route::post('prestation/verif-code-demande',[DemandePrestationController::class, 'verifCodeDemande'])->name('verifCodeDemande');
        Route::get('prestation/mesPrestations', [DemandePrestationController::class, 'mesPrestations'])->name('mesPrestations');
        Route::get('prestation/print-fiche-prestation/', [DemandePrestationController::class, 'printFichePrestation'])->name('printFichePrestation');
        Route::post('prestation/DemandePrestationByDashboard/', [DemandePrestationController::class, 'DemandePrestation'])->name('DemandePrestation');
        
        // Route::post('prestation/getPrestations', [DemandePrestationController::class, 'getPrestations'])->name('getPrestations');
        // Route::post('prestation/mesPrestations', [DemandePrestationController::class, 'mesPrestations'])->name('mesPrestations');
        Route::get('prestation/create/{id}',[DemandePrestationController::class, 'create'])->name('prestation.create');
        Route::get('prestation/autre/{id}',[DemandePrestationController::class, 'createAutre'])->name('prestation.autre');
        Route::post('prestation/autre/add',[DemandePrestationController::class, 'storePrestAutre'])->name('prestation.storePrestAutre');
        Route::get('details-prestation/{code}',[DemandePrestationController::class, 'show'])->name('prestation.show');
        Route::post('prestation/add',[DemandePrestationController::class, 'store'])->name('prestation.store');
        Route::get('prestation/modifier-apres-rejet/{code}',[DemandePrestationController::class, 'editAfterRejet'])->name('prestation.editAfterRejet');
        Route::get('prestation/edit/{code}',[DemandePrestationController::class, 'edit'])->name('prestation.edit');
        Route::post('prestation/transmettrePrest/{code}',[DemandePrestationController::class, 'transmettrePrest'])->name('prestation.transmettrePrest');
        Route::post('prestation/update/{code}',[DemandePrestationController::class, 'update'])->name('prestation.update');
        Route::post('prestation/destroy/{code}',[DemandePrestationController::class, 'destroy'])->name('prestation.destroy');
        Route::post('prestation/addDocPrest',[DemandePrestationController::class, 'addDocPrest'])->name('prestation.add.docPrest');
        Route::post('prestation/destroyDoc/{id}',[DemandePrestationController::class, 'destroyDoc'])->name('prestation.destroyDoc');

        // customer rdv routes
        Route::get('rdv',[RdvController::class, 'index'])->name('rdv');
        Route::get('rdv/create/{id}',[RdvController::class, 'create'])->name('rdv.create');
        Route::get('rdv/selectPrestation',[RdvController::class, 'selectPrestation'])->name('rdv.selectPrestation');
        Route::get('rdv/mesRdv/',[RdvController::class, 'mesRdv'])->name('rdv.mesRdv');
        Route::get('/rdv/optionDate/{id}', [RdvController::class, 'getOptionRdv'])->name('rdv.optionDate');
        // Route::get('rdv/getRdvDate/{id}/{dateRdv}',[RdvController::class, 'getOptionRdv'])->name('rdv.optionDate');
        Route::get('/rdv/getRdv', [RdvController::class, 'getRdvByDate'])->name('rdv.getRdv');


        Route::post('rdv/add',[RdvController::class, 'store'])->name('rdv.store');

         
    });
});

Route::prefix('sinistre', 'PreventBackHistory')->name('sinistre.')->group(function(){
    Route::middleware('guest:web', 'PreventBackHistory')->group(function(){
        // Route::post('api/checkContrat', [SinistreController::class, 'checkContrat'])->name('checkContrat');
        Route::get('/', [SinistreController::class, 'index'])->name('index');
        Route::get('/new', [SinistreController::class, 'newSinistre'])->name('newSinistre');
        Route::get('/history', [SinistreController::class, 'historySinistre'])->name('historySinistre');
        Route::post('/getContratAssures', [SinistreController::class, 'getContratAssures'])->name('getContratAssures');
        Route::get('/create', [SinistreController::class, 'create'])->name('create');
        Route::post('/store', [SinistreController::class, 'store'])->name('store');
        Route::get('show/{code}', [SinistreController::class, 'show'])->name('show');
        Route::get('/edit/{code}', [SinistreController::class, 'edit'])->name('edit');
        Route::post('/update/{code}', [SinistreController::class, 'update'])->name('update');
        Route::post('/destroy/{code}', [SinistreController::class, 'destroy'])->name('destroy');
        Route::post('/addDoc', [SinistreController::class, 'addDocSinistre'])->name('addDoc');
        Route::post('/destroyDoc/{id}', [SinistreController::class, 'destroyDoc'])->name('destroyDoc');
        Route::post('/transmettreSinistre/{code}', [SinistreController::class, 'transmettreSinistre'])->name('transmettreSinistre');
    });
});

Route::get('/test', [DemandePrestationController::class, 'testSign'])->name('test.sign');


Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


