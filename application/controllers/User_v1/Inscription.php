<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inscription extends CI_Controller {

    public $module = "User";
    
    public function __construct() {
        parent::__construct();
        
        load_library("Group");
        load_library("Jury");
        load_library("Member");
        load_library("Grade");
        load_library("School");
        load_library("ImageResizer", "ToolBox");
        
        load_model("UserModel");
        load_model("GroupModel");
        load_model("GradeModel");
        load_model("SchoolModel");
    }

    public function index()
    {
        $this->membre();
    }
    
    public function membre() {              
        $formValid  = false;
        if (isset($_POST))
        {
            // On valide le formulaire
            $formValid = $this->validerFormulaire();
        }
        if(!$formValid)
        {
            // Construit les url passées au formulaire. Permet de gérer leur création dynamiquement ici.
            $data = array(
                'form_participant_uri' => construct_full_url("Inscription", "validerMembre"),
                'form_groupe_uri' => construct_full_url("Inscription", "AJAX_creerGroupe"),
                'form_school_uri' => construct_full_url("Inscription", "AJAX_creerEcole")
                );
            
            // r�cup�ration des sponsors dans les assets
            $imageResizer = new imageResizer();
            $data['images'] = $imageResizer->getSponsors();            

            $data['lesGroupes'] = $this->GroupModel->readAllGroupSchool();            
            $data['lesClasses'] = $this->GradeModel->readAllGrade();
            $data['lesEcoles'] = $this->SchoolModel->readAllSchool();



            load_view("inscriptionParticipant", $data);
        }
        else {
            $groupe = $this->input->post('groupe');
            $groupe = $this->groupModel->readOneGroup($groupe);

            $grade = $this->input->post('classe');
            $grade = $this->gradeModel->readOneGrade($grade);

            $prenom = $this->input->post('prenom');
            $nom = $this->input->post('nom');
            $mail = $this->input->post('mail');
            $password = $this->input->post('password');

            $membre = new Member('', $prenom, $nom, $mail, $password, $groupe, $grade);
            $this->userModel->createParticipant($membre);
            redirect(base_url(), "refresh");
        }

    }

    public function validerMembre() {
        // NULL, true, pour activer la protection csrf
        $data = $this->input->post(NULL, true);
        // R�cuperer l'objet groupe directement depuis le select
        // R�cuperer la classe  directement depuis le select
        $groupeWithEcole = $this->GroupModel->readOneGroupSchool($data['groupe']);
        $classe = $this->GradeModel->readOneGrade($data['classe']);
        $participant = new Member('', $data['prenom'], $data['nom'], $data['email'], md5($data['password']), $groupeWithEcole, $classe);


        $this->UserModel->createParticipant($participant);        

        //ToDo : rediriger sur la home
    }



    public function jury() {


        // r�cup�ration des sponsors dans les assets
        $imageResizer = new imageResizer();              
        $data['images'] = $imageResizer->getSponsors();

        load_view("inscriptionJury", $data);
    }



    /* ***********************************************
     * 
     *        Validation des formulaires
     * 
     * ***********************************************/
    private function validerFormulaire() {
        $this->form_validation->set_rules("nom", "nom", "trim|required|xss_clean");
        $this->form_validation->set_rules("prenom", "prenom", "trim|required|xss_clean");        
        // R�gle qui v�rifie si l'email est unique en BDD (on doit mettre les champs BDD)
        $this->form_validation->set_rules("email", "email", "trim|required|valid_email|is_unique[tm_user_usr.usr_email]|xss_clean");
        $this->form_validation->set_rules("password", "password", "trim|required|min_length[8]|md5|xss_clean");
        
        $this->form_validation->set_error_delimiters('<span class="help-block with-errors">', '</span>');
        
        $success = false;
        
        if ($this->form_validation->run() == TRUE)
        {
            $success = true;
        }
        
        return $success;
        
    }
    
    
    
    
    /* ***********************************************
     * 
     *        Vue appel�es en ajax
     * 
     ************************************************/
    public function AJAX_creerGroupe() {
        $libelleGroupe = $this->input->post("nomGroupe");
        $idEcole = $this->input->post("ecole");
        $school = new School($idEcole, "", "");
        $groupe = new Group("", $libelleGroupe, $school);
        
        $groupe = $this->GroupModel->createGroupe($groupe);
    }
    
    public function AJAX_creerEcole() {
        $libelleEcole = $this->input->post("nomEcole");
        $ville = $this->input->post("ville");
        $school = new School("", $libelleEcole, $ville);        
        $ecole = $this->SchoolModel->createSchool($school);
        $this->AJAX_reloadSchool();
    }
    
    public function AJAX_checkMail() {
        $email = $this->input->post("email");
        $check = $this->UserModel->countByEmail($email);
        
        if ($check >= 1)
        {
            echo "1";
        }
        else {
            echo "0";
        }
        return $check;
    }
    
    public function AJAX_reloadSchool() {
        $data['lesEcoles'] = $this->SchoolModel->readAllSchool();
        load_simple_view("ajax/selectSchool", $data);
        // $this->load->view("utilisateur/ajax/reloadSchool.php");
    }
}

