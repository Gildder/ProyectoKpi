<?php
/**
 * Created by PhpStorm.
 * User: gguerrero
 * Date: 17/07/2017
 * Time: 06:05 PM
 */

namespace ProyectoKpi\Cms\Clases;


class Conexion_LDAP
{
    private $PORT = 389;
    private $USER = 'agenteproy';
    private $PASS = 'mcagenteproy';
    private $HOST = '172.17.0.3';
    private $LDAP_COM = '';
    private $DOMINIO = 'multicenter.com.bo';
    private $DN = 'dc=multicenter,dc=com,dc=bo';

    public function conectar()
    {
        $this->LDAP_COM = ldap_connect($this->HOST, $this->PORT) or die("Could not connect to LDAP server.");


        $ldap_dn = 'cn=Admin,dc=multicenter,dc=com.dc=bo';


        ldap_set_option($this->LDAP_COM, LDAP_OPT_PROTOCOL_VERSION, 3);

        if(@ldap_bind($this->LDAP_COM,$ldap_dn, $this->PASS)){
            return true;
        }else{
            return false;
        }
    }

    function mailboxpowerloginrd($user,$pass){
        $ldaprdn = trim($user).'@'.$this->DOMINIO;
        $ldappass = trim($pass);
        $ds = $this->DOMINIO;
        $dn = $this->DN;
        $puertoldap = 389;
        $ldapconn = ldap_connect($ds,$puertoldap);
        ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION,3);
        ldap_set_option($ldapconn, LDAP_OPT_REFERRALS,0);
        $ldapbind = @ldap_bind($ldapconn, $ldaprdn, $ldappass);
        if ($ldapbind){
            $filter="(|(SAMAccountName=".trim($user)."))";
            $fields = array("SAMAccountName", "cn");
            $sr = @ldap_search($ldapconn, $dn, $filter, $fields);
            $info = @ldap_get_entries($ldapconn, $sr);
            $array = $info[0]["cn"][0];
        }else{
            $array=0;
        }
        ldap_close($ldapconn);
        return $array;
    }

}
