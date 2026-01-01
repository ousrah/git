<!-- =================================================================== -->
<!-- PARTIE 7 : CONFLITS ET MAINTENANCE AVANCÉE -->
<!-- =================================================================== -->
<h2 class="text-3xl font-bold text-gray-800 border-b-2 border-gray-200 pb-2 mb-6">Partie 7 : Conflits et Maintenance Avancée</h2>

<!-- ========== CHAPITRE 1 : STRATÉGIES DE MERGE ========== -->
<section id="strategies-merge" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 1 : Stratégies de Merge</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">1.1 Résolution standard des conflits</h4>
        <p class="text-gray-700 mb-4">Quand Git ne peut pas fusionner automatiquement, il marque les conflits dans les fichiers :</p>
        
        <pre class="bg-gray-800 text-sm overflow-x-auto p-4 rounded mb-4">
<span class="text-green-400"><<<<<<< HEAD</span>
<span class="text-blue-400">Votre version (branche courante)</span>
<span class="text-yellow-400">=======</span>
<span class="text-red-400">Leur version (branche mergée)</span>
<span class="text-green-400">>>>>>>> feature-branch</span></pre>

        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto">
# Voir les fichiers en conflit
$ git status

# Après résolution manuelle
$ git add fichier_resolu.txt
$ git commit                    # Message de merge auto-généré

# Utiliser un outil graphique
$ git mergetool

# Annuler le merge en cours
$ git merge --abort</pre>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">1.2 Stratégies Ours vs Theirs</h4>
        
        <div class="grid md:grid-cols-2 gap-6 mb-4">
            <div class="bg-blue-50 p-4 rounded border-l-4 border-blue-500">
                <h5 class="font-bold text-blue-900 mb-2">🏠 Ours (La nôtre)</h5>
                <p class="text-sm text-blue-800 mb-2">En cas de conflit, garde <strong>notre version</strong> (branche courante).</p>
                <pre class="bg-blue-100 p-2 rounded text-xs overflow-x-auto">
# Stratégie de merge
$ git merge -X ours feature

# Pour un fichier spécifique
$ git checkout --ours fichier.txt
$ git add fichier.txt</pre>
            </div>
            <div class="bg-orange-50 p-4 rounded border-l-4 border-orange-500">
                <h5 class="font-bold text-orange-900 mb-2">🏢 Theirs (La leur)</h5>
                <p class="text-sm text-orange-800 mb-2">En cas de conflit, garde <strong>leur version</strong> (branche mergée).</p>
                <pre class="bg-orange-100 p-2 rounded text-xs overflow-x-auto">
# Stratégie de merge
$ git merge -X theirs feature

# Pour un fichier spécifique
$ git checkout --theirs fichier.txt
$ git add fichier.txt</pre>
            </div>
        </div>

        <div class="bg-red-50 p-4 rounded border-l-4 border-red-500">
            <p class="text-sm text-red-800"><strong>⚠️ Ne confondez pas :</strong> <code>-X ours</code> (option de stratégie) vs <code>-s ours</code> (stratégie complète). <code>-s ours</code> ignore COMPLÈTEMENT les modifications de l'autre branche !</p>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h4 class="text-xl font-bold text-gray-800 mb-4">1.3 Cas d'usage des stratégies</h4>
        
        <div class="grid md:grid-cols-2 gap-4">
            <div class="bg-gray-100 p-4 rounded">
                <h5 class="font-bold text-gray-800 mb-2">🔄 Sync depuis upstream</h5>
                <p class="text-sm text-gray-700">Garder vos personnalisations lors d'un merge depuis le projet parent :</p>
                <pre class="bg-gray-200 p-2 rounded text-xs mt-2">$ git merge -X ours upstream/main</pre>
            </div>
            <div class="bg-gray-100 p-4 rounded">
                <h5 class="font-bold text-gray-800 mb-2">📥 Accepter les mises à jour</h5>
                <p class="text-sm text-gray-700">Prendre toutes les modifications de la feature branch :</p>
                <pre class="bg-gray-200 p-2 rounded text-xs mt-2">$ git merge -X theirs feature</pre>
            </div>
        </div>
    </div>
</section>

