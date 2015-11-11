<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\TableModel;

class AlexaTop extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:alexa';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pull top 500 domains from Alexa and store in DB.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $tableModel = new TableModel;
        $tableModel->cleanTable();
        for($j = 0; $j<5; $j++) {
            $accessKeyId       = "AKIAJGMJHABBXMYJDXTQ";
            $secretAccessKey   = "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";
            $ActionName        = 'TopSites';
            $ResponseGroupName = 'Country';
            $ServiceHost       = 'ats.amazonaws.com';
            $NumReturn         = 100;
            $StartNum          = 1 + 100*$j;
            $SigVersion        = '2';
            $HashAlgorithm     = 'HmacSHA256';
            $params = array(
                'Action'            => $ActionName,
                'ResponseGroup'     => $ResponseGroupName,
                'AWSAccessKeyId'    => $accessKeyId,
                'Timestamp'         => gmdate("Y-m-d\TH:i:s.\\0\\0\\0\\Z", time()),
                'CountryCode'       => "",
                'Count'             => $NumReturn,
                'Start'             => $StartNum,
                'SignatureVersion'  => $SigVersion,
                'SignatureMethod'   => $HashAlgorithm
            );
            ksort($params);
            $keyvalue = array();
            foreach($params as $k => $v) {
                $keyvalue[] = $k . '=' . rawurlencode($v);
            }
            $queryParams = implode('&',$keyvalue);
            $sign = "GET\n".strtolower($ServiceHost)."\n/\n".$queryParams;
            $sig1 = base64_encode(hash_hmac('sha256', $sign, $secretAccessKey, true));
            $sig =  rawurlencode($sig1);
            $url = 'http://'.$ServiceHost.'/?'.$queryParams.'&Signature='.$sig;

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_TIMEOUT, 4);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($ch);
            curl_close($ch);
            $xml = new \SimpleXMLElement($result, null, false, 'http://ats.amazonaws.com/doc/2005-11-21');

            foreach($xml->Response->TopSitesResult->Alexa->TopSites->Country->Sites->children('http://ats.amazonaws.com/doc/2005-11-21') as $site) {
                $tableModel = new TableModel;
                $tableModel->rank = $site->Global->Rank;
                $tableModel->name = $site->DataUrl;
                $tableModel->save();
            }
        }
    }
}
