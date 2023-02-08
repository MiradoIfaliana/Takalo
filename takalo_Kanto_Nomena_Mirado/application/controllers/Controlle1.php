<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controlle1 extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('login');
		//this: tenany
	}
	public function _construct(){
		//ireo tiana atao alohan'ny fonction rehetra
	}
	public function login()
	{
		$this->load->model('model1');
		$this->load->helper('login_helper');
		//--isLoginValide($nom,$pwd,$users)
		$mail=$this->input->post('mail');
		$pwd=$this->input->post('pwd');
		$users=$this->model1->getUsers();
		$rep=getOneUser($mail,$pwd,$users);
		$this->session->set_userdata('connected',true);
		if($rep!=null){
			if($rep['isadmin']==1){
				$this->session->set_userdata('connected',$rep);
				$objet['objet']=$this->model1->getObjetsbyiduser($rep['iduser']);
				$objet['images']=array();
				$objet['connected']=$rep;
				if($objet['objet']!=null){
					for($i=0;$i<count($objet['objet']);$i++){
						$objet['images'][$i]=$this->model1->getImagesobjetbyidobjet( $objet['objet'][$i]['idobjet'] ); //['images'][$i][$u]-->image iray
					}
				}else{
					$objet['images']=null;
				}

				$this->load->view('acceuil',$objet);

			}else if($rep['isadmin']==0){
				$this->load->view('gestioncategorie');
			}
		}else{
			$message['message']="erreur";
			//$this->load->view('login',$message);
			redirect('controlle1');
		}
		//this: tenany
	}	

	public function toacceuil(){
		$this->load->model('model1');
			$connected=$this->session->userdata('connected');
			$objet['objet']=$this->model1->getObjetsbyiduser($connected['iduser']);
			$objet['images']=array();
			if($objet['objet']!=null){
				for($i=0;$i<count($objet['objet']);$i++){
					$objet['images'][$i]=$this->model1->getImagesobjetbyidobjet( $objet['objet'][$i]['idobjet'] ); //['images'][$i][$u]-->image iray
				}
			}else{
				$objet['images']=null;
			}

			$this->load->view('acceuil',$objet);
	}

	public function toinscrire()
	{
		$this->load->view('inscription');
	}

	public function inscription(){

		$this->load->model('model1');
			$nom=$this->input->post('nom');
			$prenom=$this->input->post('prenom');
			$mail=$this->input->post('mail');
			$pwd=$this->input->post('pwd');
			$nee=$this->input->post('nee');
		$this->model1->inscrire($nom,$prenom,$mail,$pwd,$nee);
		redirect('controlle1');
	}

	public function todetail(){
		$this->load->model('model1'); 
		$idobjet=$this->input->get('idobjet');
		$objet['objet']=$this->model1->getObjetsbyidobjet($idobjet);
		$objet['images']=$this->model1->getImagesobjetbyidobjet($idobjet);
		$this->load->view('detailobjet',$objet);

	}

	public function toficheobjet(){
		$this->load->model('model1');
		$users=$this->model1->getUserwithOutIduserinObjet($_SESSION['connected']['iduser']);
		for($i=0;$i<count($users);$i++){
			$userObjet['objetuser'][$i]['nom']=$users[$i]['nom'];
			$userObjet['objetuser'][$i]['objets']=$this->model1->getObjetsbyiduser($users[$i]['iduser']);

			$userObjet['objetuser'][$i]['images']=array();

			if($userObjet['objetuser'][$i]['objets']!=null){
				for($j=0;$j<count($userObjet['objetuser'][$i]['objets']);$j++){
					$userObjet['objetuser'][$i]['images'][$j]=$this->model1->getImagesobjetbyidobjet( $userObjet['objetuser'][$i]['objets'][$j]['idobjet'] ); //['images'][$j][$u]-->image iray
				}
			}else{
				$userObjet['objetuser'][$i]['images']=null;
			}

		}
		$this->load->view('ficheobjet',$userObjet);
	} 
	public function topropose(){
		$this->load->model('model1'); 
		$objet['objet']=array();
		$objet['myobjet']=array();
		$u=0;
		if( $this->input->post('idobjet') !=false)
		{
		   foreach($this->input->post('idobjet') as $idobjet)
		   {
			  	$objet['objet'][$u]=$this->model1->getObjetsbyidobjet($idobjet);
				$u++;
		   }

		   if($objet['objet']!=null){
				for($i=0;$i<count($objet['objet']);$i++){
					$objet['images'][$i]=$this->model1->getImagesobjetbyidobjet( $objet['objet'][$i]['idobjet'] ); //['images'][$i][$u]-->image iray
				}
		   }else{
				$objet['images']=null;
		   }

		   $objet['myobjet']=$this->model1->getObjetsbyiduser($_SESSION['connected']['iduser']);

		   if($objet['myobjet']!=null){
				for($i=0;$i<count($objet['myobjet']);$i++){
					$objet['myimages'][$i]=$this->model1->getImagesobjetbyidobjet( $objet['myobjet'][$i]['idobjet'] ); //['images'][$i][$u]-->image iray
				}
	       }else{
				$objet['myimages']=null;
	   	   }
		   
		   $this->load->view('propose',$objet);
		}else{

			$users=$this->model1->getUserwithOutIduserinObjet($_SESSION['connected']['iduser']);
			for($i=0;$i<count($users);$i++){
				$userObjet['objetuser'][$i]['nom']=$users[$i]['nom'];
				$userObjet['objetuser'][$i]['objets']=$this->model1->getObjetsbyiduser($users[$i]['iduser']);

				$userObjet['objetuser'][$i]['images']=array();

				if($userObjet['objetuser'][$i]['objets']!=null){
					for($j=0;$j<count($userObjet['objetuser'][$i]['objets']);$j++){
						$userObjet['objetuser'][$i]['images'][$j]=$this->model1->getImagesobjetbyidobjet( $userObjet['objetuser'][$i]['objets'][$j]['idobjet'] ); //['images'][$j][$u]-->image iray
					}
				}else{
					$userObjet['objetuser'][$i]['images']=null;
				}

			}
			$this->load->view('ficheobjet',$userObjet);
		}
	}

	public function executeproposition(){
		$this->load->model('model1'); 
		$objet['sesobjet']=array();
		$objet['mesobjet']=array();

		$lstsesobjet=array();
		$lstmesobjet=array();

		$u=0;
		$o1=false;
		$o2=false;
		if( $this->input->post('sesidobjet') !=false)
		{
		   foreach($this->input->post('sesidobjet') as $idobjet)
		   {
			  	$objet['sesobjet'][$u]=$this->model1->getObjetsbyidobjet($idobjet);
				$lstsesobjet[$u]=$idobjet;
				$u++;
		   }		   
		   $o1=true;
		}
		$u=0;
		if( $this->input->post('mesidobjet') !=false)
		{
		   foreach($this->input->post('mesidobjet') as $idobjet)
		   {
			  	$objet['mesobjet'][$u]=$this->model1->getObjetsbyidobjet($idobjet);
				$lstmesobjet[$u]=$idobjet;
				$u++;
		   }		   
		   $o2=true;
		}
		if($o1==true && $o2==true){
			$this->model1->proposer($lstmesobjet,$lstsesobjet);

		}

			$users=$this->model1->getUserwithOutIduserinObjet($_SESSION['connected']['iduser']);
			for($i=0;$i<count($users);$i++){
				$userObjet['objetuser'][$i]['nom']=$users[$i]['nom'];
				$userObjet['objetuser'][$i]['objets']=$this->model1->getObjetsbyiduser($users[$i]['iduser']);

				$userObjet['objetuser'][$i]['images']=array();

				if($userObjet['objetuser'][$i]['objets']!=null){
					for($j=0;$j<count($userObjet['objetuser'][$i]['objets']);$j++){
						$userObjet['objetuser'][$i]['images'][$j]=$this->model1->getImagesobjetbyidobjet( $userObjet['objetuser'][$i]['objets'][$j]['idobjet'] ); //['images'][$j][$u]-->image iray
					}
				}else{
					$userObjet['objetuser'][$i]['images']=null;
				}

			}
			$this->load->view('ficheobjet',$userObjet);

		
	}

	public function topropositionreceive(){
		$this->load->model('model1'); 
		$propositionreceive['propositionreceive']=$this->model1->getEchangepropositionforIduser($_SESSION['connected']['iduser']);
		$this->load->view('propositionreceive',$propositionreceive);
	}
	public function topropositionsend(){
		$this->load->model('model1'); 
		$propositionsend['propositionsend']=$this->model1->getEchangeproposerParIduser($_SESSION['connected']['iduser']);
		$this->load->view('propositionsend',$propositionsend);
	}
	public function todetailsend(){
		$this->load->model('model1');
		$idechange=$this->input->get('idechange');
		$objet['objetsend']=$this->model1->getobjetpropositionsend($idechange);
		$objet['objetreceive']=$this->model1->getobjetpropositionreceive($idechange);
		$objet['idechange']=$idechange;
		$this->load->view('detailsend',$objet);
	}
	public function todetailreceive(){
		$this->load->model('model1');
		$idechange=$this->input->get('idechange');
		$objet['objetsend']=$this->model1->getobjetpropositionsend($idechange);
		$objet['objetreceive']=$this->model1->getobjetpropositionreceive($idechange);
		$objet['idechange']=$idechange;
		$this->load->view('detailreceive',$objet);
	}

	public function deconnexion(){
		$this->session->sess_destroy();
		redirect('controlle1');
	}
	public function accepter(){
		$this->load->model('model1');
		$idechange=$this->input->get('idechange');
		$iduserdestinataire=$this->input->get('iduserdestinataire');
		$this->model1->accepterproposition($idechange,$iduserdestinataire);


		$users=$this->model1->getUserwithOutIduserinObjet($_SESSION['connected']['iduser']);
		for($i=0;$i<count($users);$i++){
			$userObjet['objetuser'][$i]['nom']=$users[$i]['nom'];
			$userObjet['objetuser'][$i]['objets']=$this->model1->getObjetsbyiduser($users[$i]['iduser']);

			$userObjet['objetuser'][$i]['images']=array();

			if($userObjet['objetuser'][$i]['objets']!=null){
				for($j=0;$j<count($userObjet['objetuser'][$i]['objets']);$j++){
					$userObjet['objetuser'][$i]['images'][$j]=$this->model1->getImagesobjetbyidobjet( $userObjet['objetuser'][$i]['objets'][$j]['idobjet'] ); //['images'][$j][$u]-->image iray
				}
			}else{
				$userObjet['objetuser'][$i]['images']=null;
			}

		}
		$this->load->view('ficheobjet',$userObjet);

	}
	public function refuser(){
		$this->load->model('model1');
		$idechange=$this->input->get('idechange');
		$this->model1->refuserORannuler($idechange);

		$users=$this->model1->getUserwithOutIduserinObjet($_SESSION['connected']['iduser']);
		for($i=0;$i<count($users);$i++){
			$userObjet['objetuser'][$i]['nom']=$users[$i]['nom'];
			$userObjet['objetuser'][$i]['objets']=$this->model1->getObjetsbyiduser($users[$i]['iduser']);

			$userObjet['objetuser'][$i]['images']=array();

			if($userObjet['objetuser'][$i]['objets']!=null){
				for($j=0;$j<count($userObjet['objetuser'][$i]['objets']);$j++){
					$userObjet['objetuser'][$i]['images'][$j]=$this->model1->getImagesobjetbyidobjet( $userObjet['objetuser'][$i]['objets'][$j]['idobjet'] ); //['images'][$j][$u]-->image iray
				}
			}else{
				$userObjet['objetuser'][$i]['images']=null;
			}

		}
		$this->load->view('ficheobjet',$userObjet);

	}
	public function annuler(){
		$this->load->model('model1');
		$idechange=$this->input->get('idechange');
		$this->model1->refuserORannuler($idechange);

		$users=$this->model1->getUserwithOutIduserinObjet($_SESSION['connected']['iduser']);
		for($i=0;$i<count($users);$i++){
			$userObjet['objetuser'][$i]['nom']=$users[$i]['nom'];
			$userObjet['objetuser'][$i]['objets']=$this->model1->getObjetsbyiduser($users[$i]['iduser']);

			$userObjet['objetuser'][$i]['images']=array();

			if($userObjet['objetuser'][$i]['objets']!=null){
				for($j=0;$j<count($userObjet['objetuser'][$i]['objets']);$j++){
					$userObjet['objetuser'][$i]['images'][$j]=$this->model1->getImagesobjetbyidobjet( $userObjet['objetuser'][$i]['objets'][$j]['idobjet'] ); //['images'][$j][$u]-->image iray
				}
			}else{
				$userObjet['objetuser'][$i]['images']=null;
			}

		}
		$this->load->view('ficheobjet',$userObjet);
		
	}

}

