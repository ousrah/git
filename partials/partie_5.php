<!-- =================================================================== -->
<!-- PARTIE 5 : COLLABORATION ET SÉCURITÉ -->
<!-- =================================================================== -->
<h2 class="text-3xl font-bold text-gray-800 border-b-2 border-gray-200 pb-2 mb-6">Partie 5 : Collaboration et Sécurité</h2>

<!-- ========== CHAPITRE 1 : PROTOCOLES & REMOTES ========== -->
<section id="protocoles-remotes" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 1 : Protocoles & Remotes (SSH vs HTTPS)</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">1.1 Gestion des dépôts distants (Remotes)</h4>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto mb-4">
# Voir les remotes configurés
$ git remote -v
origin  https://github.com/user/repo.git (fetch)
origin  https://github.com/user/repo.git (push)

# Ajouter un remote
$ git remote add upstream https://github.com/original/repo.git

# Renommer un remote
$ git remote rename origin github

# Supprimer un remote
$ git remote remove upstream

# Changer l'URL d'un remote
$ git remote set-url origin git@github.com:user/repo.git

# Voir les informations détaillées
$ git remote show origin</pre>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">1.2 SSH vs HTTPS</h4>
        
        <div class="grid md:grid-cols-2 gap-6 mb-4">
            <div class="bg-blue-50 p-4 rounded border-l-4 border-blue-500">
                <h5 class="font-bold text-blue-900 mb-2">🔐 HTTPS</h5>
                <p class="text-sm text-blue-800 mb-2"><code>https://github.com/user/repo.git</code></p>
                <ul class="list-disc ml-4 text-sm text-blue-800 space-y-1">
                    <li>Fonctionne partout (pare-feu rarement bloquant)</li>
                    <li>Nécessite authentification à chaque push (ou token)</li>
                    <li>Credential manager peut stocker les identifiants</li>
                    <li>Idéal pour débutants ou accès temporaire</li>
                </ul>
            </div>
            <div class="bg-green-50 p-4 rounded border-l-4 border-green-500">
                <h5 class="font-bold text-green-900 mb-2">🔑 SSH</h5>
                <p class="text-sm text-green-800 mb-2"><code>git@github.com:user/repo.git</code></p>
                <ul class="list-disc ml-4 text-sm text-green-800 space-y-1">
                    <li>Authentification par clé publique/privée</li>
                    <li>Pas de mot de passe à chaque opération</li>
                    <li>Plus sécurisé (clé > mot de passe)</li>
                    <li>Recommandé pour usage quotidien</li>
                </ul>
            </div>
        </div>

        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto">
# Générer une clé SSH
$ ssh-keygen -t ed25519 -C "votre@email.com"
# Ou RSA pour compatibilité
$ ssh-keygen -t rsa -b 4096 -C "votre@email.com"

# Démarrer l'agent SSH et ajouter la clé
$ eval "$(ssh-agent -s)"
$ ssh-add ~/.ssh/id_ed25519

# Tester la connexion
$ ssh -T git@github.com
Hi username! You've successfully authenticated...</pre>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h4 class="text-xl font-bold text-gray-800 mb-4">1.3 Opérations réseau</h4>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto">
# Récupérer les modifications distantes (sans fusionner)
$ git fetch origin
$ git fetch --all             # Tous les remotes

# Récupérer et fusionner
$ git pull origin main
$ git pull --rebase           # Rebase au lieu de merge

# Pousser vers le remote
$ git push origin main
$ git push -u origin main     # Configurer le tracking
$ git push --all              # Toutes les branches</pre>
    </div>
</section>

<!-- ========== CHAPITRE 2 : FORCE PUSH ========== -->
<section id="force-push" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 2 : Le Force Push</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">2.1 Pourquoi c'est dangereux</h4>
        
        <div class="bg-red-50 p-4 rounded border-l-4 border-red-500 mb-4">
            <p class="text-sm text-red-800"><strong>🚨 Danger :</strong> <code>git push --force</code> réécrit l'historique distant. Les commits des autres collaborateurs peuvent être perdus s'ils ont basé leur travail sur les commits que vous écrasez.</p>
        </div>

        <pre class="bg-gray-800 text-sm overflow-x-auto p-4 rounded mb-4">
<span class="text-gray-400"># Scénario catastrophe</span>
<span class="text-green-400">$ git rebase -i HEAD~5        </span><span class="text-gray-400"># Réécrit 5 commits</span>
<span class="text-green-400">$ git push --force            </span><span class="text-gray-400"># 💥 Écrase l'historique distant</span>

<span class="text-gray-400"># Entre-temps, Alice avait fait :</span>
<span class="text-green-400">$ git pull origin main        </span><span class="text-gray-400"># Basé sur l'ancien historique</span>
<span class="text-green-400">$ git commit ...              </span><span class="text-gray-400"># Ses nouveaux commits</span>

