create table categorie(
    id_cat integer primary key AUTO_INCREMENT,
    designation varchar(10),
    taux_tva float);
create table produit(
    id_prod integer PRIMARY key AUTO_INCREMENT,
    id_cat integer,
    designation varchar(10),
    marque varchar(10),
    prix_uht float,
    qstock integer,
    FOREIGN key(id_cat) REFERENCES categorie(id_cat) on UPDATE CASCADE on DELETE CASCADE
    );