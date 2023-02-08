<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model1 extends CI_Model {

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
	public function getUsers(){
		$query = $this-> db ->query("SELECT * from user");
		$admin=array();
		$i=0;
		foreach($query->result_array() as $admin[$i]){
			$i++;
		}
		return $admin;
	}

	public function justexecute($rqt){
		$this->db->query($rqt);
	}

	public function inscrire($nom,$prenom,$mail,$password,$nee){
		$rqt="insert into user (nom,prenom,mail,pwd,nee,isadmin) values('%s','%s','%s','%s','%s',1)";
		$rqt=sprintf($rqt,$nom,$prenom,$mail,$password,$nee);
		$this->db->query($rqt);
	}

	public function getObjetsbyiduser($iduser){
		$rqt="SELECT * from objet where iduser=%d";
		$rqt=sprintf($rqt,$iduser);
		$query = $this-> db ->query($rqt);
		$objets=array();
		$i=0;
		foreach($query->result_array() as $objets[$i]){
			$i++;
		}
		return $objets;
	}
	public function getObjetsbyidobjet($idobjet){
		$rqt="SELECT * from objet where idobjet=%d";
		$rqt=sprintf($rqt,$idobjet);
		$query = $this-> db ->query($rqt);
		$objet=null;
		foreach($query->result_array() as $objet){
			return $objet;
		}
		return $objet;
	}
	public function getImagesobjetbyidobjet($idobjet){
		$rqt="SELECT * from image_objet where idobjet=%d";
		$rqt=sprintf($rqt,$idobjet);
		$query = $this-> db ->query($rqt);
		$images=array();
		$i=0;
		foreach($query->result_array() as $images[$i]){
			$i++;
		}
		return $images;
	}
	public function getObjetswithOutIduser($iduser){
		$rqt="SELECT * from objet where iduser!=%d order by iduser";
		$rqt=sprintf($rqt,$iduser);
		$query = $this-> db ->query($rqt);
		$objets=array();
		$i=0;
		foreach($query->result_array() as $objets[$i]){
			$i++;
		}
		return $objets;
	}
	public function getUserwithOutIduserinObjet($iduser){
		$rqt="SELECT * from user where iduser in (SELECT iduser from objet where iduser!=%d order by iduser) group by iduser order by iduser";
		$rqt=sprintf($rqt,$iduser);
		$query = $this-> db ->query($rqt);
		$users=array();
		$i=0;
		foreach($query->result_array() as $users[$i]){
			$i++;
		}
		return $users;
	}
	public function proposer($lstidobjet_envoyeur,$lstidobjet_destinataire){
		$date=Date('y-m-d h:i:s');
		$rqt="INSERT into echange (datedemande,dateaccepte) values('%s',NULL)";
		$rqt=sprintf($rqt,$date);
		$this->db->query($rqt);

		$rqt="SELECT * from echange where idechange=(SELECT max(idechange) from echange) ";
		$query = $this-> db ->query($rqt);
		$echangelast=null;
		foreach($query->result_array() as $last){
			$echangelast=$last;
		}

		for($i=0;$i<count($lstidobjet_envoyeur); $i++){
			$date=Date('y-m-d h:i:s');
			$rqt="INSERT into echange_objet_envoyeur (idechange,idobjet) values(%d,%d)";
			$rqt=sprintf($rqt,$echangelast['idechange'],$lstidobjet_envoyeur[$i]);
			$this->db->query($rqt);
		}
		for($i=0;$i<count($lstidobjet_destinataire); $i++){
			$date=Date('y-m-d h:i:s');
			$rqt="INSERT into echange_objet_destinataire (idechange,idobjet) values(%d,%d)";
			$rqt=sprintf($rqt,$echangelast['idechange'],$lstidobjet_destinataire[$i]);
			$this->db->query($rqt);
		}
	}
	
	public function getEchangepropositionforIduser($iduser){
		$rqt="SELECT * from echange where idechange in ( select idechange from echange_objet_destinataire where idobjet in (select idobjet from objet where iduser=%d) ) and dateaccepte is null";
		$rqt=sprintf($rqt,$iduser);
		$query = $this-> db ->query($rqt);
		$echange=array();
		$i=0;
		foreach($query->result_array() as $echange[$i]){
			$i++;
		}
		if($i==0){ $echange=null; }
		return $echange;
	}
	public function getEchangeproposerParIduser($iduser){
		$rqt="SELECT * from echange where idechange in ( select idechange from echange_objet_envoyeur where idobjet in (select idobjet from objet where iduser=%d) ) and dateaccepte is null";
		$rqt=sprintf($rqt,$iduser);
		$query = $this-> db ->query($rqt);
		$echange=array();
		$i=0;
		foreach($query->result_array() as $echange[$i]){
			$i++;
		}
		if($i==0){ $echange=null; }
		return $echange;
	}
	public function getobjetpropositionsend($idechange){
		$rqt="SELECT * from objet where idobjet in (select idobjet from echange_objet_envoyeur where idechange=%d)";
		$rqt=sprintf($rqt,$idechange);
		$query = $this-> db ->query($rqt);
		$objetsend=array();
		$i=0;
		foreach($query->result_array() as $objetsend[$i]){
			$i++;
		}
		if($i==0){ $objetsend=null; }
		return $objetsend;
	}
	public function getobjetpropositionreceive($idechange){
		$rqt="SELECT * from objet where idobjet in (select idobjet from echange_objet_destinataire where idechange=%d)";
		$rqt=sprintf($rqt,$idechange);
		$query = $this-> db ->query($rqt);
		$objetreceive=array();
		$i=0;
		foreach($query->result_array() as $objetreceive[$i]){
			$i++;
		}
		if($i==0){ $objetreceive=null; }
		return $objetreceive;
	}

	public function accepterproposition($idechange,$iduserdestinataire){
		$date=Date('y-m-d h:i:s');
		$rqt="UPDATE echange set dateaccepte='%s' where idechange=%d";
		$rqt=sprintf($rqt,$date,$idechange);
		$this->db->query($rqt);

		//destinataire devient proprietaire des objets du envoyeur
		$rqt="UPDATE objet set iduser=%d where idobjet in (select idobjet from echange_objet_envoyeur where idechange=%d)";
		$rqt=sprintf($rqt,$iduserdestinataire,$idechange);
		$this->db->query($rqt);

		//envoyeur devient proprietaire des objets du destinaire
		$rqt="UPDATE objet set iduser=%d where idobjet in (select idobjet from echange_objet_destinataire where idechange=%d)";
		$rqt=sprintf($rqt,$_SESSION['connected']['iduser'],$idechange);
		$this->db->query($rqt);

	}
	public function refuserORannuler($idechange){

		$rqt="DELETE from echange_objet_envoyeur where idechange=%d";
		$rqt=sprintf($rqt,$idechange);
		$this->db->query($rqt);

		$rqt="DELETE from echange_objet_destinataire where idechange=%d";
		$rqt=sprintf($rqt,$idechange);
		$this->db->query($rqt);

		$rqt="DELETE from echange where idechange=%d";
		$rqt=sprintf($rqt,$idechange);
		$this->db->query($rqt);
	}
	
}

