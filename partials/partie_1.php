<!-- =================================================================== -->
<!-- PARTIE 1 : INTRODUCTION ET FONDAMENTAUX -->
<!-- =================================================================== -->
<h2 class="text-3xl font-bold text-gray-800 border-b-2 border-gray-200 pb-2 mb-6">Partie 1 : Introduction et Fondamentaux</h2>

<!-- ========== CHAPITRE 1 : VCS & PHILOSOPHIE ========== -->
<section id="vcs-philosophie" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 1 : VCS & Philosophie (Centralisé vs Distribué)</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">1.1 Qu'est-ce qu'un VCS (Version Control System) ?</h4>
        <p class="text-gray-700 mb-4 text-justify">
            Un <strong>système de contrôle de versions</strong> (VCS) est un outil qui enregistre les modifications apportées à un fichier ou un ensemble de fichiers au fil du temps, permettant de rappeler des versions spécifiques ultérieurement.
        </p>
        <div class="bg-blue-50 p-4 rounded border-l-4 border-blue-500 mb-4">
            <p class="text-sm text-blue-800"><strong>💡 Analogie :</strong> Imaginez un VCS comme une "machine à remonter le temps" pour votre code. Chaque sauvegarde est une photo de l'état de votre projet à un instant T.</p>
        </div>
        <h5 class="font-bold text-gray-800 mb-2">Pourquoi utiliser un VCS ?</h5>
        <ul class="list-disc ml-6 text-gray-700 space-y-1">
            <li><strong>Historique complet :</strong> Qui a modifié quoi, quand et pourquoi.</li>
            <li><strong>Collaboration :</strong> Plusieurs développeurs travaillent simultanément.</li>
            <li><strong>Récupération :</strong> Revenir à une version précédente en cas de problème.</li>
            <li><strong>Branches :</strong> Développer des fonctionnalités en parallèle sans affecter le code principal.</li>
            <li><strong>Traçabilité :</strong> Chaque modification est documentée et attribuée.</li>
        </ul>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">1.2 VCS Centralisé vs Distribué</h4>
        
        <div class="grid md:grid-cols-2 gap-6">
            <div class="bg-orange-50 p-4 rounded border-l-4 border-orange-500">
                <h5 class="font-bold text-orange-900 mb-2">🏢 Centralisé (CVCS)</h5>
                <p class="text-sm text-orange-800 mb-2"><strong>Exemples :</strong> SVN, CVS, Perforce</p>
                <ul class="list-disc ml-4 text-sm text-orange-800 space-y-1">
                    <li>Un seul serveur central contient l'historique</li>
                    <li>Les clients ne récupèrent que la dernière version</li>
                    <li>Connexion au serveur obligatoire pour la plupart des opérations</li>
                    <li><strong>Point de défaillance unique :</strong> Si le serveur tombe, tout est bloqué</li>
                </ul>
            </div>
            <div class="bg-green-50 p-4 rounded border-l-4 border-green-500">
                <h5 class="font-bold text-green-900 mb-2">🌐 Distribué (DVCS)</h5>
                <p class="text-sm text-green-800 mb-2"><strong>Exemples :</strong> Git, Mercurial</p>
                <ul class="list-disc ml-4 text-sm text-green-800 space-y-1">
                    <li>Chaque développeur possède une copie complète du dépôt</li>
                    <li>Travail hors ligne possible (commit, branches, historique)</li>
                    <li>Pas de point de défaillance unique</li>
                    <li><strong>Performance :</strong> Opérations locales ultra-rapides</li>
                </ul>
            </div>
        </div>

        <div class="mt-6 bg-gray-100 p-4 rounded">
            <h5 class="font-bold text-gray-800 mb-2">📊 Tableau comparatif</h5>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-4 py-2 text-left">Critère</th>
                            <th class="px-4 py-2 text-left">Centralisé</th>
                            <th class="px-4 py-2 text-left">Distribué (Git)</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        <tr class="border-b">
                            <td class="px-4 py-2 font-medium">Travail hors ligne</td>
                            <td class="px-4 py-2">❌ Non</td>
                            <td class="px-4 py-2">✅ Oui</td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-4 py-2 font-medium">Vitesse des opérations</td>
                            <td class="px-4 py-2">🐢 Dépend du réseau</td>
                            <td class="px-4 py-2">🚀 Ultra-rapide (local)</td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-4 py-2 font-medium">Copie complète de l'historique</td>
                            <td class="px-4 py-2">❌ Non</td>
                            <td class="px-4 py-2">✅ Oui</td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-4 py-2 font-medium">Résilience</td>
                            <td class="px-4 py-2">⚠️ Faible</td>
                            <td class="px-4 py-2">💪 Très forte</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h4 class="text-xl font-bold text-gray-800 mb-4">1.3 Snapshot vs Delta : La philosophie de Git</h4>
        
        <div class="grid md:grid-cols-2 gap-6 mb-4">
            <div class="bg-red-50 p-4 rounded">
                <h5 class="font-bold text-red-900 mb-2">📝 Approche Delta (CVS, SVN)</h5>
                <p class="text-sm text-red-800">Stocke les <strong>différences</strong> (patches) entre chaque version. Pour reconstruire un fichier, il faut appliquer tous les deltas depuis l'origine.</p>
                <pre class="bg-red-100 p-2 rounded mt-2 text-xs overflow-x-auto">