<span class="text-gray-400"># Résultat : l'historique d'Alice est incompatible !</span></pre>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">2.2 Quand c'est nécessaire</h4>
        
        <ul class="list-disc ml-6 text-gray-700 space-y-2 mb-4">
            <li><strong>Après un rebase interactif</strong> sur une branche feature personnelle</li>
            <li><strong>Amend du dernier commit</strong> déjà poussé</li>
            <li><strong>Nettoyage d'historique</strong> avant merge d'une feature branch</li>
            <li><strong>Correction d'une erreur</strong> sur une branche non partagée</li>
        </ul>

        <div class="bg-yellow-50 p-4 rounded border-l-4 border-yellow-500">
            <p class="text-sm text-yellow-800"><strong>📏 Règle d'or :</strong> Ne JAMAIS force push sur <code>main</code>, <code>master</code>, <code>develop</code> ou toute branche partagée. Réservez le force push aux branches feature personnelles.</p>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h4 class="text-xl font-bold text-gray-800 mb-4">2.3 L'alternative sécurisée : --force-with-lease</h4>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto mb-4">
# Force push sécurisé
$ git push --force-with-lease

# Équivaut à : "Force push, MAIS seulement si personne
# n'a poussé de nouveaux commits entre-temps"</pre>

        <div class="grid md:grid-cols-2 gap-4">
            <div class="bg-red-50 p-4 rounded">
                <h5 class="font-bold text-red-900 mb-2">❌ --force</h5>
                <p class="text-sm text-red-800">Écrase tout, même si d'autres ont poussé.</p>
            </div>
            <div class="bg-green-50 p-4 rounded">
                <h5 class="font-bold text-green-900 mb-2">✅ --force-with-lease</h5>
                <p class="text-sm text-green-800">Refuse si le remote a changé depuis votre dernier fetch.</p>
            </div>
        </div>

        <div class="mt-4 bg-blue-50 p-4 rounded border-l-4 border-blue-500">
            <p class="text-sm text-blue-800"><strong>💡 Alias recommandé :</strong></p>
            <pre class="bg-blue-100 p-2 rounded text-xs mt-2">$ git config --global alias.pushf "push --force-with-lease"</pre>
        </div>
    </div>
</section>

<!-- ========== CHAPITRE 3 : SÉCURITÉ DES SECRETS ========== -->
<section id="securite-secrets" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 3 : Sécurité des secrets</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">3.1 Pourquoi ne jamais commiter de secrets</h4>
        
        <div class="bg-red-50 p-4 rounded border-l-4 border-red-500 mb-4">
            <p class="text-sm text-red-800"><strong>🚨 Danger critique :</strong> Une fois qu'un secret est dans l'historique Git, il y reste <strong>pour toujours</strong> (même après suppression du fichier). Les bots scannent GitHub en permanence à la recherche de clés API exposées.</p>
        </div>

        <div class="grid md:grid-cols-2 gap-4 mb-4">
            <div class="bg-gray-100 p-4 rounded">
                <h5 class="font-bold text-gray-800 mb-2">🔐 Secrets à ne jamais commiter</h5>
                <ul class="list-disc ml-4 text-sm text-gray-700 space-y-1">
                    <li>Clés API (AWS, Stripe, etc.)</li>
                    <li>Mots de passe de base de données</li>
                    <li>Clés privées SSH/SSL</li>
                    <li>Tokens d'authentification</li>
                    <li>Fichiers <code>.env</code> avec credentials</li>
                </ul>
            </div>
            <div class="bg-gray-100 p-4 rounded">
                <h5 class="font-bold text-gray-800 mb-2">📁 Fichiers souvent dangereux</h5>
                <ul class="list-disc ml-4 text-sm text-gray-700 space-y-1">
                    <li><code>.env</code>, <code>.env.local</code></li>
                    <li><code>config/secrets.yml</code></li>
                    <li><code>*.pem</code>, <code>*.key</code></li>
                    <li><code>credentials.json</code></li>
                    <li><code>service-account.json</code></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">3.2 Le fichier .gitignore</h4>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto mb-4">
# Exemple de .gitignore pour la sécurité
# Fichiers d'environnement
.env
.env.*
!.env.example

# Clés et certificats
*.pem
*.key
*.p12

# Configurations locales sensibles
config/secrets.yml
credentials/

# IDE et OS
.idea/
.vscode/
.DS_Store

# Dépendances (ne pas versionner)
node_modules/
vendor/
__pycache__/</pre>

        <div class="bg-blue-50 p-4 rounded border-l-4 border-blue-500">
            <p class="text-sm text-blue-800"><strong>💡 Astuce :</strong> Utilisez <a href="https://gitignore.io" target="_blank" class="underline">gitignore.io</a> pour générer des .gitignore complets selon vos technologies.</p>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h4 class="text-xl font-bold text-gray-800 mb-4">3.3 Outils de détection de secrets</h4>
        
        <div class="grid md:grid-cols-2 gap-4">
            <div class="bg-purple-50 p-4 rounded">
                <h5 class="font-bold text-purple-900 mb-2">🔍 git-secrets (AWS)</h5>
                <pre class="bg-purple-100 p-2 rounded text-xs overflow-x-auto">
