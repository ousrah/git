<!-- =================================================================== -->
<!-- PARTIE 10 : CAS RÉELS ET DISASTER RECOVERY -->
<!-- =================================================================== -->
<h2 class="text-3xl font-bold text-gray-800 border-b-2 border-gray-200 pb-2 mb-6">Partie 10 : Cas Réels, Erreurs Classiques et Disaster Recovery</h2>

<!-- ========== CHAPITRE 1 : REPO EN FEU ========== -->
<section id="repo-en-feu" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 1 : Scénario "Repo en feu"</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">1.1 Diagnostiquer un dépôt corrompu</h4>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto mb-4">
# Vérifier l'intégrité du dépôt
$ git fsck --full
error: object abc1234: badTimezone: invalid author/committer line
dangling commit def5678
missing blob ghi9012

# Identifier les problèmes
$ git fsck --lost-found
# Les objets récupérables sont placés dans .git/lost-found/</pre>

        <div class="bg-red-50 p-4 rounded border-l-4 border-red-500 mb-4">
            <h5 class="font-bold text-red-900 mb-2">🚨 Causes courantes de corruption</h5>
            <ul class="list-disc ml-4 text-sm text-red-800 space-y-1">
                <li>Coupure de courant pendant une opération Git</li>
                <li>Disque dur défaillant</li>
                <li>Interruption d'un clone/fetch</li>
                <li>Manipulation manuelle de .git/</li>
            </ul>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">1.2 Récupération d'urgence</h4>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto mb-4">
# Option 1 : Si le remote est sain, recloner
$ mv projet projet-backup
$ git clone https://github.com/user/projet.git

# Option 2 : Récupérer les refs corrompues depuis le remote
$ git fetch origin
$ git reset --hard origin/main

# Option 3 : Récupérer des objets manquants
$ git fetch --all
$ git fsck --full    # Revérifier

# Option 4 : Si le reflog est intact, revenir à un état sain
$ git reflog
$ git reset --hard HEAD@{5}</pre>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h4 class="text-xl font-bold text-gray-800 mb-4">1.3 Réparer un historique public cassé</h4>
        
        <div class="bg-yellow-50 p-4 rounded border-l-4 border-yellow-500 mb-4">
            <p class="text-sm text-yellow-800"><strong>⚠️ Important :</strong> Toute réécriture d'historique public nécessite une coordination avec l'équipe. Tout le monde devra re-cloner ou exécuter des commandes spécifiques.</p>
        </div>

        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto">
# Après avoir corrigé l'historique localement
$ git push --force-with-lease origin main

# Communication aux collaborateurs :
# "L'historique de main a été réécrit. Exécutez :"
$ git fetch origin
$ git reset --hard origin/main
# Ou pour préserver le travail local :
$ git rebase origin/main</pre>
    </div>
</section>

<!-- ========== CHAPITRE 2 : NETTOYAGE D'HISTORIQUE ========== -->
<section id="nettoyage-historique" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 2 : Nettoyage d'historique</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">2.1 Le problème : Fichier sensible commité</h4>
        
        <div class="bg-red-50 p-4 rounded border-l-4 border-red-500 mb-4">
            <p class="text-sm text-red-800"><strong>🚨 Scénario cauchemar :</strong> Vous avez accidentellement commité un fichier <code>.env</code> avec vos clés API, puis poussé sur GitHub. Le supprimer avec un nouveau commit n'est PAS suffisant — il reste dans l'historique !</p>
        </div>

        <p class="text-gray-700 mb-4"><strong>Étape 0 :</strong> Révoquez immédiatement les secrets exposés (nouvelle clé API, nouveau mot de passe, etc.)</p>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">2.2 BFG Repo-Cleaner (Recommandé)</h4>
        <p class="text-gray-700 mb-4">Outil dédié, beaucoup plus rapide et simple que git filter-branch.</p>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto mb-4">
