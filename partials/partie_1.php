<!-- =================================================================== -->
<!-- PARTIE 1 : INTRODUCTION ET FONDAMENTAUX (VULGARISÉ) -->
<!-- =================================================================== -->
<h2 class="text-3xl font-bold text-gray-800 border-b-2 border-gray-200 pb-2 mb-6">Partie 1 : Introduction et Fondamentaux</h2>

<!-- ========== CHAPITRE 1 : LE PROBLÈME ========== -->
<section id="probleme-solution" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 1 : Le problème (Pourquoi Git ?)</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">1.1 Le cauchemar des fichiers "Final"</h4>
        <p class="text-gray-700 mb-4">
            On a tous déjà vécu ça. Vous travaillez sur un projet important, vous avez peur de perdre des modifications ou de faire une bêtise, alors vous faites des copies. Et ça finit comme ça :
        </p>
        
        <div class="bg-gray-100 p-4 rounded text-center font-mono text-sm mb-4">
            <p>rapport.docx</p>
            <p>rapport_final.docx</p>
            <p>rapport_final_v2.docx</p>
            <p>rapport_final_vrai_cette_fois.docx</p>
            <p>rapport_final_CORRIGE_Oussama.docx</p>
        </div>

        <div class="bg-red-50 p-4 rounded border-l-4 border-red-500">
            <p class="text-sm text-red-800"><strong>⚠️ Le Problème :</strong> C'est ingérable ! On ne sait plus quelle est la bonne version, qui a modifié quoi, et revenir en arrière est un calvaire.</p>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">1.2 Travailler en équipe sans s'entretuer</h4>
        <p class="text-gray-700 mb-4">
            Imaginez maintenant que vous êtes 3 à travailler sur le MÊME fichier en même temps.
        </p>
        <ul class="list-disc ml-6 text-gray-700 space-y-2">
            <li>Comment fusionner les modifications d'Alice avec celles de Bob ?</li>
            <li>Que se passe-t-il si les deux modifient la ligne 12 en même temps ?</li>
            <li>Comment savoir qui a cassé le code hier soir ?</li>
        </ul>
        <p class="text-gray-700 mt-4">Sans outil adapté, c'est le chaos assuré. On s'envoie des fichiers par mail "tiens ma version", on écrase le travail des autres par erreur... </p>
    </div>
</section>

<!-- ========== CHAPITRE 2 : GIT, C'EST QUOI ? ========== -->
<section id="vcs-definition" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 2 : Git, c'est quoi ? (Définitions simples)</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">2.1 La machine à remonter le temps</h4>
        <p class="text-gray-700 mb-4 text-justify">
            <strong>Git</strong> est un logiciel de <strong>gestion de versions</strong> (VCS). Pour faire simple, c'est une "machine à remonter le temps" pour vos dossiers.
        </p>
        
        <div class="grid md:grid-cols-2 gap-6">
            <div class="bg-green-50 p-4 rounded border-l-4 border-green-500">
                <h5 class="font-bold text-green-900 mb-2">✅ Ce qu'il permet</h5>
                <ul class="list-disc ml-4 text-sm text-green-800 space-y-1">
                    <li>Sauvegarder l'état exact du projet à un instant T (un "Commit").</li>
                    <li>Revenir à n'importe quelle version précédente instantanément.</li>
                    <li>Voir exactement ce qui a changé (qui, quoi, quand).</li>
                    <li>Travailler à plusieurs sans se marcher sur les pieds.</li>
                </ul>
            </div>
            <div class="bg-blue-50 p-4 rounded border-l-4 border-blue-500">
                <h5 class="font-bold text-blue-900 mb-2">💡 Analogie Jeu Vidéo</h5>
                <p class="text-sm text-blue-800">C'est comme un système de <strong>Checkpoints</strong> dans un jeu vidéo. Avant d'affronter le boss (faire une grosse modif risquée), vous sauvegardez. Si vous mourrez (le code plante), vous rechargez la sauvegarde (commande <code>checkout</code> ou <code>reset</code>).</p>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">2.2 "Distribué", ça veut dire quoi ?</h4>
        <p class="text-gray-700 mb-4">
            Vous entendrez souvent que Git est "décentralisé" ou "distribué". Contrairement à une sauvegarde classique sur un serveur central :
        </p>
        
        <div class="bg-yellow-50 p-4 rounded border-l-4 border-yellow-500 mb-4">
            <p class="text-sm text-yellow-800"><strong>🌍 Tout le monde a TOUT :</strong> Quand vous téléchargez un projet Git, vous ne récupérez pas juste les fichiers actuels. Vous téléchargez <strong>tout l'historique complet</strong>, depuis la création du projet.</p>
        </div>

        <p class="text-gray-700">
            <strong>Avantage énorme :</strong> Vous pouvez travailler dans le train, sans internet. Vous avez votre propre copie complète de la base de données du projet. Vous pouvez faire des commits, créer des branches, regarder l'historique... tout ça hors ligne !
        </p>
    </div>
