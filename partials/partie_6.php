<!-- =================================================================== -->
<!-- PARTIE 6 : LA BOÎTE À OUTILS SAUVETAGE -->
<!-- =================================================================== -->
<h2 class="text-3xl font-bold text-gray-800 border-b-2 border-gray-200 pb-2 mb-6">Partie 6 : La Boîte à Outils "Sauvetage"</h2>

<!-- ========== CHAPITRE 1 : ANNULATION ========== -->
<section id="annulation" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 1 : Annulation (amend, reset, revert, restore)</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">1.1 Modifier le dernier commit (--amend)</h4>
        <p class="text-gray-700 mb-4">Corrige le dernier commit sans en créer un nouveau. Utile pour corriger un message ou ajouter un fichier oublié.</p>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto mb-4">
# Modifier le message du dernier commit
$ git commit --amend -m "Nouveau message corrigé"

# Ajouter des fichiers oubliés au dernier commit
$ git add fichier_oublie.txt
$ git commit --amend --no-edit    # Garde le même message

# Modifier auteur
$ git commit --amend --author="Nouveau Nom <email@example.com>"</pre>

        <div class="bg-yellow-50 p-4 rounded border-l-4 border-yellow-500">
            <p class="text-sm text-yellow-800"><strong>⚠️ Attention :</strong> <code>--amend</code> réécrit l'historique. Ne l'utilisez PAS sur un commit déjà poussé, sauf si vous êtes seul sur la branche et prêt à <code>force push</code>.</p>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">1.2 Git Reset : Revenir en arrière</h4>
        <p class="text-gray-700 mb-4">Déplace HEAD et potentiellement modifie l'index et le working directory.</p>
        
        <div class="grid md:grid-cols-3 gap-4 mb-4">
            <div class="bg-green-50 p-4 rounded border-t-4 border-green-500">
                <h5 class="font-bold text-green-900 mb-2">--soft</h5>
                <p class="text-sm text-green-800">Déplace HEAD. Index et working directory intacts.</p>
                <p class="text-xs text-green-700 mt-2">📦 Modifications restent stagées</p>
            </div>
            <div class="bg-yellow-50 p-4 rounded border-t-4 border-yellow-500">
                <h5 class="font-bold text-yellow-900 mb-2">--mixed (défaut)</h5>
                <p class="text-sm text-yellow-800">Déplace HEAD + reset l'index. Working directory intact.</p>
                <p class="text-xs text-yellow-700 mt-2">✏️ Modifications non stagées</p>
            </div>
            <div class="bg-red-50 p-4 rounded border-t-4 border-red-500">
                <h5 class="font-bold text-red-900 mb-2">--hard</h5>
                <p class="text-sm text-red-800">Déplace HEAD + reset index + reset working directory.</p>
                <p class="text-xs text-red-700 mt-2">🗑️ PERTE de modifications !</p>
            </div>
        </div>

        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto">
# Annuler les 3 derniers commits (garder les modifications stagées)
$ git reset --soft HEAD~3

# Annuler les 3 derniers commits (modifications non stagées)
$ git reset HEAD~3

# DANGER : Supprimer les 3 derniers commits ET les modifications
$ git reset --hard HEAD~3

# Annuler un reset (avec reflog, voir chapitre 3)
$ git reset --hard HEAD@{1}</pre>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">1.3 Git Revert : Annuler sans réécrire</h4>
        <p class="text-gray-700 mb-4">Crée un nouveau commit qui annule les modifications d'un commit précédent. Préserve l'historique.</p>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto mb-4">
# Annuler un commit spécifique
$ git revert abc1234

# Annuler sans créer de commit immédiatement
$ git revert --no-commit abc1234

# Annuler plusieurs commits
$ git revert abc1234..def5678