# Installation (Java requis)
# Télécharger depuis https://rtyley.github.io/bfg-repo-cleaner/

# Supprimer un fichier de tout l'historique
$ java -jar bfg.jar --delete-files .env repo.git

# Supprimer les fichiers > 100Mo
$ java -jar bfg.jar --strip-blobs-bigger-than 100M repo.git

# Remplacer du texte (mots de passe)
$ echo "PASSWORD" > passwords.txt
$ java -jar bfg.jar --replace-text passwords.txt repo.git

# Après BFG, nettoyer les objets
$ cd repo.git
$ git reflog expire --expire=now --all
$ git gc --prune=now --aggressive

# Force push le résultat
$ git push --force --all
$ git push --force --tags</pre>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h4 class="text-xl font-bold text-gray-800 mb-4">2.3 git filter-repo (Alternative moderne)</h4>
        <p class="text-gray-700 mb-4">Remplaçant officiel de <code>filter-branch</code> (déprécié). Plus flexible que BFG.</p>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto mb-4">
# Installation
$ pip install git-filter-repo

# Supprimer un fichier de tout l'historique
$ git filter-repo --path .env --invert-paths

# Supprimer un dossier
$ git filter-repo --path secrets/ --invert-paths

# Remplacer du texte
$ git filter-repo --replace-text replacements.txt
# Format du fichier: regex:ANCIEN==>NOUVEAU</pre>

        <div class="bg-blue-50 p-4 rounded border-l-4 border-blue-500">
            <p class="text-sm text-blue-800"><strong>💡 Après nettoyage :</strong> Demandez à GitHub/GitLab de purger leur cache. Les commits supprimés peuvent rester accessibles temporairement via des liens directs.</p>
        </div>
    </div>
</section>

<!-- ========== CHAPITRE 3 : HOOKS ========== -->
<section id="hooks" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 3 : Automatisation (Hooks)</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">3.1 Qu'est-ce qu'un Hook Git ?</h4>
        <p class="text-gray-700 mb-4">Les hooks sont des scripts exécutés automatiquement à certains moments du cycle Git. Ils vivent dans <code>.git/hooks/</code>.</p>
        
        <div class="grid md:grid-cols-2 gap-4 mb-4">
            <div class="bg-blue-50 p-4 rounded">
                <h5 class="font-bold text-blue-900 mb-2">Hooks côté client</h5>
                <ul class="list-disc ml-4 text-sm text-blue-800 space-y-1">
                    <li><strong>pre-commit</strong> : Avant le commit</li>
                    <li><strong>commit-msg</strong> : Valide le message</li>
                    <li><strong>pre-push</strong> : Avant le push</li>
                    <li><strong>post-checkout</strong> : Après un checkout</li>
                </ul>
            </div>
            <div class="bg-orange-50 p-4 rounded">
                <h5 class="font-bold text-orange-900 mb-2">Hooks côté serveur</h5>
                <ul class="list-disc ml-4 text-sm text-orange-800 space-y-1">
                    <li><strong>pre-receive</strong> : Avant réception</li>
                    <li><strong>post-receive</strong> : Après réception</li>
                    <li><strong>update</strong> : Par branche</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">3.2 Exemple : Hook pre-commit</h4>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto mb-4">
#!/bin/sh
# .git/hooks/pre-commit

# Linter JavaScript
echo "🔍 Running ESLint..."
npx eslint --fix .
if [ $? -ne 0 ]; then
    echo "❌ ESLint failed. Commit aborted."
    exit 1
fi

# Vérifier qu'aucun fichier sensible n'est stagé
if git diff --cached --name-only | grep -E '\.(env|pem|key)$'; then
    echo "❌ Sensitive file detected! Commit aborted."
    exit 1
fi

echo "✅ Pre-commit checks passed!"
exit 0</pre>

        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto">
# Rendre le hook exécutable
$ chmod +x .git/hooks/pre-commit

