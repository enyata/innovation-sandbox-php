<?php
namespace InnovationSandbox\NIBSS\Common;

class Hash {
    public function BVNData($organisation_code, $password){
        $signatureMethodHeader = 'SHA256';
        $date = date('Ymd');
        $signatureString = $organisation_code.$date.$password;
        $signatureHeader = hash('sha256', $signatureString);
        $authString = $organisation_code.':'.$password;
        $authHeader = base64_encode($authString);
        return [
            'Authorization' => $authHeader,
            'SIGNATURE_METH' => $signatureMethodHeader,
            'SIGNATURE' => $signatureHeader
        ];

    }

    public function encrypt($bvn, $aes_key, $ivkey) {
        $EncryptedText = openssl_encrypt(
            $bvn, 'AES-128-CBC', $aes_key, 
            $options = OPENSSL_RAW_DATA, 
            $ivkey);

        return bin2hex($EncryptedText);
    }

    public function decrypt($data, $aes_key, $ivkey){
        $result = openssl_decrypt(
            hex2bin($data), 
            'AES-128-CBC', 
            $aes_key, 
            $options=OPENSSL_RAW_DATA|OPENSSL_ZERO_PADDING, 
            $ivkey);

        $ans = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $result), true );;
        while ($msg = openssl_error_string()){
            echo $msg . '<br />\n';
        }
        
        return $ans;
    }

}