<!-- =================================================================== -->
<!-- PARTIE 4 : NAVIGATION, BRANCHES ET ÉTATS COMPLEXES -->
<!-- =================================================================== -->
<h2 class="text-3xl font-bold text-gray-800 border-b-2 border-gray-200 pb-2 mb-6">Partie 4 : Navigation, Branches et États Complexes</h2>

<!-- ========== CHAPITRE 1 : LES BRANCHES ========== -->
<section id="branches" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 1 : Les Branches (Création, Fusion, Suppression)</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">1.1 Comprendre les branches</h4>
        <p class="text-gray-700 mb-4">
            Une branche est simplement un <strong>pointeur mobile</strong> vers un commit. Créer une branche = créer un nouveau pointeur. C'est instantané et ne coûte presque rien en espace.
        </p>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto mb-4">
# Voir les branches locales
$ git branch
* main
  feature/login
  hotfix/security

# Voir toutes les branches (locales + distantes)
$ git branch -a

# Voir les branches avec leur dernier commit
$ git branch -v

# Voir les branches fusionnées dans la branche courante
$ git branch --merged
$ git branch --no-merged</pre>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">1.2 Création et navigation</h4>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto mb-4">
# Créer une branche (sans y aller)
$ git branch feature/new-feature

# Créer et basculer sur la branche
$ git checkout -b feature/new-feature   # Ancienne méthode
$ git switch -c feature/new-feature     # Git 2.23+ (recommandé)

# Basculer sur une branche existante
$ git checkout main
$ git switch main                        # Git 2.23+

# Créer une branche depuis un commit spécifique
$ git switch -c hotfix/bug123 abc1234

# Renommer une branche
$ git branch -m ancien-nom nouveau-nom
$ git branch -M ancien-nom nouveau-nom   # Forcer même si le nom existe</pre>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">1.3 Types de fusion (Merge)</h4>
        
        <div class="grid md:grid-cols-2 gap-6 mb-4">
            <div class="bg-green-50 p-4 rounded border-l-4 border-green-500">
                <h5 class="font-bold text-green-900 mb-2">⚡ Fast-Forward Merge</h5>
                <p class="text-sm text-green-800 mb-2">Quand la branche cible n'a pas divergé. Git "avance" simplement le pointeur.</p>
                <pre class="bg-green-100 p-2 rounded text-xs">
main:     A---B---C
                   \
feature:            D---E

Après merge (fast-forward):
main:     A---B---C---D---E</pre>
                <p class="text-xs text-green-700 mt-2">Pas de commit de merge créé.</p>
            </div>
            <div class="bg-blue-50 p-4 rounded border-l-4 border-blue-500">
                <h5 class="font-bold text-blue-900 mb-2">🔀 Three-way Merge</h5>
                <p class="text-sm text-blue-800 mb-2">Quand les deux branches ont divergé. Git crée un commit de merge.</p>
                <pre class="bg-blue-100 p-2 rounded text-xs">
main:     A---B---C---F
               \     /
feature:        D---E

F = commit de merge (2 parents)</pre>
                <p class="text-xs text-blue-700 mt-2">Préserve l'historique des branches.</p>
            </div>
        </div>

        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto">
# Fusionner une branche dans la branche courante
$ git merge feature/login

# Forcer un commit de merge (même si fast-forward possible)
$ git merge --no-ff feature/login

# Merge sans commit automatique (pour vérifier avant)
$ git merge --no-commit feature/login

# Annuler un merge en cours (en cas de conflits)
$ git merge --abort</pre>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h4 class="text-xl font-bold text-gray-800 mb-4">1.4 Suppression de branches</h4>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto mb-4">
# Supprimer une branche fusionnée
$ git branch -d feature/login

# Forcer la suppression (même si non fusionnée)
$ git branch -D feature/login

# Supprimer une branche distante
$ git push origin --delete feature/login
$ git push origin :feature/login          # Ancienne syntaxe