# Bypasser un hook (urgence seulement)
$ git commit --no-verify -m "Emergency fix"</pre>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h4 class="text-xl font-bold text-gray-800 mb-4">3.3 Outils de gestion des hooks</h4>
        <p class="text-gray-700 mb-4">Les hooks ne sont pas versionnés par défaut. Ces outils résolvent ce problème :</p>
        
        <div class="grid md:grid-cols-3 gap-4">
            <div class="bg-gray-100 p-4 rounded">
                <h5 class="font-bold text-gray-800 mb-2">🐶 Husky</h5>
                <p class="text-sm text-gray-600 mb-2">Pour projets JavaScript</p>
                <pre class="bg-gray-200 p-2 rounded text-xs">npm install husky --save-dev
npx husky init</pre>
            </div>
            <div class="bg-gray-100 p-4 rounded">
                <h5 class="font-bold text-gray-800 mb-2">🪝 pre-commit</h5>
                <p class="text-sm text-gray-600 mb-2">Framework Python multi-langage</p>
                <pre class="bg-gray-200 p-2 rounded text-xs">pip install pre-commit
pre-commit install</pre>
            </div>
            <div class="bg-gray-100 p-4 rounded">
                <h5 class="font-bold text-gray-800 mb-2">🎣 lefthook</h5>
                <p class="text-sm text-gray-600 mb-2">Rapide, multi-langage</p>
                <pre class="bg-gray-200 p-2 rounded text-xs">brew install lefthook
lefthook install</pre>
            </div>
        </div>
    </div>
</section>

<!-- ========== CHAPITRE 4 : SIGNATURES GPG ========== -->
<section id="signatures-gpg" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 4 : Signatures GPG</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">4.1 Pourquoi signer ses commits ?</h4>
        
        <div class="bg-purple-50 p-4 rounded border-l-4 border-purple-500 mb-4">
            <p class="text-sm text-purple-800"><strong>🔐 Problème :</strong> <code>git config user.name</code> peut être modifié par n'importe qui. Un attaquant peut usurper votre identité dans un commit. La signature GPG prouve cryptographiquement que VOUS êtes l'auteur.</p>
        </div>

        <div class="flex items-center space-x-4 mb-4">
            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">✓ Verified</span>
            <span class="text-gray-600 text-sm">Badge affiché sur GitHub/GitLab pour les commits signés</span>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">4.2 Configuration de la signature</h4>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto mb-4">
# 1. Générer une clé GPG (ou utiliser une existante)
$ gpg --full-generate-key
# Choisir RSA 4096, email identique à git config user.email

# 2. Trouver l'ID de votre clé
$ gpg --list-secret-keys --keyid-format LONG
sec   rsa4096/3AA5C34371567BD2 2024-01-01 [SC]
#                ↑ C'est l'ID de la clé

# 3. Configurer Git
$ git config --global user.signingkey 3AA5C34371567BD2
$ git config --global commit.gpgsign true    # Signe tous les commits
$ git config --global tag.gpgsign true       # Signe tous les tags

# 4. Exporter la clé publique (pour GitHub/GitLab)
$ gpg --armor --export 3AA5C34371567BD2</pre>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">4.3 Utilisation</h4>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto mb-4">
# Signer un commit (si gpgsign n'est pas activé globalement)
$ git commit -S -m "Signed commit"

# Signer un tag
$ git tag -s v1.0.0 -m "Signed release"

# Vérifier la signature d'un commit
$ git verify-commit abc1234
$ git log --show-signature

# Vérifier la signature d'un tag
$ git verify-tag v1.0.0</pre>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h4 class="text-xl font-bold text-gray-800 mb-4">4.4 Dépannage GPG</h4>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto mb-4">
# Erreur "gpg: signing failed: No pinentry"
$ export GPG_TTY=$(tty)
# Ajouter à ~/.bashrc ou ~/.zshrc

