<?php
function ldap_auth($ldap_id, $ldap_password){
	$ds = ldap_connect("ldap.iitb.ac.in") or die("Unable to connect to LDAP server. Please try again later.");
	if($ldap_id=='') return "NONE";
	if($ldap_password=='') return "NONE";

	$sr = ldap_search($ds,"dc=iitb,dc=ac,dc=in","(uid=$ldap_id)");
	$info = ldap_get_entries($ds, $sr);
        $roll = $info[0]["employeenumber"][0];
	$ldap_id = $info[0]['dn'];

	if(ldap_bind($ds,$ldap_id,$ldap_password)){
		return $info;
	}
	else
	{
		return "NONE";
	}
}
?>

