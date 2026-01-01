<!-- =================================================================== -->
<!-- PARTIE 8 : INVESTIGATION ET DEBUGGING -->
<!-- =================================================================== -->
<h2 class="text-3xl font-bold text-gray-800 border-b-2 border-gray-200 pb-2 mb-6">Partie 8 : Investigation et Debugging (Niveau Senior)</h2>

<!-- ========== CHAPITRE 1 : GIT BLAME ========== -->
<section id="git-blame" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 1 : Git Blame</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">1.1 Retrouver l'auteur d'une ligne</h4>
        <p class="text-gray-700 mb-4">
            <code>git blame</code> affiche, pour chaque ligne d'un fichier, qui l'a modifiée en dernier, quand, et dans quel commit.
        </p>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto mb-4">
# Blame un fichier entier
$ git blame src/app.js

# Sortie exemple :
abc1234d (Alice   2024-01-15 10:30:00 +0100  1) const express = require('express');
def5678e (Bob     2024-02-20 14:45:00 +0100  2) const app = express();
abc1234d (Alice   2024-01-15 10:30:00 +0100  3)
ghi9012f (Charlie 2024-03-10 09:15:00 +0100  4) app.use(cors());</pre>

        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto">
# Blame une plage de lignes spécifique
$ git blame -L 10,20 src/app.js

# Ignorer les espaces blancs
$ git blame -w src/app.js

# Format court (juste le hash)
$ git blame -s src/app.js

# Afficher l'email au lieu du nom
$ git blame -e src/app.js</pre>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">1.2 Ignorer certains commits</h4>
        <p class="text-gray-700 mb-4">Parfois un commit de reformatage pollue le blame. Git permet de l'ignorer.</p>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto mb-4">
# Ignorer un commit spécifique
$ git blame --ignore-rev abc1234 src/app.js

# Ignorer une liste de commits (fichier)
$ echo "abc1234" >> .git-blame-ignore-revs
$ echo "def5678" >> .git-blame-ignore-revs
$ git blame --ignore-revs-file .git-blame-ignore-revs src/app.js

# Configurer le fichier globalement pour le projet
$ git config blame.ignoreRevsFile .git-blame-ignore-revs</pre>

        <div class="bg-blue-50 p-4 rounded border-l-4 border-blue-500">
            <p class="text-sm text-blue-800"><strong>💡 Bonne pratique :</strong> Créez un fichier <code>.git-blame-ignore-revs</code> à la racine du projet et commitez-le. Ajoutez-y les commits de reformatage massif.</p>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h4 class="text-xl font-bold text-gray-800 mb-4">1.3 Du blame au contexte complet</h4>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto">
# Une fois le commit trouvé, voir les détails
$ git show abc1234

# Voir le diff de ce commit sur ce fichier uniquement
$ git show abc1234 -- src/app.js

# Voir l'historique des modifications de cette ligne
$ git log -p -L 15,15:src/app.js

# Blame sur une ancienne version du fichier
$ git blame abc1234^ -- src/app.js</pre>
    </div>
</section>

<!-- ========== CHAPITRE 2 : GIT BISECT ========== -->
<section id="git-bisect" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 2 : Git Bisect</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">2.1 Chasse aux bugs par dichotomie</h4>
        <p class="text-gray-700 mb-4">
            <code>git bisect</code> utilise une recherche binaire pour trouver le commit exact qui a introduit un bug. Extrêmement efficace sur les longs historiques.
        </p>
        
        <div class="bg-purple-50 p-4 rounded border-l-4 border-purple-500 mb-4">
            <p class="text-sm text-purple-800"><strong>📊 Efficacité :</strong> Pour 1000 commits, il suffit de ~10 tests (log₂(1000) ≈ 10) au lieu de potentiellement 1000 !</p>
        </div>

        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto">
# 1. Démarrer la session bisect
$ git bisect start

# 2. Marquer le commit actuel comme "mauvais" (bug présent)
$ git bisect bad

# 3. Marquer un ancien commit comme "bon" (bug absent)
$ git bisect good v1.0.0
# ou: git bisect good abc1234

# 4. Git checkout un commit au milieu
# Testez si le bug est présent...

# 5. Marquer selon le résultat
$ git bisect good    # Bug absent
# ou
$ git bisect bad     # Bug présent

# 6. Répéter jusqu'à trouver le commit coupable
# Git affiche: "abc1234 is the first bad commit"

# 7. Terminer et revenir à l'état initial
$ git bisect reset</pre>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">2.2 Bisect automatisé avec un script</h4>
        <p class="text-gray-700 mb-4">Si vous avez un test automatisé, Git peut exécuter le bisect sans intervention humaine :</p>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto mb-4">
# Script de test (doit retourner 0 = good, 1-127 = bad, 125 = skip)
$ cat test-bug.sh
#!/bin/bash
npm test 2>&1 | grep -q "PASS"
# Retourne 0 si "PASS" trouvé, sinon retourne 1

