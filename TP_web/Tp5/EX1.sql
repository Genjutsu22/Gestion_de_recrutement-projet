create database TP5;
create table Annuaire(
        nom varchar(10),
        prenom varchar(10),
        num_post varchar(5),
        primary key(nom,prenom)
);
insert into Annuaire values('Ahmed','Mohamed','88.26'),
                            ('Oulih','Hamid','99.66'),
                            ('Baddi','Saad','55.55');

