<!-- =================================================================== -->
<!-- PARTIE 2 : INITIALISATION ET FONCTIONNEMENT (VULGARISÉ) -->
<!-- =================================================================== -->
<h2 class="text-3xl font-bold text-gray-800 border-b-2 border-gray-200 pb-2 mb-6">Partie 2 : Initialisation et Fonctionnement</h2>

<!-- ========== CHAPITRE 1 : GIT INIT ========== -->
<section id="git-init" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 1 : Créer son premier dépôt (git init)</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">1.1 Démarrer un projet Git</h4>
        <p class="text-gray-700 mb-4">
            Pour commencer à suivre l'historique d'un projet, il faut dire à Git : "Hé, surveille ce dossier !". C'est le rôle de la commande <code>git init</code>.
        </p>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto mb-4">
# 1. Se placer dans le dossier du projet
$ cd mon-super-projet

# 2. Initialiser Git
$ git init
Initialized empty Git repository in /chemin/mon-super-projet/.git/</pre>

        <div class="bg-green-50 p-4 rounded border-l-4 border-green-500">
            <p class="text-sm text-green-800"><strong>🎉 Félicitations !</strong> Vous avez transformé un simple dossier en un dépôt Git. Git est maintenant prêt à enregistrer vos modifications.</p>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">1.2 Que s'est-il passé ?</h4>
        <p class="text-gray-700 mb-4">
            Si vous regardez les fichiers (en affichant les éléments masqués), vous verrez un nouveau dossier caché : <strong>.git</strong>.
        </p>
        <div class="flex items-center p-4 bg-gray-100 rounded">
            <span class="text-2xl mr-4">📂</span>
            <div>
                <p class="font-bold text-gray-800">mon-super-projet/</p>
                <div class="ml-6 text-gray-600">
                    <p>├── index.html</p>
                    <p>├── style.css</p>
                    <p class="text-blue-600 font-bold">└── .git/  <-- (La magie est ici)</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h4 class="text-xl font-bold text-gray-800 mb-4">1.3 Erreurs classiques</h4>
        
        <div class="grid md:grid-cols-2 gap-4">
            <div class="bg-red-50 p-4 rounded">
                <h5 class="font-bold text-red-900 mb-2">🚫 Init dans le dossier utilisateur</h5>
                <p class="text-sm text-red-800">Ne faites JAMAIS <code>git init</code> directement dans <code>C:\Users\Moi</code> ou sur le Bureau. Cela ralentirait tout votre ordinateur car Git essaierait de suivre tous vos fichiers personnels !</p>
            </div>
            <div class="bg-yellow-50 p-4 rounded">
                <h5 class="font-bold text-yellow-900 mb-2">📂 Init imbriqués</h5>
                <p class="text-sm text-yellow-800">Évitez de faire un <code>git init</code> à l'intérieur d'un dossier qui est DÉJÀ dans un projet Git. Cela créerait des conflits bizarres (submodules).</p>
            </div>
        </div>
    </div>
</section>

<!-- ========== CHAPITRE 2 : LA BOITE NOIRE .GIT ========== -->
<section id="comment-ca-marche" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 2 : Comment ça marche ? (La boîte noire .git)</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">2.1 Le dossier .git : Touche pas à ça !</h4>
        <p class="text-gray-700 mb-4">
            Le dossier <code>.git</code> est le cerveau de votre projet. Il contient <strong>tout</strong> votre historique, tous vos anciens fichiers, toutes vos branches.
        </p>
        
        <div class="bg-red-50 p-4 rounded border-l-4 border-red-500 mb-4">
            <p class="text-sm text-red-800"><strong>⚠️ Règle d'or :</strong> Ne modifiez jamais manuellement les fichiers à l'intérieur de <code>.git/</code>. Laissez la commande <code>git</code> gérer ce dossier pour vous.</p>
        </div>

        <p class="text-gray-700">Si vous supprimez ce dossier, vous perdez tout l'historique du projet et redevenez un simple dossier de fichiers.</p>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">2.2 Analogie : L'album photo</h4>
        <p class="text-gray-700 mb-4">
            Imaginez Git comme un photographe ultra-rapide pour votre code.
        </p>
        
        <div class="grid md:grid-cols-3 gap-4 text-center">
            <div class="bg-blue-50 p-4 rounded">
                <div class="text-3xl mb-2">📸</div>
                <h5 class="font-bold text-blue-900">Le Commit</h5>
                <p class="text-sm text-blue-800">C'est une photo (snapshot) de tout votre projet à un instant T.</p>
            </div>
            <div class="bg-purple-50 p-4 rounded">
                <div class="text-3xl mb-2">🎞️</div>
                <h5 class="font-bold text-purple-900">L'Historique</h5>
                <p class="text-sm text-purple-800">C'est l'album photo complet, classé par ordre chronologique.</p>
            </div>
            <div class="bg-orange-50 p-4 rounded">
                <div class="text-3xl mb-2">🏷️</div>
                <h5 class="font-bold text-orange-900">Les Branches</h5>
                <p class="text-sm text-orange-800">Ce sont des étiquettes mobiles collées sur certaines photos pour dire "On travaille ici".</p>
            </div>
        </div>
    </div>
</section>

<!-- ========== CHAPITRE 3 : INTÉGRITÉ ========== -->
<section id="integrite-simplifiee" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 3 : Pourquoi Git ne perd rien (Intégrité)</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">3.1 Empreintes digitales (Hash)</h4>
        <p class="text-gray-700 mb-4">
            Git donne à chaque version de fichier et à chaque commit une <strong>empreinte digitale unique</strong>. C'est une suite de 40 caractères bizarres (lettres et chiffres) que vous verrez souvent.
        </p>
        
        <pre class="bg-gray-800 text-green-400 p-2 rounded text-sm mb-4">
a1b2c3d4e5f6g7h8i9j0k1l2m3n4o5p6q7r8s9t0</pre>

        <p class="text-gray-700 mb-2">On appelle ça un <strong>SHA-1</strong> (ou Hash). Ce qu'il faut retenir :</p>
        <ul class="list-disc ml-6 text-gray-700 space-y-1">
            <li>Si vous changez <em>une seule virgule</em> dans un fichier, son empreinte change complètement.</li>
            <li>C'est impossible de corrompre un fichier sans que Git ne s'en aperçoive.</li>
            <li>C'est grâce à ça que Git est ultra-fiable pour le travail en équipe.</li>
        </ul>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h4 class="text-xl font-bold text-gray-800 mb-4">3.2 Une base de données efficace</h4>
        <p class="text-gray-700 mb-4">
            "Git prend une photo de tout le projet à chaque fois ? Mais ça va prendre une place énorme sur mon disque dur !"
        </p>
        
        <div class="bg-blue-50 p-4 rounded border-l-4 border-blue-500">
            <h5 class="font-bold text-blue-900 mb-2">💡 L'astuce géniale de Git</h5>
            <p class="text-sm text-blue-800">
                Non ! Git est intelligent. Si vous avez 100 fichiers et que vous n'en modifiez qu'un seul :
                <br>- La nouvelle "photo" stocke le nouveau fichier.
                <br>- Pour les 99 autres, Git fait juste un <strong>lien</strong> vers la version précédente (comme un raccourci).
            </p>
            <p class="text-sm text-blue-800 mt-2">
                C'est pour ça que les dépôts Git restent légers et rapides, même avec des milliers de versions.
            </p>
        </div>
    </div>
</section>
