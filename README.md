<h1>API citations Kaamelott</h1>
<p>API de citations de la série française Kaamelott.</p>

<h2>Utilisation</h2>
<h3>Citation aléatoire</h3>
<p>GET | POST /api/random<br>
<blockquote>Retourne une citation aléatoire parmis toutes les citations disponible.</blockquote></p>
<p>GET | POST /api/random/personnage<br>
<blockquote>Retourne une citation aléatoire parmis toutes les citations du personnage.</blockquote></p>

<p>GET | POST /api/random/livre<br>
<blockquote>Retourne une citation aléatoire parmis toutes les citations du livre.</blockquote></p>

<p>GET | POST /api/random/personnage/livre<br>
<blockquote>Retourne une citation aléatoire parmis toutes les citations du personnage dans le livre.</blockquote></p>


<h3>Toutes les citations</h3>
<p>GET | POST /api/all<br>
<blockquote>Retourne toutes les citations disponible.</blockquote></p>

<p>GET | POST /api/all/personnage<br>
<blockquote>Retourne toutes les citations du personnage.</blockquote></p>

<p>GET | POST /api/all/livre<br>
<blockquote>Retourne toutes les citations du livre.</blockquote></p>

<p>GET | POST /api/all/personnage/livre<br>
&nbsp;<blockquote>Retourne toutes les citations du personnage dans le livre.</blockquote></p>

<h3>Paramètres</h3>
<ul>
  <li><code>livre</code> - int - Entre 1 et 6</li>
  <li><code>personnage</code> - string - présent dans la liste suivante :<br>
  Angharad, Anna, Appius Manilius, Arthur, Attila, Belt, Père Blaise, Bohort, Breccan, Le Roi Burgonde, Caius Camillus, Calogrenant, Capito, César, Cryda de Tintagel, Dagonet, La Dame du Lac, Demetra, Drusilla, Le Duc d'Aquitaine, Edern, Elias de Kelliwic'h, Galessin, Gauvain, Goustan, Grüdü, Guenièvre, Guethenoc, Hervé de Rinel, L'interprète burgonde, Le Seigneur Jacca, Les Jumelles du pêcheur, Le Jurisconsulte, Kadoc, Karadoc, Lancelot, Léodagan, Loth, Le Maître d'Armes, Méléagant, Manius Macrinus Firmus, Merlin, Mevanwi, Perceval, Roparzh, Lucius Sillius Sallustius, Séfriane d'Aquitaine, Séli, Spurius Cordius Frontinius, Le Tavernier, Urgan, Vérinus, Venec, Ygerne, Yvain.</li>
</ul>

<h3>Exemple de réponse :</h3>
<code>
  {</br>
  "status":1,</br>
  "citation":{</br>
    "citation":" J'ai toujours dit que je supportais pas les jupes ; mais c'est l'uniforme r\u00e9glementaire, j'y suis pour rien !",</br>
    "infos":{</br>
      "auteur":"Alexandre Astier",</br>
      "acteur":"Bruno Salomone",</br>
      "personnage":"Caius Camillus",</br>
      "saison":"Livre I ",</br>
      "episode":" 56 : Le Dernier Empereur"</br>
    }</br>
  }</br>
  }</br>
</code>