# Lancer le bisect automatique
$ git bisect start
$ git bisect bad HEAD
$ git bisect good v1.0.0
$ git bisect run ./test-bug.sh

# Git teste automatiquement chaque commit et trouve le coupable</pre>

        <div class="bg-yellow-50 p-4 rounded border-l-4 border-yellow-500">
            <p class="text-sm text-yellow-800"><strong>💡 Code de retour 125 :</strong> Utilisez-le quand un commit ne peut pas être testé (ex: ne compile pas). Git le sautera.</p>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h4 class="text-xl font-bold text-gray-800 mb-4">2.3 Commandes utiles pendant bisect</h4>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto">
# Voir le log de la session (commits testés)
$ git bisect log

# Visualiser la progression
$ git bisect visualize

# Sauvegarder/restaurer une session
$ git bisect log > bisect.log
$ git bisect replay bisect.log

# Ignorer un commit (ne peut pas être testé)
$ git bisect skip

# Termes alternatifs (pour clarté)
$ git bisect start --term-old=working --term-new=broken
$ git bisect working abc1234
$ git bisect broken HEAD</pre>
    </div>
</section>

<!-- ========== CHAPITRE 3 : GIT GREP ========== -->
<section id="git-grep" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 3 : Git Grep</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">3.1 Recherche dans le code versionné</h4>
        <p class="text-gray-700 mb-4">
            <code>git grep</code> est un grep optimisé pour les dépôts Git. Plus rapide que grep classique et ignore automatiquement <code>.git/</code> et les fichiers ignorés.
        </p>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto">
# Recherche simple
$ git grep "TODO"

# Ignorer la casse
$ git grep -i "error"

# Afficher les numéros de ligne
$ git grep -n "function"

# Compter les occurrences par fichier
$ git grep -c "import"

# Recherche avec contexte (3 lignes avant/après)
$ git grep -C 3 "bug"

# Limiter à certains fichiers
$ git grep "useState" -- "*.jsx" "*.tsx"

# Expression régulière étendue
$ git grep -E "TODO|FIXME|HACK"</pre>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">3.2 Recherche dans l'historique</h4>
        <p class="text-gray-700 mb-4">Contrairement à grep classique, git grep peut chercher dans les anciennes versions du code :</p>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto mb-4">
# Chercher dans un commit spécifique
$ git grep "oldFunction" abc1234

# Chercher dans un tag
$ git grep "deprecated" v1.0.0

# Chercher dans toutes les branches
$ git grep "API_KEY" $(git branch -r --format='%(refname:short)')

# Chercher quand un pattern a été ajouté/supprimé
$ git log -p -S "function login" --all

# Avec expression régulière
$ git log -p -G "function\s+login\s*\(" --all</pre>

        <div class="bg-blue-50 p-4 rounded border-l-4 border-blue-500">
            <p class="text-sm text-blue-800"><strong>💡 Différence -S vs -G :</strong></p>
            <ul class="list-disc ml-4 text-sm text-blue-800 mt-2">
                <li><code>-S "text"</code> : Commits qui changent le NOMBRE d'occurrences de "text"</li>
                <li><code>-G "regex"</code> : Commits dont le diff CONTIENT le pattern</li>
            </ul>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h4 class="text-xl font-bold text-gray-800 mb-4">3.3 Recherches avancées</h4>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto mb-4">
# Recherche multi-pattern (AND)
$ git grep -e "import" --and -e "react"

# Recherche dans les noms de fonctions (avec contexte)
$ git grep -p "validate" -- "*.js"

# Afficher le nom de la fonction contenant le match
$ git grep -W "TODO"

# Combiner avec log pour trouver l'auteur
$ git log --all -p -S "buggyCode" --pretty=format:"%h %an %s"</pre>

        <div class="grid md:grid-cols-2 gap-4">
            <div class="bg-green-50 p-4 rounded">
                <h5 class="font-bold text-green-900 mb-2">✅ Avantages sur grep</h5>
                <ul class="list-disc ml-4 text-sm text-green-800 space-y-1">
                    <li>Ignore automatiquement .git/</li>
                    <li>Respecte .gitignore</li>
                    <li>Peut chercher dans l'historique</li>
                    <li>Optimisé pour les dépôts Git</li>
                </ul>
            </div>
            <div class="bg-orange-50 p-4 rounded">
                <h5 class="font-bold text-orange-900 mb-2">🔧 Alternatives modernes</h5>
                <ul class="list-disc ml-4 text-sm text-orange-800 space-y-1">
                    <li><strong>ripgrep (rg)</strong> : Ultra-rapide</li>
                    <li><strong>ag (Silver Searcher)</strong> : Rapide</li>
                    <li><strong>ack</strong> : Orienté programmeurs</li>
                </ul>
            </div>
        </div>
    </div>
</section>
