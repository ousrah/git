<!-- =================================================================== -->
<!-- PARTIE 6 : TRAVAILLER EN PARALLÈLE -->
<!-- =================================================================== -->
<h2 class="text-3xl font-bold text-gray-800 border-b-2 border-gray-200 pb-2 mb-6">Partie 6 : Travailler en Parallèle</h2>

<!-- ========== CHAPITRE 1 : THÉORIE & UNGIT ========== -->
<section id="theorie-branches" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 1 : Comprendre les Branches & Ungit</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">1.1 Le concept de Branche (Mondes Parallèles)</h4>
        <p class="text-gray-700 mb-4">
            Une branche est une ligne de développement indépendante. Elle permet de travailler sur une fonctionnalité ou un correctif sans toucher à la version stable (souvent appelée <code>main</code> ou <code>master</code>) du projet.
        </p>
        <p class="text-gray-700 mb-4">
            C'est comme faire une photocopie d'un document pour écrire des notes dessus. Si les notes sont mauvaises, on jette la photocopie. Si elles sont bonnes, on les recopie sur l'original.
        </p>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">1.2 Voir l'Invisible avec Ungit</h4>
        <div class="bg-indigo-50 p-6 rounded-lg border border-indigo-200">
            <h5 class="font-bold text-indigo-900 mb-4">🛠️ Installation & Utilisation</h5>
            <p class="text-indigo-800 mb-2">Pour visualiser ces mondes parallèles, nous utiliserons Ungit.</p>
            <code class="block bg-gray-800 text-white p-2 rounded text-sm mb-2">$ npm install -g ungit</code>
            <p class="text-indigo-800 mb-2">Puis dans votre dossier projet :</p>
            <code class="block bg-gray-800 text-green-400 p-2 rounded text-sm mb-2">$ ungit</code>
            <p class="text-xs text-indigo-600 mt-2">Ouvrez <a href="http://localhost:8448" target="_blank" class="underline">http://localhost:8448</a>.</p>
        </div>
    </div>
</section>

<!-- ========== CHAPITRE 2 : COMMANDES ESSENTIELLES ========== -->
<section id="commandes-base" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 2 : Les Commandes Essentielles</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">2.1 Créer et Changer (Branch, Checkout, Switch)</h4>
        
        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <h5 class="font-bold text-gray-700 mb-2">La Méthode Classique (Checkout)</h5>
                <p class="text-sm text-gray-600 mb-2">Historiquement, <code>checkout</code> sert à tout (fichiers et branches).</p>
                <pre class="bg-gray-100 p-3 rounded text-sm border font-mono">
# Créer une branche
$ git branch ma-feature

# Aller dessus
$ git checkout ma-feature

# Créer ET Aller dessus (Raccourci)
$ git checkout -b ma-feature</pre>
            </div>
            
            <div>
                <h5 class="font-bold text-green-700 mb-2">La Méthode Moderne (Switch)</h5>
                <p class="text-sm text-gray-600 mb-2">Plus explicite, dédié uniquement aux branches (Git > 2.23).</p>
                <pre class="bg-gray-100 p-3 rounded text-sm border font-mono">
# Aller sur une branche existante
$ git switch ma-feature

# Créer ET Aller dessus
$ git switch -c ma-feature</pre>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">2.2 ramener le travail (Merge)</h4>
        <p class="text-gray-700 mb-4">
            Une fois le travail fini sur la branche, il faut le ramener sur la branche principale.
        </p>
        <div class="border-l-4 border-blue-500 pl-4 bg-blue-50 p-4 rounded">
            <p class="font-bold text-blue-800">La Règle d'Or du Merge :</p>
            <p class="text-blue-900">On se place TOUJOURS sur la branche qui REÇOIT (souvent main).</p>
        </div>
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm mt-4 font-mono">
# 1. Je retourne sur le vaisseau mère
$ git switch main

# 2. J'aspire le travail de ma branche
$ git merge ma-feature</pre>
    </div>
</section>

