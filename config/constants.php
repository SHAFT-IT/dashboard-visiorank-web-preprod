<?php 

return [
    'options' => [
        'sd_send_mail' => 0,
        'nombre_par_page' => 2,
        'sd_mail_from_mail' => 'no-reply@visiorank.net',
        'sd_mail_from_name' => 'Dashboard Visiorank',
        'sd_mail_subject_new_ticket' => 'Une nouvelle demande a été crée dans votre Dashboard Visiorank',
        'sd_mail_subject_modif_ticket' => 'La demande "%s" a été modifié dans votre Dashboard Visiorank',
        'sd_mail_subject_status_changed' => 'Le statut de la demande "%s" a changé'
    ],
    'status' => [
        'STATUT_BROUILLON_KEY' => 1,
        'STATUT_PRISE_EN_CHARGE_KEY' => 2,
        'STATUT_REFUSE_KEY' => 3,
        'STATUT_LIVRE_KEY' => 4,
        'STATUT_VALIDE_KEY' => 5,
        'STATUT_CLOS_KEY' => 6,
        'STATUT_BROUILLON_LABEL' => "Brouillon",
        'STATUT_PRISE_EN_CHARGE_LABEL' => "Prise en charge",
        'STATUT_REFUSE_LABEL' => "Refusé",
        'STATUT_LIVRE_LABEL' => "Livré",
        'STATUT_VALIDE_LABEL' => "Validé",
        'STATUT_CLOS_LABEL' => "Cloturé"
    ],
    'ws' => [
        'ga_client_id' => '766771941565-i8us8l9u82du4604d57cqiesqumsf04t.apps.googleusercontent.com',
        'ga_client_mail' => '766771941565-i8us8l9u82du4604d57cqiesqumsf04t@developer.gserviceaccount.com',
        'imap_ssl_ovh' => '{SSL0.OVH.NET:143/imap}'
       
    ]

];

?>