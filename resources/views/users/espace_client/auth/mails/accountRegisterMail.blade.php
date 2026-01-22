<!-- users/espace_client/auth/mails/accountRegisterMail.blade.php -->
<div style="padding: 40px 40px 20px;">
    <h2 style="color: #003C17; font-size: 18px; margin-bottom: 20px;">
        Cher(e) client(e) {{ $customer->nom }} {{ $customer->prenom }},
    </h2>
     @if($emailType == 'account-register-end')
        <p style="color: #555555; line-height: 1.6; margin-bottom: 20px;">
            Votre compte YNOV a bien été crée succès
        </p>
    @else
    <p style="color: #555555; line-height: 1.6; margin-bottom: 20px;">
        Vous devez finaliser votre inscription en cliquant sur le lien suivant
    </p>
    @endif
</div>

<div style="padding: 0 40px 20px;">
    <div style="background-color: #f9f9f9; border-left: 4px solid #003C17; padding: 20px; margin: 20px 0;">
        <p style="margin-bottom: 15px;">
            Bonjour <strong>{{ $customer->nom }} {{ $customer->prenom }}</strong>,
        </p>
        
        @if($emailType == 'account-register-end')
        <p style="margin-bottom: 15px;">
            Votre compte Ynov a bien été crée succès vous pouvez désormais vous connecter à l'aide de vos accès suivant :
        </p>
        <p style="margin-bottom: 15px;">
            Veuillez cliquer sur le lien ci-dessous, munis de votre login et mot de passe pour acceder à votre compte :
        </p>
        @else
        <p style="margin-bottom: 15px;">
            Votre compte a bien été créé :
        </p>
        @endif
        
        
        <div style="background-color: #ffffff; border: 1px solid #ddd; border-radius: 4px; padding: 15px; margin: 15px 0;">
            <h3 style="color: #003C17; font-size: 16px; margin-bottom: 10px;">
                Vos identifiants de connexion :
            </h3>
            <ul style="color: #555; margin-left: 20px; margin-bottom: 0;">
                <li><strong>Login :</strong> {{ $customer->login }}</li>
                <li><strong>Mot de passe :</strong> Utilisez le mot de passe défini au moment de votre inscription</li>

                <li><strong>Nom complet :</strong> {{ $customer->nom }} {{ $customer->prenom }}</li>
                <li><strong>Email :</strong> {{ $customer->email }}</li>
                <li><strong>Téléphone :</strong> {{ $customer->cel }}</li>
            </ul>
        </div>
        

        
        <p style="margin: 0;">
            <strong>⚠️ Important :</strong> Cependant, vous devez finaliser votre inscription en cliquant sur le lien suivant pour associer au moins un contrat d\'assurance 
        </p>
    </div>
    
    <!-- CALL TO ACTION -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 30px 0;">
        <tr>
            <td align="center">
                <a href="{{ $btnLink }}" class="button"
                    style="color: #ffffff; text-decoration: none; font-weight: bold; padding: 14px 28px; 
                    background-color: #003C17; border-radius: 4px; display: inline-block;">
                    {{ $btnText }}
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