<!-- ========== CHAPITRE 3 : PROJET TECHSTORE ========== -->
<section id="projet-start" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-purple-800">Chapitre 3 : 🏆 Projet 'TechStore' (Mise en Pratique)</h3>

    <div class="bg-purple-50 p-6 rounded-lg border border-purple-200 mb-6">
        <h4 class="text-xl font-bold text-purple-900 mb-2">Scénario</h4>
        <p class="text-purple-800">
            Maintenant que vous connaissez les commandes, vous allez les utiliser pour construire un site E-Commerce. Vous allez rencontrer 3 situations réelles : Le Fast-Forward, Le Merge Classique (No-FF) et le Conflit.
        </p>
    </div>

    <!-- 3.1 SETUP -->
    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-8">
        <h4 class="text-lg font-bold text-gray-800 mb-4">3.1 Initialisation (Main)</h4>
        <p class="text-sm text-gray-600 mb-4">Créez le dossier <code>techstore</code> et les fichiers suivants. Commitez le tout sur <code>main</code>.</p>
        
        <details>
            <summary class="cursor-pointer bg-gray-200 p-2 rounded font-bold text-sm">📂 Afficher le Code Source de départ</summary>
            <div class="mt-4 grid gap-4">
                <div class="border p-2 rounded">
                    <p class="font-bold text-xs text-gray-500">index.html</p>
                    <pre class="text-xs bg-gray-50 p-2 overflow-x-auto">&lt;!DOCTYPE html&gt;&lt;html&gt;&lt;body&gt;&lt;h1&gt;TechStore&lt;/h1&gt;&lt;/body&gt;&lt;/html&gt;</pre>
                </div>
                <div class="border p-2 rounded">
                    <p class="font-bold text-xs text-gray-500">style.css</p>
                    <pre class="text-xs bg-gray-50 p-2 overflow-x-auto">body { background: #fff; color: #333; }</pre>
                </div>
            </div>
        </details>
        <div class="mt-4 grid gap-4">
            <div class="border p-2 rounded">
                <p class="font-bold text-xs text-gray-500">index.html</p>
                <pre class="text-xs bg-gray-50 p-2 overflow-x-auto">&lt;!DOCTYPE html&gt;&lt;html&gt;&lt;body&gt;&lt;h1&gt;TechStore&lt;/h1&gt;&lt;/body&gt;&lt;/html&gt;</pre>
            </div>
            <div class="border p-2 rounded">
                <p class="font-bold text-xs text-gray-500">style.css</p>
                <pre class="text-xs bg-gray-50 p-2 overflow-x-auto">body { background: #fff; color: #333; }</pre>
            </div>
        </div>
    </details>
    <div class="mt-4 bg-gray-800 text-gray-300 p-4 rounded text-xs font-mono">
        <p class="mb-1 text-gray-500"># Windows (PowerShell) & Linux/Mac : Tapez les commandes l'une après l'autre</p>
        <p>$ git init</p>
        <p>$ git add .</p>
        <p>$ git commit -m "Init V1"</p>
    </div>
    </div>

    <!-- 3.2 FAST FORWARD -->
    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-8">
        <h4 class="text-lg font-bold text-gray-800 mb-4">3.2 Cas 1 : Le Fast-Forward (Design)</h4>
        <p class="text-gray-700 mb-4">
            Vous travaillez seul. <code>main</code> ne bouge pas. C'est le cas le plus simple.
        </p>
        <ol class="list-decimal ml-6 space-y-2 text-sm text-gray-800">
            <li>Créez une branche : <code>git switch -c design-v2</code></li>
            <li>Modifiez <code>style.css</code> (Changez le background en <code>#f4f4f4</code>).</li>
            <li>
                <strong>Commitez :</strong>
                <div class="bg-gray-800 text-gray-300 p-2 rounded text-xs mt-1 font-mono">
                    <p>$ git add .</p>
                    <p>$ git commit -m "New Design"</p>
                </div>
            </li>
            <li>Revenez sur main : <code>git switch main</code></li>
            <li>Fusionnez : <code>git merge design-v2</code></li>
        </ol>
        <p class="text-green-600 font-bold mt-2 text-sm">Observe le résultat : Git a juste avancé l'étiquette main. C'est un Fast-Forward.</p>
    </div>

    <!-- 3.3 NO-FF -->
    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-8">
        <h4 class="text-lg font-bold text-gray-800 mb-4">3.3 Cas 2 : L'Historique Forcé (Features)</h4>
        <p class="text-gray-700 mb-4">
            On veut voir clairement la branche "Produits" dans l'historique, même si un FF est possible.
        </p>
        <ol class="list-decimal ml-6 space-y-2 text-sm text-gray-800">
            <li>Branche : <code>git switch -c feature-produits</code></li>
            <li>
                Créez <code>produits.html</code>. <strong>Commitez :</strong>
                <div class="bg-gray-800 text-gray-300 p-2 rounded text-xs mt-1 font-mono">
                    <p>$ git add .</p>
                    <p>$ git commit -m "Page produits basic"</p>
                </div>
            </li>
            <li>Main : <code>git switch main</code></li>
            <li>Fusion : <code>git merge --no-ff feature-produits</code></li>
        </ol>
        <p class="text-purple-600 font-bold mt-2 text-sm">Observe Ungit : Une "bulle" s'est créée. On voit le début et la fin de la feature.</p>
    </div>

    <!-- 3.4 CONFLIT -->
    <div class="bg-red-50 p-6 rounded-lg border border-red-200 mb-8">
        <h4 class="text-lg font-bold text-red-900 mb-4">3.4 Cas 3 : Le Conflit (Le Choc)</h4>
        <p class="text-red-800 mb-4">
            Deux versions différentes du même titre. Qui gagne ?
        </p>
        <div class="grid md:grid-cols-2 gap-4 text-sm">
            <div class="bg-white p-3 rounded">
                <p class="font-bold">1. Sur MAIN</p>
                <p>Modifiez le H1 : "TechStore 2026"</p>
                <p>Commitez.</p>
            </div>
            <div class="bg-white p-3 rounded">
                <p class="font-bold">2. Sur une nouvelle branche "promo"</p>
                <p>Modifiez le H1 (Même ligne) : "PROMO HIVER"</p>
                <p>Commitez.</p>
            </div>
        </div>
        <div class="mt-4">
            <p class="font-bold text-red-900 mb-2">3. La Fusion</p>
            <div class="bg-red-900 text-white p-3 rounded text-xs font-mono">
                <p>$ git switch main</p>
                <p>$ git merge promo</p>
            </div>
            <p class="text-red-800 mt-2">💥 CONFLIT ! Ouvrez index.html, choisissez la version finale, puis faites <code>git add .</code> et <code>git commit</code>.</p>
        </div>
    </div>
</section>

<!-- ========== CHAPITRE 4 : STASH EXPERT ========== -->
<section id="master-stash" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-indigo-800">Chapitre 4 : La Maîtrise du Stash</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">4.1 Le "Presse-papiers" de Git</h4>
        <p class="text-gray-700 mb-4 leading-relaxed">
            Vous devez changer de branche MAIS votre travail n'est pas fini. Vous ne pouvez pas commiter du code cassé.<br>
            Le Stash vous permet de <strong>stocker temporairement</strong> vos fichiers modifiés.
        </p>
        
        <table class="min-w-full text-sm border mt-4">
            <tr class="bg-gray-100">
                <th class="p-2 border">Action</th>
                <th class="p-2 border">Commande</th>
            </tr>
            <tr>
                <td class="p-2 border">Sauvegarder (Rapide)</td>
                <td class="p-2 border font-mono text-blue-600">git stash</td>
            </tr>
            <tr>
                <td class="p-2 border">Sauvegarder (Nommé)</td>
                <td class="p-2 border font-mono text-blue-600">git stash save "Mon travail en cours"</td>
            </tr>
            <tr>
                <td class="p-2 border">Récupérer & Supprimer</td>
                <td class="p-2 border font-mono text-blue-600">git stash pop</td>
            </tr>
            <tr>
                <td class="p-2 border">Voir la liste</td>
                <td class="p-2 border font-mono text-blue-600">git stash list</td>
            </tr>
        </table>
    </div>
</section>
