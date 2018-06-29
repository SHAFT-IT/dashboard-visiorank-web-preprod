<style>
    html,
    body {
        margin: 0 auto !important;
        padding: 0 !important;
        height: 100% !important;
        width: 100% !important;
    }
    * {
        -ms-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%;
    }

    div[style*="margin: 16px 0"] {
        margin: 0 !important;
    }

    table,
    td {
        mso-table-lspace: 0pt !important;
        mso-table-rspace: 0pt !important;
    }

    table {
        border-spacing: 0 !important;
        border-collapse: collapse !important;
        table-layout: fixed !important;
        margin: 0 auto !important;
    }
    table table table {
        table-layout: auto;
    }

    a {
        text-decoration: none;
    }

    img {
        -ms-interpolation-mode:bicubic;
    }

    *[x-apple-data-detectors],  /* iOS */
    .unstyle-auto-detected-links *,
    .aBn {
        border-bottom: 0 !important;
        cursor: default !important;
        color: inherit !important;
        text-decoration: none !important;
        font-size: inherit !important;
        font-family: inherit !important;
        font-weight: inherit !important;
        line-height: inherit !important;
    }

    .a6S {
        display: none !important;
        opacity: 0.01 !important;
    }

    img.g-img + div {
        display: none !important;
    }


    @media only screen and (min-device-width: 320px) and (max-device-width: 374px) {
        .email-container {
            min-width: 320px !important;
        }
    }

    @media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
        .email-container {
            min-width: 375px !important;
        }
    }

    @media only screen and (min-device-width: 414px) {
        .email-container {
            min-width: 414px !important;
        }
    }

    .button-td,
    .button-a {
        transition: all 100ms ease-in;
    }
    .button-td-primary:hover,
    .button-a-primary:hover {
        background: #555555 !important;
        border-color: #555555 !important;
    }

    @media screen and (max-width: 600px) {

        .email-container {
            width: 100% !important;
            margin: auto !important;
        }

        .fluid {
            max-width: 100% !important;
            height: auto !important;
            margin-left: auto !important;
            margin-right: auto !important;
        }

        .stack-column,
        .stack-column-center {
            display: block !important;
            width: 100% !important;
            max-width: 100% !important;
            direction: ltr !important;
        }

        .stack-column-center {
            text-align: center !important;
        }

        .center-on-narrow {
            text-align: center !important;
            display: block !important;
            margin-left: auto !important;
            margin-right: auto !important;
            float: none !important;
        }
        table.center-on-narrow {
            display: inline-block !important;
        }

        .email-container p {
            font-size: 17px !important;
        }
    }

</style>

<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #222222;">
<table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="600" style="margin: 0 auto;" class="email-container">
    <tr style="background-color: black;">
        <td style="padding: 20px 0; text-align: center;">
            <a href="http://www.visiorank.net" target="_blank" style="text-decoration:none;"><img src="http://www.visiorank.net/wp-content/uploads/2016/12/logo-visiorank-blanc.png" width="443" height="105" alt="alt_text" border="0" style="height: auto; font-family: sans-serif; font-size: 15px; line-height: 15px; color: #555555;"></a>
        </td>
    </tr>
    <tr>
        <td style="background-color: #ffffff;">
            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                <tr>
                    <td style="padding: 20px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;">
                        <p style="margin: 0 0 10px;">Bonjour {{ $oUserTicket->prenom }}&nbsp;{{ $oUserTicket->nom }},</p>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 20px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;">
                        <h1 style="margin: 0 0 10px; font-size: 25px; line-height: 30px; color: #333333; font-weight: normal;">
                            @if($isNewTicket)
                                Une nouvelle demande a été crée pour vous dans Dashboard VISIORANK
                            @else
                                Voter demande <strong>{{$oTicket->titre}}</strong> a été mis à jours dans Dashboard VISIORANK
                            @endif
                        </h1>
                        <p style="margin: 0 0 10px;">Ci-dessous les détails de la demande : </p>
                        <ul style="padding: 0; margin: 0; list-style-type: disc;">
                            <li style="margin:0 0 10px 20px;" class="list-item-first"><strong>Titre : </strong>{{$oTicket->titre}}</li>
                            <li style="margin:0 0 10px 20px;"><strong>Description : </strong>{!! str_limit($oTicket->description, 100, ' ... ') !!}</li>
                            <li style="margin:0 0 10px 20px;"><strong>Propriétaire : </strong>{{ $oConnectedUser->prenom }}&nbsp;{{ $oConnectedUser->nom }}</li>
                            <li style="margin:0 0 10px 20px;"><strong>Type : </strong>@if ($oTicket->type == 1) Évolution @elseif ($oTicket->type == 2) Correction @else Demande d'information @endif</li>
                            <li style="margin:0 0 10px 20px;"><strong>Priorité : </strong>@if ($oTicket->priorite_id == 1) Haute @elseif ($oTicket->priorite_id == 2) Normal @else Basse @endif</li>
                            <li style="margin:0 0 10px 20px;"><strong>Utilisateur : </strong>{{ $oUserTicket->societe }}&nbsp;-&nbsp;{{ $oUserTicket->nom }}&nbsp;{{ $oUserTicket->prenom }}</li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 0 20px 20px;">
                        <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" style="margin: auto;">
                            <tr>
                                <td class="button-td button-td-primary" style="border-radius: 4px; background: #222222;">
                                    <a class="button-a button-a-primary" target="_blank" href="{{ action('ServiceDeskController@edit_ticket', array('id' => $oTicket->ticket_id)) }}" style="background: #222222; border: 1px solid #000000; font-family: sans-serif; font-size: 15px; line-height: 15px; text-decoration: none; padding: 13px 17px; color: #ffffff; display: block; border-radius: 4px;">Cliquer ici pour accéder à votre demande</a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 20px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;">
                        <p style="margin: 0 0 10px;">Cordialement,</p>
                        <p style="margin: 0 0 10px;">L'équipe de VISIORANK,</p>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 20px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;">
                        <p style="margin: 0 0 10px;font-size: 10px;"><i>Ceci est un message automatique, veuillez ne pas répondre directement à ce message</i></p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr style="background-color: black;">
        <td style="padding: 20px; text-align: left; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #ffffff; text-align:center;">
            <p style="margin: 0; font-weight:bold;">Des questions ?</p>
            <p style="margin: 0; font-weight:bold;">Contactez notre espace client au</p>
            <p style="margin: 0; font-weight:bold;"><span style="color: #f67d05;">02 22 06 99 03</span></p>
            <p style="margin: 0; font-size: 8px; color: #908f8f; padding-top: 20px;">© Copyright 2018, Visiorank, Booster de chiffre d'affaire sur internet.</p>

        </td>
    </tr>
</table>