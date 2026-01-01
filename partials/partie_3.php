<!-- =================================================================== -->
<!-- PARTIE 3 : FLUX LOCAL ET ANALYSE DE DIFFÉRENCES -->
<!-- =================================================================== -->
<h2 class="text-3xl font-bold text-gray-800 border-b-2 border-gray-200 pb-2 mb-6">Partie 3 : Flux Local et Analyse de Différences</h2>

<!-- ========== CHAPITRE 1 : CYCLE DE VIE ========== -->
<section id="cycle-vie" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 1 : Cycle de vie des fichiers</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">1.1 Les 4 états d'un fichier</h4>
        
        <div class="grid md:grid-cols-4 gap-3 mb-6">
            <div class="bg-gray-100 p-3 rounded text-center">
                <div class="text-2xl mb-2">❓</div>
                <h5 class="font-bold text-gray-800">Untracked</h5>
                <p class="text-xs text-gray-600">Nouveau fichier, inconnu de Git</p>
            </div>
            <div class="bg-red-100 p-3 rounded text-center">
                <div class="text-2xl mb-2">✏️</div>
                <h5 class="font-bold text-red-800">Modified</h5>
                <p class="text-xs text-red-700">Modifié mais pas encore stagé</p>
            </div>
            <div class="bg-yellow-100 p-3 rounded text-center">
                <div class="text-2xl mb-2">📦</div>
                <h5 class="font-bold text-yellow-800">Staged</h5>
                <p class="text-xs text-yellow-700">Prêt pour le prochain commit</p>
            </div>
            <div class="bg-green-100 p-3 rounded text-center">
                <div class="text-2xl mb-2">✅</div>
                <h5 class="font-bold text-green-800">Committed</h5>
                <p class="text-xs text-green-700">Enregistré dans l'historique</p>
            </div>
        </div>

        <div class="bg-blue-50 p-4 rounded border-l-4 border-blue-500">
            <h5 class="font-bold text-blue-900 mb-2">🔄 Le flux de travail standard</h5>
            <pre class="text-sm text-blue-800 font-mono">
Untracked ──git add──▶ Staged ──git commit──▶ Committed
                          ▲                        │
                          │                        │
Modified ◀──modifier────────────────────────────────┘</pre>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">1.2 Commandes essentielles du cycle</h4>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto mb-4">
# Voir l'état actuel
$ git status
$ git status -s          # Version courte

# Ajouter des fichiers à la staging area
$ git add fichier.txt    # Un fichier spécifique
$ git add .              # Tout le répertoire courant
$ git add -A             # Tout, y compris suppressions
$ git add -p             # Interactif, chunk par chunk

# Retirer de la staging area (sans perdre les modifications)
$ git restore --staged fichier.txt   # Git 2.23+
$ git reset HEAD fichier.txt         # Ancienne méthode

# Annuler les modifications (DANGER: perte définitive)
$ git restore fichier.txt            # Git 2.23+
$ git checkout -- fichier.txt        # Ancienne méthode

# Créer un commit
$ git commit -m "Message du commit"
$ git commit -am "Message"           # Add + Commit (fichiers suivis uniquement)
$ git commit                         # Ouvre l'éditeur pour le message</pre>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h4 class="text-xl font-bold text-gray-800 mb-4">1.3 Bonnes pratiques pour les commits</h4>
        
        <div class="grid md:grid-cols-2 gap-4">
            <div class="bg-green-50 p-4 rounded">
                <h5 class="font-bold text-green-900 mb-2">✅ À faire</h5>
                <ul class="list-disc ml-4 text-sm text-green-800 space-y-1">
                    <li>Commits atomiques (une seule modification logique)</li>
                    <li>Messages clairs : "feat: ajout login OAuth"</li>
                    <li>Utiliser des préfixes : feat, fix, docs, refactor, test</li>
                    <li>Écrire au présent impératif : "Add", pas "Added"</li>
                </ul>
            </div>
            <div class="bg-red-50 p-4 rounded">
                <h5 class="font-bold text-red-900 mb-2">❌ À éviter</h5>
                <ul class="list-disc ml-4 text-sm text-red-800 space-y-1">
                    <li>Commits géants mélangeant plusieurs features</li>
                    <li>Messages vagues : "fix bug", "update"</li>
                    <li>Commiter des fichiers générés ou secrets</li>
                    <li>Commits WIP sans les squasher avant merge</li>
                </ul>
            </div>
        </div>

        <div class="mt-4 bg-purple-50 p-4 rounded border-l-4 border-purple-500">
            <h5 class="font-bold text-purple-900 mb-2">📝 Convention Conventional Commits</h5>
            <pre class="text-sm text-purple-800 font-mono bg-purple-100 p-2 rounded">