<!-- ========== CHAPITRE 2 : CONFLITS DE REBASE ========== -->
<section id="conflits-rebase" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 2 : Conflits de Rebase</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">2.1 Merge vs Rebase</h4>
        
        <div class="grid md:grid-cols-2 gap-6 mb-4">
            <div class="bg-green-50 p-4 rounded">
                <h5 class="font-bold text-green-900 mb-2">🔀 Merge</h5>
                <pre class="bg-green-100 p-2 rounded text-xs mb-2">
    A---B---C (main)
         \   \
          D---E---M (feature + merge)</pre>
                <ul class="list-disc ml-4 text-sm text-green-800 space-y-1">
                    <li>Crée un commit de merge</li>
                    <li>Préserve l'historique exact</li>
                    <li>Un seul conflit à résoudre</li>
                </ul>
            </div>
            <div class="bg-blue-50 p-4 rounded">
                <h5 class="font-bold text-blue-900 mb-2">📐 Rebase</h5>
                <pre class="bg-blue-100 p-2 rounded text-xs mb-2">
    A---B---C (main)
             \
              D'---E' (feature rebased)</pre>
                <ul class="list-disc ml-4 text-sm text-blue-800 space-y-1">
                    <li>Réécrit les commits sur la nouvelle base</li>
                    <li>Historique linéaire et propre</li>
                    <li>Conflits possibles à CHAQUE commit</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">2.2 Pourquoi les conflits de rebase sont plus complexes</h4>
        
        <div class="bg-yellow-50 p-4 rounded border-l-4 border-yellow-500 mb-4">
            <p class="text-sm text-yellow-800"><strong>🔄 Problème :</strong> Un rebase rejoue chaque commit un par un. Si vous avez 10 commits et que le premier entre en conflit, vous devez résoudre puis le conflit peut réapparaître au commit suivant !</p>
        </div>

        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto">
# Démarrer un rebase
$ git rebase main

# Conflit détecté !
# Résoudre le conflit dans les fichiers...
$ git add fichier.txt

# Continuer au commit suivant
$ git rebase --continue

# Si nouveau conflit, résoudre et continuer...

# Annuler complètement le rebase
$ git rebase --abort

# Ignorer le commit problématique
$ git rebase --skip</pre>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h4 class="text-xl font-bold text-gray-800 mb-4">2.3 Bonnes pratiques du rebase</h4>
        
        <div class="grid md:grid-cols-2 gap-4">
            <div class="bg-green-50 p-4 rounded">
                <h5 class="font-bold text-green-900 mb-2">✅ Quand utiliser rebase</h5>
                <ul class="list-disc ml-4 text-sm text-green-800 space-y-1">
                    <li>Sur vos branches feature personnelles</li>
                    <li>Avant de créer une Pull Request</li>
                    <li>Pour nettoyer l'historique local</li>
                    <li>Avec <code>pull --rebase</code> quotidien</li>
                </ul>
            </div>
            <div class="bg-red-50 p-4 rounded">
                <h5 class="font-bold text-red-900 mb-2">❌ Quand éviter rebase</h5>
                <ul class="list-disc ml-4 text-sm text-red-800 space-y-1">
                    <li>Sur des branches partagées (main, develop)</li>
                    <li>Après avoir poussé les commits</li>
                    <li>Si d'autres ont basé du travail dessus</li>
                    <li>Quand l'historique exact est important</li>
                </ul>
            </div>
        </div>

        <div class="mt-4 bg-purple-50 p-4 rounded border-l-4 border-purple-500">
            <p class="text-sm text-purple-800"><strong>🌟 Règle d'or :</strong> Ne JAMAIS rebaser des commits qui existent ailleurs que sur votre machine locale.</p>
        </div>
    </div>
</section>

<!-- ========== CHAPITRE 3 : RERERE ========== -->
<section id="rerere" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 3 : Git Rerere</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">3.1 Qu'est-ce que Rerere ?</h4>
        <p class="text-gray-700 mb-4">
            <strong>Rerere</strong> = <strong>Re</strong>use <strong>Re</strong>corded <strong>Re</strong>solution. Git mémorise comment vous avez résolu un conflit et l'applique automatiquement s'il le rencontre à nouveau.
        </p>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto mb-4">
# Activer rerere globalement
$ git config --global rerere.enabled true

# Voir les résolutions enregistrées
$ ls .git/rr-cache/

