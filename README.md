<h1>API citations Kaamelott</h1>
<p>API de citations de la série française Kaamelott.</p>

<h2>Utilisation</h2>
<h3>Citation aléatoire</h3>
<p>GET | POST /api/random<br>
Retourne une citation aléatoire parmis toutes les citations disponible.</p>
<p>GET | POST /api/random/personnage<br>
Retourne une citation aléatoire parmis toutes les citations du personnage.</p>

<p>GET | POST /api/random/livre<br>
Retourne une citation aléatoire parmis toutes les citations du livre.</p>

<p>GET | POST /api/random/personnage/livre<br>
Retourne une citation aléatoire parmis toutes les citations du personnage dans le livre.</p>


<h3>Toutes les citations</h3>
<p>GET | POST /api/all<br>
<blockquote>Retourne toutes les citations disponible.</p><blockquote>

<p>GET | POST /api/all/personnage<br>
Retourne toutes les citations du personnage.</p>

<p>GET | POST /api/all/livre<br>
Retourne toutes les citations du livre.</p>

<p>GET | POST /api/all/personnage/livre<br>
Retourne toutes les citations du personnage dans le livre.</p>

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