# Erreur avec macOS
$ brew install pinentry-mac
$ echo "pinentry-program /usr/local/bin/pinentry-mac" >> ~/.gnupg/gpg-agent.conf
$ gpgconf --kill gpg-agent

# Tester la signature
$ echo "test" | gpg --clearsign</pre>

        <div class="bg-blue-50 p-4 rounded border-l-4 border-blue-500">
            <p class="text-sm text-blue-800"><strong>💡 Alternative moderne :</strong> Git 2.34+ supporte la signature avec clés SSH (<code>git config gpg.format ssh</code>). Plus simple si vous avez déjà des clés SSH configurées.</p>
        </div>
    </div>
</section>

<!-- ========== CONCLUSION ========== -->
<section id="conclusion" class="mb-16">
    <h2 class="text-3xl font-bold text-gray-800 border-b-2 border-gray-200 pb-2 mb-6">Conclusion & Perspectives</h2>
    
    <div class="bg-gradient-to-r from-blue-50 to-purple-50 p-6 rounded-lg border border-blue-200 mb-6">
        <h3 class="text-xl font-bold text-gray-800 mb-4">🎓 Ce que vous avez appris</h3>
        <div class="grid md:grid-cols-2 gap-4">
            <ul class="list-disc ml-6 text-gray-700 space-y-1">
                <li>La philosophie et architecture interne de Git</li>
                <li>La gestion avancée des branches et merges</li>
                <li>Les outils de sauvetage (reset, reflog, stash)</li>
                <li>La collaboration sécurisée (SSH, secrets, signing)</li>
            </ul>
            <ul class="list-disc ml-6 text-gray-700 space-y-1">
                <li>Le debugging avec blame, bisect, grep</li>
                <li>Les workflows industriels (GitFlow, Trunk-Based)</li>
                <li>La gestion des mono-repos et dépendances</li>
                <li>Le disaster recovery et nettoyage d'historique</li>
            </ul>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h3 class="text-xl font-bold text-gray-800 mb-4">📚 Pour aller plus loin</h3>
        <div class="grid md:grid-cols-3 gap-4">
            <div class="bg-gray-100 p-4 rounded">
                <h5 class="font-bold text-gray-800 mb-2">📖 Ressources</h5>
                <ul class="text-sm text-gray-600 space-y-1">
                    <li><a href="https://git-scm.com/book" class="text-blue-600 underline" target="_blank">Pro Git Book</a> (gratuit)</li>
                    <li><a href="https://learngitbranching.js.org" class="text-blue-600 underline" target="_blank">Learn Git Branching</a></li>
                    <li><a href="https://ohshitgit.com" class="text-blue-600 underline" target="_blank">Oh Shit, Git?!</a></li>
                </ul>
            </div>
            <div class="bg-gray-100 p-4 rounded">
                <h5 class="font-bold text-gray-800 mb-2">🔧 Outils GUI</h5>
                <ul class="text-sm text-gray-600 space-y-1">
                    <li>GitKraken, Sourcetree</li>
                    <li>VS Code Git Lens</li>
                    <li>GitHub Desktop</li>
                </ul>
            </div>
            <div class="bg-gray-100 p-4 rounded">
                <h5 class="font-bold text-gray-800 mb-2">🚀 Pratique</h5>
                <ul class="text-sm text-gray-600 space-y-1">
                    <li>Contribuer à l'open source</li>
                    <li>Configurer un projet avec CI/CD</li>
                    <li>Mettre en place des hooks</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="bg-yellow-50 p-6 rounded-lg border border-yellow-200">
        <h3 class="text-xl font-bold text-yellow-900 mb-2">💡 Conseil final</h3>
        <p class="text-yellow-800">
            Git est un outil puissant qui peut sembler intimidant. La clé est de <strong>pratiquer régulièrement</strong> et de ne pas avoir peur d'expérimenter — le reflog est là pour vous sauver. Avec le temps, les commandes avancées deviendront des réflexes.
        </p>
    </div>
</section>