# Oublier une résolution enregistrée
$ git rerere forget fichier.txt</pre>

        <div class="bg-blue-50 p-4 rounded border-l-4 border-blue-500">
            <p class="text-sm text-blue-800"><strong>💡 Cas d'usage parfait :</strong> Vous testez régulièrement le merge de feature branches vers main, puis annulez. Avec rerere, les mêmes conflits sont résolus automatiquement à chaque fois.</p>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h4 class="text-xl font-bold text-gray-800 mb-4">3.2 Comment ça fonctionne</h4>
        
        <ol class="list-decimal ml-6 text-gray-700 space-y-2 mb-4">
            <li>Première rencontre d'un conflit : vous le résolvez manuellement</li>
            <li>Git enregistre le "pattern" du conflit et sa résolution dans <code>.git/rr-cache/</code></li>
            <li>Prochaine fois que le MÊME conflit apparaît : Git applique automatiquement votre résolution</li>
        </ol>

        <pre class="bg-gray-800 text-sm overflow-x-auto p-4 rounded">
<span class="text-yellow-400"># Premier merge avec conflit</span>
<span class="text-green-400">$ git merge feature</span>
<span class="text-red-400">CONFLICT (content): Merge conflict in app.js
Recorded preimage for 'app.js'</span>

<span class="text-yellow-400"># Résolution manuelle...</span>
<span class="text-green-400">$ git add app.js</span>
<span class="text-green-400">$ git commit</span>
<span class="text-cyan-400">Recorded resolution for 'app.js'</span>

<span class="text-yellow-400"># Plus tard, même conflit...</span>
<span class="text-green-400">$ git merge feature</span>
<span class="text-cyan-400">Resolved 'app.js' using previous resolution</span>
<span class="text-green-400">✨ Automatique !</span></pre>
    </div>
</section>

<!-- ========== CHAPITRE 4 : MAINTENANCE ========== -->
<section id="maintenance" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 4 : Maintenance (clean, gc)</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">4.1 Git Clean : Nettoyer les fichiers non suivis</h4>
        
        <div class="bg-yellow-50 p-4 rounded border-l-4 border-yellow-500 mb-4">
            <p class="text-sm text-yellow-800"><strong>⚠️ Attention :</strong> <code>git clean</code> supprime définitivement les fichiers non suivis. Pas de récupération possible !</p>
        </div>

        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto">
# Voir ce qui serait supprimé (dry run)
$ git clean -n

# Supprimer les fichiers non suivis
$ git clean -f

# Supprimer aussi les répertoires
$ git clean -fd

# Supprimer aussi les fichiers ignorés (.gitignore)
$ git clean -fx

# Mode interactif (recommandé)
$ git clean -i</pre>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">4.2 Git GC : Garbage Collection</h4>
        <p class="text-gray-700 mb-4">Optimise le dépôt en compressant les objets et en supprimant ceux inaccessibles.</p>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto mb-4">
# Lancer le garbage collector
$ git gc

# Version agressive (plus lent, meilleure compression)
$ git gc --aggressive

# Supprimer immédiatement les objets non référencés
$ git gc --prune=now

# Git lance automatiquement gc quand nécessaire
# Désactiver si besoin :
$ git config gc.auto 0</pre>

        <div class="grid md:grid-cols-2 gap-4">
            <div class="bg-green-50 p-4 rounded">
                <h5 class="font-bold text-green-900 mb-2">♻️ Ce que fait GC</h5>
                <ul class="list-disc ml-4 text-sm text-green-800 space-y-1">
                    <li>Compresse les objets en packfiles</li>
                    <li>Supprime les branches de reflog expirées</li>
                    <li>Optimise les références</li>
                    <li>Nettoie les fichiers temporaires</li>
                </ul>
            </div>
            <div class="bg-orange-50 p-4 rounded">
                <h5 class="font-bold text-orange-900 mb-2">⏰ Quand l'utiliser</h5>
                <ul class="list-disc ml-4 text-sm text-orange-800 space-y-1">
                    <li>Après suppression de grosses branches</li>
                    <li>Dépôt qui grossit anormalement</li>
                    <li>Avant un backup/archive</li>
                    <li>Performance dégradée</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h4 class="text-xl font-bold text-gray-800 mb-4">4.3 Autres commandes de maintenance</h4>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto">
# Vérifier l'intégrité du dépôt
$ git fsck

# Optimiser le dépôt (Git 2.30+)
$ git maintenance run

# Configurer la maintenance automatique
$ git maintenance start

# Compter les objets
$ git count-objects -v

# Voir la taille du dépôt
$ du -sh .git/</pre>
    </div>
</section>