# En cas de conflit
$ git revert --abort</pre>

        <div class="bg-blue-50 p-4 rounded border-l-4 border-blue-500">
            <p class="text-sm text-blue-800"><strong>💡 Reset vs Revert :</strong></p>
            <ul class="list-disc ml-4 text-sm text-blue-800 mt-2">
                <li><strong>Reset :</strong> Pour les commits NON poussés (réécrit l'historique)</li>
                <li><strong>Revert :</strong> Pour les commits DÉJÀ poussés (préserve l'historique)</li>
            </ul>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h4 class="text-xl font-bold text-gray-800 mb-4">1.4 Git Restore (Git 2.23+)</h4>
        <p class="text-gray-700 mb-4">Commande moderne pour restaurer des fichiers, plus claire que <code>checkout</code>.</p>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto">
# Annuler les modifications d'un fichier (non stagé)
$ git restore fichier.txt

# Retirer un fichier de la staging area
$ git restore --staged fichier.txt

# Restaurer un fichier depuis un commit spécifique
$ git restore --source=abc1234 fichier.txt

# Restaurer tout le working directory
$ git restore .

# Équivalents ancienne syntaxe
$ git checkout -- fichier.txt         # = git restore
$ git reset HEAD fichier.txt          # = git restore --staged</pre>
    </div>
</section>

<!-- ========== CHAPITRE 2 : STASH ========== -->
<section id="stash" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 2 : Le Stash</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">2.1 Principe du Stash</h4>
        <p class="text-gray-700 mb-4">
            Le stash permet de "mettre de côté" des modifications en cours pour travailler sur autre chose, puis de les récupérer plus tard. C'est une pile (LIFO).
        </p>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto mb-4">
# Stasher les modifications
$ git stash
# Équivaut à: git stash push

# Avec un message descriptif
$ git stash push -m "WIP: login feature"

# Inclure les fichiers non suivis
$ git stash -u
$ git stash --include-untracked

# Stasher seulement certains fichiers
$ git stash push -m "Partial stash" -- fichier1.txt fichier2.txt</pre>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">2.2 Gestion de la pile de stash</h4>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto mb-4">
# Voir la liste des stashs
$ git stash list
stash@{0}: WIP on main: abc1234 Message du commit
stash@{1}: On feature: def5678 Autre message

# Appliquer le dernier stash (sans le supprimer)
$ git stash apply

# Appliquer et supprimer le dernier stash
$ git stash pop

# Appliquer un stash spécifique
$ git stash apply stash@{2}

# Voir le contenu d'un stash
$ git stash show stash@{0}
$ git stash show -p stash@{0}     # Avec le diff

# Supprimer un stash
$ git stash drop stash@{1}

# Vider toute la pile
$ git stash clear</pre>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h4 class="text-xl font-bold text-gray-800 mb-4">2.3 Techniques avancées</h4>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto mb-4">
# Créer une branche depuis un stash
$ git stash branch nouvelle-branche stash@{0}

# Stash interactif (choisir les hunks)
$ git stash push -p

# Garder les fichiers stagés intacts
$ git stash push --keep-index</pre>

        <div class="bg-purple-50 p-4 rounded border-l-4 border-purple-500">
            <p class="text-sm text-purple-800"><strong>🎯 Cas d'usage typiques :</strong></p>
            <ul class="list-disc ml-4 text-sm text-purple-800 mt-2 space-y-1">
                <li>Changement de branche urgent avec travail en cours</li>
                <li>Pull qui nécessite un working directory propre</li>
                <li>Test rapide d'un état "propre" du code</li>
                <li>Transfert de modifications entre branches</li>
            </ul>
        </div>
    </div>
</section>

<!-- ========== CHAPITRE 3 : REFLOG ========== -->
<section id="reflog" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 3 : Le Reflog</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">3.1 Qu'est-ce que le Reflog ?</h4>
        <p class="text-gray-700 mb-4">
            Le <strong>Reference Log</strong> enregistre TOUTES les modifications de HEAD et des branches sur votre machine locale. C'est votre filet de sécurité ultime.
        </p>
        
        <div class="bg-green-50 p-4 rounded border-l-4 border-green-500 mb-4">
            <p class="text-sm text-green-800"><strong>🛡️ Superpouvoir :</strong> Même après un <code>reset --hard</code>, les commits "perdus" sont encore accessibles via le reflog pendant au moins 30 jours.</p>
        </div>

        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto">
$ git reflog
abc1234 HEAD@{0}: commit: feat: nouvelle fonctionnalité
def5678 HEAD@{1}: checkout: moving from feature to main
ghi9012 HEAD@{2}: reset: moving to HEAD~3
jkl3456 HEAD@{3}: commit: fix: correction bug
...</pre>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">3.2 Récupérer des commits perdus</h4>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto mb-4">
# Scénario : Oups, j'ai fait reset --hard et perdu mon travail !

# 1. Trouver le commit perdu
$ git reflog
abc1234 HEAD@{0}: reset: moving to HEAD~3
def5678 HEAD@{1}: commit: Travail important perdu  <-- Le voilà !

# 2. Option A : Revenir à cet état
$ git reset --hard HEAD@{1}

# 2. Option B : Créer une branche pour le récupérer
$ git branch recovery HEAD@{1}

# 2. Option C : Cherry-pick le commit
$ git cherry-pick def5678</pre>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">3.3 Récupérer une branche supprimée</h4>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto mb-4">
# Oups, j'ai supprimé ma branche feature avec -D !

# 1. Trouver le dernier commit de la branche
$ git reflog | grep feature
abc1234 HEAD@{5}: checkout: moving from feature to main

# 2. Ou chercher le message spécifique
$ git reflog | grep "mon message de commit"

# 3. Recréer la branche
$ git branch feature abc1234</pre>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h4 class="text-xl font-bold text-gray-800 mb-4">3.4 Commandes utiles du reflog</h4>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto mb-4">
# Reflog d'une branche spécifique
$ git reflog show feature

# Avec dates
$ git reflog --date=iso

# Chercher par date
$ git reflog --since="2 days ago"

# Voir le reflog d'un tag
$ git reflog show v1.0.0</pre>

        <div class="grid md:grid-cols-2 gap-4">
            <div class="bg-yellow-50 p-4 rounded">
                <h5 class="font-bold text-yellow-900 mb-2">⏰ Durée de conservation</h5>
                <ul class="list-disc ml-4 text-sm text-yellow-800 space-y-1">
                    <li>Refs accessibles : 90 jours (par défaut)</li>
                    <li>Refs inaccessibles : 30 jours</li>
                    <li>Configurable via <code>gc.reflogExpire</code></li>
                </ul>
            </div>
            <div class="bg-red-50 p-4 rounded">
                <h5 class="font-bold text-red-900 mb-2">⚠️ Limites</h5>
                <ul class="list-disc ml-4 text-sm text-red-800 space-y-1">
                    <li>Local uniquement (pas partagé)</li>
                    <li>Supprimé par <code>git gc</code> après expiration</li>
                    <li>N'existe pas après un fresh clone</li>
                </ul>
            </div>
        </div>
    </div>
</section>
