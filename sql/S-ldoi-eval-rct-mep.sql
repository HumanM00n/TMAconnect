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
    FOREIGN KEY (environnement) REFERENCES TC_Environnement(IdEnvironnement),
    FOREIGN KEY (nom_env) REFERENCES TC_Environnement(IdEnvironnement),
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


/* DEMANDE A JL POUR LA TABLE SI C'EST UNE TABLE OU UNE CONTRAINTE RELATIONELLE ? */