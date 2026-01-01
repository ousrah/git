<!-- =================================================================== -->
<!-- PARTIE 5 : ANNULER ET RÉPARER -->
<!-- =================================================================== -->
<h2 class="text-3xl font-bold text-gray-800 border-b-2 border-gray-200 pb-2 mb-6">Partie 5 : Annuler et Réparer</h2>

<!-- ========== CHAPITRE 1 : GIT AMEND ========== -->
<section id="git-amend" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 1 : Oups ! Petite correction (git commit --amend)</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">1.1 Corriger le dernier commit</h4>
        <p class="text-gray-700 mb-4">
            Vous venez de commiter et... vous réalisez que vous avez fait une faute de frappe dans le message ? Ou oublié un fichier ?
        </p>
        <p class="text-gray-700 mb-4">
            Pas besoin de créer un commit "Oups correction" ! Utilisez <code>--amend</code> pour modifier le commit précédent comme si rien ne s'était passé.
        </p>

        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto mb-4">
# Cas 1 : Changer juste le message
$ git commit --amend -m "Nouveau message corrigé"

# Cas 2 : Ajouter un fichier oublié
$ git add fichier_oublie.css
$ git commit --amend --no-edit
# --no-edit garde l'ancien message</pre>
        
        <div class="bg-red-50 p-4 rounded border-l-4 border-red-500">
            <p class="text-sm text-red-800"><strong>⚠️ Attention :</strong> Amend réécrit l'historique (Change le SHA-1). Ne le faites JAMAIS sur un commit déjà pushé !</p>
        </div>
    </div>
</section>

