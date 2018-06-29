<?php

namespace App\Extra;


class ImapAPI
{
    public static function getUnseenMessages($url, $email, $password){
        try {
            $imap = imap_open($url, $email, $password);

            if ($imap) {
                $listMessages = imap_search($imap, 'UNSEEN');
                imap_close($imap);

                return $listMessages ? count($listMessages) : 0;
            }
            return 0;
        }catch (\Exception $e){
            return 0;
        }
    }

    public static function getMessages($url, $email, $password){
        $messages = array();
        try {
            $imap = imap_open($url, $email, $password);

            if ($imap) {
                $nombreMessage = imap_num_msg($imap);
                $messages = imap_fetch_overview($imap, "1:" . $nombreMessage);
                imap_close($imap);
            }
        }catch (\Exception $e){
            return $messages;
        }

        return $messages;
    }

    public static function getMessage($url, $email, $password, $uid){
        $message = array();
        try {
            $imap = imap_open($url, $email, $password);

            if ($imap) {
                $headerText = imap_fetchHeader($imap, $uid, FT_UID);
                $header = imap_rfc822_parse_headers($headerText);

                $corps = ImapAPI::getBody($uid, $imap);

                $message['uid'] = $uid;
                $message['header'] = $header;
                $message['body'] = $corps;
                $message['attachments'] = ImapAPI::extract_attachments($imap, $uid);

                imap_close($imap);
            }
        }catch (\Exception $e){
                return $message;
        }
        return $message;
    }

    static function getBody($uid, $imap) {
        $body = ImapAPI::get_part($imap, $uid, "TEXT/HTML");
        // if HTML body is empty, try getting text body
        if ($body == "") {
            $body = ImapAPI::get_part($imap, $uid, "TEXT/PLAIN");
        }
        return $body;
    }

    static function get_part($imap, $uid, $mimetype, $structure = false, $partNumber = false) {
        if (!$structure) {
            $structure = imap_fetchstructure($imap, $uid, FT_UID);
        }
        if ($structure) {
            if ($mimetype == ImapAPI::get_mime_type($structure)) {
                if (!$partNumber) {
                    $partNumber = 1;
                }
                $text = imap_fetchbody($imap, $uid, $partNumber, FT_UID);
                switch ($structure->encoding) {
                    case 3: return imap_base64($text);
                    case 4: return imap_qprint($text);
                    default: return $text;
                }
            }

            // multipart
            if ($structure->type == 1) {
                foreach ($structure->parts as $index => $subStruct) {
                    $prefix = "";
                    if ($partNumber) {
                        $prefix = $partNumber . ".";
                    }
                    $data = ImapAPI::get_part($imap, $uid, $mimetype, $subStruct, $prefix . ($index + 1));
                    if ($data) {
                        return $data;
                    }
                }
            }
        }
        return false;
    }

    static function get_mime_type($structure) {
        $primaryMimetype = array("TEXT", "MULTIPART", "MESSAGE", "APPLICATION", "AUDIO", "IMAGE", "VIDEO", "OTHER");

        if ($structure->subtype) {
            return $primaryMimetype[(int)$structure->type] . "/" . $structure->subtype;
        }
        return "TEXT/PLAIN";
    }

    static function extract_attachments($connection, $message_number) {

        $attachments = array();
        $structure = imap_fetchstructure($connection, $message_number, FT_UID);

        if(isset($structure->parts) && count($structure->parts)) {

            for($i = 0; $i < count($structure->parts); $i++) {
                if($structure->parts[$i]->ifdparameters) {
                    $attachments[$i] = array(
                        'filename' => '',
                        'name' => '',
                        'attachment' => '',
                        'encoding' => $structure->parts[$i]->encoding
                    );

                    foreach ($structure->parts[$i]->dparameters as $object) {
                        if (strtolower($object->attribute) == 'filename') {
                            $attachments[$i]['filename'] = $object->value;
                        }
                    }
                    foreach ($structure->parts[$i]->parameters as $object) {
                        if (strtolower($object->attribute) == 'name') {
                            $attachments[$i]['name'] = $object->value;
                        }
                    }

                    $attachments[$i]['attachment'] = imap_fetchbody($connection, $message_number, $i + 1, FT_UID);
                    if ($structure->parts[$i]->encoding == 3) { // 3 = BASE64
                        $attachments[$i]['attachment'] = base64_decode($attachments[$i]['attachment']);
                    } elseif ($structure->parts[$i]->encoding == 4) { // 4 = QUOTED-PRINTABLE
                        $attachments[$i]['attachment'] = quoted_printable_decode($attachments[$i]['attachment']);
                    }

                }

            }

        }

        return $attachments;

    }

    public static function downloadAttachment($url, $email, $password, $uid, $partNum, $encoding) {
        $imap = imap_open($url, $email, $password);

        if($imap) {
            $pj = array();
            $partStruct = imap_bodystruct($imap, imap_msgno($imap, $uid), $partNum);
            if($partStruct->subtype == 'ALTERNATIVE'){
                $partNum++;
                $partStruct = imap_bodystruct($imap, imap_msgno($imap, $uid), $partNum);
            }

            $pj['filename'] = $partStruct->dparameters[0]->value;
            $message = imap_fetchbody($imap, $uid, $partNum, FT_UID);

            switch ($encoding) {
                case 0:
                case 1:
                    $message = imap_8bit($message);
                    break;
                case 2:
                    $message = imap_binary($message);
                    break;
                case 3:
                    $message = imap_base64($message);
                    break;
                case 4:
                    $message = quoted_printable_decode($message);
                    break;
            }
            $pj['message'] = $message;


            return $pj;
        }
        return null;
    }

}