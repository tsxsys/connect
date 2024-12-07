<?php
/***************
 * Constants   *
 **************/

use Connect\AppConfig;
use Connect\Contract;

$passphrase = "X7aK8nU8zT5jS7bW";

function generateRandomString($length)
{
    return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
}

//echo  generateRandomString(10);  // OR: generateRandomString(24)
/**********************************
 ***   UUID Generator  ***
 **********************************/
function gen_uuid(): string
{
    return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        // 32 bits for "time_low"
        mt_rand(0, 0xffff), mt_rand(0, 0xffff),

        // 16 bits for "time_mid"
        mt_rand(0, 0xffff),

        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        mt_rand(0, 0x0fff) | 0x4000,

        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand(0, 0x3fff) | 0x8000,

        // 48 bits for "node"
        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    );
}
/**********************************
            ***   End  ***
 **********************************/

/**********************************
 ***  Password generator  ***
 **********************************/
function passwordGenerator()
{
    $salt = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 10);
    $hex = md5($salt . uniqid("", true));
    $pack = pack('H*', $hex);
    $tmp = base64_encode($pack);
    $pass = preg_replace("#(*UTF8)[^A-Za-z0-9]#", "", $tmp);
    $len = max(10, min(128, 10));
    $unique_pwd = substr($pass, 0, $len);
    return $unique_pwd;
}
/**********************************
 ***  Password generator End  ***
 **********************************/

/**********************************
 ***  Error Logging generator  ***
 **********************************/
function logger($str = '')
{
    $file = 'log.txt';
    $current = file_get_contents($file);
    file_put_contents($file, $str . PHP_EOL, FILE_APPEND);
}

/**********************************
 ***   End  ***
 **********************************/

/**************************************
 ***  Alphanumeric Token generator  ***
 **************************************/
function alphanumeric_token($length = 5)
{
    $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
    $string = '';
    for ($i = 0; $i < $length; $i++) {
        $string .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $string;
}
/**********************************
 ***   End  ***
 **********************************/
function quotify($string, $isString = true, $char = "'") {
    $quotify_string = stripslashes($string);
    $quotify_string = str_pad($quotify_string, strlen($quotify_string) + 2, $char, STR_PAD_BOTH);
    return $isString ? $quotify_string : $string;
}

function truncate($string, $length, $append): string
{
    $string = trim($string);

    if (strlen($string) > $length) {
        $string = wordwrap($string, $length);
        $string = explode("\n", $string, 2);
        $string = $string[0] . $append;
    }

    return $string;
}

function roundTo($value, $length)
{
    return number_format((float)$value, $length, '.', '');
}

function imgCheck($file_dir, $file_name, $replacement_file_name): string
{
    if (empty($file_name)) {
        $file_path = $file_dir . $replacement_file_name;
    } else {
        $file_path = $file_dir . "/" . $file_name;
        if (@get_headers($file_path)[0] == 'HTTP/1.1 404 Not Found') {
            $file_path = $file_dir . $replacement_file_name;
        }
    }
    return $file_path;
}

function decodeJSBase64($encoded_data, $iv_base64, $key_base64): string
{
    $encrypted = base64_decode($encoded_data); // data_base64 from JS
    $iv = base64_decode($iv_base64);   // iv_base64 from JS
    $key = base64_decode($key_base64);  // key_base64 from JS


    /* MCRYPT */
    $plaintext = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $encrypted, MCRYPT_MODE_CBC, $iv);

    /***************************************/
    /* OPENSSL */
//    $plaintext = openssl_decrypt($encrypted, 'AES-256-CBC', $key, 0, $iv);
// or
//    $plaintext = openssl_decrypt("data_base64", 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv); // works with base64 encoded data from JS

// remove padding added by crypt algorithms
    // remove tab-, zero- and space-padding
    return rtrim($plaintext, "\t\0 ");

}


