<?php

namespace App\Controllers;

use App\Models\Bon_de_commande_model;
use App\Models\Fiche_de_besoin_model;


class Employe extends BaseController{

    public function __constructor()
    {
    }

    public function index()
    {
        $session = session();

        if ($session->get('status')) {

            $fiche = new Fiche_de_besoin_model();
            $fiche_besoin = $fiche->where(
                'ID_AGENT_KEY',$session->get('id'))->findAll();
            return view('pages/dashboard',['fiches'=>$fiche_besoin]);

        } else {
            
            return redirect()->to('/');
        }
        
        
    }

    public function formAddNeed(){

        return view('pages/profile');
    }


    public function addFicheBesoin(){
        
        $session = session();

        if ($session->get('status')) {
            
            helper(['form', 'url']);
            if ($this->request->getMethod() === 'post' && $this->validate([
                'name_prod' => 'required|min_length[3]|max_length[255]',
                'reason' => 'required|min_length[3]|max_length[255]',
                'date_del' => 'required|min_length[3]|max_length[255]',
                'adress_del' => 'required|min_length[3]|max_length[255]',
                'hour_del' => 'required|min_length[3]|max_length[255]',
                'description'  => 'required|min_length[5]|max_length[255]',
            ])) {

                
                $id = $session->get('id');
                $fiche = new Fiche_de_besoin_model();
                $fiche_besoin = $fiche->insert([
                    'ID_AGENT_KEY' =>$id,
                    'NOM_PRODUIT' =>$this->request->getPost('name_prod'),
                    'DESCRIPTION' =>$this->request->getPost('description'),
                    'RAISON' =>$this->request->getPost('reason'),
                    'DATE_LIVRAISON_SOUHAITE' =>$this->request->getPost('date_del'),
                    'ADRESSE_LIVRAISON' =>$this->request->getPost('adress_del'),
                    'HEURE_LIVRAISON' =>$this->request->getPost('hour_del')
                ]);

                $session->setFlashdata('add_demand', 'Vous avez ajout?? une demande cher(e) '.$session->get('name'));
                return  redirect()->to('/demander');
            }
            else{
    
                $session->setFlashdata('rules_repect', true);
                return  redirect()->to($_SERVER['HTTP_REFERER']);
            }
        }
        
    }


    public function allDemandsFromEmploye()
    {
        
        $session = session();

        if ($session->get('status')) {

            $fiche = new Fiche_de_besoin_model();
            $fiche_besoin = $fiche->findAll();
            return view('pages/tables',['fiches'=>$fiche_besoin]);

        } else {
            
            return redirect()->to('/');
        }
    }

    public function validateDemand($id)
    {
        
        $session = session();

        if ($session->get('status')) {

                $fiche = new Fiche_de_besoin_model();
                $fiche_besoin = $fiche->update($id,[
                    'ETAT_FICHE'=>'en attente'
                ]);

                $session->setFlashdata('rules_repect', true);
                return  redirect()->to($_SERVER['HTTP_REFERER']);
        }
    }

    public function annulerDemand($id)
    {
        
        $session = session();

        if ($session->get('status')) {

                $fiche = new Fiche_de_besoin_model();
                $fiche_besoin = $fiche->update($id,[
                    'ETAT_FICHE'=>'annuler'
                ]);

                $session->setFlashdata('rules_repect', true);
                return  redirect()->to($_SERVER['HTTP_REFERER']);
        }
    }

    public function validateDemandService ($id){

        $session = session();

        if ($session->get('status')) {

            $fiche = new Fiche_de_besoin_model();
            $fiche_besoin = $fiche->update($id,[
                'ETAT_FICHE'=>'en cours'
            ]);

            $session->setFlashdata('rules_repect', true);
            return  redirect()->to($_SERVER['HTTP_REFERER']);
        }
    }

    public function annulerDemandService ($id){

        $session = session();

        if ($session->get('status')) {

            $fiche = new Fiche_de_besoin_model();
            $fiche_besoin = $fiche->update($id,[
                'ETAT_FICHE'=>'annuler'
            ]);

            $session->setFlashdata('rules_repect', true);
            return  redirect()->to($_SERVER['HTTP_REFERER']);
        }
    }

    public function allDemandsFromEmployeAttente()
    {
        
        $session = session();

        if ($session->get('status')) {

            $fiche = new Fiche_de_besoin_model();

            $fiche_besoin = $fiche->findAll();

            
            return view('pages/attente',['fiches'=>$fiche_besoin]);

        } else {
            
            return redirect()->to('/');
        }
    }



    public function demandDirector()
    {
        $session = session();

        if ($session->get('status')) {

            $fiche = new Fiche_de_besoin_model();

            $fiche_besoin = $fiche->where(
                'ETAT_FICHE','en cours')->findAll();

            
            return view('pages/directorDemand',['fiches'=>$fiche_besoin]);

        } else {
            
            return redirect()->to('/');
        }
    }


    public function validateDemandDirect ($id){

        $session = session();

        if ($session->get('status')) {

            $fiche = new Fiche_de_besoin_model();
            $fiche_besoin = $fiche->update($id,[
                'ETAT_FICHE'=>'actif'
            ]);

            $session->setFlashdata('rules_repect', true);
            return  redirect()->to($_SERVER['HTTP_REFERER']);
        }
    }

    public function annulerDemandDirect ($id){

        $session = session();

        if ($session->get('status')) {

            $fiche = new Fiche_de_besoin_model();
            $fiche_besoin = $fiche->update($id,[
                'ETAT_FICHE'=>'annuler'
            ]);

            $session->setFlashdata('rules_repect', true);
            return  redirect()->to($_SERVER['HTTP_REFERER']);
        }
    }


    public function addBonCommande(){
        
        $session = session();

        if ($session->get('status')) {
            
            helper(['form', 'url']);
            if ($this->request->getMethod() === 'post' && $this->validate([
                'type_commande' => 'required|min_length[3]|max_length[255]',
                'name_prod' => 'required|min_length[3]|max_length[255]',
                'observation' => 'required|min_length[3]|max_length[255]',
                'date_com' => 'required|min_length[3]|max_length[255]',
                'quantite' => 'required|min_length[3]|max_length[255]',
                'proformat_valide' => 'required|min_length[3]|max_length[255]',
                'fournisseur'  => 'required|min_length[5]|max_length[255]',
            ])) {

                
                $id = $session->get('id');
                $bon = new Bon_de_commande_model();
                $boncommande = $bon->insert([
                    'ID_FICHE_KEY' =>$id,
                    'DESIGNATION_PRODUIT' =>$this->request->getPost('name_prod'),
                    'OBSERVATION' =>$this->request->getPost('observation'),
                    'TYPE_BON_COMMANDE' =>$this->request->getPost('type_commande'),
                    'DATE_BON_COMMANDE' =>$this->request->getPost('date_com'),
                    'QUANTITE' =>$this->request->getPost('quantite'),
                    'PROFORMAT_FOURNISSEUR' =>$this->request->getPost('proformat_valide'),
                    'ID_FOUNISSEUR' =>$this->request->getPost('fournisseur')
                ]);

                $session->setFlashdata('add_demand', 'Vous avez ajout?? une demande cher(e) '.$session->get('name'));
                return  redirect()->to('/demander');
            }
            else{
    
                $session->setFlashdata('rules_repect', true);
                return  redirect()->to($_SERVER['HTTP_REFERER']);
            }
        }
        
    }


     

}