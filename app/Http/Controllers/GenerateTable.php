<?php

namespace App\Http\Controllers;

use App\TableModel;
use Illuminate\Routing\Controller;

class GenerateTable extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function makeTopTable()
    {
	$domains = isset($_POST['domain_list']) ? htmlspecialchars($_POST['domain_list']) : '';
        $domainArray = array();
        if($domains !== '') {
            $domainsArray = explode("\n", $domains);
        }

        $tableModel = new TableModel;
        $tableModel->cleanTable();
        foreach ($domainsArray as $site) {
            $name = str_replace("\r", "", $site); 
            //look up domain in alexa table    
            $rank = 0;
            //put into table
            $tableModel = new TableModel;
            $tableModel->rank = $rank;
            $tableModel->name = $name;
            $tableModel->save();
        }
        return redirect()->intended('domainTable');
    }

    //get all db domains and ranks
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

    //puts ranks at end of table
    public function makeUserTable() {
        $domains = isset($_POST['domain_list']) ? htmlspecialchars($_POST['domain_list']) : '';
        $domainArray = array();
        if($domains !== '') {
            $domainsArray = explode("\n", $domains);
        }

        $tableModel = new TableModel;
        $tableModel->cleanTable();
        foreach ($domainsArray as $site) {
            $name = str_replace("\r", "", $site);
            //look up domain in alexa table    
            $rank = 0;
            //put into table
            $tableModel = new TableModel;
            $tableModel->rank = $rank;
            $tableModel->name = $name;
            $tableModel->save();
        }
        return redirect()->intended('domainTable');
/*
	$domains = isset($_POST['domain_list']) ? htmlspecialchars($_POST['domain_list']) : '';
        $domainArray = array();
        $results = array();
        if($domains !== '') {
            $domainsArray = explode("\n", $domains);
            foreach ($domainsArray as $site) {
                $name = str_replace("\r", "", $site); 
                //look up domain in alexa table    
                $rank = 0;
                array_push($results, array(0, $site));
            }
        }
        return response()->json($results);
*/
    }

    //get all db domains and ranks
    public function getUserTable()
    {
        $sites = TableModel::all();
        $results = array();
        foreach($sites as $site) {
            array_push($results, array($site->rank, $site->name));
        }
        return response()->json($results);
    }
}
