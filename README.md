
# API citations Kaamelott
API de citations de la série française Kaamelott.


# Introduction
L'API de citations Kaamelott est une API entièrement publique et ouverte à tous. L’API Kaamelott est une API JSON RESTful avec laquelle vous pouvez interagir à partir de n’importe quel langage avec une bibliothèque HTTP.

## Base URL
L'URL de base pour toute l'API est `https://kaamelott.chaudie.re/api`. Si jamais lors d'une requête vous obtenez cette réponse:
```json
{
  "status": 0,
  "code": 404,
  "error": "Unknown path."
}
```

Vérifiez d'abord l'URL de base puis votre path. La documentation en dessous ce base sur cette URL pour chaque requête.

## Réponses

### Succès

Un status `1` sera retourné, ainsi que le body contenant la réponse. Exemple pour une citation :
```json
{
  "status":1,
  "citation": {
    "citation":"J'ai toujours dit que je supportais pas les jupes ;   mais c'est l'uniforme r\u00e9glementaire, j'y suis pour rien !",
    "infos": {
      "auteur":"Alexandre Astier",
      "acteur":"Bruno Salomone",
      "personnage":"Caius Camillus",
      "saison":"Livre I ",
      "episode":" 56 : Le Dernier Empereur"
    }
  }
}
```

Exemple pour plusieurs citations :
```json
{
  "status":1,
  "citation": [
    {
      "citation":"J'ai toujours dit que je supportais pas les jupes ;   mais c'est l'uniforme r\u00e9glementaire, j'y suis pour rien !",
      "infos": {
        "auteur":"Alexandre Astier",
        "acteur":"Bruno Salomone",
        "personnage":"Caius Camillus",
        "saison":"Livre I ",
        "episode":" 56 : Le Dernier Empereur"
      }
    },
    {
      "citation":"(À Perceval) Rangez moi ça, débile, la table ronde, c'est pas la fête de l'artisanat !",
      "infos": {
        "auteur":"Alexandre Astier",
        "acteur":"Alexandre Astier",
        "personnage":"Arthur",
        "saison":"Livre I ",
        "episode":"De retour de Judée"
      }
    }
  ]
}
```

### Erreur
Un status `0` sera retourné, ainsi que le code d'erreur et un message correspondant.  
```json
{
  "status": 0,
  "code": 404,
  "error": "Unknown path."
}
```

# Utilisation

## Citations

`GET /random`  
Retourne une citation aléatoire parmis toutes les citations disponibles.

`GET /all`  
Retourne toutes les citations disponible. **765** citations sont disponibles.

## Personnage

`GET /random/personnage/:personnage`  
Retourne une citation aléatoire parmis toutes les citations du personnage.

`GET /all/personnage/:personnage`  
Retourne toutes les citations du personnage.

**Paramètres**
| Nom | Type | Description  |
| - | -|  - |
| personnage | String |  Nom du personnage dont vous souhaitez les citations. [Voir liste des personnages disponibles](#liste-des-personnages)

## Auteur

`GET /random/auteur/:auteur`  
Retourne une citation aléatoire parmis toutes les citations de l'auteur.

`GET /all/auteur/:auteur`  
Retourne toutes les citations de l'auteur.

**Paramètres**
| Nom | Type | Description  |
| - | -|  - |
| auteur | String |  Nom de l'auteur dont vous souhaitez les citations. [Voir liste des auteurs disponibles](#liste-des-auteurs)

## Livre

`GET /random/livre/:livre`  
Retourne une citation aléatoire parmis toutes les citations du livre.

`GET /random/livre/:livre/personnage/:personnage`  
Retourne une citation aléatoire parmis toutes les citations du personnage dans le livre.  

`GET /all/livre/:livre`  
Retourne toutes les citations du livre.
  
`GET /all/livre/:livre/personnage/:personnage`  
Retourne toutes les citations du personnage dans le livre.

**Paramètres**
| Nom | Type | Description |
| - | -|  - |
| livre | Integer |  Chiffre entre 1 et 6. Numéro du livre dont vous souhaitez les citations.
| personnage | String | Nom du personnage dont vous souhaitez les citations. [Voir liste des personnages disponibles](#liste-des-personnages)

## Soundbox

`GET /sounds/:filename`  
Retourne le fichier .mp3. 

**Paramètres**
| Nom | Type | Description |
| - | -|  - |
| filename | String |  Noms des fichiers dans [sounds](/assets/sounds/)


# Liste des personnages

- Angharad
- Anna
- Appius Manilius
- Arthur
- Attila
- Belt
- Père Blaise
- Bohort
- Breccan
- Le Roi Burgonde
- Caius Camillus
- Calogrenant
- Capito
- César
- Cryda de Tintagel
- Dagonet
- La Dame du Lac
- Demetra
- Drusilla
- Le Duc d'Aquitaine
- Edern
- Elias de Kelliwic'h
- Galessin
- Gauvain
- Goustan
- Grüdü
- Guenièvre
- Guethenoc
- Hervé de Rinel
- L'interprète burgonde
- Le Seigneur Jacca
- Les Jumelles du pêcheur
- Le Jurisconsulte
- Kadoc
- Karadoc
- Lancelot
- Léodagan
- Loth
- Le Maître d'Armes
- Méléagant
- Manius Macrinus Firmus
- Merlin
- Mevanwi
- Perceval
- Roparzh
- Lucius Sillius Sallustius
- Séfriane d'Aquitaine
- Séli
- Spurius Cordius Frontinius
- Le Tavernier
- Urgan
- Vérinus
- Venec
- Ygerne
- Yvain


# Liste des auteurs

- Alexandre Astier
- Alexandre Astier - Simon Astier
- Fabien Rault
- Lionnel Astier
- Nicolas Gabion


# Ajouter une nouvelle citation

Si vous souhaitez ajouter une nouvelle citation, merci d'ouvrir une issue avec le label "Ajout de citation" et les informations suivantes :

- Citation
- Acteur
- Épisode
- Titre de l'épisode
- Saison
- Auteur


# TODO

- Faire un lien entre les citations et les sons disponibles
