<!-- users/espace_client/auth/mails/accountRegisterMail.blade.php -->
<div style="padding: 40px 40px 20px;">
    <h2 style="color: #003C17; font-size: 18px; margin-bottom: 20px;">
        Cher(e) client(e) {{ $customer->nom }} {{ $customer->prenom }},
    </h2>
    
   
        <p style="color: #555555; line-height: 1.6; margin-bottom: 20px;">
            Vous devez finaliser votre inscription en cliquant sur le lien suivant
        </p>
    
</div>

<div style="padding: 0 40px 20px;">
    <div style="background-color: #f9f9f9; border-left: 4px solid #003C17; padding: 20px; margin: 20px 0;">
        <p style="margin-bottom: 15px;">
            Bonjour <strong>{{ $customer->nom }} {{ $customer->prenom }}</strong>,
        </p>
        
        <p style="margin-bottom: 15px;">
           Le contrat {{ $idcontrat }} a bien été ajouté à votre compte, vous pouvez désormais consulter les détails du contrat une fois connecter à votre compte Ynov.
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