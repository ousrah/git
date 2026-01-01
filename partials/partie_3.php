<!-- =================================================================== -->
<!-- PARTIE 3 : LES BASES DU TRAVAIL (ADD, COMMIT, IGNORE) -->
<!-- =================================================================== -->
<h2 class="text-3xl font-bold text-gray-800 border-b-2 border-gray-200 pb-2 mb-6">Partie 3 : Les Bases du Travail</h2>

<!-- ========== CHAPITRE 1 : CONCEPTS ET ÉTATS ========== -->
<section id="concepts-etats" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 1 : Concepts & États</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">1.1 Le Repository et le Commit</h4>
        <div class="grid md:grid-cols-2 gap-6">
            <div class="bg-blue-50 p-4 rounded">
                <h5 class="font-bold text-blue-900 mb-2">📂 Le Repository (Dépôt)</h5>
                <p class="text-sm text-blue-800">C'est votre projet complet, avec tout son historique. C'est la base de données qui contient toutes les versions de vos fichiers.</p>
            </div>
            <div class="bg-purple-50 p-4 rounded">
                <h5 class="font-bold text-purple-900 mb-2">� Le Commit</h5>
                <p class="text-sm text-purple-800">C'est une photo instantanée (snapshot) de votre projet à un moment précis. Une fois créé, un commit est gravé dans le marbre (ou presque).</p>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">1.2 Les 4 États d'un fichier</h4>
        <p class="text-gray-700 mb-6">Git classe chaque fichier de votre dossier dans une de ces 4 catégories. C'est CRUCIAL de bien comprendre la différence.</p>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 text-center">
            <!-- État 1 : Untracked -->
            <div class="border-2 border-dashed border-gray-400 p-4 rounded bg-gray-50 opacity-75">
                <div class="text-2xl mb-2">👻</div>
                <h5 class="font-bold text-gray-600 mb-2">Untracked</h5>
                <p class="text-xs text-gray-500">"Non suivi"</p>
                <p class="text-xs mt-2 text-left bg-white p-2 rounded border">Fichier nouveau que Git ne connait pas encore. Il n'est pas dans l'album photo.</p>
            </div>

            <!-- État 2 : Modified -->
            <div class="border-2 border-red-200 p-4 rounded bg-red-50">
                <div class="text-2xl mb-2">📝</div>
                <h5 class="font-bold text-red-600 mb-2">Modified</h5>
                <p class="text-xs text-red-500">"Modifié"</p>
                <p class="text-xs mt-2 text-left bg-white p-2 rounded border">Fichier connu de Git, que vous avez changé mais pas encore préparé pour la photo.</p>
            </div>

            <!-- État 3 : Staged -->
            <div class="border-2 border-green-200 p-4 rounded bg-green-50">
                <div class="text-2xl mb-2">📦</div>
                <h5 class="font-bold text-green-600 mb-2">Staged</h5>
                <p class="text-xs text-green-500">"Indexé / Prêt"</p>
                <p class="text-xs mt-2 text-left bg-white p-2 rounded border">Fichier mis dans le carton (Index). Il est prêt à être commité.</p>
            </div>

            <!-- État 4 : Committed -->
            <div class="border-2 border-blue-200 p-4 rounded bg-blue-50">
                <div class="text-2xl mb-2">🔒</div>
                <h5 class="font-bold text-blue-600 mb-2">Committed</h5>
                <p class="text-xs text-blue-500">"Validé"</p>
                <p class="text-xs mt-2 text-left bg-white p-2 rounded border">La version est enregistrée dans la base de données locale. Elle est en sécurité.</p>
            </div>
        </div>
    </div>
</section>

<!-- ========== CHAPITRE 2 : ADD & GITIGNORE ========== -->
<section id="add-gitignore" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 2 : Ajouter (Add) et Ignorer (.gitignore)</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">2.1 La commande git add</h4>
        <p class="text-gray-700 mb-4">
            <code>git add</code> sert à passer un fichier de l'état <strong>Untracked</strong> ou <strong>Modified</strong> à l'état <strong>Staged</strong>.
        </p>

        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto mb-4">
# Ajouter un seul fichier
$ git add index.html

# Ajouter plusieurs fichiers spécifiques
$ git add style.css script.js

# Ajouter tout un dossier
$ git add images/

# ⚡ Ajouter TOUT (nouveaux, modifiés, supprimés) - Le plus utilisé
$ git add .

# Ajouter tout (alternative, pareil que .)
$ git add -A</pre>
        
        <div class="bg-yellow-50 p-4 rounded border-l-4 border-yellow-500">
            <p class="text-sm text-yellow-800"><strong>Attention :</strong> Si vous modifiez un fichier APRES l'avoir ajouté (staged), vous devez refaire <code>git add</code> pour prendre en compte les dernières modifs !</p>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">2.2 Le fichier .gitignore</h4>
        <p class="text-gray-700 mb-4">
            Certains fichiers ne doivent JAMAIS être committés (mots de passe, fichiers temporaires, dossiers de build, dépendances lourdes...).
            Pour ça, on crée un fichier texte nommé <code>.gitignore</code> à la racine.
        </p>

        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <h5 class="font-bold text-gray-700 mb-2">Syntaxe et Exemples :</h5>
                <pre class="bg-gray-100 p-4 rounded text-sm text-gray-800 border">
