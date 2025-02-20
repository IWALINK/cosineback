<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Nouvelle demande de contact - IWALINK</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f4f4f4;">
    <table role="presentation" style="width: 100%; border-collapse: collapse; border: 0; border-spacing: 0; background: #ffffff;">
        <tr>
            <td align="center" style="padding: 40px 0;">
                <table role="presentation" style="width: 600px; border-collapse: collapse; border: 0; border-spacing: 0; text-align: left; background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                    <!-- En-tête -->
                    <tr>
                        <td style="padding: 30px; background-color: #000000; border-radius: 8px 8px 0 0;">
                            <h1 style="margin: 0; font-size: 24px; color: #ffffff;">Nouvelle demande de contact</h1>
                        </td>
                    </tr>

                    <!-- Contenu principal -->
                    <tr>
                        <td style="padding: 30px;">
                            <p style="margin: 0 0 20px 0; font-size: 16px; line-height: 1.5; color: #333333;">
                                Une nouvelle demande de contact a été reçue avec les informations suivantes :
                            </p>

                            <!-- Informations du contact -->
                            <table role="presentation" style="width: 100%; border-collapse: collapse; margin-bottom: 30px;">
                                <tr>
                                    <td style="padding: 15px; background-color: #f8f8f8; border-bottom: 1px solid #eeeeee;">
                                        <strong style="color: #666666;">Nom :</strong>
                                        <div style="margin-top: 5px; color: #333333;">{{ $nom }}</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 15px; background-color: #ffffff; border-bottom: 1px solid #eeeeee;">
                                        <strong style="color: #666666;">Email :</strong>
                                        <div style="margin-top: 5px; color: #333333;">{{ $email }}</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 15px; background-color: #f8f8f8; border-bottom: 1px solid #eeeeee;">
                                        <strong style="color: #666666;">Sujet :</strong>
                                        <div style="margin-top: 5px; color: #333333;">{{ $sujet }}</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 15px; background-color: #ffffff;">
                                        <strong style="color: #666666;">Message :</strong>
                                        <div style="margin-top: 10px; color: #333333; line-height: 1.6;">{{ $messageContent }}</div>
                                    </td>
                                </tr>
                            </table>

                            <!-- Informations de contact IWALINK -->
                            <table role="presentation" style="width: 100%; border-collapse: collapse; border-top: 2px solid #eeeeee; padding-top: 20px;">
                                <tr>
                                    <td style="padding: 20px 0;">
                                        <p style="margin: 0; color: #666666; font-size: 14px; line-height: 1.5;">
                                            IWALINK<br/>
                                            Chemin de la Grottrause 10<br/>
                                            CH-1023 Crissier<br/>
                                            Tél: +41 22 362 04 04<br/>
                                            Email: Info@iwalink.ch
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Pied de page -->
                    <tr>
                        <td style="padding: 30px; background-color: #f8f8f8; border-radius: 0 0 8px 8px; text-align: center;">
                            <p style="margin: 0; font-size: 12px; color: #666666;">
                                Cet email a été envoyé automatiquement. Merci de ne pas y répondre directement.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
