<?php

namespace App\Models;

use CodeIgniter\Model;

class Fiche_de_besoin_model extends Model
{
    protected $table      = 'fiche_de_besoin';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes =false;

    protected $allowedFields = ['ID_AGENT_KEY','NOM_PRODUIT','DESCRIPTION',
                                'RAISON','DATE_LIVRAISON_SOUHAITE',
                                'ADRESSE_LIVRAISON','HEURE_LIVRAISON','ETAT_FICHE', 'SIGNATURE_CHEF_DEP',
                                'SIGNATURE_SERVICE_GEN','SIGNATURE_DAF','SIGNATURE_DG','PROFORMAT_1','PROFORMAT_2','PROFORMAT_3'];


    protected $useTimestamps = true;
    protected $createdField  = 'date_creation';
    protected $updatedField  = 'date_modification';
    protected $deletedField  = 'date_suppression';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}