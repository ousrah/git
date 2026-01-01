<!-- =================================================================== -->
<!-- PARTIE 4 : EXPLORATION AVANCÉE (LOG, DIFF, CHECKOUT) -->
<!-- =================================================================== -->
<h2 class="text-3xl font-bold text-gray-800 border-b-2 border-gray-200 pb-2 mb-6">Partie 4 : Exploration et Voyage</h2>

<!-- ========== CHAPITRE 1 : MAÎTRISER GIT LOG ========== -->
<section id="git-log" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 1 : Lire l'histoire (git log)</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">1.1 La base et les variantes d'affichage</h4>
        <p class="text-gray-700 mb-4">
            La commande <code>git log</code> est votre fenêtre sur le passé. Par défaut, elle est verbeuse, mais on peut la personnaliser à l'infini.
        </p>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm border-collapse">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border p-2 text-left">Commande</th>
                        <th class="border p-2 text-left">Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border p-2 font-mono text-blue-600">git log</td>
                        <td class="border p-2">Affiche l'historique complet (Hash, Auteur, Date, Message).</td>
                    </tr>
                    <tr>
                        <td class="border p-2 font-mono text-blue-600">git log -n 2</td>
                        <td class="border p-2">Limite l'affichage aux <strong>2 derniers</strong> commits.</td>
                    </tr>
                    <tr>
                        <td class="border p-2 font-mono text-blue-600">git log --oneline</td>
                        <td class="border p-2">Affiche chaque commit sur <strong>une seule ligne</strong> (Hash court + Message). Idéal pour une vue d'ensemble.</td>
                    </tr>
                    <tr>
                        <td class="border p-2 font-mono text-blue-600">git log --graph</td>
                        <td class="border p-2">Dessine un arbre ASCII sur la gauche pour voir les branches et les fusions.</td>
                    </tr>
                    <tr>
                        <td class="border p-2 font-mono text-blue-600">git log --decorate</td>
                        <td class="border p-2">Affiche les références (HEAD, branches, tags) à côté des commits.</td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="mt-4 bg-gray-800 p-4 rounded text-white text-xs font-mono">
            <p class="text-gray-400"># Le combo ultime ("A DOG" : All, Decorate, Oneline, Graph)</p>
            <p>$ git log --all --decorate --oneline --graph</p>
            <p class="text-red-400">* 3a1b2c (HEAD -> main, origin/main) Fix login bug</p>
            <p class="text-blue-400">| * 8d9e0f (feature/new-ui) Add new buttons</p>
            <p class="text-blue-400">|/ </p>
            <p class="text-red-400">* 1g2h3i Initial commit</p>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">1.2 Filtrer la recherche</h4>
        <p class="text-gray-700 mb-4">
            Dans un projet avec 10 000 commits, vous devez savoir chercher.
        </p>

        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <h5 class="font-bold text-gray-700 mb-2">📅 Par date</h5>
                <pre class="bg-gray-100 p-2 rounded text-xs mb-2">git log --since="2024-01-01"</pre>
                <pre class="bg-gray-100 p-2 rounded text-xs mb-2">git log --until="2 weeks ago"</pre>
            </div>
            <div>
                <h5 class="font-bold text-gray-700 mb-2">👤 Par auteur</h5>
                <pre class="bg-gray-100 p-2 rounded text-xs mb-2">git log --author="Oussama"</pre>
            </div>
            <div>
                <h5 class="font-bold text-gray-700 mb-2">🔍 Par message</h5>
                <pre class="bg-gray-100 p-2 rounded text-xs mb-2">git log --grep="bugfix"</pre>
            </div>
            <div>
                <h5 class="font-bold text-gray-700 mb-2">📄 Par fichier</h5>
                <pre class="bg-gray-100 p-2 rounded text-xs mb-2">git log -- index.html</pre>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h4 class="text-xl font-bold text-gray-800 mb-4">1.3 Voir le contenu (Patchs)</h4>
        <p class="text-gray-700 mb-4">
            Parfois, le message ne suffit pas, on veut voir CODE.
        </p>
        
        <ul class="space-y-3">
            <li class="flex items-start">
                <span class="font-mono bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs mr-2">git log -p</span>
                <span class="text-sm">Affiche le "Patch" (le diff) complet de chaque commit.</span>
            </li>
            <li class="flex items-start">
                <span class="font-mono bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs mr-2">git log -p index.html</span>
                <span class="text-sm">Montre l'évolution du code <strong>uniquement pour ce fichier</strong>.</span>
            </li>
            <li class="flex items-start">
                <span class="font-mono bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs mr-2">git log --stat</span>
                <span class="text-sm">Affiche des statistiques résumées (fichiers modifiés, nombre de lignes +/-).</span>
            </li>
        </ul>
    </div>
