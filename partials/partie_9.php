<!-- =================================================================== -->
<!-- PARTIE 9 : ARCHITECTURE DE PROJET ET INDUSTRIALISATION -->
<!-- =================================================================== -->
<h2 class="text-3xl font-bold text-gray-800 border-b-2 border-gray-200 pb-2 mb-6">Partie 9 : Architecture de Projet et Industrialisation</h2>

<!-- ========== CHAPITRE 1 : SUBMODULES VS SUBTREES ========== -->
<section id="submodules-subtrees" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 1 : Submodules vs Subtrees</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">1.1 Git Submodules</h4>
        <p class="text-gray-700 mb-4">Un submodule est un dépôt Git imbriqué dans un autre dépôt. Le parent stocke une référence vers un commit spécifique du submodule.</p>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto mb-4">
# Ajouter un submodule
$ git submodule add https://github.com/lib/library.git libs/library

# Cloner un projet avec submodules
$ git clone --recurse-submodules https://github.com/user/project.git
# ou après clone :
$ git submodule update --init --recursive

# Mettre à jour tous les submodules
$ git submodule update --remote

# Voir le statut des submodules
$ git submodule status</pre>

        <div class="grid md:grid-cols-2 gap-4">
            <div class="bg-green-50 p-4 rounded">
                <h5 class="font-bold text-green-900 mb-2">✅ Avantages</h5>
                <ul class="list-disc ml-4 text-sm text-green-800 space-y-1">
                    <li>Version exacte de la dépendance</li>
                    <li>Historiques séparés et propres</li>
                    <li>Dépendances légères dans le parent</li>
                </ul>
            </div>
            <div class="bg-red-50 p-4 rounded">
                <h5 class="font-bold text-red-900 mb-2">❌ Inconvénients</h5>
                <ul class="list-disc ml-4 text-sm text-red-800 space-y-1">
                    <li>Complexité extra aux opérations</li>
                    <li>Oubli fréquent de --recurse-submodules</li>
                    <li>Conflits de pointer délicats</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">1.2 Git Subtrees</h4>
        <p class="text-gray-700 mb-4">Un subtree intègre directement le code d'un autre dépôt. Pas de références externes — tout est dans l'historique.</p>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto mb-4">
# Ajouter un subtree
$ git subtree add --prefix=libs/library https://github.com/lib/library.git main --squash

# Mettre à jour depuis l'upstream
$ git subtree pull --prefix=libs/library https://github.com/lib/library.git main --squash

# Pousser des modifications vers l'upstream
$ git subtree push --prefix=libs/library https://github.com/lib/library.git feature-branch</pre>

        <div class="grid md:grid-cols-2 gap-4">
            <div class="bg-green-50 p-4 rounded">
                <h5 class="font-bold text-green-900 mb-2">✅ Avantages</h5>
                <ul class="list-disc ml-4 text-sm text-green-800 space-y-1">
                    <li>Pas d'étape supplémentaire au clone</li>
                    <li>Tout l'historique est local</li>
                    <li>Contribuer en retour facile</li>
                </ul>
            </div>
            <div class="bg-red-50 p-4 rounded">
                <h5 class="font-bold text-red-900 mb-2">❌ Inconvénients</h5>
                <ul class="list-disc ml-4 text-sm text-red-800 space-y-1">
                    <li>Historique mélangé (ou squashé)</li>
                    <li>Taille du dépôt augmentée</li>
                    <li>Commandes longues et peu connues</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h4 class="text-xl font-bold text-gray-800 mb-4">1.3 Quand utiliser quoi ?</h4>
        
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2 text-left">Critère</th>
                        <th class="px-4 py-2 text-left">Submodule</th>
                        <th class="px-4 py-2 text-left">Subtree</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    <tr class="border-b">
                        <td class="px-4 py-2">Clone simple</td>
                        <td class="px-4 py-2">❌ --recurse-submodules</td>
                        <td class="px-4 py-2">✅ Automatique</td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2">Modification de la dépendance</td>
                        <td class="px-4 py-2">⚠️ Process séparé</td>
                        <td class="px-4 py-2">✅ Dans le même repo</td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2">Taille du dépôt</td>
                        <td class="px-4 py-2">✅ Léger</td>
                        <td class="px-4 py-2">⚠️ Plus lourd</td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2">Version précise</td>
                        <td class="px-4 py-2">✅ Commit exact</td>
                        <td class="px-4 py-2">⚠️ Moins visible</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- ========== CHAPITRE 2 : WORKFLOWS INDUSTRIELS ========== -->
