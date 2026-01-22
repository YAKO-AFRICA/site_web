<!-- users/espace_client/auth/mails/accountRequestMail.blade.php -->
<div style="padding: 40px 40px 20px;">
    <h2 style="color: #003C17; font-size: 18px; margin-bottom: 20px;">
        Cher(e) client(e) {{ $customer->nom }} {{ $customer->prenom }},
    </h2>
    
    <p style="color: #555555; line-height: 1.6; margin-bottom: 20px;">
        Nous accusons réception de votre demande de création de compte.
    </p>
</div>

<div style="padding: 0 40px 20px;">
    <div style="background-color: #f9f9f9; border-left: 4px solid #003C17; padding: 20px; margin: 20px 0;">
        <p style="margin-bottom: 15px;">
            Bonjour <strong>{{ $customer->nom }} {{ $customer->prenom }}</strong>,
        </p>
        
        <p style="margin-bottom: 15px;">
            Nous vous confirmons que votre demande de création de compte a bien été enregistrée 
            dans notre système. Notre équipe traitera votre demande dans les plus brefs délais.
        </p>
        
        <div style="background-color: #ffffff; border: 1px solid #ddd; border-radius: 4px; padding: 15px; margin: 15px 0;">
            <h3 style="color: #003C17; font-size: 16px; margin-bottom: 10px;">
                📋 Détails de votre demande :
            </h3>
            <ul style="color: #555; margin-left: 20px; margin-bottom: 0;">
                <li><strong>Référence de la demande :</strong> {{ $demande->refDemande }}</li>
                <li><strong>Date de la demande :</strong> {{ $demande->dateDemande->format('d/m/Y à H:i') }}</li>
                <li><strong>Nom complet :</strong> {{ $customer->nom }} {{ $customer->prenom }}</li>
                <li><strong>Email :</strong> {{ $customer->email }}</li>
                <li><strong>Téléphone :</strong> {{ $customer->cel }}</li>
                <li><strong>Statut :</strong> <span style="color: #f0ad4e;">En attente de traitement</span></li>
            </ul>
        </div>
        
        <p style="margin-bottom: 15px;">
            <strong>⏱️ Délai de traitement :</strong><br>
            Le traitement de votre demande prend généralement <strong>24 à 48 heures ouvrées</strong>. 
            Vous recevrez un email de confirmation une fois votre compte activé.
        </p>
        
        <p style="margin-bottom: 15px;">
            <strong>📧 Prochaines étapes :</strong>
        </p>
        <ol style="color: #555; margin-left: 20px; margin-bottom: 15px;">
            <li>Vérification de vos documents</li>
            <li>Validation de votre demande par notre équipe</li>
            <li>Activation de votre compte</li>
            <li>Envoi de vos identifiants de connexion par email</li>
        </ol>
        
        <p style="margin: 0;">
            <strong>⚠️ Important :</strong> Veuillez vérifier régulièrement votre boîte email 
            (et vos spams) pour ne pas manquer notre réponse.
        </p>
    </div>
    
    <!-- CALL TO ACTION -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 30px 0;">
        <tr>
            <td align="center">
                <a href="{{ $productsLink }}" class="button"
                    style="color: #ffffff; text-decoration: none; font-weight: bold; padding: 14px 28px; 
                    background-color: #003C17; border-radius: 4px; display: inline-block;">
                    Découvrir nos produits
                </a>
            </td>
        </tr>
        {{-- <tr>
            <td align="center" style="padding-top: 10px;">
                <a href="{{ $contactLink }}" 
                    style="color: #003C17; text-decoration: none; font-size: 14px;">
                    Contactez notre support
                </a>
            </td>
        </tr> --}}
    </table>
    
</div>