# Nettoyer les références vers branches distantes supprimées
$ git fetch --prune
$ git remote prune origin</pre>

        <div class="bg-red-50 p-4 rounded border-l-4 border-red-500">
            <p class="text-sm text-red-800"><strong>⚠️ Attention :</strong> <code>-D</code> supprime la branche même si ses commits ne sont accessibles depuis aucune autre branche. Utilisez le reflog pour récupérer si nécessaire.</p>
        </div>
    </div>
</section>

<!-- ========== CHAPITRE 2 : DETACHED HEAD ========== -->
<section id="detached-head" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 2 : L'état Detached HEAD</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">2.1 Qu'est-ce que le Detached HEAD ?</h4>
        <p class="text-gray-700 mb-4">
            Normalement, <code>HEAD</code> pointe vers une branche qui pointe vers un commit. En mode "detached", HEAD pointe <strong>directement</strong> vers un commit, sans passer par une branche.
        </p>
        
        <div class="grid md:grid-cols-2 gap-4 mb-4">
            <div class="bg-green-50 p-4 rounded">
                <h5 class="font-bold text-green-900 mb-2">✅ État normal</h5>
                <pre class="text-xs text-green-800 font-mono">
HEAD → main → commit abc123</pre>
            </div>
            <div class="bg-red-50 p-4 rounded">
                <h5 class="font-bold text-red-900 mb-2">⚠️ Detached HEAD</h5>
                <pre class="text-xs text-red-800 font-mono">
HEAD → commit abc123 (directement)</pre>
            </div>
        </div>

        <pre class="bg-gray-800 text-yellow-400 p-4 rounded text-sm overflow-x-auto">
$ git checkout abc1234
Note: switching to 'abc1234'.

You are in 'detached HEAD' state. You can look around, make experimental
changes and commit them, and you can discard any commits you make in this
state without impacting any branches by switching back to a branch.</pre>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">2.2 Quand entre-t-on en Detached HEAD ?</h4>
        
        <ul class="list-disc ml-6 text-gray-700 space-y-2 mb-4">
            <li><code>git checkout &lt;commit-hash&gt;</code> - Checkout d'un commit spécifique</li>
            <li><code>git checkout v1.0.0</code> - Checkout d'un tag</li>
            <li><code>git checkout HEAD~3</code> - Remonter dans l'historique</li>
            <li><code>git checkout origin/main</code> - Checkout d'une branche distante (sans branche locale)</li>
            <li>Pendant un <code>git rebase</code> interactif</li>
            <li>Pendant un <code>git bisect</code></li>
        </ul>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">2.3 Les dangers</h4>
        
        <div class="bg-red-50 p-4 rounded border-l-4 border-red-500 mb-4">
            <p class="text-sm text-red-800"><strong>🚨 Risque principal :</strong> Si vous faites des commits en Detached HEAD puis changez de branche, ces commits deviennent "orphelins" et seront éventuellement supprimés par le garbage collector !</p>
        </div>

        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto">
# Scénario dangereux
$ git checkout abc1234           # Detached HEAD
$ echo "test" > nouveau.txt
$ git add . && git commit -m "Travail important"
$ git checkout main              # ⚠️ Le commit est maintenant orphelin !

# Message d'avertissement
Warning: you are leaving 1 commit behind, not connected to
any of your branches:
  def5678 Travail important</pre>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h4 class="text-xl font-bold text-gray-800 mb-4">2.4 Comment s'en sortir proprement</h4>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto mb-4">
# Option 1 : Créer une branche pour sauvegarder le travail
$ git switch -c ma-nouvelle-branche

# Option 2 : Sauvegarder avant de partir (si on a oublié)
$ git checkout main
# Oups ! On voit le warning...
$ git branch recovery-branch def5678    # Créer branche sur le commit orphelin