<section id="workflows" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 2 : Workflows Industriels</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">2.1 GitFlow</h4>
        
        <div class="bg-blue-50 p-4 rounded border-l-4 border-blue-500 mb-4">
            <p class="text-sm text-blue-800"><strong>Créé par :</strong> Vincent Driessen (2010). Idéal pour les projets avec cycles de release planifiés.</p>
        </div>

        <pre class="text-sm font-mono p-4 bg-gray-100 rounded mb-4 overflow-x-auto">
main        ●──────────────────●────────────────●
             ↑                  ↑                ↑
release     ┃    ●─────────────●                ┃
             ┃   ↑              ↓                ┃
develop    ●─●───●──●──────────●───●──●─────────●
            ↑   ↑              ↑      ↑
feature-A  ●───●              ┃      ┃
                               ┃      ┃
feature-B                     ●──────●</pre>

        <div class="grid md:grid-cols-2 gap-4">
            <div class="text-sm">
                <p class="font-bold text-gray-700 mb-2">Branches principales :</p>
                <ul class="space-y-1 text-gray-600">
                    <li><strong>main</strong> : Code en production</li>
                    <li><strong>develop</strong> : Intégration des features</li>
                </ul>
            </div>
            <div class="text-sm">
                <p class="font-bold text-gray-700 mb-2">Branches de support :</p>
                <ul class="space-y-1 text-gray-600">
                    <li><strong>feature/*</strong> : Nouvelles fonctionnalités</li>
                    <li><strong>release/*</strong> : Préparation d'une release</li>
                    <li><strong>hotfix/*</strong> : Correctifs urgents</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">2.2 GitHub Flow</h4>
        
        <div class="bg-green-50 p-4 rounded border-l-4 border-green-500 mb-4">
            <p class="text-sm text-green-800"><strong>Philosophie :</strong> Simple. Une seule branche main toujours déployable. Tout passe par des Pull Requests.</p>
        </div>

        <pre class="text-sm font-mono p-4 bg-gray-100 rounded mb-4 overflow-x-auto">
main      ●────●────●────●────●────●
           ↑    ↑    ↑    ↑
feature   ●────●    ┃    ┃
                    ●────●</pre>

        <ol class="list-decimal ml-6 text-gray-700 space-y-2">
            <li>Créer une branche depuis main</li>
            <li>Commiter et pousser régulièrement</li>
            <li>Ouvrir une Pull Request pour review</li>
            <li>Discuter et réviser le code</li>
            <li>Déployer depuis la branch (optionnel)</li>
            <li>Merger dans main et déployer</li>
        </ol>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h4 class="text-xl font-bold text-gray-800 mb-4">2.3 Trunk-Based Development</h4>
        
        <div class="bg-purple-50 p-4 rounded border-l-4 border-purple-500 mb-4">
            <p class="text-sm text-purple-800"><strong>Utilisé par :</strong> Google, Facebook. Orienté CI/CD extrême avec feature flags.</p>
        </div>

        <pre class="text-sm font-mono p-4 bg-gray-100 rounded mb-4 overflow-x-auto">
main    ●──●──●──●──●──●──●──●──●
         ↑        ↑
short   ●────●    ●</pre>

        <div class="grid md:grid-cols-3 gap-4">
            <div class="bg-gray-100 p-3 rounded text-sm">
                <strong>Principe :</strong> Commits directs sur main (ou branches très courtes < 1 jour)
            </div>
            <div class="bg-gray-100 p-3 rounded text-sm">
                <strong>Feature Flags :</strong> Nouvelles features cachées derrière des flags
            </div>
            <div class="bg-gray-100 p-3 rounded text-sm">
                <strong>CI/CD :</strong> Tests automatiques à chaque commit
            </div>
        </div>
    </div>
</section>

<!-- ========== CHAPITRE 3 : MONO-REPO VS MULTI-REPO ========== -->
<section id="mono-multi-repo" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 3 : Mono-repo vs Multi-repo</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">3.1 Comparaison</h4>
        
        <div class="grid md:grid-cols-2 gap-6">
            <div class="bg-blue-50 p-4 rounded border-l-4 border-blue-500">
                <h5 class="font-bold text-blue-900 mb-2">📦 Mono-repo</h5>
                <p class="text-sm text-blue-800 mb-2"><em>Un seul dépôt pour tous les projets</em></p>
                <p class="text-xs text-blue-700 mb-2">Utilisé par : Google, Facebook, Microsoft (Windows)</p>
                <ul class="list-disc ml-4 text-sm text-blue-800 space-y-1">
                    <li>✅ Refactoring atomique cross-projets</li>
                    <li>✅ Partage de code facile</li>
                    <li>✅ CI/CD unifiée</li>
                    <li>❌ Taille énorme (tooling spécial)</li>
                    <li>❌ Permissions granulaires difficiles</li>
                </ul>
            </div>
            <div class="bg-orange-50 p-4 rounded border-l-4 border-orange-500">
                <h5 class="font-bold text-orange-900 mb-2">📚 Multi-repo</h5>
                <p class="text-sm text-orange-800 mb-2"><em>Un dépôt par projet/service</em></p>
                <p class="text-xs text-orange-700 mb-2">Approche traditionnelle, microservices</p>
                <ul class="list-disc ml-4 text-sm text-orange-800 space-y-1">
                    <li>✅ Isolation claire des équipes</li>
                    <li>✅ Clone rapide</li>
                    <li>✅ Permissions natives Git</li>
                    <li>❌ Changements cross-projets = N PRs</li>
                    <li>❌ Cohérence des dépendances difficile</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h4 class="text-xl font-bold text-gray-800 mb-4">3.2 Outils pour Mono-repos</h4>
        
        <div class="grid md:grid-cols-3 gap-4">
            <div class="bg-gray-100 p-4 rounded">
                <h5 class="font-bold text-gray-800 mb-2">🔷 Nx</h5>
                <p class="text-sm text-gray-600">Mono-repo intelligent avec caching et affected commands.</p>
            </div>
            <div class="bg-gray-100 p-4 rounded">
                <h5 class="font-bold text-gray-800 mb-2">🟠 Turborepo</h5>
                <p class="text-sm text-gray-600">Build system incrémental par Vercel.</p>
            </div>
            <div class="bg-gray-100 p-4 rounded">
                <h5 class="font-bold text-gray-800 mb-2">🔵 Lerna</h5>
                <p class="text-sm text-gray-600">Gestion de mono-repos JavaScript.</p>
            </div>
        </div>
    </div>
</section>

<!-- ========== CHAPITRE 4 : OUTILS PRO ========== -->
<section id="outils-pro" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 4 : Outils Pro (worktrees, archive, notes)</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">4.1 Git Worktrees</h4>
        <p class="text-gray-700 mb-4">Permet d'avoir plusieurs branches checkout simultanément dans des dossiers séparés, partageant le même dépôt <code>.git</code>.</p>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto mb-4">
# Créer un worktree pour une branche existante
$ git worktree add ../project-hotfix hotfix/urgent-bug

# Créer un worktree avec nouvelle branche
$ git worktree add -b feature/new ../project-feature main

# Lister les worktrees
$ git worktree list
/home/user/project        abc1234 [main]
/home/user/project-hotfix def5678 [hotfix/urgent-bug]

# Supprimer un worktree
$ git worktree remove ../project-hotfix</pre>

        <div class="bg-blue-50 p-4 rounded border-l-4 border-blue-500">
            <p class="text-sm text-blue-800"><strong>💡 Cas d'usage :</strong> Travailler sur un hotfix urgent sans perdre le contexte de votre feature en cours. Pas besoin de stash ou de commit WIP !</p>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">4.2 Git Archive</h4>
        <p class="text-gray-700 mb-4">Exporte une version propre du projet (sans <code>.git</code>) pour distribution ou déploiement.</p>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto">
# Créer une archive ZIP
$ git archive --format=zip --output=release-v1.0.0.zip v1.0.0

# Créer une archive tar.gz
$ git archive --format=tar.gz --output=release.tar.gz HEAD

# Archiver seulement un sous-dossier
$ git archive --format=zip --output=docs.zip HEAD:docs/

# Avec un préfixe de dossier
$ git archive --prefix=myproject-1.0/ -o release.zip v1.0.0</pre>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h4 class="text-xl font-bold text-gray-800 mb-4">4.3 Git Notes</h4>
        <p class="text-gray-700 mb-4">Ajoute des métadonnées à un commit sans modifier son hash. Utile pour annotations, reviews, ou métadonnées CI.</p>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto mb-4">
# Ajouter une note à un commit
$ git notes add -m "Code review : OK" abc1234

# Voir les notes d'un commit
$ git notes show abc1234

# Voir le log avec les notes
$ git log --show-notes

# Éditer une note existante
$ git notes edit abc1234

# Supprimer une note
$ git notes remove abc1234

# Pousser les notes vers le remote
$ git push origin refs/notes/*</pre>

        <div class="bg-yellow-50 p-4 rounded border-l-4 border-yellow-500">
            <p class="text-sm text-yellow-800"><strong>⚠️ Note :</strong> Les notes ne sont PAS poussées par défaut avec <code>git push</code>. Elles nécessitent une configuration ou commande explicite.</p>
        </div>
    </div>
</section>