&lt;type&gt;(&lt;scope&gt;): &lt;description&gt;

[optional body]
[optional footer(s)]

Exemple: feat(auth): implement JWT token refresh</pre>
        </div>
    </div>
</section>

<!-- ========== CHAPITRE 2 : GIT DIFF ========== -->
<section id="maitrise-diff" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 2 : Maîtrise de git diff</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">2.1 Les trois comparaisons fondamentales</h4>
        
        <div class="space-y-4">
            <div class="bg-blue-50 p-4 rounded">
                <h5 class="font-bold text-blue-900 mb-2">📁 Working Directory vs Staging Area</h5>
                <pre class="bg-gray-800 text-green-400 p-3 rounded text-sm overflow-x-auto">
$ git diff
# Montre ce qui a été modifié mais pas encore stagé</pre>
            </div>
            
            <div class="bg-yellow-50 p-4 rounded">
                <h5 class="font-bold text-yellow-900 mb-2">📦 Staging vs Dernier Commit</h5>
                <pre class="bg-gray-800 text-green-400 p-3 rounded text-sm overflow-x-auto">
$ git diff --staged
$ git diff --cached     # Synonyme
# Montre ce qui sera inclus dans le prochain commit</pre>
            </div>
            
            <div class="bg-green-50 p-4 rounded">
                <h5 class="font-bold text-green-900 mb-2">📊 Working Directory vs Dernier Commit</h5>
                <pre class="bg-gray-800 text-green-400 p-3 rounded text-sm overflow-x-auto">
$ git diff HEAD
# Montre TOUTES les modifications depuis le dernier commit</pre>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">2.2 Comparaisons entre branches et commits</h4>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto mb-4">
# Entre deux branches
$ git diff main..feature/login
$ git diff main...feature/login  # Depuis l'ancêtre commun

# Entre deux commits
$ git diff abc1234..def5678
$ git diff HEAD~3..HEAD          # 3 derniers commits

# Un fichier spécifique entre commits
$ git diff abc1234..HEAD -- src/app.js

# Liste des fichiers modifiés (sans le contenu)
$ git diff --name-only main..feature
$ git diff --name-status main..feature   # Avec type de modif (M, A, D)</pre>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">2.3 Lecture d'un diff</h4>
        
        <pre class="bg-gray-800 text-sm overflow-x-auto p-4 rounded">
<span class="text-white">diff --git a/src/app.js b/src/app.js</span>
<span class="text-gray-400">index 8ab686e..2c3d4e5 100644</span>
<span class="text-white">--- a/src/app.js</span>
<span class="text-white">+++ b/src/app.js</span>
<span class="text-cyan-400">@@ -10,7 +10,8 @@ function init() {</span>
 <span class="text-gray-300">  const config = loadConfig();</span>
 <span class="text-gray-300">  const db = connectDB();</span>
<span class="text-red-400">-  console.log("Starting...");</span>
<span class="text-green-400">+  logger.info("Application starting");</span>
<span class="text-green-400">+  logger.debug("Config loaded", config);</span>
 <span class="text-gray-300">  return app;</span>
 <span class="text-gray-300">}</span></pre>

        <div class="mt-4 grid md:grid-cols-2 gap-4">
            <div class="text-sm">
                <p class="font-bold text-gray-700 mb-1">Légende :</p>
                <ul class="space-y-1 text-gray-600">
                    <li><span class="text-red-600">−</span> Ligne supprimée</li>
                    <li><span class="text-green-600">+</span> Ligne ajoutée</li>
                    <li><span class="text-gray-500">(espace)</span> Contexte non modifié</li>
                </ul>
            </div>
            <div class="text-sm">
                <p class="font-bold text-gray-700 mb-1">Header <code>@@</code> :</p>
                <p class="text-gray-600"><code>@@ -10,7 +10,8 @@</code> = "Ancien fichier: ligne 10, 7 lignes / Nouveau: ligne 10, 8 lignes"</p>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h4 class="text-xl font-bold text-gray-800 mb-4">2.4 Options utiles de diff</h4>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto">
