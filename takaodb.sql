create table user (
   iduser int primary key auto_increment, 
   nom varchar(30),
   prenom varchar(30),
   mail varchar(30),
   pwd varchar(30),
   nee date,
   isadmin int check(isadmin=0 or isadmin=1)
);
insert into user (nom,prenom,mail,pwd,nee,isadmin) values ('Moli','Quen','moli@gmail.com','1234','2001-02-02',1);
insert into user (nom,prenom,mail,pwd,nee,isadmin) values ('Ken','Kal','ken@gmail.com','1234','1999-01-06',1);
insert into user (nom,prenom,mail,pwd,nee,isadmin) values ('Sali','Maj','sali@gmail.com','1234','2002-03-10',1);
insert into user (nom,prenom,mail,pwd,nee,isadmin) values ('Dil','Jo','dil@gmail.com','1234','2000-03-21',0);
create table objet(
   idobjet int primary key auto_increment,
   nom varchar(30),
   iduser int references user(iduser),
   prixestim float,
   descriptions text
);
insert into objet (nom,iduser,prixestim,descriptions) values('objet1',1,2000,'objet occasion');
insert into objet (nom,iduser,prixestim,descriptions) values('objet2',1,3000,'objet occasion');

insert into objet (nom,iduser,prixestim,descriptions) values('objetA',2,4000,'objet vaovao');
insert into objet (nom,iduser,prixestim,descriptions) values('objetB',2,5000,'objet 2e main');

insert into objet (nom,iduser,prixestim,descriptions) values('objetC',3,6000,'objet occasion');
insert into objet (nom,iduser,prixestim,descriptions) values('objetD',3,7000,'objet neuf');

insert into objet (nom,iduser,prixestim,descriptions) values('objetI',4,16000,'objet occasion');
insert into objet (nom,iduser,prixestim,descriptions) values('objetII',4,37000,'objet neuf');

create table categorie(
   idcategorie int primary key auto_increment,
   nom varchar(30)
);
insert into categorie(nom) values('commestible');
insert into categorie(nom) values('vetement');
insert into categorie(nom) values('cuisine');
insert into categorie(nom) values('transport');
insert into categorie(nom) values('electronique');
create table objet_categorie(
   idobjet_categorie int primary key auto_increment,
   idobjet int references objet(idobjet),
   idcategorie int references categorie(idcategorie)
);
create table image_objet(
   idimage_objet int primary key auto_increment,
   idobjet int references objet(idobjet),
   nomimage varchar(40)
);
create table echange(
   idechange int primary key auto_increment,
   datedemande datetime,
   dateaccepte datetime 
);
create table echange_objet_envoyeur(
   idechange_objet_envoyeur int primary key auto_increment,
   idechange int references echange(idechange),
   idobjet int references objet(idobjet)
);
create table echange_objet_destinataire(
   idechange_objet_destinataire int primary key auto_increment,
   idechange int references echange(idechange),
   idobjet int references objet(idobjet)
);