# Ignorer un fichier spécifique
secret.txt
.env

# Ignorer par extension
*.log
*.tmp
*.psd

# Ignorer un dossier complet
node_modules/
vendor/
build/

# Ignorer tout sauf...
!index.html</pre>
            </div>
            <div>
                <h5 class="font-bold text-gray-700 mb-2">Pourquoi c'est important ?</h5>
                <ul class="list-disc ml-4 text-sm text-gray-600 space-y-2">
                    <li><strong>Sécurité :</strong> Ne pas publier vos clés API.</li>
                    <li><strong>Propreté :</strong> Ne pas polluer l'historique avec des fichiers générés.</li>
                    <li><strong>Performance :</strong> Git n'a pas besoin de scanner les dossiers géants comme <code>node_modules</code>.</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- ========== CHAPITRE 3 : STATUS & COMMIT ========== -->
<section id="status-commit" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 3 : Vérifier (Status) et Valider (Commit)</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">3.1 git status (Le tableau de bord)</h4>
        <p class="text-gray-700 mb-4">
            Affiche l'état actuel de votre Working Directory et de votre Staging Area.
        </p>

        <pre class="bg-gray-800 text-white p-4 rounded text-sm overflow-x-auto mb-4">
$ git status

<span class="text-red-400">Untracked files:</span>
  (use "git add <file>..." to include in what will be committed)
    <span class="text-red-400">nouveau_fichier.txt</span>

<span class="text-green-400">Changes to be committed:</span>
  (use "git restore --staged <file>..." to unstage)
    <span class="text-green-400">new file:   style.css</span>
    <span class="text-green-400">modified:   index.html</span></pre>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">3.2 git commit (La validation)</h4>
        <p class="text-gray-700 mb-4">
            Crée une nouvelle version avec tout ce qui est dans la Staging Area.
        </p>

        <div class="space-y-4">
            <div>
                <h5 class="font-bold text-gray-700">1. Commit classique (Recommandé)</h5>
                <pre class="bg-gray-800 text-green-400 p-3 rounded text-sm">$ git commit -m "Message clair et concis"</pre>
            </div>

            <div>
                <h5 class="font-bold text-gray-700">2. L'option -a (All modified)</h5>
                <p class="text-sm text-gray-600 mb-1">Ajoute automatiquement les fichiers <strong>déjà suivis (modified)</strong> et commit. ⚠️ Ne marche pas pour les fichiers Untracked (nouveaux) !</p>
                <pre class="bg-gray-800 text-green-400 p-3 rounded text-sm">$ git commit -a -m "Message rapide"</pre>
            </div>

            <div>
                <h5 class="font-bold text-gray-700">3. Le combo ultime (-am)</h5>
                <pre class="bg-gray-800 text-green-400 p-3 rounded text-sm">$ git commit -am "Ajoute et commit les modifs en une fois"</pre>
            </div>
        </div>
    </div>

    <div class="bg-green-50 p-6 rounded-lg border border-green-200">
        <h4 class="text-xl font-bold text-green-800 mb-4">💪 Exercices Pratiques</h4>
        <ol class="list-decimal ml-6 space-y-4 text-green-900">
            <li>
                <strong>Initialisation :</strong> Créez un dossier <code>test-git</code>, entrez dedans et tapez <code>git init</code>.
            </li>
            <li>
                <strong>Création :</strong> Créez un fichier <code>index.html</code> et tapez <code>git status</code> (Il doit être Untracked/Rouge).
            </li>
            <li>
                <strong>Staging :</strong> Tapez <code>git add index.html</code> puis <code>git status</code> (Il doit être Staged/Vert).
            </li>
            <li>
                <strong>Commit :</strong> Tapez <code>git commit -m "Premier commit"</code>.
            </li>
            <li>
                <strong>Modification :</strong> Modifiez le fichier. Tapez <code>git status</code>. Essayez <code>git commit -am "Mise à jour"</code>.
            </li>
            <li>
                <strong>Gitignore :</strong> Créez un fichier <code>secret.txt</code>. Créez un fichier <code>.gitignore</code> et écrivez <code>secret.txt</code> dedans. Vérifiez avec <code>git status</code> que le fichier secret n'apparait plus !
            </li>
        </ol>

        <!-- Solution Masquée -->
        <div class="mt-6 border-t border-green-200 pt-4">
            <details>
                <summary class="cursor-pointer bg-green-600 text-white px-4 py-2 rounded inline-block hover:bg-green-700 transition select-none">
                    👁️ Voir la solution
                </summary>
                
                <div class="mt-4 bg-gray-900 text-green-400 p-4 rounded text-sm font-mono overflow-x-auto shadow-inner">
<pre># 1. Initialisation
$ mkdir test-git
$ cd test-git
$ git init

# 2. Création (Sur Windows, utilisez l'explorateur ou echo)
$ echo "Hello" > index.html
$ git status

# 3. Staging
$ git add index.html
$ git status

# 4. Commit
$ git commit -m "Premier commit"

# 5. Modification
$ echo "Modif" >> index.html
$ git status
$ git commit -am "Mise à jour"

# 6. Gitignore
$ echo "Secret" > secret.txt
$ echo "secret.txt" > .gitignore
$ git status
# Le fichier secret.txt ne doit PAS apparaitre</pre>
                </div>
            </details>
        </div>
    </div>
</section>