Version 1: fichier_complet
Version 2: +ligne_ajoutée -ligne_supprimée
Version 3: +modification
...</pre>
            </div>
            <div class="bg-green-50 p-4 rounded">
                <h5 class="font-bold text-green-900 mb-2">📷 Approche Snapshot (Git)</h5>
                <p class="text-sm text-green-800">Stocke une <strong>photo complète</strong> de l'état du projet à chaque commit. Les fichiers non modifiés sont liés par référence (pas de duplication).</p>
                <pre class="bg-green-100 p-2 rounded mt-2 text-xs overflow-x-auto">
Commit 1: [snapshot complet]
Commit 2: [snapshot complet]
Commit 3: [snapshot complet]
→ Fichiers identiques = liens vers l'original</pre>
            </div>
        </div>

        <div class="bg-yellow-50 p-4 rounded border-l-4 border-yellow-500">
            <p class="text-sm text-yellow-800"><strong>⚡ Avantage clé du snapshot :</strong> L'accès à n'importe quelle version est instantané. Git n'a pas besoin de "rejouer" l'historique des modifications pour reconstruire un fichier.</p>
        </div>
    </div>
</section>

<!-- ========== CHAPITRE 2 : INSTALLATION & CONFIGURATION ========== -->
<section id="installation-config" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 2 : Installation & Configuration</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">2.1 Installation de Git</h4>
        
        <div class="grid md:grid-cols-3 gap-4 mb-4">
            <div class="bg-blue-50 p-4 rounded">
                <h5 class="font-bold text-blue-900 mb-2">Windows</h5>
                <p class="text-sm text-blue-800 mb-2">Télécharger depuis <a href="https://git-scm.com/download/win" class="underline" target="_blank">git-scm.com</a></p>
                <p class="text-xs text-blue-700">Inclut Git Bash, un terminal Unix-like</p>
            </div>
            <div class="bg-gray-50 p-4 rounded">
                <h5 class="font-bold text-gray-900 mb-2">MacOS</h5>
                <pre class="bg-gray-200 p-2 rounded text-xs">brew install git</pre>
                <p class="text-xs text-gray-700 mt-2">Ou via Xcode Command Line Tools</p>
            </div>
            <div class="bg-orange-50 p-4 rounded">
                <h5 class="font-bold text-orange-900 mb-2">Linux</h5>
                <pre class="bg-orange-200 p-2 rounded text-xs"># Debian/Ubuntu
sudo apt install git

# Fedora
sudo dnf install git</pre>
            </div>
        </div>

        <div class="bg-gray-100 p-4 rounded">
            <h5 class="font-bold text-gray-800 mb-2">Vérifier l'installation</h5>
            <pre class="bg-gray-800 text-green-400 p-3 rounded text-sm overflow-x-auto">
