-- liste vehicules par jour
SELECT
    DATE(h.date_heure_debut) AS jour,
    v.marque AS vehicule,
    v.modele AS modele,
    c.nom AS chauffeur_nom,
    c.prenom AS chauffeur_prenom,
    t.distance_km,
    t.montant_recette,
    t.montant_carburant
FROM Historique_Trajet h
JOIN Trajet t ON h.trajet_id = t.id
JOIN Vehicule v ON t.vehicule_id = v.id
JOIN Chauffeur c ON v.chauffeur_id = c.id
ORDER BY jour;

-- benefice
SELECT 
    v.marque AS vehicule,
    v.modele AS modele,
    SUM(t.montant_recette - t.montant_carburant) AS total_benefice
FROM Trajet t
JOIN Vehicule v ON t.vehicule_id = v.id
GROUP BY v.id;

-- benefice par vehicule
SELECT
    v.marque AS vehicule,
    v.modele AS modele,
    c.nom AS chauffeur_nom,
    c.prenom AS chauffeur_prenom,
    SUM(t.montant_recette - t.montant_carburant) AS total_benefice
FROM Historique_Trajet h
JOIN Trajet t ON t.id = h.trajet_id
JOIN Vehicule v ON t.vehicule_id = v.id
JOIN Chauffeur c ON v.chauffeur_id = c.id
GROUP BY v.id, c.id
ORDER BY total_benefice DESC;

-- trajet le plus rentable
SELECT
    DATE(h.date_heure_debut) AS jour,
    v.marque AS vehicule,
    v.modele AS modele,
    c.nom AS chauffeur_nom,
    c.prenom AS chauffeur_prenom,
    t.distance_km,
    t.montant_recette,
    t.montant_carburant,
    (t.montant_recette - t.montant_carburant) AS benefice
FROM Historique_Trajet h
JOIN Trajet t ON t.id = h.trajet_id
JOIN Vehicule v ON t.vehicule_id = v.id
JOIN Chauffeur c ON v.chauffeur_id = c.id
ORDER BY benefice DESC, jour;
