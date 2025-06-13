<?php

namespace App\Http\Controllers\EspaceClient;

use Carbon\Carbon;
use App\Models\Membre;
use App\Models\Customer;
use App\Models\TblVille;
use App\Models\TblCustomer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\MembreContrat;
use App\Models\passwordResset;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Imports\CustomersImport;
use App\Jobs\ResetRememberToken;
use App\Mail\UserRegisteredMail;
use App\Models\TblDemandeCompte;
use App\Models\TblDocPrestation;

use App\Models\TblCreationCompte;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use function Laravel\Prompts\password;

class CustomerLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showLoginForm()
    {
        // $customer = TblCustomer::select('login', 'activer', 'estajour', 'isFirstLog', 'memberok')->where('login','john')->first();
        // dd($customer);
        $villes = TblVille::all();
        return view('users.espace_client.auth.login', compact('villes'));
    }

    public function getcustomer(Request $request)
    {
        $login = $request->login;
        // $customer = TblCustomer::select('login', 'activer', 'estajour', 'isFirstLog', 'memberok')->where('login', $login)->with('membre')->first();
        $customer = TblCustomer::where('login', $login)->orWhere('old_login', $login)->with('membre')->first();
        $prospere = TblCreationCompte::select('login', 'email', 'cel', 'idCustomer', 'estClient')->where('login', $login)->first();

        if ($customer || $prospere) {
            return response()->json([
                'status' => 'found',
                'customer' => $customer,
                'prospere' => $prospere
            ]);
        } else {
            return response()->json([
                'status' => 'not_found'
            ]);
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $villes = TblVille::all();
        return view('users.espace_client.auth.register', compact('villes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function login(Request $request)
    {

        $input = $request->all();
        $this->validate(
            $request,
            [
                'login' => 'required',
                'password' => 'required',
                'type' => 'required',
            ]
        );


        // $type = $request->input('type');
        // // Récupérer l'utilisateur en fonction du champ 'login'
        // $customer = Customer::where('login', $input['login'])->first();
        // // Tentative d'authentification avec 'login' et 'pass'
        // if (Auth::guard('customer')->attempt(['login' => $input['login'], 'password' => $input['password']])) {
        //     return redirect()->route('customer.dashboard');
        // }
        $customer = TblCustomer::where('login', $input['login'])->orWhere('old_login', $input['login'])->first();
        $prospere = TblCreationCompte::where('login', $input['login'])->first();
        $membre = Membre::where('login', $input['login'])->first();

        if ($prospere && $prospere->estClient == 0) {
            if ($prospere->password === $input['password']) {
                
                session(['customerData' => $prospere->id]);
                return redirect()->route('customer.registerForm.addContrat', ['id' => $prospere->id]);
            }else{
                return redirect()->route('customer.loginForm')->with('fail', 'Nom d\'utilisateur ou mot de passe incorrect.');
            }
        }else if ($prospere && $prospere->estClient == 1 || $prospere == null) {
            
            // Vérifier si l'utilisateur existe
            if ($customer) {
                // Vérifier si le mot de passe est haché ou non (Bcrypt)
                if (Hash::needsRehash($customer->password)) {
                    // Si le mot de passe n'est pas haché (ou nécessite un nouveau hachage), comparer directement avec le mot de passe en texte clair
                    if ($customer->password === $input['password'] && $customer->memberok == 1) {
                        // Le mot de passe n'est pas haché, le hacher après une authentification réussie
                        $customer->password = Hash::make($input['password']);
                        // $customer->isFirstLog = 1;
                        $customer->save();
                        if ($membre) {
    
                            $membre->pass = Hash::make($input['password']);
                            $membre->save();
                        }
    
                        // Authentifier l'utilisateur
                        Auth::guard('customer')->login($customer);
                        if ($input['type'] == 'RendezVous') {
                            return redirect()->route('customer.rdv');
                        } else if ($input['type'] == 'Prestation') {
                            return redirect()->route('customer.prestation');
                        } else {
                            return redirect()->route('customer.dashboard');
                        }
                    } else {
                        // Si le mot de passe ne correspond pas
                        return redirect()->route('customer.loginForm')->with('fail', 'Nom d\'utilisateur ou mot de passe incorrect.');
                    }
                } else {
                    // Si le mot de passe est déjà haché, utiliser Hash::check
                    if (Hash::check($input['password'], $customer->password)) {
                        // Connexion réussie si le mot de passe est haché
                        Auth::guard('customer')->login($customer);
                        if ($input['type'] == 'RendezVous') {
                            return redirect()->route('customer.rdv');
                        } else if ($input['type'] == 'Prestation') {
                            return redirect()->route('customer.prestation');
                        } else {
                            return redirect()->route('customer.dashboard');
                        }
                    } else {
                        // Si le mot de passe haché ne correspond pas
                        return redirect()->route('customer.loginForm')->with('fail', 'Nom d\'utilisateur ou mot de passe incorrect.');
                    }
                }
            } else {
                // Si l'utilisateur n'existe pas
                return redirect()->route('customer.loginForm')->with('fail', 'Utilisateur non trouvé.');
            }
        }

    }
    public function loginByUrl(Request $request)
    {
        $login = $request->input('login');
        $password = $request->input('password');
        $type = $request->input('type');

        // Récupérer le client à partir de la base de données
        $customer = TblCustomer::where('login', $login)->orWhere('old_login', $login)->first();
        $membre = Membre::where('login', $login)->first();

        if ($customer) {
            // Vérifiez si le mot de passe est haché ou non
            if (Hash::needsRehash($customer->password)) {
                // Si le mot de passe n'est pas haché
                if ($customer->password === $password) {
                    // Hacher le mot de passe après la connexion
                    $customer->password = Hash::make($password);
                    $customer->save();

                    if ($membre) {
                        $membre->pass = Hash::make($password);
                        $membre->save();
                    }

                    // Authentifier l'utilisateur
                    Auth::guard('customer')->login($customer);
                    if ($type == 'RendezVous') {
                        return redirect()->route('customer.rdv');
                    } else if ($type == 'Prestation') {
                        return redirect()->route('customer.prestation');
                    }
                } else {
                    return redirect()->route('customer.loginForm')
                        ->with('fail', 'Nom d\'utilisateur ou mot de passe incorrect.');
                }
            } else {
                // Vérifiez si le mot de passe haché est correct
                if (Hash::check($password, $customer->password)) {
                    Auth::guard('customer')->login($customer);
                    if ($type == 'RendezVous') {
                        return redirect()->route('customer.rdv');
                    } else if ($type == 'Prestation') {
                        return redirect()->route('customer.prestation');
                    }
                } else {
                    return redirect()->route('customer.loginForm')
                        ->with('fail', 'Nom d\'utilisateur ou mot de passe incorrect.');
                }
            }
        }

        // Si l'utilisateur n'existe pas
        return redirect()->route('customer.loginForm')->with('fail', 'Utilisateur non trouvé.');
    }

    public function logout()
    {
        Auth::guard('customer')->logout();
        return redirect()->route('customer.loginForm')->with('success', 'Vous êtes déconnecté');
    }

    public function import(Request $request)
    {
        // Validation du fichier
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        // Importer le fichier Excel
        Excel::import(new CustomersImport, $request->file('file'));

        // Redirection avec un message de succès
        return back()->with('success', 'Les données ont été importées avec succès.');
    }
    public function importCP(Request $request)
{
    $externalUploadDir = base_path(env('GET_CUSTOMER_CP')); // Exemple : CPExport/

    if (!is_dir($externalUploadDir)) {
        mkdir($externalUploadDir, 0777, true);
    }

    $files = $request->file('file');

    if (is_array($files)) {
        foreach ($files as $file) {
            if ($file->isValid()) {
                // Formater le nom du fichier
                $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $extensionMaj = $file->getClientOriginalExtension();
                // extension en miniscule
                $extension = strtolower($extensionMaj);
                $fileName = $originalName . '.' . $extension;

                // Créer le dossier "CP" s'il n'existe pas déjà
                $targetDir = rtrim($externalUploadDir, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'CP';
                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }

                // Enregistrer le fichier
                $file->move($targetDir, $fileName);
            }
        }

        return back()->with('success', 'Les fichiers ont été importés avec succès.');
    }

    return back()->with('error', 'Aucun fichier valide n’a été envoyé.');
}

    /**
     * Display the specified resource.
     */
    public function showRegisterForm()
    {
        return view('users.espace_client.auth.register');
    }

    public function register(Request $request)
    {
        DB::beginTransaction();
        try {
            $customerIsExist = TblCreationCompte::where('login', '=', $request->login)->first();
            // $customerIsExist = TblCreationCompte::where('email', '=', $request->email, 'or', 'cel', '=', $request->cel, 'or', 'login', '=', $request->login, 'and', 'estClient', '=', '0')->first();
            if ($customerIsExist && $customerIsExist->estClient == 0) {
                session(['customerData' => $customerIsExist->id]);
                return response()->json([
                    'type' => 'error',
                    'urlback' => route('customer.registerForm.addContrat', $customerIsExist->id),
                    'message' => "cher(e) client(e) $customerIsExist->nom $customerIsExist->prenom, Nous sommes heureux de vous revoir, Veuillez terminer votre inscription... !",
                    'code' => 200,
                ]);
            } elseif ($customerIsExist && $customerIsExist->estClient == 1) {
                return response()->json([
                    'type' => 'error',
                    'urlback' => route('customer.loginForm'),
                    'message' => "vous avez déja un compte, Veuillez vous connecter !",
                    'code' => 400,
                ]);
            } else {
                // Enregistrer les informations de l'actualité
                $saving = TblCreationCompte::create([
                    'nom' => $request->nom,
                    'prenom' => $request->prenom,
                    'email' => $request->email,
                    'cel' => $request->cel,
                    'login' => $request->login,
                    'password' => $request->password,
                    'estClient' => 0,
                    'estnotifie' => 0,
                    'estnotifieLe' => null,
                    'idCustomer' => null,

                ]);
                $customerData = TblCreationCompte::where('id', '=', $saving->id)->first();
                session(['customerData' => $customerData->id]);
                if ($saving) {
                    $recipientEmail = $request->input('email');
                    $emailSubject = "Finalisation de la création de votre compte à Ynov";

                    // Message HTML correctement formatté
                    $message = '
                        <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" 
                            data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="justify" 
                            style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                            Votre compte a bien été créé :
                            <ul>
                                <li><strong><u>Nom d\'utilisateur (login)</u> : </strong> ' . $customerData->login . '</li>
                                <li><strong><u>Mot de passe</u> : </strong> Utilisez le mot de passe défini au moment de votre inscription</li>
                            </ul>
                            Cependant, vous devez finaliser votre inscription en cliquant sur le lien suivant pour associer au moins un contrat d\'assurance :
                        </td>';

                    $destinatorName = 'Cher(e) client(e) ' . $customerData->nom . ' ' . $customerData->prenom;

                    $mailData = [
                        'title' => $emailSubject,
                        'body' => $message,
                        'destinatorName' => $destinatorName,
                        'destinatorEmail' => $customerData->email,
                        'btnText' => 'Cliquez ici',
                        'btnLink' => route('customer.registerForm.addContrat', ['id' => $customerData->id]),
                    ];

                    // Envoi de l'email
                    $mail = new UserRegisteredMail($mailData, $emailSubject);
                    Mail::to($recipientEmail)->send($mail);

                    // Mise à jour des informations de l'utilisateur
                    TblCreationCompte::where('id', $customerData->id)->update([
                        'estnotifie' => 1,
                        'estnotifieLe' => now(),
                    ]);
                }
                // $emailSubject = "Inscription à Yakoafrica";
                // $emailData = [
                //     'name' => $request->nom,
                //     'email' => $request->email,
                //     'password' => $request->password,
                // ];
                // Mail::to($request->email)->send(new UserRegisteredMail($emailSubject, $emailData));


                DB::commit();

                return response()->json([
                    'type' => 'success',
                    'urlback' => route('customer.registerForm.addContrat', $customerData->id),
                    'message' => "Enregistré avec succès!",
                    'code' => 200,
                ]);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'type' => 'error',
                'urlback' => '',
                'message' => "Erreur système! $th",
                'code' => 500,
            ]);
        }
    }

    public function registerMail()
    {
        return view('users.espace_client.auth.registerMail');
    }
    public function createAddContrat(string $id)
    {
        $customer = session('customerData', []);
        // dd($customer);
        $customerData = TblCreationCompte::where('id', '=', $customer)->orWhere('id', '=', $id)->first();
        session(['customerId' => $customerData->id]);
        // dd($customer);
        return view('users.espace_client.auth.addContrat', compact('customerData'));
    }
    public function AddContrat(Request $request)
    {
        try {
            DB::beginTransaction();
            $idcontrat = $request->input('contrat');
            $datenaissance = Carbon::parse($request->input('datenaissance'))->format('d/m/Y');

            // dd($datenaissance);
            $cust = session('customerData', []);
            $customerId = session('customerId', []);
            $customer = TblCreationCompte::where('id', '=', $cust)->orWhere('id', '=', $customerId)->first();

            if ($customer != null || $customer != '') {
                // $contrat = MembreContrat::where('idcontrat', $idcontrat)->first();
                $response = Http::withOptions(['timeout' => 60])
                    ->post('https://api.yakoafricassur.com/oldweb/encaissement-bis', [
                        'idContrat' => $idcontrat,
                    ]);
                if ($response->successful()) {
                    $data = $response->json();
                    // dd($data['details']);
                    if (!empty($data['details'])) {
                        $existingMembre = Membre::where('login', $customer->login)->first();
                        $existingCustomer = TblCustomer::where('login', $customer->login)->first();
                        $existingMembreContrat = ($existingMembre != null) ? MembreContrat::where(['codemembre' => $existingMembre->idmembre, 'idcontrat' => $idcontrat])->first() : null;
                        // dd($existingMembre, $existingCustomer, $existingMembreContrat);

                        if ($data['details'][0]['DateNaissance'] != $datenaissance) {
                            return response()->json([
                                'type' => 'error',
                                'urlback' => '',
                                'message' => "La date de naissance saisie ne correspond pas à celle enregistrée dans le contrat.",
                                'code' => 400,
                                'count_error' => true, // Indicateur pour incrémenter le compteur en JS
                            ]);
                        } elseif (($existingMembre || $existingCustomer) && $existingMembreContrat) {
                            return response()->json([
                                'type' => 'error',
                                'urlback' => route('customer.loginForm'),
                                'message' => "Vous avez déja un compte avec ce contrat. veuillez vous connecter.",
                                'code' => 400,
                            ]);
                        } else if (($existingMembre || $existingCustomer) && !$existingMembreContrat) {
                            MembreContrat::create([
                                'codemembre' => $existingMembre->idmembre,
                                'idcontrat' => $idcontrat,
                            ]);
                            $recipientEmail = $customer->email;
                            $emailSubject = "ID contrat " . $idcontrat . "ajouté ";
                            $message = '<td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="justify" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                    Le contrat ' . $idcontrat . ' a bien été ajouté à votre compte, vous pouvez désormais consulter les détails du contrat une fois connecter à votre compte Ynov.

                                </td>';

                            $destinatorName = 'Cher(e) client(e) ' . $customer->nom . ' ' . $customer->prenom;

                            $mailData = [
                                'title' => $emailSubject,
                                'body' => $message,
                                'destinatorName' => $destinatorName,
                                'destinatorEmail' => $customer->email,
                                'btnText' => 'Cliquez ici',
                                'btnLink' => route('customer.loginForm'),
                            ];

                            $mail = new UserRegisteredMail($mailData, $emailSubject);

                            $mailSending = Mail::to($recipientEmail)->send($mail);
                            DB::commit();
                            return response()->json([
                                'type' => 'success',
                                'urlback' => route('customer.loginForm'),
                                'message' => "ID Contrat Enregistré avec succès !.",
                                'code' => 200,
                            ]);
                        } else {
                            if ($data['details'][0]['OnStdbyOff'] != "1") {
                                return response()->json([
                                    'type' => 'error',
                                    'urlback' => '',
                                    'message' => 'Ce contrat est arreté ou en veille.',
                                    'code' => 400,
                                ]);
                            } else {

                                $savingMembre = Membre::create([
                                    'login' => $customer->login,
                                    'pass' => $customer->password,
                                    'nom' => $customer->nom,
                                    'prenom' => $customer->prenom,
                                    'email' => $customer->email,
                                    'cel' => $customer->cel,
                                    'typ_membre' => 3,
                                    'activer' => 1,
                                    'estajour' => 1,
                                    'memberok' => 1,
                                    'datenaissance' => $request->datenaissance,
                                ]);
                                MembreContrat::create([
                                    'codemembre' => $savingMembre->idmembre,
                                    'idcontrat' => $idcontrat,
                                ]);
                                $password = Hash::make($customer->password);
                                $savingCustomer = TblCustomer::create([
                                    'login' => $customer->login,
                                    'password' => $password,
                                    'activer' => 1,
                                    'estajour' => 1,
                                    'memberok' => 1,
                                    'idmembre' => $savingMembre->idmembre,
                                    'isFirstLog' => 1,
                                ]);

                                if ($savingCustomer) {
                                    // mettre à jour TblCreationCompte
                                    TblCreationCompte::where('id', $customer->id)->update([
                                        'idCustomer' => $savingCustomer->id,
                                        'password' => $password,
                                        'estClient' => 1,
                                    ]);

                                    $recipientEmail = $customer->email;
                                    $emailSubject = "Félicitation M/Mme/Mlle " . $customer->nom . ' ' . $customer->prenom;
                                    $message = '<td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="justify" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                            Votre compte Ynov a bien été crée succès vous pouvez désormais vous connecter à l\'aide de vos accès suivant:
                                            <ul>
                                                <li><strong><u>Nom d\'utilisateur (login)</u> : </strong>' . $customer->login . '</li>
                                                <li><strong><u>Mot de passe</u> : </strong> Utilisez le mot de passe défini au moment de votre inscription</li>
                                            </ul>
                                                Veuillez cliquer sur le lien ci-dessous, munis de votre login et mot de passe pour acceder à votre compte :
                                        </td>';

                                    $destinatorName = 'Félicitation M/Mme/Mlle ' . $customer->nom . ' ' . $customer->prenom;

                                    $mailData = [
                                        'title' => $emailSubject,
                                        'body' => $message,
                                        'destinatorName' => $destinatorName,
                                        'destinatorEmail' => $customer->email,
                                        'btnText' => 'Cliquez ici',
                                        'btnLink' => route('customer.loginForm'),
                                    ];

                                    $mail = new UserRegisteredMail($mailData, $emailSubject);

                                    $mailSending = Mail::to($recipientEmail)->send($mail);
                                }
                                DB::commit();
                                return response()->json([
                                    'type' => 'success',
                                    'urlback' => route('customer.loginForm'),
                                    'message' => "Enregistré avec succès! Vous pouvez maintenant vous connecter.",
                                    'code' => 200,
                                ]);
                            }
                        }
                    } else {
                        return response()->json([
                            'type' => 'error',
                            'urlback' => '',
                            'message' => 'Aucun contrat trouvé pour cet ID.',
                            'code' => 400,
                        ]);
                    }
                } else {
                    return response()->json([
                        'type' => 'error',
                        'urlback' => '',
                        'message' => 'Une erreur s\'est produite.',
                        'code' => 400,
                    ]);
                }
            } else {
                return response()->json([
                    'type' => 'error',
                    'urlback' => '', // URL du PDF
                    'message' => 'Votre session a expiré. Veuillez vous reconnecter.',
                    'code' => 400,
                ]);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'type' => 'error',
                'urlback' => '',
                'message' => 'Une erreur s\'est produite : ' . $e->getMessage(),
                'code' => 400,
            ]);
        }
    }

    public function demandeCompte(Request $request)
    {
        try {
            DB::beginTransaction();
            $idcontrat = $request->input('idcontrat');
            // $datenaissance = Carbon::parse($request->input('datenais'))->format('d/m/Y');

            // dd($datenaissance);
            $cust = session('customerData', []);
            $customerId = session('customerId', []);
            $customer = TblCreationCompte::where('id', '=', $cust)->orWhere('id', '=', $customerId)->first();
            $existingCustomer = TblDemandeCompte::where('mailDemandeur', '=', $customer->email)->orWhere('tel1Demandeur', '=', $customer->cel)->first();
            if ($customer != null || $customer != '') {
                if ($existingCustomer != null || $existingCustomer != '') {
                    return response()->json([
                        'type' => 'error',
                        'urlback' => '',
                        'message' => 'Vous avez déja soumis une demande de compte le ' . $existingCustomer->dateDemande . 'Votre demande est en cours de traitement. Veuillez patienter...',
                        'code' => 400,
                    ]);
                } else {
                    $saving = TblDemandeCompte::create([
                        'nomDemandeur' => $customer->nom,
                        'prenomDemandeur' => $customer->prenom,
                        'tel1Demandeur' => $customer->cel,
                        'dateDemande' => now(),
                        'dateNaissanceDemandeur' => $request->datenais,
                        'mailDemandeur' => $customer->email,
                        // 'resumeDemandeur' => $request->input('resume'),
                        'idcontrat' => $idcontrat,
                        // 'statutDemande' => 0,
                        'conditions' => '1',
                        'refDemande' => RefgenerateCodeDemandeCompte(TblDemandeCompte::class, 'YAAV-', 'refDemande'),
                        'typeDemande' => 'demande',
                    ]);



                    $externalUploadDir = base_path(env('UPLOAD_DEMANDE_COMPTE_FILE'));

                    if (!is_dir($externalUploadDir)) {
                        mkdir($externalUploadDir, 0777, true);
                    }
                    if ($saving) {
                        // Gestion des fichiers uploadés
                        if ($request->hasFile('libelle')) {
                            $Files = [];
                            foreach ($request->file('libelle') as $index => $file) {
                                $fileType = $request->type[$index];
                                if ($fileType === 'CNIrecto') {
                                    $rectoFile = $file;
                                } elseif ($fileType === 'CNIverso') {
                                    $versoFile = $file;
                                }
                            }
                            // Si les fichiers recto et verso sont présents, fusionner en un fichier PDF
                            if ($rectoFile && $versoFile) {
                                $mergedFileName = Carbon::now()->format('Ymd_His') . '_CNI_' . $saving->refDemande . '.pdf';
                                $mergedFilePath = $externalUploadDir . $mergedFileName;

                                // Charger les fichiers recto et verso
                                $rectoContent = file_get_contents($rectoFile->getPathname());
                                $versoContent = file_get_contents($versoFile->getPathname());

                                // Créer une vue HTML pour le PDF
                                $html = view('users.espace_client.services.fiches.cni', [
                                    'rectoContent' => base64_encode($rectoContent),
                                    'versoContent' => base64_encode($versoContent)
                                ])->render();

                                // Générer le PDF
                                $pdf = Pdf::loadHTML($html)->setPaper('a4', 'portrait');
                                $pdf->save($mergedFilePath);

                                // Enregistrer dans la base de données
                                $Files[] = [
                                    'idDemandeCompte' => $saving->idTblDemandeCompte,
                                    'libelle' => $mergedFileName,
                                    'path' => 'storage/demande_comptes/' . $mergedFileName,
                                    'type' => 'CNI',
                                ];
                            }

                            // Enregistrer tous les fichiers
                            foreach ($Files as $fileData) {
                                TblDocPrestation::create($fileData);
                            }
                        }
                    }
                    if ($saving) {
                        $recipientEmail = $customer->email;
                        $emailSubject = "Demande de création de compte " . $customer->nom . ' ' . $customer->prenom;
                        $message = '<td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="justify" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                    Votre demande de création de compte a bien été enregistrée :
                                <ul>
                                    <li><strong><u>Code de la demande</u> : </strong>' . $saving->refDemande . '</li>
                                    <li><strong><u>Date de demande</u> : </strong> ' . $saving->dateDemande . '</li>
                                </ul>
                                Une fois votre demande acceptée, vous recevrez un email de confirmation contenant vos informations de connexion (login et mot de passe). <br>
                                Veuillez cliquer sur le lien ci-dessous, pour consulter nos produits et services :
                            </td>';

                        $destinatorName = 'Cher(e) client(e) ' . $customer->nom . ' ' . $customer->prenom;

                        $mailData = [
                            'title' => $emailSubject,
                            'body' => $message,
                            'destinatorName' => $destinatorName,
                            'destinatorEmail' => $customer->email,
                            'btnText' => 'Cliquez ici',
                            'btnLink' => route('home.all_products'),
                        ];

                        $mail = new UserRegisteredMail($mailData, $emailSubject);

                        $mailSending = Mail::to($recipientEmail)->send($mail);
                        DB::commit();
                        return response()->json([
                            'type' => 'success',
                            'urlback' => '',
                            // 'urlback' => route('index'),
                            'message' => "Votre demande a bien été enregistré. Vous recevrez un email à l'adresse " . $customer->email . " contenant les details de votre demande.",
                            'code' => 200,
                        ]);
                    }
                }
            } else {
                return response()->json([
                    'type' => 'error',
                    'urlback' => '', // URL du PDF
                    'message' => 'Votre session a expiré. Veuillez vous reconnecter.',
                    'code' => 400,
                ]);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'type' => 'error',
                'urlback' => '',
                'message' => 'Une erreur s\'est produite : ' . $e->getMessage(),
                'code' => 400,
            ]);
        }
    }

    public function getDemandeCompteDoc(string $idDemandeCompte)
    {
        try {
            $DemandeCompteDoc = TblDocPrestation::where('idDemandeCompte', $idDemandeCompte)->get();
            if ($DemandeCompteDoc->isEmpty()) {
                return response()->json(['status' => 'success', 'data' => []]);
            }
            return response()->json([
                'status' => 'success',
                'data' => $DemandeCompteDoc,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Une erreur est survenue : ' . $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function resetPassFirstLogin(Request $request)
    {
        $input = $request->all();
        $this->validate(
            $request,
            [
                'login' => 'required',
                'password' => 'required',
            ]
        );
        $customer = TblCustomer::where('login', $input['login'])->orWhere('old_login', $input['login'])->first();
        $membre = Membre::where('login', $input['login'])->first();

        if ($customer) {
            // Le mot de passe n'est pas haché, le hacher après une authentification réussie
            $customer->password = Hash::make($input['password']);
            $customer->isFirstLog = 1;
            $customer->save();
            if ($membre) {

                $membre->pass = $input['password'];
                // $membre->pass = Hash::make($input['password']);
                $membre->save();
            }
            // Authentifier l'utilisateur
            Auth::guard('customer')->login($customer);
            // return redirect()->route('customer.dashboard');
            return response()->json([
                'type' => 'success', 
                'urlback' => route('customer.dashboard'),
                'message' => 'Votre mot de passe a bien été mis à jour.',
                'code' => 200
            ]);
        } else {
            // Si l'utilisateur n'existe pas
            return response()->json([
                'type' => 'error',
                'message' => 'Une erreur s\'est produite, Veuillez vous réessayer.',
                'code' => 400
            ]);
            // return redirect()->route('customer.loginForm')->with('fail', 'Utilisateur non trouvé.');
        }
    }

    public function updateCompte(Request $request)
    {
        $customer = TblCustomer::where('login', $request->update_login)->orWhere('old_login', $request->update_login)->first();
        $membre = Membre::where('login', $request->update_login)->first();

        if ($customer) {
            $customer->login = $request->login;
            $customer->password = $request->password;
            $customer->estajour = 1;
            $customer->isFirstLog = 0;
            $customer->save();
            if ($membre) {
                $membre->login = $request->login;
                $membre->pass = $request->password;
                $membre->email = $request->email;
                $membre->nom = $request->nom;
                $membre->prenom = $request->prenom;
                $membre->sexe = $request->sexe;
                $membre->tel = $request->tel;
                $membre->cel = $request->cel;
                $membre->datenaissance = $request->datenaissance;
                $membre->lieunaissance = $request->lieunaissance;
                $membre->lieuresidence = $request->lieuresidence;
                $membre->estajour = 1;
                $membre->save();
            }
            $recipientEmail = $request->email;
            $emailSubject = "Mise à jour de votre compte à Ynov";

            // Message HTML correctement formatté
            $message = '
                <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" 
                    data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="justify" 
                    style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                    Votre compte a bien été mise à jour, veuillez utiliser les informations suivantes pour vous connecter à votre compte Ynov :
                    <ul>
                        <li><strong><u>Nom d\'utilisateur (login)</u> : </strong> ' . $customer->login . '</li>
                        <li><strong><u>Mot de passe (Par défaut) </u> : </strong> 123456</li>
                    </ul>
                    Cependant, pour plus de sécurité, vous devez impérativement modifier votre mot de passe en cliquant sur le lien suivant :
                </td>';

            $destinatorName = 'Cher(e) client(e) ' . $membre->nom . ' ' . $membre->prenom;

            $mailData = [
                'title' => $emailSubject,
                'body' => $message,
                'destinatorName' => $destinatorName,
                'destinatorEmail' => $membre->email,
                'btnText' => 'Cliquez ici',
                'btnLink' => route('customer.loginForm'),
            ];

            // Envoi de l'email
            $mail = new UserRegisteredMail($mailData, $emailSubject);
            Mail::to($recipientEmail)->send($mail);
            return response()->json([
                'type' => 'success',
                'urlback' => '',
                'message' => "Votre compte a été mis à jour avec success ! Veuillez verifier votre messagerie email ($recipientEmail) pour plus de details.",
            ]);
        }
        
    }

    // public function resetPass(Request $request)
    // {
    //     $input = $request->all();
    //     $this->validate(
    //         $request,
    //         [
    //             'login' => 'required',
    //             'password' => 'required',
    //         ]
    //     );
    //     $customer = TblCustomer::where('login', $input['login'])->first();
    //     $membre = Membre::where('login', $input['login'])->first();

    //     if ($customer) {
    //         // Le mot de passe n'est pas haché, le hacher après une authentification réussie
    //         $customer->password = Hash::make($input['password']);
    //         $customer->isFirstLog = 1;
    //         $customer->save();
    //         if ($membre) {

    //             $membre->password = Hash::make($input['password']);
    //             $membre->save();
    //         }
    //         // Authentifier l'utilisateur
    //         Auth::guard('customer')->login($customer);
    //         return redirect()->route('customer.dashboard');
    //     } else {
    //         // Si l'utilisateur n'existe pas
    //         return redirect()->route('customer.loginForm')->with('fail', 'Utilisateur non trouvé.');
    //     }
    // }
    // return view('users.espace_client.auth.reset-password');

    /**
     * Update the specified resource in storage.
     */
    public function resetPassSendMail(Request $request)
    {
        $token = Str::random(80);
        $email = $request->email;
        $membre = Membre::where('email', $email)->first();
        $login = ($membre) ? $membre->login : '';
        $customer = ($membre) ? TblCustomer::where('login', $login)->orWhere('old_login', $login)->with('membre')->first() : null;
        // dd($customer);
        if ($customer || $customer != null) {
            $customer->remember_token = $token;
            $customer->updated_at = Carbon::now();
            $customer->token_expires_at = Carbon::now()->addMinutes(60); // Expire dans 60 min
            $customer->save();
            // dd($customer);
            // session(['DataToken' => $customer]);
            // creer une ligne dans la table password_resets
            // passwordResset::create([
            //     'email' => $customer->login,
            //     'token' => $token,
            //     'created_at' => Carbon::now()
            // ]);
            $recipientEmail = $email;
            $emailSubject = "Réinitialisation de votre mot de passe";
            $message = '<td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="justify" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                            Pour réinitialiser votre mot de passe, cliquez sur le lien ci-dessous :
                        </td>
                       <strong style="color:rgb(255, 0, 0);"> NB : </strong> Nous tenons à vous informer que le lien expirera dans 60 minutes.
                        ';

            $destinatorName = 'Cher(e) client(e) ' . $customer->membre->nom . ' ' . $customer->membre->prenom;

            $mailData = [
                'title' => $emailSubject,
                'body' => $message,
                'destinatorName' => $destinatorName,
                'destinatorEmail' => $email,
                'btnText' => 'Réinitialiser',
                'btnLink' => route('customer.resetPassForm', ['token' => $token]),
            ];

            $mail = new UserRegisteredMail($mailData, $emailSubject);
            if ($recipientEmail != null) {
                $mailSending = Mail::to($recipientEmail)->send($mail);
            }
            // Planifier la réinitialisation dans 60 minutes
            // ResetRememberToken::dispatch($customer->id)->delay(now()->addMinutes(1));

            if ($mailSending) {
                return back()->with("success", "Un lien de reinitialisation de mot de passe a ete envoye a votre adresse email   $email . Veuillez consulter votre boite de reception. Le lien expirera dans 60 minutes.");
            }
        } else {
            return back()->with("fail", "Aucun utilisateur trouvé avec ce email ($email) .");
        }
    }

    // public function destroyToken()
    // {

    //     $cust = session('DataToken', []);
    //     if ($cust) {

    //         $customer = TblCustomer::where('id', $cust->id)->first();
    //         $customer->remember_token = null;
    //         $customer->save();
    //         Log::info('Le lien de reinitialisation de votre mot de passe a expiré.'.$cust);
    //         session()->forget('DataToken');

    //     }else{
    //         Log::info('Aucune donnee a supprimer.');

    //     }
    // }
    // public function destroyToken()
    // {
    //     $cust = session('DataToken', []);
    //     if ($cust) {
    //         $customer = TblCustomer::where('id', $cust->id)->first();
    //         // $customer = TblCustomer::where('login', $request->login)->first();

    //         if ($customer) {
    //             $now = now();
    //             $tokenCreatedAt = $customer->updated_at; // Date de dernière mise à jour du token
    //             $tokenExpiryTime = $tokenCreatedAt->addMinutes(60); // Expire après 60 min

    //             if ($now >= $tokenExpiryTime) {
    //                 $customer->remember_token = null;
    //                 $customer->save();
    //                 Log::info('Token réinitialisé avec succès :' . $cust);
    //                 session()->forget('DataToken');
    //                 return response()->json(['message' => 'Token réinitialisé avec succès']);
    //             } else {
    //                 return response()->json(['message' => 'Token encore valide']);
    //             }
    //         }
    //     } else {
    //         Log::info('Aucune donnee a supprimer.');
    //         return response()->json(['message' => 'Utilisateur non trouvé'], 404);
    //     }
    // }
    

    public function destroyToken()
{
    $now = Carbon::now();
    $deleted = TblCustomer::where('token_expires_at', '<', $now)
                ->update(['remember_token' => null, 'token_expires_at' => null]);

    return response()->json(['message' => "$deleted tokens expirés supprimés"]);
    // $cust = session('DataToken');
    // if (!empty($cust) && isset($cust['id'])) {
    //     $customer = TblCustomer::where('id', $cust['id'])->first();

    //     if ($customer) {
    //         $now = now();
    //         $tokenCreatedAt = $customer->updated_at; // Date de dernière mise à jour du token
    //         $tokenExpiryTime = $tokenCreatedAt->addMinutes(60); // Expire après 60 min

    //         if ($now >= $tokenExpiryTime) {
    //             $customer->remember_token = null;
    //             $customer->save();

    //             Log::info('Token réinitialisé avec succès : ' . json_encode($cust));
    //             session()->forget('DataToken');

    //             return response()->json(['message' => 'Token réinitialisé avec succès']);
    //         } else {
    //             return response()->json(['message' => 'Token encore valide']);
    //         }
    //     }else {
    //         Log::info('Aucune donnée à supprimer.');
    //         return response()->json(['message' => 'Utilisateur non trouvé'], 404);
    //     }
    // }else {
    //     Log::info('Aucune donnée à supprimer.');
    //     return response()->json(['message' => 'Utilisateur non trouvé'], 404);
    // }

}

    public function resetPassForm(string $token)
    {
        $customer = TblCustomer::where('remember_token', $token)
                ->where('token_expires_at', '>=', Carbon::now()) // Vérifie expiration
                ->first();
        // $customer = TblCustomer::where('remember_token', $token)->first();
        if (!$customer) {
            return redirect()->route('customer.loginForm')->with('fail', 'Le lien de reinitialisation de votre mot de passe a expiré.');
        }
        return view('users.espace_client.auth.reset-password', compact('token'));
    }

    public function resetPass(Request $request, string $token)
    {
        $input = $request->all();
        $this->validate(
            $request,
            [
                'password' => 'required',
            ]
        );
        $customer = TblCustomer::where('remember_token', $token)->first();
        $membre = Membre::where('idmembre', $customer->idmembre)->first();

        if ($customer) {
            // Le mot de passe n'est pas haché, le hacher après une authentification réussie
            $customer->password = Hash::make($input['password']);
            $customer->isFirstLog = 1;
            $customer->remember_token = null;
            $customer->token_expires_at = null;
            $customer->save();
            if ($membre) {

                $membre->pass = $input['password'];
                // $membre->password = Hash::make($input['password']);
                $membre->save();
            }
            // Authentifier l'utilisateur
            // Auth::guard('customer')->login($customer);
            return redirect()->route('customer.loginForm')->with('success', 'Votre mot de passe a ete reinitialise avec success');
        } else {
            // Si l'utilisateur n'existe pas
            return back()->with('fail', 'Erreur lors de la reinitialisation de votre mot de passe');
        }
    }
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