$ git --version
git version 2.43.0</pre>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">2.2 Configuration de l'identité</h4>
        <p class="text-gray-700 mb-4">Git a besoin de savoir qui vous êtes pour attribuer vos commits. Ces informations sont <strong>obligatoires</strong>.</p>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto mb-4">
# Configuration globale (pour tous les projets)
$ git config --global user.name "Votre Nom"
$ git config --global user.email "votre.email@example.com"

# Configuration locale (pour un projet spécifique)
$ git config user.name "Nom Projet Spécifique"
$ git config user.email "email.projet@example.com"</pre>

        <div class="bg-blue-50 p-4 rounded border-l-4 border-blue-500">
            <p class="text-sm text-blue-800"><strong>Niveaux de configuration :</strong></p>
            <ul class="list-disc ml-4 text-sm text-blue-800 mt-2">
                <li><code class="bg-blue-100 px-1 rounded">--system</code> : Tous les utilisateurs de la machine (<code>/etc/gitconfig</code>)</li>
                <li><code class="bg-blue-100 px-1 rounded">--global</code> : Votre utilisateur uniquement (<code>~/.gitconfig</code>)</li>
                <li><code class="bg-blue-100 px-1 rounded">--local</code> : Le dépôt courant (<code>.git/config</code>) - Priorité la plus haute</li>
            </ul>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">2.3 Configuration de l'éditeur</h4>
        <p class="text-gray-700 mb-4">Choisissez l'éditeur utilisé pour rédiger les messages de commit :</p>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto">
# VS Code (recommandé)
$ git config --global core.editor "code --wait"

# Vim
$ git config --global core.editor "vim"

# Nano
$ git config --global core.editor "nano"

# Notepad++ (Windows)
$ git config --global core.editor "'C:/Program Files/Notepad++/notepad++.exe' -multiInst -notabbar -nosession -noPlugin"</pre>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">2.4 Gestion des fins de ligne (CRLF vs LF)</h4>
        <p class="text-gray-700 mb-4">Les systèmes d'exploitation utilisent des caractères différents pour les fins de ligne :</p>
        
        <div class="grid md:grid-cols-2 gap-4 mb-4">
            <div class="bg-blue-50 p-3 rounded text-sm">
                <strong>Windows :</strong> CRLF (<code>\r\n</code>)
            </div>
            <div class="bg-green-50 p-3 rounded text-sm">
                <strong>Linux/macOS :</strong> LF (<code>\n</code>)
            </div>
        </div>

        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto mb-4">
# Windows : Convertir CRLF en LF lors du commit, LF en CRLF lors du checkout
$ git config --global core.autocrlf true

# Linux/macOS : Ne convertir que les CRLF en LF lors du commit
$ git config --global core.autocrlf input

# Désactiver (si vous gérez manuellement)
$ git config --global core.autocrlf false</pre>

        <div class="bg-yellow-50 p-4 rounded border-l-4 border-yellow-500">
            <p class="text-sm text-yellow-800"><strong>⚠️ Conseil :</strong> Pour les projets d'équipe, utilisez un fichier <code>.gitattributes</code> pour définir les règles de fins de ligne de manière cohérente.</p>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h4 class="text-xl font-bold text-gray-800 mb-4">2.5 Alias pour la productivité</h4>
        <p class="text-gray-700 mb-4">Créez des raccourcis pour les commandes fréquentes :</p>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto mb-4">
# Alias courts et pratiques
$ git config --global alias.st status
$ git config --global alias.co checkout
$ git config --global alias.br branch
$ git config --global alias.ci commit
$ git config --global alias.lg "log --oneline --graph --all --decorate"

# Utilisation
$ git st          # Équivaut à: git status
$ git lg          # Affiche un historique graphique compact</pre>

        <div class="bg-gray-100 p-4 rounded">
            <h5 class="font-bold text-gray-800 mb-2">📋 Voir toute la configuration</h5>
            <pre class="bg-gray-800 text-green-400 p-3 rounded text-sm overflow-x-auto">
$ git config --list --show-origin</pre>
            <p class="text-xs text-gray-600 mt-2">Affiche toutes les configurations avec leur fichier source.</p>
        </div>
    </div>
</section>