function bs_4800_colorsel()
{
    $bs_4800_Colours = array(
        '00 E 55 Gloss White', '00 A 01 Ash Grey', '00 A 05 Goose Grey', '00 A 09 Flint Grey', '00 A 13 Storm Grey', '02 C 33 Lupin Pink',
        '02 C 37 Clover Pink', '02 C 39 Victoria Plum', '02 C 40 Deep Plum', '04 B 15 Pastel Pink', '04 B 17 Dusky Pink',
        '04 B 21 Sable', '04 C 33 Orchid Pink', '04 C 37 Autumn Brown', '04 C 39 Brick Red', '04 D 44 Misty Red',
        '04 D 45 Dark Cherry', '04 E 49 Rose Pink', '04 E 51 Salmon Red', '04 E 53 Poppy', '06 C 33 Peach', '06 C 37 Leather Brown',
        '06 C 39 Saddle Brown', '06 D 43 Mid Tan', '06 D 45 Teak', '06 E 50 Mellow Apricot', '06 E 51 Mandarin Orange',
        '06 E 56 Maori Brown', '08 B 15 Magnolia', '08 B 17 Honey Beige', '08 B 21 Antelope', '08 B 25 Beaver Brown',
        '08 B 29 Bitter Chocolate', '08 C 31 Honey Suckle Cream', '08 C 35 Fudge', '08 C 37 Caramel', '08 C 39 Coffee',
        '08 E 51 Golden Yellow', '10 A 03 Dawn Mist', '10 A 07 Nimbus Grey', '10 A 11 Charcoal Grey', '10 B 15 Creamy White',
        '10 B 17 Oatmeal', '10 B 21 Lizard Grey', '10 B 25 Turtle Green', '10 B 29 Vandyke Brown', '10 C 31 Ivory',
        '10 C 33 Vanilla', '10 C 35 Wheat', '10 C 39 Dark Olive', '10 D 43 Golden Maize', '10 D 45 French Mustard',
        '10 E 49 Pale Primrose', '10 E 50 Grapefruit', '10 E 53 Sunflower Yellow', '12 B 15 Seafoam', '12 B 17 Green Mist',
        '12 B 21 Mineral Green', '12 B 25 Spruce Green', '12 B 29 Midnight Green', '12 C 33 Green Haze', '12 C 39 Ivy Green',
        '12 D 43 Greengage', '12 D 45 Dark Laurel', '12 E 51 Pale Lime', '12 E 53 Linden Green', '14 C 31 Glacial Green',
        '14 C 35 Iceplant Green', '14 C 39 Holly Green', '14 C 40 Moss Green', '14 E 51 Bright Green', '14 E 53 Irish Green',
        '16 C 33 Duck Egg Blue', '16 C 37 Reef Green', '16 D 45 Dark Jade', '16 E 53 Aquamarine', '18 B 17 Blue Mink',
        '18 B 21 Squirrel Grey', '18 B 25 Dark Admiralty Grey', '18 B 29 Raven', '18 C 31 Ice Blue', '18 C 35 Corvette Blue',
        '18 C 39 Fathom Blue', '18 D 43 Dresden Blue', '18 E 49 Crystal Blue', '18 E 50 Ribbon Blue', '18 E 51 Delphinium Blue',
        '18 E 53 Tartan Blue', '20 C 33 Porcelain Blue', '20 C 37 Larkspur Blue', '20 C 40 Duchess Blue', '20 D 45 Sapphire Blue',
        '20 E 51 Cornflower Blue', '22 B 15 Pearl Grey', '22 B 17 Pale Lavender', '22 C 37 Purple Heather', '22 D 45 Deep Purple',
        '24 C 33 Pale Lilac', '24 C 39 Regal Violet'

    );

    foreach ($bs_4800_Colours as $key => $value):
        echo "<option value='BS 4800 - " . $value . "'>$value</option>";
    endforeach;
}