</section>

<!-- ========== CHAPITRE 3 : INSTALLATION ET ÉCOSYSTÈME ========== -->
<section id="installation-ecosysteme" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 3 : Installation et les Géants (GitHub, GitLab...)</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">3.1 Installer Git facilement</h4>
        
        <div class="grid md:grid-cols-2 gap-6">
            <div class="bg-blue-50 p-4 rounded">
                <h5 class="font-bold text-blue-900 mb-2">🪟 Sur Windows</h5>
                <p class="text-sm text-blue-800 mb-2">Téléchargez l'installateur sur <a href="https://git-scm.com/download/win" class="underline font-bold" target="_blank">git-scm.com</a>.</p>
                <p class="text-sm text-blue-800"><strong>Astuce :</strong> Faites "Suivant" à chaque étape, les options par défaut sont très bien pour commencer.</p>
                <p class="text-xs text-blue-700 mt-2">Cela installera aussi "Git Bash", un terminal puissant.</p>
            </div>
            <div class="bg-gray-50 p-4 rounded">
                <h5 class="font-bold text-gray-900 mb-2">🍎 Sur macOS / Linux</h5>
                <p class="text-sm text-gray-800 mb-2">Ouvrez le terminal et tapez :</p>
                <pre class="bg-gray-200 p-2 rounded text-xs">git --version</pre>
                <p class="text-sm text-gray-800 mt-1">S'il n'est pas installé, votre ordinateur vous proposera de le faire automatiquement.</p>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">3.2 Git vs GitHub (Ne pas confondre !)</h4>
        <p class="text-gray-700 mb-4">C'est la confusion n°1 des débutants.</p>
        
        <div class="grid md:grid-cols-2 gap-6 mb-4">
            <div class="bg-orange-50 p-4 rounded border-t-4 border-orange-500 text-center">
                <h5 class="font-bold text-orange-900 mb-2 text-xl">Git</h5>
                <p class="text-sm text-orange-800">C'est le <strong>LOGICIEL</strong> (l'outil).</p>
                <p class="text-xs text-orange-700 mt-2">Comme <em>Word</em> ou <em>Photoshop</em>.<br>Il s'installe sur votre ordinateur.</p>
            </div>
            <div class="bg-purple-50 p-4 rounded border-t-4 border-purple-500 text-center">
                <h5 class="font-bold text-purple-900 mb-2 text-xl">GitHub</h5>
                <p class="text-sm text-purple-800">C'est le <strong>SITE WEB</strong> (le service).</p>
                <p class="text-xs text-purple-700 mt-2">Comme <em>Google Drive</em> ou <em>Dropbox</em>.<br>Il héberge vos projets Git sur internet.</p>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h4 class="text-xl font-bold text-gray-800 mb-4">3.3 Les plateformes d'hébergement</h4>
        <p class="text-gray-700 mb-4">Où stocker votre code en ligne ? Il y a plusieurs concurrents :</p>
        
        <div class="grid md:grid-cols-3 gap-4">
            <div class="bg-gray-100 p-4 rounded hover:shadow-md transition">
                <h5 class="font-bold text-gray-800 mb-1">🐱 GitHub</h5>
                <p class="text-xs text-gray-600 mb-2">Racheté par Microsoft.</p>
                <p class="text-sm text-gray-700">Le plus populaire. C'est le "réseau social" des développeurs. Idéal pour l'open-source et votre portfolio.</p>
            </div>
            <div class="bg-gray-100 p-4 rounded hover:shadow-md transition">
                <h5 class="font-bold text-gray-800 mb-1">🦊 GitLab</h5>
                <p class="text-xs text-gray-600 mb-2">Open source core.</p>
                <p class="text-sm text-gray-700">Très puissant pour le DevOps (CI/CD intégré). Souvent utilisé en entreprise pour être installé sur leurs propres serveurs.</p>
            </div>
            <div class="bg-gray-100 p-4 rounded hover:shadow-md transition">
                <h5 class="font-bold text-gray-800 mb-1">⚙️ Bitbucket</h5>
                <p class="text-xs text-gray-600 mb-2">Par Atlassian (Jira/Trello).</p>
                <p class="text-sm text-gray-700">Très utilisé dans les entreprises qui utilisent déjà Jira. Bonne intégration avec les outils Atlassian.</p>
            </div>
        </div>
    </div>
</section>