$ git secrets --install
$ git secrets --register-aws
$ git secrets --scan</pre>
            </div>
            <div class="bg-orange-50 p-4 rounded">
                <h5 class="font-bold text-orange-900 mb-2">🔍 gitleaks</h5>
                <pre class="bg-orange-100 p-2 rounded text-xs overflow-x-auto">
$ gitleaks detect --source .
$ gitleaks protect --staged</pre>
            </div>
            <div class="bg-green-50 p-4 rounded">
                <h5 class="font-bold text-green-900 mb-2">🔍 truffleHog</h5>
                <pre class="bg-green-100 p-2 rounded text-xs overflow-x-auto">
$ trufflehog git file://./
$ trufflehog github --repo=...</pre>
            </div>
            <div class="bg-blue-50 p-4 rounded">
                <h5 class="font-bold text-blue-900 mb-2">🔍 GitHub Secret Scanning</h5>
                <p class="text-xs text-blue-800">Automatiquement activé sur les dépôts publics GitHub. Alerte si des secrets connus sont détectés.</p>
            </div>
        </div>
    </div>
</section>

<!-- ========== CHAPITRE 4 : PERFORMANCE ========== -->
<section id="performance-clone" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 4 : Performance (shallow & partial clone)</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">4.1 Le problème des gros dépôts</h4>
        <p class="text-gray-700 mb-4">
            Certains dépôts deviennent énormes avec le temps (historique de 10+ ans, fichiers binaires, assets). Un clone complet peut prendre des gigaoctets et des heures.
        </p>
        
        <div class="bg-gray-100 p-4 rounded">
            <p class="text-sm text-gray-700"><strong>Exemples de gros dépôts :</strong></p>
            <ul class="list-disc ml-4 text-sm text-gray-600 mt-2">
                <li>Linux kernel : ~4 Go, 1M+ commits</li>
                <li>Chromium : ~30 Go</li>
                <li>Android : plusieurs centaines de Go</li>
            </ul>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">4.2 Shallow Clone (--depth)</h4>
        <p class="text-gray-700 mb-4">Clone uniquement les N derniers commits, sans tout l'historique.</p>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto mb-4">
# Cloner seulement le dernier commit
$ git clone --depth 1 https://github.com/user/repo.git

# Cloner les 10 derniers commits
$ git clone --depth 10 https://github.com/user/repo.git

# Récupérer plus d'historique plus tard
$ git fetch --deepen 50        # 50 commits de plus
$ git fetch --unshallow        # Tout l'historique</pre>

        <div class="grid md:grid-cols-2 gap-4">
            <div class="bg-green-50 p-4 rounded">
                <h5 class="font-bold text-green-900 mb-2">✅ Avantages</h5>
                <ul class="list-disc ml-4 text-sm text-green-800 space-y-1">
                    <li>Clone ultra-rapide</li>
                    <li>Économie d'espace disque</li>
                    <li>Idéal pour CI/CD</li>
                </ul>
            </div>
            <div class="bg-red-50 p-4 rounded">
                <h5 class="font-bold text-red-900 mb-2">⚠️ Limitations</h5>
                <ul class="list-disc ml-4 text-sm text-red-800 space-y-1">
                    <li><code>git log</code> limité</li>
                    <li><code>git blame</code> incomplet</li>
                    <li>Certains merges peuvent échouer</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">4.3 Partial Clone (Git 2.22+)</h4>
        <p class="text-gray-700 mb-4">Télécharge les métadonnées mais pas tous les blobs. Les fichiers sont récupérés à la demande.</p>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto mb-4">
# Clone sans les blobs (téléchargés à la demande)
$ git clone --filter=blob:none https://github.com/user/repo.git

# Clone sans les blobs > 1 Mo
$ git clone --filter=blob:limit=1m https://github.com/user/repo.git

# Clone "treeless" (sans les trees historiques)
$ git clone --filter=tree:0 https://github.com/user/repo.git</pre>

        <div class="bg-blue-50 p-4 rounded border-l-4 border-blue-500">
            <p class="text-sm text-blue-800"><strong>💡 Meilleur compromis :</strong> <code>--filter=blob:none</code> donne un clone rapide avec historique complet. Idéal pour le développement sur de gros repos.</p>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h4 class="text-xl font-bold text-gray-800 mb-4">4.4 Single branch clone</h4>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto">
# Cloner une seule branche
$ git clone --single-branch --branch main https://github.com/user/repo.git

# Combiner avec shallow
$ git clone --depth 1 --single-branch --branch main https://repo.git

# Récupérer d'autres branches plus tard
$ git remote set-branches origin '*'
$ git fetch origin</pre>
    </div>
</section>