<!-- ========== CHAPITRE 2 : GIT REVERT ========== -->
<section id="git-revert" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 2 : Annuler proprement (git revert)</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">2.1 Le concept : "L'Anti-Commit"</h4>
        <p class="text-gray-700 mb-4">
            Imaginez que vous avez ajouté une fonctionnalité qui fait planter le site en Prod. Vous voulez l'annuler, MAIS vous ne voulez pas effacer l'historique (pour garder une trace de l'erreur).
        </p>
        <p class="text-gray-700 mb-4">
            <code>git revert</code> ne supprime pas de commit. Il crée un <strong>Nouveau Commit</strong> qui fait exactement l'inverse du commit ciblé.
        </p>

        <!-- Illustration Revert -->
        <div class="flex items-center justify-center space-x-4 bg-gray-50 p-6 rounded font-mono text-sm mb-4">
            <div class="text-center">
                <div class="bg-gray-800 text-white p-2 rounded">Commit A</div>
                <div class="text-gray-500">Ajoute bouton</div>
            </div>
            <div class="text-2xl">➔</div>
            <div class="text-center">
                <div class="bg-gray-800 text-white p-2 rounded">Commit B</div>
                <div class="text-gray-500">Ajoute menu</div>
            </div>
            <div class="text-2xl text-blue-500">➔</div>
            <div class="text-center border-2 border-blue-500 rounded p-1">
                <div class="bg-blue-600 text-white p-2 rounded">Commit C</div>
                <div class="text-blue-600 font-bold">Revert "Commit B"</div>
                <div class="text-gray-500 font-bold">Supprime menu</div>
            </div>
        </div>

        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto">
# Annuler le dernier commit
$ git revert HEAD

# Annuler un commit spécifique (via son hash)
$ git revert a1b2c3d</pre>
        
        <div class="bg-green-50 p-4 rounded border-l-4 border-green-500 mt-4">
            <p class="text-sm text-green-800"><strong>✅ Quand l'utiliser ?</strong> TOUJOURS si le commit a déjà été partagé (pushé) sur GitHub/GitLab. C'est la méthode sûre.</p>
        </div>
    </div>

    <!-- EXERCICE REVERT -->
    <div class="bg-blue-50 p-6 rounded-lg border border-blue-200">
        <h4 class="text-xl font-bold text-blue-800 mb-4">💪 Exercice : Le bouton maudit</h4>
        <ol class="list-decimal ml-6 space-y-2 text-blue-900 mb-4">
            <li>Créez un fichier <code>site.html</code> avec "Version Stable". Commitez.</li>
            <li>Ajoutez une ligne "Bouton Maudit" qui casse tout. Commitez.</li>
            <li>Vérifiez l'historique avec <code>git log --oneline</code>.</li>
            <li>Oups ! Utilisez <code>git revert</code> pour annuler ce bouton sans effacer l'historique.</li>
            <li>Vérifiez que le fichier est revenu à la normale ET qu'un nouveau commit "Revert" est apparu.</li>
        </ol>

        <!-- Solution Masquée -->
        <details>
            <summary class="cursor-pointer bg-blue-600 text-white px-4 py-2 rounded inline-block hover:bg-blue-700 transition select-none">
                👁️ Solution Revert
            </summary>
            <div class="mt-4 bg-gray-900 text-green-400 p-4 rounded text-sm font-mono overflow-x-auto shadow-inner">
<pre>$ echo "<h1>Site Stable</h1>" > site.html
$ git add . && git commit -m "Site stable"

$ echo "<button>BOUM</button>" >> site.html
$ git commit -am "Ajout bouton"

$ git log --oneline
# a1b2c (HEAD) Ajout bouton
# d3e4f Site stable

$ git revert HEAD
# (Git ouvre l'éditeur pour le message, sauvegardez et quittez)

$ cat site.html
# "<h1>Site Stable</h1>" uniquement

$ git log --oneline
# z9y8x (HEAD) Revert "Ajout bouton"
# a1b2c Ajout bouton
# d3e4f Site stable</pre>
            </div>
        </details>
    </div>
</section>

<!-- ========== CHAPITRE 3 : GIT RESET ========== -->
<section id="git-reset" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 3 : La chirurgie de l'historique (git reset)</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">3.1 Le Grand Nettoyage</h4>
        <p class="text-gray-700 mb-4">
            Contrairement à Revert, <code>git reset</code> <strong>efface</strong> l'historique. Il déplace le pointeur HEAD vers l'arrière, comme si les commits suivants n'avaient jamais existé.
        </p>

        <div class="bg-red-50 p-4 rounded border-l-4 border-red-500 mb-6">
            <p class="text-sm text-red-800"><strong>🚨 DANGER :</strong> Ne faites jamais de reset sur des commits déjà pushés ! Vos collègues vous détesteraient.</p>
        </div>

        <h5 class="text-lg font-bold text-gray-800 mb-3">Les 3 Modes de Reset (Le Trio Infernal)</h5>
        
        <div class="space-y-4">
            <!-- SOFT -->
            <div class="border rounded p-4 bg-green-50">
                <div class="flex items-center justify-between mb-2">
                    <code class="bg-green-200 text-green-800 px-2 py-1 rounded font-bold">git reset --soft</code>
                    <span class="text-xs font-bold text-green-600">Le "Gentil"</span>
                </div>
                <p class="text-sm text-gray-700">Déplace HEAD en arrière mais <strong>garde les modifs stagées (dans le carton)</strong>.</p>
                <p class="text-xs text-gray-500 mt-1"><em>Usage : J'ai raté mon dernier commit (message ou oubli), je veux le refaire sans perdre mon travail.</em></p>
            </div>

            <!-- MIXED -->
            <div class="border rounded p-4 bg-yellow-50">
                <div class="flex items-center justify-between mb-2">
                    <code class="bg-yellow-200 text-yellow-800 px-2 py-1 rounded font-bold">git reset --mixed</code>
                    <span class="text-xs font-bold text-yellow-600">Le "Par défaut"</span>
                </div>
                <p class="text-sm text-gray-700">Déplace HEAD mais <strong>garde les modifs en non-stagées (Working Directory)</strong>.</p>
                <p class="text-xs text-gray-500 mt-1"><em>Usage : Je veux annuler mes commits et retravailler mes fichiers tranquillement.</em></p>
            </div>

            <!-- HARD -->
            <div class="border rounded p-4 bg-red-50">
                <div class="flex items-center justify-between mb-2">
                    <code class="bg-red-200 text-red-800 px-2 py-1 rounded font-bold">git reset --hard</code>
                    <span class="text-xs font-bold text-red-600">Le "Destructeur"</span>
                </div>
                <p class="text-sm text-gray-700">Déplace HEAD et <strong>SUPPRIME TOUTES LES MODIFS</strong>.</p>
                <p class="text-xs text-gray-500 mt-1"><em>Usage : Je veux tout jeter et revenir exactement comme c'était avant. C'est irréversible* !</em></p>
                <p class="text-xs text-gray-400 mt-1">*Sauf avec git reflog ;)</p>
            </div>
        </div>
    </div>

    <!-- EXERCICE RESET -->
    <div class="bg-blue-50 p-6 rounded-lg border border-blue-200">
        <h4 class="text-xl font-bold text-blue-800 mb-4">💪 Exercice : Crash Test Reset</h4>
        <ol class="list-decimal ml-6 space-y-2 text-blue-900 mb-4">
            <li>Faites 3 commits : "V1", "V2", "V3" (avec des fichiers différents pour bien voir).</li>
            <li><strong>Test Soft :</strong> <code>git reset --soft HEAD~1</code> (Revient 1 cran avant). Vérifiez <code>git status</code> : les modifs de V3 sont là, prêtes à être commitées.</li>
            <li>Recommitez pour revenir en V3.</li>
            <li><strong>Test Mixed :</strong> <code>git reset --mixed HEAD~1</code>. Vérifiez <code>git status</code> : les modifs de V3 sont là, mais "Untracked/Modified".</li>
            <li>Recommitez/Restaurer pour revenir en V3.</li>
            <li><strong>Test Hard :</strong> <code>git reset --hard HEAD~1</code>. Vérifiez : Tout a disparu. V3 est mort.</li>
        </ol>

        <!-- Solution Masquée -->
        <details>
            <summary class="cursor-pointer bg-blue-600 text-white px-4 py-2 rounded inline-block hover:bg-blue-700 transition select-none">
                👁️ Solution Reset
            </summary>
            <div class="mt-4 bg-gray-900 text-green-400 p-4 rounded text-sm font-mono overflow-x-auto shadow-inner">