# Option 3 : Retrouver via reflog
$ git reflog
def5678 HEAD@{1}: commit: Travail important
abc1234 HEAD@{2}: checkout: moving from main to abc1234
$ git branch recovery def5678</pre>

        <div class="bg-blue-50 p-4 rounded border-l-4 border-blue-500">
            <p class="text-sm text-blue-800"><strong>💡 Conseil :</strong> Pour explorer l'historique sans risque, utilisez plutôt <code>git log</code>, <code>git show</code>, ou créez explicitement une branche temporaire.</p>
        </div>
    </div>
</section>

<!-- ========== CHAPITRE 3 : CHERRY-PICK ========== -->
<section id="cherry-pick" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 3 : Le Cherry-pick</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">3.1 Principe du Cherry-pick</h4>
        <p class="text-gray-700 mb-4">
            Le cherry-pick permet d'appliquer les modifications d'un commit spécifique sur la branche courante, sans fusionner toute la branche source.
        </p>
        
        <div class="bg-purple-50 p-4 rounded border-l-4 border-purple-500 mb-4">
            <p class="text-sm text-purple-800"><strong>🍒 Analogie :</strong> Comme cueillir une seule cerise sur un arbre au lieu de récolter toute la branche.</p>
        </div>

        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto">
# Cherry-pick un commit
$ git cherry-pick abc1234

# Cherry-pick plusieurs commits
$ git cherry-pick abc1234 def5678 ghi9012

# Cherry-pick une plage de commits
$ git cherry-pick abc1234..ghi9012      # Exclut abc1234
$ git cherry-pick abc1234^..ghi9012     # Inclut abc1234

# Sans créer de commit (modifications dans staging)
$ git cherry-pick --no-commit abc1234

# Éditer le message du commit
$ git cherry-pick -e abc1234</pre>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">3.2 Cas d'usage courants</h4>
        
        <div class="grid md:grid-cols-2 gap-4">
            <div class="bg-orange-50 p-4 rounded">
                <h5 class="font-bold text-orange-900 mb-2">🔥 Hotfix urgent</h5>
                <p class="text-sm text-orange-800">Un bug est corrigé sur <code>develop</code> mais doit être appliqué immédiatement sur <code>main</code> en production.</p>
            </div>
            <div class="bg-blue-50 p-4 rounded">
                <h5 class="font-bold text-blue-900 mb-2">⏪ Backport</h5>
                <p class="text-sm text-blue-800">Appliquer une correction de sécurité sur une ancienne version maintenue (ex: v2.x quand on est en v3.x).</p>
            </div>
            <div class="bg-green-50 p-4 rounded">
                <h5 class="font-bold text-green-900 mb-2">🧪 Extraction partielle</h5>
                <p class="text-sm text-green-800">Une feature branch contient plusieurs changements, mais un seul est prêt pour la release.</p>
            </div>
            <div class="bg-red-50 p-4 rounded">
                <h5 class="font-bold text-red-900 mb-2">🔄 Reconstruction</h5>
                <p class="text-sm text-red-800">Reconstruire proprement une branche en sélectionnant uniquement les commits pertinents.</p>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h4 class="text-xl font-bold text-gray-800 mb-4">3.3 Gestion des conflits</h4>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto mb-4">
# En cas de conflit
$ git cherry-pick abc1234
# CONFLICT (content): Merge conflict in file.txt

# Résoudre le conflit manuellement, puis :
$ git add file.txt
$ git cherry-pick --continue

# Ou annuler le cherry-pick
$ git cherry-pick --abort

# Ignorer ce commit et passer au suivant (dans une plage)
$ git cherry-pick --skip</pre>

        <div class="bg-yellow-50 p-4 rounded border-l-4 border-yellow-500">
            <p class="text-sm text-yellow-800"><strong>⚠️ Attention :</strong> Le cherry-pick crée un <strong>nouveau commit</strong> avec un hash différent. Évitez de cherry-pick puis merge la même branche, car vous aurez des commits en double (même contenu, hashs différents).</p>
        </div>
    </div>
</section>

