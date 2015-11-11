<?php

namespace App\Http\Controllers;

use App\TableModel;
use App\UserModel;
use Illuminate\Routing\Controller;

class GenerateTable extends Controller
{
    //get all top db domains and ranks
    public function getTopTable()
    {
        $sites = TableModel::all();
        $results = array();
        foreach($sites as $site) {
            array_push($results, array($site->rank, $site->name));
        }
        return response()->json($results);
    }

    //adds a new domain and rank to db manually
    public function adminAdd() {
	$rank   = isset($_POST['rank'])   ? htmlspecialchars($_POST['rank'])   : '';
	$domain = isset($_POST['domain']) ? htmlspecialchars($_POST['domain']) : '';
        if($rank !== '' && $domain !== '') {
            $tableModel = new TableModel;
            $tableModel->rank = $rank;
            $tableModel->name = $domain;
            $tableModel->save();
        }
        return redirect()->intended('/adminview');
    }

    //puts ranks in table
    public function makeUserTable() {
        $domains = isset($_POST['domain_list']) ? htmlspecialchars($_POST['domain_list']) : '';
        $domainArray = array();
        if($domains !== '') {
            $domainsArray = explode("\n", $domains);
        }

        $userModel = new UserModel;
        $userModel->cleanTable();
        foreach ($domainsArray as $siteName) {
            $site = str_replace("\r", "", $siteName);
            $accessKeyId = "AKIAJGMJHABBXMYJDXTQ";
            $secretAccessKey = "u2KzeMmzyymW0OyXTWcqukssiguYBWxe1otpkyhE";
            $ActionName        = 'UrlInfo';
            $ResponseGroupName = 'Rank,ContactInfo,LinksInCount';
            $ServiceHost      = 'awis.amazonaws.com';
            $NumReturn         = 10;
            $StartNum          = 1;
            $SigVersion        = '2';
            $HashAlgorithm     = 'HmacSHA256';
            $params = array(
                'Action'            => $ActionName,
                'ResponseGroup'     => $ResponseGroupName,
                'AWSAccessKeyId'    => $accessKeyId,
                'Timestamp'         => gmdate("Y-m-d\TH:i:s.\\0\\0\\0\\Z", time()),
                'Count'             => $NumReturn,
                'Start'             => $StartNum,
                'SignatureVersion'  => $SigVersion,
                'SignatureMethod'   => $HashAlgorithm,
                'Url'               => $site
            );
            ksort($params);
            $keyvalue = array();
            foreach($params as $k => $v) {
                $keyvalue[] = $k . '=' . rawurlencode($v);
            }
            $queryParams = implode('&',$keyvalue);
            $sign = "GET\n".strtolower($ServiceHost)."\n/\n".$queryParams;
            $sig1 = base64_encode(hash_hmac('sha256', $sign, $secretAccessKey, true));
            $sig = rawurlencode($sig1);
            $url = 'http://'.$ServiceHost.'/?'.$queryParams . '&Signature=' . $sig;
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_TIMEOUT, 4);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($ch);
            curl_close($ch);
            $xml = new \SimpleXMLElement($result, null, false, 'http://awis.amazonaws.com/doc/2005-07-11');
            if($xml->count() && $xml->Response->UrlInfoResult->Alexa->count()) {
                $info = $xml->Response->UrlInfoResult->Alexa;
                $nice_array = array(
                    'Rank'           => $info->TrafficData->Rank
                );
            }
            $rank = $nice_array['Rank'];

            //put into table
            $userModel = new UserModel;
            $userModel->rank = $rank;
            $userModel->name = $site;
            $userModel->save();
        }
        return redirect()->intended('domainTable');
    }

    //get all user db domains and ranks
    public function getUserTable()
    {
        $sites = UserModel::all();
        $results = array();
        foreach($sites as $site) {
            array_push($results, array($site->rank, $site->name));
        }
        return response()->json($results);
    }
}
