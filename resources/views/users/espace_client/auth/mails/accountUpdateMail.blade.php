<!-- users/espace_client/auth/mails/accountUpdateMail.blade.php -->
<div style="padding: 40px 40px 20px;">
    <h2 style="color: #003C17; font-size: 18px; margin-bottom: 20px;">
        Cher(e) client(e) {{ $fullName }},
    </h2>
    
    <p style="color: #555555; line-height: 1.6; margin-bottom: 20px;">
        Votre compte Yako Africassur a été mis à jour avec succès.
    </p>
</div>

<div style="padding: 0 40px 20px;">
    <div style="background-color: #f9f9f9; border-left: 4px solid #003C17; padding: 20px; margin: 20px 0;">
        <p style="margin-bottom: 15px;">
            Bonjour <strong>{{ htmlspecialchars($fullName) }}</strong>,
        </p>
        
        <p style="margin-bottom: 15px;">
            Nous vous confirmons que votre compte client a été mis à jour avec succès. 
            Vous pouvez désormais utiliser les nouvelles informations de connexion.
        </p>
        
        <div style="background-color: #ffffff; border: 1px solid #ddd; border-radius: 4px; padding: 15px; margin: 15px 0;">
            <h3 style="color: #003C17; font-size: 16px; margin-bottom: 10px;">
                📋 Informations de votre compte :
            </h3>
            <ul style="color: #555; margin-left: 20px; margin-bottom: 0;">
                <li><strong>Nom d'utilisateur (Login) :</strong> {{ $login }}</li>
                <li><strong>Email :</strong> {{ $membre->email }}</li>
                <li><strong>Nom complet :</strong> {{ $membre->nom }} {{ $membre->prenom }}</li>
                <li><strong>Téléphone :</strong> {{ $membre->tel }}</li>
            </ul>
        </div>
        
        <p style="margin: 20px 0 15px;">
            <strong>🔐 Conseil de sécurité important :</strong>
        </p>
        <ul style="color: #555; margin-left: 20px; margin-bottom: 15px;">
            <li>Nous vous recommandons de changer votre mot de passe régulièrement</li>
            <li>N'utilisez jamais le même mot de passe sur plusieurs sites</li>
            <li>Activez l'authentification à deux facteurs si disponible</li>
            <li>Ne partagez jamais vos informations de connexion</li>
        </ul>
        
        <p style="margin-bottom: 15px;">
            Vous pouvez maintenant accéder à votre espace client en utilisant vos nouvelles informations de connexion.
        </p>
        
        <p style="margin: 0;">
            Cordialement,<br>
            <strong>L'équipe de support Yako Africassur</strong>
        </p>
    </div>
    
    <!-- CALL TO ACTION -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 30px 0;">
        <tr>
            <td align="center">
                <a href="{{ $loginLink }}" class="button"
                    style="color: #ffffff; text-decoration: none; font-weight: bold; padding: 14px 28px; 
                    background-color: #003C17; border-radius: 4px; display: inline-block;">
                    Accéder à mon espace client
                </a>
            </td>
        </tr>
        <tr>
            <td align="center" style="padding-top: 15px;">
                <p style="color: #777777; font-size: 12px;">
                    Lien direct : <a href="{{ $loginLink }}"
                        style="color: #003C17; word-break: break-all;">{{ $loginLink }}</a>
                </p>
            </td>
        </tr>
    </table>
    
    <!-- IMPORTANT NOTE -->
    <div style="background-color: #e8f4fd; border: 1px solid #b6d4fe; padding: 15px; border-radius: 4px; margin: 20px 0;">
        <p style="color: #084298; margin: 0;">
            <strong>ℹ️ Informations importantes :</strong>
        </p>
        <ul style="color: #084298; margin-left: 20px; margin-bottom: 0;">
            <li>Si vous n'avez pas effectué cette mise à jour, veuillez contacter immédiatement notre support</li>
            <li>Conservez cet email pour vos références</li>
            <li>Votre sécurité est notre priorité</li>
        </ul>
    </div>
    
</div>