<!-- ========== CHAPITRE 4 : TAGS ET SEMVER ========== -->
<section id="tags-semver" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 4 : Versioning (Tags et SemVer)</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">4.1 Créer et gérer les tags</h4>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto mb-4">
# Tag léger (simple pointeur)
$ git tag v1.0.0

# Tag annoté (recommandé pour les releases)
$ git tag -a v1.0.0 -m "Version 1.0.0 - Release stable"

# Tag sur un commit spécifique
$ git tag -a v0.9.0 abc1234 -m "Version beta"

# Voir tous les tags
$ git tag
$ git tag -l "v1.*"     # Filtrer par pattern

# Voir les détails d'un tag annoté
$ git show v1.0.0

# Supprimer un tag local
$ git tag -d v1.0.0

# Pousser les tags vers le remote
$ git push origin v1.0.0           # Un tag
$ git push origin --tags           # Tous les tags

# Supprimer un tag distant
$ git push origin --delete v1.0.0</pre>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">4.2 Semantic Versioning (SemVer)</h4>
        <p class="text-gray-700 mb-4">
            Le <a href="https://semver.org/lang/fr/" target="_blank" class="text-blue-600 underline">Semantic Versioning</a> est un standard de numérotation des versions : <code class="bg-gray-100 px-2 py-1 rounded">MAJOR.MINOR.PATCH</code>
        </p>
        
        <div class="overflow-x-auto mb-4">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2 text-left">Composant</th>
                        <th class="px-4 py-2 text-left">Quand incrémenter ?</th>
                        <th class="px-4 py-2 text-left">Exemple</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    <tr class="border-b">
                        <td class="px-4 py-2 font-bold text-red-600">MAJOR</td>
                        <td class="px-4 py-2">Changements incompatibles (breaking changes)</td>
                        <td class="px-4 py-2">1.0.0 → <strong>2</strong>.0.0</td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-bold text-yellow-600">MINOR</td>
                        <td class="px-4 py-2">Nouvelles fonctionnalités rétrocompatibles</td>
                        <td class="px-4 py-2">1.0.0 → 1.<strong>1</strong>.0</td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-bold text-green-600">PATCH</td>
                        <td class="px-4 py-2">Corrections de bugs rétrocompatibles</td>
                        <td class="px-4 py-2">1.0.0 → 1.0.<strong>1</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="bg-purple-50 p-4 rounded border-l-4 border-purple-500">
            <h5 class="font-bold text-purple-900 mb-2">🏷️ Versions de pré-release</h5>
            <p class="text-sm text-purple-800">
                <code>1.0.0-alpha</code> < <code>1.0.0-alpha.1</code> < <code>1.0.0-beta</code> < <code>1.0.0-rc.1</code> < <code>1.0.0</code>
            </p>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h4 class="text-xl font-bold text-gray-800 mb-4">4.3 Bonnes pratiques de versioning</h4>
        
        <div class="grid md:grid-cols-2 gap-4">
            <div class="bg-green-50 p-4 rounded">
                <h5 class="font-bold text-green-900 mb-2">✅ À faire</h5>
                <ul class="list-disc ml-4 text-sm text-green-800 space-y-1">
                    <li>Toujours utiliser des tags annotés pour les releases</li>
                    <li>Suivre strictement SemVer</li>
                    <li>Documenter les changements (CHANGELOG.md)</li>
                    <li>Signer les tags avec GPG en production</li>
                </ul>
            </div>
            <div class="bg-red-50 p-4 rounded">
                <h5 class="font-bold text-red-900 mb-2">❌ À éviter</h5>
                <ul class="list-disc ml-4 text-sm text-red-800 space-y-1">
                    <li>Modifier un tag existant déjà publié</li>
                    <li>Utiliser des versions aléatoires</li>
                    <li>Oublier de pousser les tags</li>
                    <li>Mélanger tags légers et annotés</li>
                </ul>
            </div>
        </div>
    </div>
</section>
