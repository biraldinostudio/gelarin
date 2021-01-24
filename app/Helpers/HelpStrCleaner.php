<?php
function mb_ucfirst($string, $encoding = 'utf-8')
{
    $strlen = mb_strlen($string, $encoding);
    $first_char = mb_substr($string, 0, 1, $encoding);
    $then = mb_substr($string, 1, $strlen - 1, $encoding);
    
    return mb_strtoupper($first_char, $encoding) . $then;
}
function strCleaner($string)
{
    $string = strip_tags($string, '<br><br/>');
    $string = str_replace(array('<br>', '<br/>', '<br />'), "\n", $string);
    $string = preg_replace("/[\r\n]+/", "\n", $string);
    /*
    Hapus 4 (+) - karakter byte dari string UTF-8
    Sepertinya MySQL tidak mendukung karakter dengan lebih dari 3 byte dalam charset UTF-8 default-nya.
    CATATAN: Anda tidak boleh hanya mengupas, tetapi ganti dengan karakter pengganti U + FFFD untuk menghindari serangan unicode, kebanyakan XSS:
    http://unicode.org/reports/tr36/#Deletion_of_Noncharacters
    */
    $string = preg_replace('/[\x{10000}-\x{10FFFF}]/u', '', $string);
    $string = mb_ucfirst(trim($string));
    
    return $string;
}
?>