function ralcolorsel()
{
    $ralColours = array(
        '9002 Grey White', '7046 Telegrey 2', '1000 Green Beige', '1001 Pale Beige', '1002 Sand Yellow', '1003 Signal Yellow', '1004 Dark Golden Yellow',
        '1005 Honey Yellow', '1006 Maize Yellow', '1007 Chrome Yellow', '1011 Brown Beige', '1012 Lemon Yellow',
        '1013 Pearl White', '1014 Dark Ivory', '1015 Light Ivory', '1016 Sulphur Yellow', '1017 Saffron Yellow',
        '1018 Zinc Yellow', '1019 Grey Beige', '1020 Olive Yellow', '1021 Cadmium Yellow', '1023 Traffic Yellow',
        '1024 Ochre Yellow', '1027 Curry Yellow', '1028 Mellon Yellow', '1032 Broom Yellow', '1033 Dahlia Yellow',
        '1034 Pastel Yellow', '2000 Yellow Orange', '2001 Red Orange', '2002 Vermillion', '2003 Pastel Orange',
        '2004 Pure Orange', '2008 Light Red Orange', '2009 Traffic Orange', '2010 Signal Orange', '2011 Deep Orange',
        '2012 Salmon Orange', '3000 Flame Red', '3001 RAL Signal Red', '3002 Carmine Red', '3003 Ruby Red',
        '3004 Purple Red', '3005 Wine Red', '3007 Black Red', '3009 Oxide Red', '3011 Brown Red', '3012 Beige Red',
        '3013 Tomato Red', '3014 Antique Pink', '3015 Light Pink', '3016 Coral Red', '3017 Rose', '3018 Strawberry Red',
        '3020 Traffic Red', '3022 Dark Salmon Red', '3027 Raspberry Red', '3031 Orient Red', '4001 Red Lilac',
        '4002 Red Violet', '4003 Heather Violet', '4004 Claret Violet', '4005 Blue Lilac', '4006 Traffic Purple',
        '4007 Purple Violet', '4008 Signal Violet', '4009 Pastel Violet', '4010 Telemagenta', '5000 Violet Blue',
        '5001 Green Blue', '5002 Ultramarine Blue', '5003 dark Sapphire Blue', '5004 Black Blue', '5005 Signal Blue',
        '5007 Brilliant Blue', '5008 Grey Blue', '5009 Light Azure Blue', '5010 Gentian Blue', '5011 Steel Blue',
        '5012 Light Blue', '5013 Dark Cobalt Blue', '5014 Pigeon Blue', '5015 Middle Sky Blue', '5017 Traffic Blue',
        '5018 Turkish Blue', '5019 Capri Blue', '5020 Ocean Blue', '5021 Water Blue', '5022 Night Blue', '5023 Fern Blue',
        '5024 Pastel Blue', '6000 Patina Green', '6001 Middle Emerald Green', '6002 Leaf Green', '6003 Middle Olive Green',
        '6004 Blue Green', '6005 Light Moss Green', '6006 Grey Olive', '6007 Bottle Green', '6008 Brown Green',
        '6009 Fir Green', '6010 Middle Grass Green', '6011 Reseda Green', '6012 Black Green', '6013 Reed Green',
        '6014 Yellow Olive', '6015 Black Olive', '6016 Turquoise Green', '6017 May Green', '6018 Yellow Green',
        '6019 Pastel Green', '6020 Chrome Green', '6021 Pale Green', '6022 Brown Olive', '6024 Traffic Green',
        '6025 Bracken Green', '6026 Opal Green', '6027 Turkish Green', '6028 Pine Tree Green', '6029 Mint Green',
        '6032 Signal Green', '6033 Turquoise Blue', '6034 Pale Turquoise', '7000 Dark Squirrel Grey', '7001 Silver Grey',
        '7002 Olive Grey', '7003 Moss Grey', '7004 Signal Grey', '7005 Mouse Grey', '7006 Beige Grey', '7008 Khaki Grey',
        '7009 Green Grey', '7010 Tarpaulin Grey', '7011 Iron Grey', '7012 Basalt Grey', '7013 Brown Grey', '7015 Slate Grey',
        '7016 Anthracite Grey', '7021 Black Grey', '7022 Umber Grey', '7023 Concrete Grey', '7024 Graphite Grey',
        '7026 Granite Grey', '7030 Stone Grey', '7031 Blue Grey', '7032 Grey', '7033 Cement Grey', '7034 Yellow Grey',
        '7035 Pale Grey', '7036 Platinum Grey', '7037 Dusty Grey', '7038 Agate Grey', '7039 Quartz Grey', '7040 Window Grey',
        '7042 Traffic Grey A', '7043 Traffic Grey B', '7044 Silky Grey', '7045 Telegrey 1', '7047 Telegrey 4',
        '8000 Green Brown', '8001 Gold Brown', '8002 Signal Brown', '8003 Clay Brown', '8004 Copper Brown', '8007 Fawn Brown',
        '8008 Olive Brown', '8011 Nut Brown', '8012 Red Brown', '8014 Sepia Brown', '8015 Chestnut Brown', '8016 Mahogany Brown',
        '8017 Chocolate Brown', '8019 Grey Brown', '8022 Black Brown', '8023 Orange Brown', '8024 Beige Brown',
        '8025 Pale Brown', '8028 Earth Brown', '9001 Cream', '9003 Signal White', '9004 Signal Black',
        '9005 Jet Black', '9010 Pure White', '9011 Graphite Black', '9016 Traffic White', '9017 Traffic Black', '9018 Papyrus White'
    );

    foreach ($ralColours as $key => $value):
        echo "<option value='RAL - " . $value . "'>$value</option>";
    endforeach;
}