<pre># Setup
$ touch v1 && git add . && git commit -m "V1"
$ touch v2 && git add . && git commit -m "V2"
$ touch v3 && git add . && git commit -m "V3"

# 1. Soft
$ git reset --soft HEAD~1
$ git status
# On voit "new file: v3" en vert (Staged)
$ git commit -m "Retour V3"

# 2. Mixed
$ git reset --mixed HEAD~1
$ git status
# On voit "v3" en rouge (Untracked)
$ git add . && git commit -m "Retour V3"

# 3. Hard
$ git reset --hard HEAD~1
$ ls
# v3 a disparu définitivement !
$ git log --oneline
# V3 n'est plus dans l'historique</pre>
            </div>
        </details>
    </div>
</section>

<!-- ========== CHAPITRE 4 : GIT RESTORE ========== -->
<section id="git-restore" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 4 : Restaurer sans danger (git restore)</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">4.1 Le remplaçant moderne de checkout</h4>
        <p class="text-gray-700 mb-4">
            Comme nous l'avons vu, <code>git checkout</code> fait trop de choses. Git a introduit <code>git restore</code> spécifiquement pour gérer les fichiers, sans risque de changer de branche par erreur.
        </p>

        <div class="grid md:grid-cols-2 gap-6">
            <div class="border p-4 rounded hover:shadow-md">
                <h5 class="font-bold text-gray-800 mb-2">Annuler les modifications (Working Dir)</h5>
                <pre class="bg-gray-800 text-green-400 p-2 rounded text-xs mb-2">$ git restore mon_fichier.txt</pre>
                <p class="text-xs text-gray-600">Le fichier redevient comme au dernier commit. C'est l'équivalent de "Annuler les changements" dans VS Code.</p>
            </div>
            
            <div class="border p-4 rounded hover:shadow-md">
                <h5 class="font-bold text-gray-800 mb-2">Enlever du carton (Unstage)</h5>
                <pre class="bg-gray-800 text-green-400 p-2 rounded text-xs mb-2">$ git restore --staged mon_fichier.txt</pre>
                <p class="text-xs text-gray-600">Vous avez fait <code>git add</code> par erreur ? Ceci sort le fichier du carton sans modifier son contenu.</p>
            </div>
        </div>
    </div>

    <!-- EXERCICE RESTORE -->
    <div class="bg-blue-50 p-6 rounded-lg border border-blue-200">
        <h4 class="text-xl font-bold text-blue-800 mb-4">💪 Exercice : Le stagiaire maladroit</h4>
        <ol class="list-decimal ml-6 space-y-2 text-blue-900 mb-4">
            <li>Créez un fichier <code>important.config</code>. Commitez.</li>
            <li>Modifiez le fichier avec des bêtises.</li>
            <li>Faites <code>git add .</code> (Oups, c'est dans le carton !)</li>
            <li>Utilisez <code>git restore --staged</code> pour sortir le fichier du carton.</li>
            <li>Utilisez <code>git restore</code> pour annuler vos bêtises dans le fichier.</li>
        </ol>

        <!-- Solution Masquée -->
        <details>
            <summary class="cursor-pointer bg-blue-600 text-white px-4 py-2 rounded inline-block hover:bg-blue-700 transition select-none">
                👁️ Solution Restore
            </summary>
            <div class="mt-4 bg-gray-900 text-green-400 p-4 rounded text-sm font-mono overflow-x-auto shadow-inner">
<pre>$ echo "Config=OK" > important.config
$ git add . && git commit -m "Config Clean"

$ echo "Config=PORTNAWAK" > important.config
$ git add .
$ git status
# Modifié et Staged (Vert)

$ git restore --staged important.config
$ git status
# Modifié mais Unstaged (Rouge)

$ git restore important.config
$ cat important.config
# "Config=OK" -> Ouf !</pre>
            </div>
        </details>
    </div>
</section>