</section>

<!-- ========== CHAPITRE 2 : INSPECTER AVEC GIT DIFF ========== -->
<section id="git-diff-detail" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 2 : Inspecter les changements (git diff)</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">2.1 Comprendre ce qu'on compare</h4>
        <p class="text-gray-700 mb-4">
            <code>git diff</code> ne sert pas juste à voir ce qu'on a fait avant de commiter. C'est un outil de comparaison universel.
        </p>

        <div class="grid md:grid-cols-2 gap-4">
            <div class="border p-4 rounded bg-gray-50">
                <h5 class="font-bold text-gray-800 mb-2">1. Working Directory vs Staging (Le défaut)</h5>
                <pre class="bg-gray-800 text-green-400 p-2 rounded text-xs mb-2">$ git diff</pre>
                <p class="text-xs text-gray-600">Ce que j'ai modifié mais PAS ENCORE ajouté (add).</p>
            </div>
            
            <div class="border p-4 rounded bg-gray-50">
                <h5 class="font-bold text-gray-800 mb-2">2. Staging vs Dernier Commit</h5>
                <pre class="bg-gray-800 text-green-400 p-2 rounded text-xs mb-2">$ git diff --staged</pre>
                <p class="text-xs text-gray-600">Ce que je m'apprête à commiter (ce qui est ready).</p>
            </div>

            <div class="border p-4 rounded bg-gray-50">
                <h5 class="font-bold text-gray-800 mb-2">3. Entre deux commits</h5>
                <pre class="bg-gray-800 text-green-400 p-2 rounded text-xs mb-2">$ git diff a1b2c..d4e5f</pre>
                <p class="text-xs text-gray-600">Qu'est-ce qui a changé entre la version A et la version B ?</p>
            </div>

            <div class="border p-4 rounded bg-gray-50">
                <h5 class="font-bold text-gray-800 mb-2">4. Entre deux branches</h5>
                <pre class="bg-gray-800 text-green-400 p-2 rounded text-xs mb-2">$ git diff main..feature</pre>
                <p class="text-xs text-gray-600">Qu'est-ce que "feature" a de plus que "main" ?</p>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h4 class="text-xl font-bold text-gray-800 mb-4">2.2 Options pratiques</h4>
        <ul class="list-disc ml-6 text-gray-700 space-y-2">
            <li><code>git diff --name-only</code> : Affiche juste les noms de fichiers, pas le code.</li>
            <li><code>git diff -w</code> : Ignore les changements d'espaces (utile si quelqu'un a juste réindenté tout le fichier !).</li>
            <li><code>git diff --word-diff</code> : Affiche les changements mot par mot (plutôt que ligne par ligne).</li>
        </ul>
    </div>
</section>

<!-- ========== CHAPITRE 3 : GIT CHECKOUT & NAVIGATION ========== -->
<section id="git-checkout" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 3 : Voyager dans le temps (git checkout)</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">3.1 La commande aux multiples visages</h4>
        <p class="text-gray-700 mb-4">
            <code>git checkout</code> fait deux choses très différentes selon le contexte. C'est pour cela que Git moderne a introduit <code>switch</code> et <code>restore</code> (mais checkout reste universel).
        </p>

        <div class="grid md:grid-cols-2 gap-6">
            <div class="bg-purple-50 p-4 rounded border-l-4 border-purple-500">
                <h5 class="font-bold text-purple-900 mb-2">✈️ Se déplacer (HEAD)</h5>
                <p class="text-sm text-purple-800 mb-2">Change l'état global du projet.</p>
                <pre class="bg-purple-100 p-2 rounded text-xs text-purple-900 font-mono space-y-2">