$countries = array(
    "AF" => "Afghanistan",
    "AX" => "Aland Islands",
    "AL" => "Albania",
    "DZ" => "Algeria",
    "AS" => "American Samoa",
    "AD" => "Andorra",
    "AO" => "Angola",
    "AI" => "Anguilla",
    "AQ" => "Antarctica",
    "AG" => "Antigua and Barbuda",
    "AR" => "Argentina",
    "AM" => "Armenia",
    "AW" => "Aruba",
    "AU" => "Australia",
    "AT" => "Austria",
    "AZ" => "Azerbaijan",
    "BS" => "Bahamas",
    "BH" => "Bahrain",
    "BD" => "Bangladesh",
    "BB" => "Barbados",
    "BY" => "Belarus",
    "BE" => "Belgium",
    "BZ" => "Belize",
    "BJ" => "Benin",
    "BM" => "Bermuda",
    "BT" => "Bhutan",
    "BO" => "Bolivia",
    "BA" => "Bosnia and Herzegovina",
    "BW" => "Botswana",
    "BV" => "Bouvet Island",
    "BR" => "Brazil",
    "IO" => "British Indian Ocean Territory",
    "BN" => "Brunei Darussalam",
    "BG" => "Bulgaria",
    "BF" => "Burkina Faso",
    "BI" => "Burundi",
    "KH" => "Cambodia",
    "CM" => "Cameroon",
    "CA" => "Canada",
    "CV" => "Cape Verde",
    "KY" => "Cayman Islands",
    "CF" => "Central African Republic",
    "TD" => "Chad",
    "CL" => "Chile",
    "CN" => "China",
    "CX" => "Christmas Island",
    "CC" => "Cocos (Keeling) Islands",
    "CO" => "Colombia",
    "KM" => "Comoros",
    "CG" => "Congo",
    "CD" => "Congo, The Democratic Republic of The",
    "CK" => "Cook Islands",
    "CR" => "Costa Rica",
    "CI" => "Cote D'ivoire",
    "HR" => "Croatia",
    "CU" => "Cuba",
    "CY" => "Cyprus",
    "CZ" => "Czech Republic",
    "DK" => "Denmark",
    "DJ" => "Djibouti",
    "DM" => "Dominica",
    "DO" => "Dominican Republic",
    "EC" => "Ecuador",
    "EG" => "Egypt",
    "SV" => "El Salvador",
    "GQ" => "Equatorial Guinea",
    "ER" => "Eritrea",
    "EE" => "Estonia",
    "ET" => "Ethiopia",
    "FK" => "Falkland Islands (Malvinas)",
    "FO" => "Faroe Islands",
    "FJ" => "Fiji",
    "FI" => "Finland",
    "FR" => "France",
    "GF" => "French Guiana",
    "PF" => "French Polynesia",
    "TF" => "French Southern Territories",
    "GA" => "Gabon",
    "GM" => "Gambia",
    "GE" => "Georgia",
    "DE" => "Germany",
    "GH" => "Ghana",
    "GI" => "Gibraltar",
    "GR" => "Greece",
    "GL" => "Greenland",
    "GD" => "Grenada",
    "GP" => "Guadeloupe",
    "GU" => "Guam",
    "GT" => "Guatemala",
    "GG" => "Guernsey",
    "GN" => "Guinea",
    "GW" => "Guinea-bissau",
    "GY" => "Guyana",
    "HT" => "Haiti",
    "HM" => "Heard Island and Mcdonald Islands",
    "VA" => "Holy See (Vatican City State)",
    "HN" => "Honduras",
    "HK" => "Hong Kong",
    "HU" => "Hungary",
    "IS" => "Iceland",
    "IN" => "India",
    "ID" => "Indonesia",
    "IR" => "Iran, Islamic Republic of",
    "IQ" => "Iraq",
    "IE" => "Ireland",
    "IM" => "Isle of Man",
    "IL" => "Israel",
    "IT" => "Italy",
    "JM" => "Jamaica",
    "JP" => "Japan",
    "JE" => "Jersey",
    "JO" => "Jordan",
    "KZ" => "Kazakhstan",
    "KE" => "Kenya",
    "KI" => "Kiribati",
    "KP" => "Korea, Democratic People's Republic of",
    "KR" => "Korea, Republic of",
    "KW" => "Kuwait",
    "KG" => "Kyrgyzstan",
    "LA" => "Lao People's Democratic Republic",
    "LV" => "Latvia",
    "LB" => "Lebanon",
    "LS" => "Lesotho",
    "LR" => "Liberia",
    "LY" => "Libyan Arab Jamahiriya",
    "LI" => "Liechtenstein",
    "LT" => "Lithuania",
    "LU" => "Luxembourg",
    "MO" => "Macao",
    "MK" => "Macedonia, The Former Yugoslav Republic of",
    "MG" => "Madagascar",
    "MW" => "Malawi",
    "MY" => "Malaysia",
    "MV" => "Maldives",
    "ML" => "Mali",
    "MT" => "Malta",
    "MH" => "Marshall Islands",
    "MQ" => "Martinique",
    "MR" => "Mauritania",
    "MU" => "Mauritius",
    "YT" => "Mayotte",
    "MX" => "Mexico",
    "FM" => "Micronesia, Federated States of",
    "MD" => "Moldova, Republic of",
    "MC" => "Monaco",
    "MN" => "Mongolia",
    "ME" => "Montenegro",
    "MS" => "Montserrat",
    "MA" => "Morocco",
    "MZ" => "Mozambique",
    "MM" => "Myanmar",
    "NA" => "Namibia",
    "NR" => "Nauru",
    "NP" => "Nepal",
    "NL" => "Netherlands",
    "AN" => "Netherlands Antilles",
    "NC" => "New Caledonia",
    "NZ" => "New Zealand",
    "NI" => "Nicaragua",
    "NE" => "Niger",
    "NG" => "Nigeria",
    "NU" => "Niue",
    "NF" => "Norfolk Island",
    "MP" => "Northern Mariana Islands",
    "NO" => "Norway",
    "OM" => "Oman",
    "PK" => "Pakistan",
    "PW" => "Palau",
    "PS" => "Palestinian Territory, Occupied",
    "PA" => "Panama",
    "PG" => "Papua New Guinea",
    "PY" => "Paraguay",
    "PE" => "Peru",
    "PH" => "Philippines",
    "PN" => "Pitcairn",
    "PL" => "Poland",
    "PT" => "Portugal",
    "PR" => "Puerto Rico",
    "QA" => "Qatar",
    "RE" => "Reunion",
    "RO" => "Romania",
    "RU" => "Russian Federation",
    "RW" => "Rwanda",
    "SH" => "Saint Helena",
    "KN" => "Saint Kitts and Nevis",
    "LC" => "Saint Lucia",
    "PM" => "Saint Pierre and Miquelon",
    "VC" => "Saint Vincent and The Grenadines",
    "WS" => "Samoa",
    "SM" => "San Marino",
    "ST" => "Sao Tome and Principe",
    "SA" => "Saudi Arabia",
    "SN" => "Senegal",
    "RS" => "Serbia",
    "SC" => "Seychelles",
    "SL" => "Sierra Leone",
    "SG" => "Singapore",
    "SK" => "Slovakia",
    "SI" => "Slovenia",
    "SB" => "Solomon Islands",
    "SO" => "Somalia",
    "ZA" => "South Africa",
    "GS" => "South Georgia and The South Sandwich Islands",
    "ES" => "Spain",
    "LK" => "Sri Lanka",
    "SD" => "Sudan",
    "SR" => "Suriname",
    "SJ" => "Svalbard and Jan Mayen",
    "SZ" => "Swaziland",
    "SE" => "Sweden",
    "CH" => "Switzerland",
    "SY" => "Syrian Arab Republic",
    "TW" => "Taiwan, Province of China",
    "TJ" => "Tajikistan",
    "TZ" => "Tanzania, United Republic of",
    "TH" => "Thailand",
    "TL" => "Timor-leste",
    "TG" => "Togo",
    "TK" => "Tokelau",
    "TO" => "Tonga",
    "TT" => "Trinidad and Tobago",
    "TN" => "Tunisia",
    "TR" => "Turkey",
    "TM" => "Turkmenistan",
    "TC" => "Turks and Caicos Islands",
    "TV" => "Tuvalu",
    "UG" => "Uganda",
    "UA" => "Ukraine",
    "AE" => "United Arab Emirates",
    "GB" => "United Kingdom",
    "US" => "United States",
    "UM" => "United States Minor Outlying Islands",
    "UY" => "Uruguay",
    "UZ" => "Uzbekistan",
    "VU" => "Vanuatu",
    "VE" => "Venezuela",
    "VN" => "Viet Nam",
    "VG" => "Virgin Islands, British",
    "VI" => "Virgin Islands, U.S.",
    "WF" => "Wallis and Futuna",
    "EH" => "Western Sahara",
    "YE" => "Yemen",
    "ZM" => "Zambia",
    "ZW" => "Zimbabwe");
