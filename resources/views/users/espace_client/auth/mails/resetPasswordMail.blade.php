 <!-- GREETING -->
 <tr>
     <td style="padding: 40px 40px 20px;">
         <h2 style="color: #003C17; font-size: 18px; margin-bottom: 20px;">
             Cher(e) client(e) {{ $fullName }},
         </h2>
         <p style="color: #555555; line-height: 1.6; margin-bottom: 20px;">
             Vous avez demandé la réinitialisation de votre mot de passe pour votre compte client Yako Africa Assurances Vie.
         </p>
     </td>
 </tr>

 <!-- CONTENT -->
 <tr>
     <td style="padding: 0 40px 20px;">
         <div style="background-color: #f9f9f9; border-left: 4px solid #003C17; padding: 20px; margin: 20px 0;">

             <p>Bonjour <strong>{{ htmlspecialchars($fullName) }}</strong>,</p>

             <p>Vous avez demandé la réinitialisation de votre mot de passe pour votre compte client Yako Africassur.
             </p>

             <p>Pour procéder à la réinitialisation, cliquez sur le bouton ci-dessous :</p>

             <p style="margin: 30px 0;">
                 <strong style="color:#d9534f;">⚠️ Important :</strong> Ce lien de réinitialisation est valable pendant
                 <strong>60 minutes</strong> seulement.
             </p>

             <p>Si vous n'avez pas demandé cette réinitialisation, veuillez ignorer cet email. Votre mot de passe
                 restera inchangé.</p>

             <p>Pour des raisons de sécurité, nous vous recommandons de :</p>
             <ul style="margin-left: 20px;">
                 <li>Choisir un mot de passe fort (majuscules, minuscules, chiffres, caractères spéciaux)</li>
                 <li>Ne jamais partager votre mot de passe</li>
                 <li>Changer régulièrement votre mot de passe</li>
             </ul>

             <p>Cordialement,<br>L'équipe de support Yako Africassur</p>
         </div>

         <!-- CALL TO ACTION -->
         <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 30px 0;">
             <tr>
                 <td align="center">
                     <a href="{{ $resetLink ?? '#' }}" class="button"
                         style="color: #ffffff; text-decoration: none; font-weight: bold; padding: 14px 28px; background-color: #003C17; border-radius: 4px; display: inline-block;">
                         Réinitialiser mon mot de passe
                     </a>
                 </td>
             </tr>
             <tr>
                 <td align="center" style="padding-top: 15px;">
                     <p style="color: #777777; font-size: 12px;">
                         Lien direct : <a href="{{ $resetLink ?? '#' }}"
                             style="color: #003C17; word-break: break-all;">{{ $resetLink ?? '' }}</a>
                     </p>
                 </td>
             </tr>
         </table>

         <!-- IMPORTANT NOTE -->
         <div
             style="background-color: #fff8e1; border: 1px solid #ffd54f; padding: 15px; border-radius: 4px; margin: 20px 0;">
             <p style="color: #856404; margin: 0;">
                 <strong>⚠️ IMPORTANT :</strong> Ce lien est valable pendant <strong>60 minutes</strong> seulement.
                 Après expiration, vous devrez refaire une demande de réinitialisation.
             </p>
         </div>

         <!-- SECURITY NOTE -->
         <div
             style="background-color: #f8f9fa; border: 1px solid #e9ecef; padding: 15px; border-radius: 4px; margin: 20px 0;">
             <p style="color: #495057; margin-bottom: 10px;">
                 <strong>🔒 Sécurité :</strong> Si vous n'êtes pas à l'origine de cette demande :
             </p>
             <ul style="color: #495057; margin-left: 20px; margin-bottom: 0;">
                 <li>Ignorez simplement cet email</li>
                 <li>Votre mot de passe restera inchangé</li>
                 <li>Contactez notre support si vous êtes inquiet</li>
             </ul>
         </div>
     </td>
 </tr>
