CREATE DATABASE TMAconnect;

use TMAconnect;


CREATE TABLE TC_Service
(
    IdService INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    c_libelle VARCHAR(50) NOT NULL,
    s_libelle VARCHAR(50) NOT NULL
)ENGINE=InnoDB;


CREATE TABLE TC_Poste
(
    IdPoste INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    p_libelle VARCHAR(30) NOT NULL
)ENGINE=InnoDB;


CREATE TABLE TC_Droit
(
    IdDroit INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    d_libelle VARCHAR(50) NOT NULL
)ENGINE=InnoDB;


CREATE TABLE TC_Date 
(
    date_connect TIMESTAMP PRIMARY KEY NOT NULL
) ENGINE=InnoDB;


CREATE TABLE TC_Utilisateur
(
    IdUtil INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50)NOT NULL,
    matricule VARCHAR(50)NOT NULL,
    email VARCHAR(50)NOT NULL,
    passwd VARCHAR(20)NOT NULL,
    S_users INT NOT NULL,
    P_users INT NOT NULL,
    D_users INT NOT NULL,
    dateFin DATE NOT NULL,
    derniere_connect TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
    FOREIGN KEY (S_users) REFERENCES TC_Service (IdService),
    FOREIGN KEY (P_users) REFERENCES TC_Poste (IdPoste),
    FOREIGN KEY (D_users) REFERENCES TC_Droit (IdDroit)
    )ENGINE=InnoDB;

CREATE TABLE TC_Logs
(
    IdUtil INT,
    date_connect TIMESTAMP NOT NULL,
    PRIMARY KEY(IdUtil, date_connect),
    FOREIGN KEY (IdUtil) REFERENCES TC_Utilisateur(IdUtil),
    FOREIGN KEY (date_connect) REFERENCES TC_Date(date_connect)
)ENGINE=InnoDB;


CREATE TABLE TC_Domaine
(
    IdDomaine INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    libelle VARCHAR(50) NOT NULL
)ENGINE=InnoDB;


CREATE TABLE TC_Qualif 
(
    IdQual INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    libelle VARCHAR(50) NOT NULL
)ENGINE=InnoDB;

CREATE TABLE TC_Priorite 
(
    IdPriorite INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    libelle VARCHAR(50) NOT NULL
)ENGINE=InnoDB;

CREATE TABLE TC_Etat
(
    IdEtat INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    libelle VARCHAR(50) NOT NULL
)ENGINE=InnoDB;

CREATE TABLE TC_Regroupement
(
    IdRegroupe INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    libelle VARCHAR(50) NOT NULL
)ENGINE=InnoDB;


CREATE TABLE TC_Groupe
(
    IdGroupe INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    libelle VARCHAR(50) NOT NULL
)ENGINE=InnoDB;


CREATE TABLE TC_Demandes
(
    IdDemande INT NOT NULL PRIMARY KEY AUTO_INCREMENT,  
    dom_dmd INT NOT NULL,
    qual_dmd INT NOT NULL,
    prt_dmd INT NOT NULL,
    libelle VARCHAR(80) NOT NULL,
    date_crea DATE NOT NULL,                           
    util_crea INT NOT NULL,
    date_emet DATE NOT NULL,
    util_emet INT NOT NULL,
    date_recu DATE NOT NULL,
    util_benef INT NOT NULL,
    date_etat_dmd DATE NOT NULL,
    etat_dmd INT NOT NULL,
    date_visa_dmd DATE NOT NULL,
    util_sign_dmd INT NOT NULL,
    util_affect_dmd INT NOT NULL,
    date_fs DATE NOT NULL,
    amorti_dmd VARCHAR(3) NOT NULL,
    date_rct_prvu DATE NOT NULL,
    regroupement INT NOT NULL, 
    date_archiv DATE NOT NULL,
    Constraint fk_TCDemandes_TCDomaine FOREIGN KEY (dom_dmd) REFERENCES TC_Domaine(IdDomaine),     
    FOREIGN KEY (qual_dmd) REFERENCES TC_Qualif(IdQual) ,
    FOREIGN KEY (prt_dmd) REFERENCES TC_Priorite(IdPriorite),
    FOREIGN KEY (util_crea) REFERENCES TC_Utilisateur(IdUtil),
    FOREIGN KEY (util_emet) REFERENCES TC_Utilisateur(IdUtil),
    FOREIGN KEY (util_benef) REFERENCES TC_Utilisateur(IdUtil),
    FOREIGN KEY (etat_dmd) REFERENCES TC_Etat(IdEtat),
    FOREIGN KEY (util_sign_dmd) REFERENCES TC_Utilisateur(IdUtil),
    FOREIGN KEY (util_affect_dmd) REFERENCES TC_Utilisateur(IdUtil),
    FOREIGN KEY (regroupement) REFERENCES TC_Regroupement(IdRegroupe)  
)ENGINE=InnoDB;