function countrySel()
{
    foreach ($GLOBALS['countries'] as $key => $value):
        echo "<option value='" . htmlspecialchars($value) . "' title='" . htmlspecialchars($value) . "' id='" . htmlspecialchars($key) . "'>" . htmlspecialchars($value) . "</option>";
    endforeach;
}

function array_delete($delArrKey, $array1)
{
    //deletes from
    if (is_array($delArrKey)) {
        foreach ($delArrKey as $del_key => $del_value) {
            foreach ($array1 as $key => $value) {
                if ($value == $del_value) {
                    unset($array1[$key]);
                }
            }
        }
    } else {
        foreach ($array1 as $key => $value) {
            if ($value == $delArrKey) {
                unset($array1[$key]);
            }
        }
    }
    return $array1;
}
function list_default_files()
{
    list_files('default', null);
}
function list_files($file_type, $file_id)
{
    $_DES_DIR = getDES_DIR($file_type, $file_id, $conf);
    $files = glob($_DES_DIR . '*.*', GLOB_BRACE);
    if (glob($_DES_DIR . "/*")) {
        foreach ($files as $file) {
            $path_parts = pathinfo($file);
            $file_size = round(filesize($file) / 1024 / 1024, 2);

            $filename = $path_parts['filename'];
            $extension = $path_parts['extension'];

            echo '<tr>
                        <td>
                            <span><i class="icon-docs"></i></span> ' . $filename . '
                            <br>
                                <small>
                                    [' . $extension . ', ' . $file_size . ' MB] 
                                    <a href="download.php?dt='.$file_type.'&dn=' . urlencode($filename) . '&de=' . urlencode($extension) . '&di=' . urlencode($file_id) . '">Download</a>';
            if ($extension == 'pdf' || $extension == 'PDF') {
                echo '
                                    <span> | </span>
                                    <a href="view.pdf.php?dt='.$file_type.'&dn=' . urlencode($filename) . '&de=' . urlencode($extension) . '&di=' . urlencode($file_id) . '" target="_blank">View</a>';
            }
            echo '</small>
                        </td>
                    </tr>';
        }
    } else {
        echo '<tr><td><p class="info_data text-center">No additional documents available.</p></td></tr>';
    }
}
function getFileServerDir($__FILE_SERVER_DIR): string
{
    $appConfig = AppConfig::pullMultiSettings(array("base_dir", "base_url", "avatar_dir", "allowed_file_types", "max_upload_size"));
    return $appConfig["base_dir"] . 'console/modules/file_server/'.$__FILE_SERVER_DIR.'/';
}
function list_contract_files($contract_id)
{
    $data = (new Connect\Contract)->pullAllContractFiles($contract_id);
//    echo json_encode($data);
    $file_target = 'contract';
    $files = glob(getFileServerDir('contracts') . '*.*', GLOB_BRACE);
    if (glob(getFileServerDir('contracts') . "/*")) {
        foreach ($files as $file) {
            if (in_array($file, $data)) {
                $path_parts = pathinfo($file);
                $file_size = round(filesize($file) / 1024 / 1024, 2);

                $filename = $path_parts['filename'];
                $extension = $path_parts['extension'];
                $realFileName = pathinfo($data['file_name'])['filename'];
                echo '<tr>
                        <td>
                            <span><i class="icon-docs"></i></span> ' . $realFileName . '
                            <br>
                                <small>
                                    [' . $extension . ', ' . $file_size . ' MB] 
                                    <a href="download.php?dt=' . $file_target . '&dn=' . urlencode($filename) . '&de=' . urlencode($extension) . '&di=' . urlencode($file_id) . '">Download</a>';
                if ($extension == 'pdf' || $extension == 'PDF') {
                    echo '
                                    <span> | </span>
                                    <a href="view.pdf.php?dt=' . $file_target . '&dn=' . urlencode($filename) . '&de=' . urlencode($extension) . '&di=' . urlencode($file_id) . '" target="_blank">View</a>';
                }
                echo '</small>
                        </td>
                    </tr>';
            }
        }
    } else {
        echo '<tr><td><p class="info_data text-center">No additional documents available.</p></td></tr>';
    }
}