# Aller sur une branche
$ git checkout main

# Créer et aller sur une branche
$ git checkout -b ma-super-branche

# Aller sur un commit précis (Lecture seule)
$ git checkout a1b2c3d</pre>
            </div>

            <div class="bg-orange-50 p-4 rounded border-l-4 border-orange-500">
                <h5 class="font-bold text-orange-900 mb-2">♻️ Restaurer des fichiers</h5>
                <p class="text-sm text-orange-800 mb-2">Écrase les modifications locales.</p>
                <pre class="bg-orange-100 p-2 rounded text-xs text-orange-900 font-mono space-y-2">
# Annuler les modifs d'un fichier
$ git checkout -- fichier.html

# Tout remettre à zéro (DANGER ☢️)
$ git checkout .

# Récupérer un fichier d'une autre branche
$ git checkout main -- fichier.html</pre>
            </div>
        </div>
    </div>

    <!-- EXERCICE COMPLET -->
    <div class="bg-green-50 p-6 rounded-lg border border-green-200">
        <h4 class="text-xl font-bold text-green-800 mb-4">💪 Exercice Avancé : L'enquêteur Temporel</h4>
        <p class="text-green-900 mb-4">Objectif : Créer un historique complexe et naviguer dedans.</p>
        
        <ol class="list-decimal ml-6 space-y-3 text-green-900 text-sm">
            <li>Créez un dépôt et faites 3 commits modifiant <code>data.txt</code> (contenu: "A", puis "A B", puis "A B C").</li>
            <li>Utilisez <code>git log --oneline</code> pour voir les Hashs.</li>
            <li>Utilisez <code>git log -p data.txt</code> pour voir exactement ce qui a été ajouté à chaque fois.</li>
            <li>Faites un <code>git checkout</code> vers le 1er commit. Vérifiez le fichier.</li>
            <li>Revenez sur main. Modifiez le fichier ("A B C D") sans commiter.</li>
            <li>Faites <code>git diff</code> pour voir la modif.</li>
            <li>Oops, c'était une erreur ! Utilisez <code>git checkout -- data.txt</code> pour annuler.</li>
        </ol>

        <!-- Solution Masquée -->
        <div class="mt-6 border-t border-green-200 pt-4">
            <details>
                <summary class="cursor-pointer bg-green-600 text-white px-4 py-2 rounded inline-block hover:bg-green-700 transition select-none">
                    👁️ Voir la solution
                </summary>
                
                <div class="mt-4 bg-gray-900 text-green-400 p-4 rounded text-sm font-mono overflow-x-auto shadow-inner">
<pre># 1. Setup
$ git init exo-log
$ cd exo-log
$ echo "A" > data.txt && git add . && git commit -m "Ajout A"
$ echo "A B" > data.txt && git commit -am "Ajout B"
$ echo "A B C" > data.txt && git commit -am "Ajout C"

# 2. Log avancé
$ git log --oneline
# 3a1b2c (HEAD -> main) Ajout C
# 1f2e3d Ajout B
# 9z8y7x Ajout A

# 3. Voir l'évolution
$ git log -p data.txt

# 4. Voyage
$ git checkout 9z8y7x  (Hash du 1er commit)
$ cat data.txt         # Affiche "A"
$ git checkout main    # Retour au présent

# 5, 6, 7. Manipulation et Annulation
$ echo "A B C D" > data.txt
$ git diff
# Affiche le +D en vert
$ git checkout -- data.txt
$ cat data.txt
# Affiche "A B C" (Modif annulée)</pre>
                </div>
            </details>
        </div>
    </div>
</section>