CREATE TABLE TC_Environnement
(
    IdEnvironnement INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nom_env VARCHAR(10) NOT NULL, 
    libelle VARCHAR(30) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE TC_MEP
(
    IdMep INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    date_mep DATE NOT NULL,
    util_date_mep INT NOT NULL,  /* Clés étrangère */
    prcd_mep VARCHAR(10) NOT NULL,
    FOREIGN KEY (util_date_mep) REFERENCES TC_Utilisateur(IdUtil)
) ENGINE=InnoDB;

CREATE TABLE TC_LDOI
(
    IdLdoi  INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nom_env INT NOT NULL, /* Clés étrangère */
    type VARCHAR(10) NOT NULL,
    environnement INT NOT NULL, /* Clés étrangère */
    libelle VARCHAR(50) NOT NULL,
    nv_ldoi VARCHAR(3) NOT NULL,
    archv_ldoi VARCHAR(3) NOT NULL,
    date_mtnc DATE NOT NULL,
    bibliotheque VARCHAR(20) NOT NULL,
    date_mep INT, /* Clés étrangère */
    vrs_phx VARCHAR(20) NOT NULL,
    report VARCHAR(3) NOT NULL,
    FOREIGN KEY (nom_env) REFERENCES TC_Environnement(IdEnvironnement),
    FOREIGN KEY (environnement) REFERENCES TC_Environnement(IdEnvironnement),
    FOREIGN KEY (date_mep) REFERENCES TC_MEP(IdMep)
) ENGINE=InnoDB;

CREATE TABLE TC_Eval
(
    IdEval INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    date_eval DATE NOT NULL,
    util_date_emet INT NOT NULL, /* Clés étrangère */
    charge_eval INT(2) NOT NULL,
    tarif_eval VARCHAR(30) NOT NULL,
    accept_eval VARCHAR(3) NOT NULL,
    date_accept_eval DATE NOT NULL,
    util_accept_eval INT NOT NULL, /* Clés étrangère */
    nbj_passe VARCHAR(2) NOT NULL,
    rap_eval VARCHAR(2) NOT NULL, 
    demande_fact VARCHAR(3) NOT NULL,
    FOREIGN KEY (util_date_emet) REFERENCES TC_Utilisateur(IdUtil),
    FOREIGN KEY (util_accept_eval) REFERENCES TC_Utilisateur(IdUtil)
) ENGINE=InnoDB;

CREATE TABLE TC_Recette
(
    IdRecette INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    date_mise_rct DATE NOT NULL,
    util_date_emet INT NOT NULL , /* Clés étrangère */
    num_bon_lvrs INT(6) NOT NULL,
    date_debut DATE NOT NULL,
    date_fin DATE NOT NULL,
    rct_prononce VARCHAR(3) NOT NULL,
    util_rct_prononce INT NOT NULL , /* Clés étrangère */
    nb_fch_evos INT(2) NOT NULL,
    nb_fch_non_anos INT(2) NOT NULL,  
    nb_fch_valos INT(2) NOT NULL,
    FOREIGN KEY (util_date_emet) REFERENCES TC_Utilisateur(IdUtil),
    FOREIGN KEY (util_rct_prononce) REFERENCES TC_Utilisateur(IdUtil)
) ENGINE=InnoDB;


CREATE TABLE TC_Benef
(
    IdBenef INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    lbl_benef VARCHAR(50) NOT NULL,
    ser_benef INT NOT NULL, 
    actif VARCHAR(3) NOT NULL, /* Clés étrangère */
    FOREIGN KEY (ser_benef) REFERENCES TC_Service(IdService)
)ENGINE=InnoDB;