// used for checking if IO is assigned and check the checkbox
function ifInArray($needle, $checkedArr, $column_key_id): bool
{
    $array = array(); // Store the query results in the array
    foreach ($checkedArr as $result) {
        $array[] = $result;
    }
    if (in_array($needle, array_column($array, $column_key_id))) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

/**
 * @param $file_type
 * @param $file_id
 * @param $conf
 * @return string
 */
function getDES_DIR($file_target_dir = null, $file_id = null, $conf = null)
{
//    switch ($file_type) {
//        case 'contract':
//            $FILE_DES_DIR = CONTRACTS_FILE_DIR;
//            break;
//        case 'datasheets':
//            $FILE_DES_DIR = DATASHEETS_FILE_DIR;
//            break;
//        case 'software':
//            $FILE_DES_DIR = SOFTWARE_FILE_DIR;
//            break;
//        default:
//            $FILE_DES_DIR = STORAGE_DIR . 'files/';
//
//    }
    if ($file_target_dir == "contract_docs") {
        $_HRF_URL = $conf->base_url . '/console/modules/file_server/contracts/';
        $_DES_DIR = CONTRACTS_FILE_DIR;
        $_DES_URL = $_HRF_URL . '/' . $file_id . '/';
    } else if ($file_target_dir == "software") {
        $_HRF_URL = $conf->base_url . '/console/modules/file_server/io/';
        $_DES_DIR = SOFTWARE_FILE_DIR;
        $_DES_URL = $_HRF_URL . '/';
    } else if ($file_target_dir == "default") {
        $_HRF_URL = $conf->base_url . '/console/modules/file_server/datasheets/default/';
        $_DES_DIR = DATASHEETS_FILE_DIR . 'default/';
        $_DES_URL = $_HRF_URL . '/';
    } else {
        $_DES_DIR = '';
    }
    $FILE_DES_DIR = $_SERVER['DOCUMENT_ROOT'] . '/portal_production/console/modules/file_server/contracts/';
    if (empty($FILE_DES_DIR)) {
        $e = 'Error obtaining the file directory';
        error_log($e);
        echo $e;
    }
    return $FILE_DES_DIR;
}

function download_file($file_target, $file_name, $file_extension, $file_id = null)
{
    if (!empty($file_target) && !empty($file_name) && !empty($file_extension)) {
        $_DES_DIR = getDES_DIR($file_target, $file_id, $conf);

        if (!empty($_DES_DIR)) {
            $_FILE_TARGET = $_DES_DIR . $file_name . '.' . $file_extension;
//            echo $_FILE_TARGET;
            if (!empty($_FILE_TARGET)) {
                // Process download
                if (file_exists($_FILE_TARGET)) {
                    header('Content-Description: File Transfer');
                    header('Content-Type: application/octet-stream');
                    header('Content-Disposition: attachment; filename="' . basename($_FILE_TARGET) . '"');
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate');
                    header('Pragma: public');
                    header('Content-Length: ' . filesize($_FILE_TARGET));
                    flush(); // Flush system output buffer
                    readfile($_FILE_TARGET);
                } else {
                    http_response_code(404);
                }
                die();
            }
        }
    }
}
function file_check($file_type, $file_id, $data){
//    $_DES_DIR = getDES_DIR($file_type, $file_id);
    $_DES_DIR = $_SERVER['DOCUMENT_ROOT'] . '/portal_production/console/modules/file_server/io/';

    $files = glob($_DES_DIR . '*.*', GLOB_BRACE);
    if (glob($_DES_DIR . "/*")) {
        foreach ($files as $file) {
            if (in_array($file, $data)) {
                return true;
            } else return false;
        }
    }
}
function open_doc($file_type, $file_name, $file_extension, $file_id = null)
{
    if (!empty($file_type) && !empty($file_name) && !empty($file_extension)) {
        $_DES_DIR = getDES_DIR($file_type, $file_id, $conf);

        if (!empty($_DES_DIR)) {
            $_FILE_TARGET = $_DES_DIR . $file_name . '.' . $file_extension;
//            echo $_FILE_TARGET;
            if (!empty($_FILE_TARGET)) {
                if (file_exists($_FILE_TARGET)) {
                    $pdf = file_get_contents($_FILE_TARGET);
                    header('Content-Type: application/pdf');
                    header('Cache-Control: public, must-revalidate, max-age=0'); // HTTP/1.1
                    header('Pragma: public');
                    header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
                    header('Content-Length: ' . strlen($pdf));
                    header('Content-Disposition: inline; filename="' . basename($_FILE_TARGET) . '";');
                    ob_clean();
                    flush();
                    echo $pdf;
                } else {
                    http_response_code(404);
                    $e = 'error opening file';
                    error_log($e);
                }
                die();
            }
        }
    }
}

//Calling the function by

//$array1 = array('apple', 'orange', 'strawberry', 'blueberry', 'kiwi');
//$delArrKey = array('orange', 'apple');
//$new_arr = array_delete_insert($delArrKey, $array1);

/********************************************************
 *-------------Encryption & Decryption -----------------*
 ********************************************************/
/**
 * Decrypt data from a CryptoJS json encoding string
 *
 * @param mixed $passphrase
 * @param mixed $jsonString
 * @return mixed
 */
function cryptoJsAesDecrypt($passphrase, $jsonString)
{
    $jsondata = json_decode($jsonString, true);
    $salt = hex2bin($jsondata["s"]);
    $ct = base64_decode($jsondata["ct"]);
    $iv = hex2bin($jsondata["iv"]);
    $concatedPassphrase = $passphrase . $salt;
    $md5 = array();
    $md5[0] = md5($concatedPassphrase, true);
    $result = $md5[0];
    for ($i = 1; $i < 3; $i++) {
        $md5[$i] = md5($md5[$i - 1] . $concatedPassphrase, true);
        $result .= $md5[$i];
    }
    $key = substr($result, 0, 32);
    $data = openssl_decrypt($ct, 'aes-256-cbc', $key, true, $iv);
    return json_decode($data, true);
}

/**
 * Encrypt value to a cryptojs compatible json encoding string
 *
 * @param mixed $passphrase
 * @param mixed $value
 * @return string
 */
function cryptoJsAesEncrypt($passphrase, $value)
{
    $salt = openssl_random_pseudo_bytes(8);
    $salted = '';
    $dx = '';
    while (strlen($salted) < 48) {
        $dx = md5($dx . $passphrase . $salt, true);
        $salted .= $dx;
    }
    $key = substr($salted, 0, 32);
    $iv = substr($salted, 32, 16);
    $encrypted_data = openssl_encrypt(json_encode($value), 'aes-256-cbc', $key, true, $iv);
    $data = array("ct" => base64_encode($encrypted_data), "iv" => bin2hex($iv), "s" => bin2hex($salt));
    return json_encode($data);
}

//Calling the function by

//$encrypted = '{"ct":"nPfd1U0y9o2hRCdwJK6XkM1E01wa1ZjMu3eAzGjUD60=","iv":"2abda27fc571cf74e6efc1ba564801f9","s":"813a340e805f54ae"}';
//$key = "123456";
//$decrypted = cryptoJsAesDecrypt($passphrase, $encrypted);
/*********************************************
 *-------------HR Functions -----------------*
 *********************************************/
function getDuration($date_from, $date_to)
{
    $leave_from = new DateTime($date_from);
    $leave_to = new DateTime($date_to);

    // otherwise the  end date is excluded (bug?)
    $leave_to->modify('+1 day');
    $interval = $leave_to->diff($leave_from);
    // total days
    $no_days = $interval->days;
    // create an iterable period of date (P1D equates to 1 day)
    $period = new DatePeriod($leave_from, new DateInterval('P1D'), $leave_to);
    // best stored as array, so you can add more than one
//        $holidays = array('2012-09-07');

    foreach ($period as $dt) {
        $curr = $dt->format('D');

        // substract if Saturday or Sunday
        if ($curr == 'Sat' || $curr == 'Sun') {
            $no_days--;
        }

        // (optional) for the updated question
//            elseif (in_array($dt->format('Y-m-d'), $holidays)) {
//                $days--;
//            }
    }
    return $no_days;
}