# Ignorer les espaces blancs
$ git diff -w
$ git diff --ignore-all-space

# Montrer les mots modifiés (pas les lignes)
$ git diff --word-diff

# Diff coloré pour les mots
$ git diff --color-words

# Statistiques seulement
$ git diff --stat

# Limiter le contexte
$ git diff -U1     # 1 ligne de contexte (défaut: 3)</pre>
    </div>
</section>

<!-- ========== CHAPITRE 3 : PATCHS ========== -->
<section id="patchs" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 3 : Patchs (git apply, git format-patch)</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">3.1 Créer un patch</h4>
        <p class="text-gray-700 mb-4">
            Un patch est un fichier texte contenant les modifications, pouvant être partagé et appliqué ailleurs (par email, ticket, etc.).
        </p>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto mb-4">
# Créer un patch à partir du diff non commité
$ git diff > mon_patch.patch

# Créer des patchs pour les N derniers commits (1 fichier par commit)
$ git format-patch -3
# Crée: 0001-Premier-commit.patch, 0002-Deuxieme.patch, 0003-Troisieme.patch

# Patch depuis une branche
$ git format-patch main..feature/login -o patches/

# Patch unique pour plusieurs commits
$ git format-patch main..feature --stdout > all-changes.patch</pre>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">3.2 Appliquer un patch</h4>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto mb-4">
# Appliquer un patch simple (modifications non commitées)
$ git apply mon_patch.patch

# Vérifier si le patch s'applique proprement (dry run)
$ git apply --check mon_patch.patch

# Appliquer avec statistiques
$ git apply --stat mon_patch.patch

# Appliquer les patchs format-patch (avec commits et messages)
$ git am 0001-Premier-commit.patch
$ git am patches/*.patch             # Tous les patchs du dossier

# En cas de conflit avec git am
$ git am --abort                     # Annuler
$ git am --skip                      # Ignorer ce patch
$ git am --continue                  # Après résolution manuelle</pre>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h4 class="text-xl font-bold text-gray-800 mb-4">3.3 Cas d'usage des patchs</h4>
        
        <div class="grid md:grid-cols-2 gap-4">
            <div class="bg-blue-50 p-4 rounded">
                <h5 class="font-bold text-blue-900 mb-2">📧 Contribution par email</h5>
                <p class="text-sm text-blue-800">Le workflow historique du noyau Linux : les développeurs envoient des patchs par email aux mainteneurs.</p>
            </div>
            <div class="bg-green-50 p-4 rounded">
                <h5 class="font-bold text-green-900 mb-2">🔒 Environnements isolés</h5>
                <p class="text-sm text-green-800">Transférer des modifications vers des machines sans accès réseau au dépôt distant.</p>
            </div>
            <div class="bg-orange-50 p-4 rounded">
                <h5 class="font-bold text-orange-900 mb-2">📋 Review de code</h5>
                <p class="text-sm text-orange-800">Partager des modifications pour revue avant de les pousser officiellement.</p>
            </div>
            <div class="bg-purple-50 p-4 rounded">
                <h5 class="font-bold text-purple-900 mb-2">🔧 Hotfixes</h5>
                <p class="text-sm text-purple-800">Appliquer rapidement un correctif spécifique à plusieurs branches ou dépôts.</p>
            </div>
        </div>

        <div class="mt-4 bg-yellow-50 p-4 rounded border-l-4 border-yellow-500">
            <p class="text-sm text-yellow-800"><strong>💡 Conseil :</strong> <code>git format-patch</code> est préférable à <code>git diff</code> car il préserve les métadonnées du commit (auteur, date, message).</p>
        </div>
    </div>
</section>
