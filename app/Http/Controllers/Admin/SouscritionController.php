<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\cotationSenderMail;
use App\Models\EmailNewsletter;
use App\Models\FormuleProduit;
use App\Models\Presouscription;
use App\Models\Souscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class SouscritionController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        // Récupérer le statut sélectionné dans la requête 
        $statusPre = $request->input('filterByPre', '');
        $statusCon = $request->input('filterByContact', '');

        // Filtrer les pré-souscriptions et les contacts en fonction du statut, si fourni
        $preSouscriptions = Presouscription::where('etat', 'Actif')
            ->where('type', 'Pré-souscription')
            ->when($statusPre, function ($query, $statusPre) {
                return $query->where('status', $statusPre);
            })
            ->with('formul_product', 'user')
            ->orderBy('created_at', 'desc')
            ->get();

        $contacts = Presouscription::where('etat', 'Actif')
            ->where('type', 'contact')
            ->when($statusCon, function ($query, $statusCon) {
                return $query->where('status', $statusCon);
            })
            ->with('formul_product', 'user')
            ->orderBy('created_at', 'desc')
            ->get();

        if ($request->ajax()) {
            return response()->json([
                'preSouscriptions' => view('admins.pages.mail.partials.pre-souscriptions', compact('preSouscriptions'))->render(),
                'contacts' => view('admins.pages.mail.partials.contacts', compact('contacts'))->render(),
            ]);
        }

        return view('admins.pages.mail.index', compact('preSouscriptions', 'contacts', 'statusCon', 'statusPre'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function mail()
    {
        // $newsletters = EmailNewsletter::orderBy('created_at', 'desc')->get();
        return view('admins.pages.mail.mail');
    }
    public function newsletter()
    {
        $newsletters = EmailNewsletter::orderBy('created_at', 'desc')->get();
        return view('admins.pages.mail.newsletter', compact('newsletters'));
    }

    public function newsletterStore(Request $request)
    {

        DB::beginTransaction();
        try {

            $uuid = Str::uuid();
            $saving = EmailNewsletter::create([
                'uuid' => $uuid,
                'email' => $request->email,
            ])->save();

            if ($saving) {

                $dataResponse = [
                    'type' => 'success',
                    'urlback' => "back",
                    'message' => "Enregistré avec succes!",
                    'code' => 200,
                ];
                DB::commit();
            } else {
                DB::rollback();
                $dataResponse = [
                    'type' => 'error',
                    'urlback' => '',
                    'message' => "Erreur lors de l'enregistrement!",
                    'code' => 500,
                ];
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            $dataResponse = [
                'type' => 'error',
                'urlback' => '',
                'message' => "Erreur systeme! $th",
                'code' => 500,
            ];
        }
        return response()->json($dataResponse);
    }
    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $recaptchaResponse = Http::asForm()->post(
    //         'https://www.google.com/recaptcha/api/siteverify',
    //         [
    //             'secret' => env('RECAPTCHA_SECRET_KEY'),
    //             'response' => $request->recaptcha_token,
    //             'remoteip' => $request->ip(),
    //         ]
    //     );

    //     $recaptcha = $recaptchaResponse->json();

    //     if (!$recaptcha['success'] || $recaptcha['score'] < 0.5) {
    //         return response()->json([
    //             'type' => 'error',
    //             'message' => 'Spam détecté.',
    //             'code' => 403
    //         ]);
    //     }
    //     DB::beginTransaction();
    //     try {

    //         $uuid = Str::uuid();
    //         $saving = Presouscription::create([
    //             'uuid' => $uuid,
    //             'code' => Refgenerate(Presouscription::class, 'PrS', 'code'),
    //             'product_uuid' => $request->product_uuid,
    //             'customer_firstname' => $request->customer_firstname,
    //             'customer_lastname' => $request->customer_lastname,
    //             'customer_civility' => $request->customer_civility,
    //             'customer_assure' => $request->customer_assure,
    //             'customer_birthday' => $request->customer_birthday,
    //             'assure_birthday' => $request->assure_birthday,
    //             'customer_placebirth' => $request->customer_placebirth,
    //             'customer_job' => $request->customer_job,
    //             'customer_residence' => $request->customer_residence,
    //             'customer_email' => $request->customer_email,
    //             'customer_phone' => $request->customer_phone,
    //             'customer_whatsapp' => $request->customer_whatsapp,
    //             'object' => $request->object,
    //             'content' => $request->content,
    //             'type' => $request->type,
    //         ]);

    //         if ($saving) {
    //             $product = FormuleProduit::where('uuid', $saving->product_uuid)->first();
    //             $recipientEmail = $saving->customer_email;
    //             $emailSubject = ($request->type == 'Pré-souscription') ? "Demande de cotation" : $request->object;
    //             $data = [
    //                 'title' => $emailSubject,
    //                 'product' => $product->label ?? '',
    //                 'customer_firstname' => $saving->customer_firstname,
    //                 'customer_lastname' => $saving->customer_lastname,
    //                 'customer_civility' => $saving->customer_civility,
    //                 'customer_assure' => $saving->customer_assure,
    //                 'customer_birthday' => $saving->customer_birthday,
    //                 'assure_birthday' => $saving->assure_birthday,
    //                 'customer_placebirth' => $saving->customer_placebirth,
    //                 'customer_job' => $saving->customer_job,
    //                 'customer_residence' => $saving->customer_residence,
    //                 'customer_email' => $saving->customer_email,
    //                 'customer_phone' => $saving->customer_phone,
    //                 'customer_whatsapp' => $saving->customer_whatsapp,
    //                 'object' => $saving->object,
    //                 'content' => $saving->content,
    //                 'created_at' => $saving->created_at,
    //                 'type' => $saving->type,
    //             ];

    //             // Envoi de l'email
    //             $mail = new cotationSenderMail($data, $emailSubject);
    //             Mail::to($recipientEmail)->send($mail);
    //             if($request->type == 'Pré-souscription'){
    //                 Mail::to('cotations@yakoafricassur.com')->send($mail);
    //             }else{
    //                 // Mail::to('reclamations@yakoafricassur.com')->send($mail);
    //             }

    //             $dataResponse = [
    //                 'type' => 'success',
    //                 'urlback' => "back",
    //                 'message' => "Enregistré avec succes!",
    //                 'code' => 200,
    //             ];
    //             DB::commit();
    //         } else {
    //             DB::rollback();
    //             $dataResponse = [
    //                 'type' => 'error',
    //                 'urlback' => '',
    //                 'message' => "Erreur lors de l'enregistrement!",
    //                 'code' => 500,
    //             ];
    //         }
    //     } catch (\Throwable $th) {
    //         DB::rollBack();
    //         $dataResponse = [
    //             'type' => 'error',
    //             'urlback' => '',
    //             'message' => "Erreur systeme! $th",
    //             'code' => 500,
    //         ];
    //     }
    //     return response()->json($dataResponse);
    // }

    public function store(Request $request)
    {

        // Log::info('Token reçu:', ['token' => $request->recaptcha_token]);
        // Honeypot anti-spam
        if ($request->filled('website')) {
            return response()->json([
                'type' => 'error',
                'message' => 'Spam détecté',
                'urlback' => '',
                'code' => 403
            ]);
        }

        // Vérification reCAPTCHA
        $recaptchaResponse = Http::asForm()->post(
            'https://www.google.com/recaptcha/api/siteverify',
            [
                'secret' => '6LdaUYgsAAAAAMUzQgLPDRrYTgTAsK-QdgtzfLDS',
                // 'secret' => config('services.recaptcha.secret_key'),
                'response' => $request->recaptcha_token,
                'remoteip' => $request->ip(),
            ]
        );

        $recaptcha = $recaptchaResponse->json();

        if (!isset($recaptcha['success']) || $recaptcha['success'] !== true) {
            $errorCodes = isset($recaptcha['error-codes']) ? implode(', ', $recaptcha['error-codes']) : 'Unknown error';

            return response()->json([
                'type' => 'error',
                'message' => 'reCAPTCHA invalide ' . $errorCodes,
                'urlback' => '',
                'code' => 403
            ]);
        }

        if (isset($recaptcha['score']) && $recaptcha['score'] < 0.3) {

            return response()->json([
                'type' => 'error',
                'message' => 'Spam détecté par reCAPTCHA',
                'urlback' => '',
                'code' => 403
            ]);
        }

        DB::beginTransaction();

        try {

            $uuid = Str::uuid();

            $saving = Presouscription::create([
                'uuid' => $uuid,
                'code' => Refgenerate(Presouscription::class, 'PrS', 'code'),
                'product_uuid' => $request->product_uuid,
                'customer_firstname' => $request->customer_firstname,
                'customer_lastname' => $request->customer_lastname,
                'customer_civility' => $request->customer_civility,
                'customer_assure' => $request->customer_assure,
                'customer_birthday' => $request->customer_birthday,
                'assure_birthday' => $request->assure_birthday,
                'customer_placebirth' => $request->customer_placebirth,
                'customer_job' => $request->customer_job,
                'customer_residence' => $request->customer_residence,
                'customer_email' => $request->customer_email,
                'customer_phone' => $request->customer_phone,
                'customer_whatsapp' => $request->customer_whatsapp,
                'object' => $request->object,
                'content' => $request->content,
                'type' => $request->type,
            ]);

            if ($saving) {

                $product = FormuleProduit::where('uuid', $saving->product_uuid)->first();

                $recipientEmail = $saving->customer_email;

                $emailSubject = ($request->type == 'Pré-souscription')
                    ? "Demande de cotation"
                    : $request->object;

                $data = [
                    'title' => $emailSubject,
                    'product' => $product->label ?? '',
                    'customer_firstname' => $saving->customer_firstname,
                    'customer_lastname' => $saving->customer_lastname,
                    'customer_civility' => $saving->customer_civility,
                    'customer_assure' => $saving->customer_assure,
                    'customer_birthday' => $saving->customer_birthday,
                    'assure_birthday' => $saving->assure_birthday,
                    'customer_placebirth' => $saving->customer_placebirth,
                    'customer_job' => $saving->customer_job,
                    'customer_residence' => $saving->customer_residence,
                    'customer_email' => $saving->customer_email,
                    'customer_phone' => $saving->customer_phone,
                    'customer_whatsapp' => $saving->customer_whatsapp,
                    'object' => $saving->object,
                    'content' => $saving->content,
                    'created_at' => $saving->created_at,
                    'type' => $saving->type,
                ];

                $mail = new cotationSenderMail($data, $emailSubject);

                Mail::to($recipientEmail)->send($mail);

                if ($request->type == 'Pré-souscription') {
                    Mail::to('cotations@yakoafricassur.com')->send($mail);
                } else {
                    //                 // Mail::to('reclamations@yakoafricassur.com')->send($mail);
                }

                DB::commit();

                return response()->json([
                    'type' => 'success',
                    'urlback' => 'back',
                    'message' => 'Enregistré avec succès!',
                    'code' => 200
                ]);
            }

            DB::rollBack();

            return response()->json([
                'type' => 'error',
                'message' => "Erreur lors de l'enregistrement!",
                'urlback' => '',
                'code' => 500
            ]);
        } catch (\Throwable $th) {

            DB::rollBack();

            return response()->json([
                'type' => 'error',
                'message' => "Erreur système!",
                'urlback' => '',
                'code' => 500
            ]);
        }
    }
    /**
     * Display the specified resource.
     */
    public function showpreSouscription(string $uuid)
    {
        // Recherche du souscription à modifier
        $preSouscription = Presouscription::where('uuid', $uuid)->with('formul_product', 'user')->firstOrFail();

        // return view('admins.pages.mail.index', compact('preSouscription'));
        return response()->json($preSouscription);
    }

    public function showContact(string $uuid)
    {
        // Recherche du souscription à modifier
        $contact = Presouscription::where('uuid', $uuid)->with('user')->firstOrFail();
        return response()->json($contact);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function approuvedMessage(string $uuid)
    {
        $preSouscription = Presouscription::where('uuid', $uuid)->firstOrFail();
        if ($preSouscription) {
            $preSouscription->status = 'Approuver';
            $preSouscription->save();  // Sauvegarder la modification

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Message non trouvé.']);
    }

    public function dismissMessage(string $uuid)
    {
        // Récupérer la souscription via l'UUID
        $preSouscription = Presouscription::where('uuid', $uuid)->firstOrFail();
        if ($preSouscription) {
            $preSouscription->status = 'Rejeter';
            $preSouscription->save();  // Sauvegarder la modification

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Message non trouvé.']);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        // Récupérer la souscription via l'UUID
        $preSouscription = Presouscription::where('uuid', $uuid)->firstOrFail();
        if ($preSouscription) {
            $preSouscription->etat = 'Inactif';
            $preSouscription->save();  // Sauvegarder la modification

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Message non trouvé.']);
    }
}
