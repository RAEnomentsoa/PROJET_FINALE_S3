

create table photos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_habitation INT ,
    url VARCHAR(255) NOT NULL,
    FOREIGN KEY (id_habitation) REFERENCES habitations(id)
    
)

create table type_maison (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL
)

CREATE table habitations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_type_maison int ,
    nb_chambre INT ,
    loyer_par_jour DECIMAL(10, 2) NOT NULL,
    quartier VARCHAR(50) NOT NULL,
    description TEXT NOT NULL,
    FOREIGN KEY (id_type_maison) REFERENCES type_maison(id)
)
