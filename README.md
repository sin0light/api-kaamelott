# API citations Kaamelott
API de citations de la série française Kaamelott.

## Utilisation
### Citation aléatoire
GET | POST /api/random

Retourne une citation aléatoire parmis toutes les citations disponible.

GET | POST /api/random/personnage

Retourne une citation aléatoire parmis toutes les citations du personnage.

GET | POST /api/random/livre

Retourne une citation aléatoire parmis toutes les citations du livre.

GET | POST /api/random/personnage/livre

Retourne une citation aléatoire parmis toutes les citations du personnage dans le livre.


### Toutes les citations
GET | POST /api/all
Retourne toutes les citations disponible.
GET | POST /api/all/personnage
Retourne toutes les citations du personnage.
GET | POST /api/all/livre
Retourne toutes les citations du livre.
GET | POST /api/all/personnage/livre
Retourne toutes les citations du personnage dans le livre.

### Paramètres
  - livre - int - Entre 1 et 6
  - personnage - string - présent dans la liste suivante :
  Angharad, Anna, Appius Manilius, Arthur, Attila, Belt, Père Blaise, Bohort, Breccan, Le Roi Burgonde, Caius Camillus, Calogrenant, Capito, César, Cryda de Tintagel, Dagonet, La Dame du Lac, Demetra, Drusilla, Le Duc d'Aquitaine, Edern, Elias de Kelliwic'h, Galessin, Gauvain, Goustan, Grüdü, Guenièvre, Guethenoc, Hervé de Rinel, L'interprète burgonde, Le Seigneur Jacca, Les Jumelles du pêcheur, Le Jurisconsulte, Kadoc, Karadoc, Lancelot, Léodagan, Loth, Le Maître d'Armes, Méléagant, Manius Macrinus Firmus, Merlin, Mevanwi, Perceval, Roparzh, Lucius Sillius Sallustius, Séfriane d'Aquitaine, Séli, Spurius Cordius Frontinius, Le Tavernier, Urgan, Vérinus, Venec, Ygerne, Yvain.

### Exemple de réponse :
{
"status":1,
"citation":{
  "citation":" J'ai toujours dit que je supportais pas les jupes ; mais c'est l'uniforme r\u00e9glementaire, j'y suis pour rien !",
  "infos":{
    "auteur":"Alexandre Astier",
    "acteur":"Bruno Salomone",
    "personnage":"Caius Camillus",
    "saison":"Livre I ",
    "episode":" 56 : Le Dernier Empereur"
  }
}
}
