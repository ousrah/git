<!-- =================================================================== -->
<!-- PARTIE 2 : ARCHITECTURE INTERNE (L'ÂME DE GIT) -->
<!-- =================================================================== -->
<h2 class="text-3xl font-bold text-gray-800 border-b-2 border-gray-200 pb-2 mb-6">Partie 2 : Architecture Interne (L'âme de Git)</h2>

<!-- ========== CHAPITRE 1 : LES OBJETS GIT ========== -->
<section id="objets-git" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 1 : Les Objets Git (Blobs, Trees, Commits, Tags)</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">1.1 Le modèle objet de Git</h4>
        <p class="text-gray-700 mb-4 text-justify">
            Git est fondamentalement une <strong>base de données clé-valeur adressée par contenu</strong>. Tout dans Git est stocké sous forme d'objets identifiés par leur hash SHA-1 (40 caractères hexadécimaux).
        </p>
        
        <div class="bg-purple-50 p-4 rounded border-l-4 border-purple-500 mb-4">
            <p class="text-sm text-purple-800"><strong>Principe fondamental :</strong> Le même contenu produit toujours le même hash. Deux fichiers identiques = un seul objet blob stocké.</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-blue-50 p-4 rounded border-t-4 border-blue-500">
                <h5 class="font-bold text-blue-900 mb-2">📄 Blob</h5>
                <p class="text-sm text-blue-800">Contenu brut d'un fichier (sans nom ni métadonnées). Un blob = une version d'un fichier.</p>
            </div>
            <div class="bg-green-50 p-4 rounded border-t-4 border-green-500">
                <h5 class="font-bold text-green-900 mb-2">Tree</h5>
                <p class="text-sm text-green-800">Représente un répertoire. Contient des références vers des blobs (fichiers) et d'autres trees (sous-dossiers).</p>
            </div>
            <div class="bg-orange-50 p-4 rounded border-t-4 border-orange-500">
                <h5 class="font-bold text-orange-900 mb-2">Commit</h5>
                <p class="text-sm text-orange-800">Pointe vers un tree (snapshot) + métadonnées (auteur, date, message, parent(s)).</p>
            </div>
            <div class="bg-red-50 p-4 rounded border-t-4 border-red-500">
                <h5 class="font-bold text-red-900 mb-2">Tag</h5>
                <p class="text-sm text-red-800">Référence nommée vers un commit, généralement utilisé pour marquer les releases.</p>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">1.2 Explorer les objets avec les commandes plumbing</h4>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto mb-4">
# Voir le type d'un objet
$ git cat-file -t abc1234
commit

# Voir le contenu d'un objet
$ git cat-file -p abc1234
tree 9f83d7b2c...
parent 5a2e8c1...
author Oussama <o@mail.com> 1704067200 +0100
committer Oussama <o@mail.com> 1704067200 +0100

Message du commit

# Voir la taille d'un objet
$ git cat-file -s abc1234
245</pre>

        <div class="bg-gray-100 p-4 rounded">
            <h5 class="font-bold text-gray-800 mb-2">🔍 Exemple pratique : Anatomie d'un commit</h5>
            <pre class="bg-gray-800 text-green-400 p-3 rounded text-sm overflow-x-auto">
$ git cat-file -p HEAD
tree 4b825dc642cb6eb9a060e54bf8d69288fbee4904
parent a1b2c3d4e5f6g7h8i9j0k1l2m3n4o5p6q7r8s9t0
author F. Rahmouni Oussama <ousrah@gmail.com> 1704067200 +0100
committer F. Rahmouni Oussama <ousrah@gmail.com> 1704067200 +0100

feat: Ajout du système d'authentification</pre>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h4 class="text-xl font-bold text-gray-800 mb-4">1.3 Tags légers vs Tags annotés</h4>
        
        <div class="grid md:grid-cols-2 gap-6">
            <div class="bg-gray-50 p-4 rounded">
                <h5 class="font-bold text-gray-900 mb-2">🏷️ Tag léger (lightweight)</h5>
                <p class="text-sm text-gray-700 mb-2">Simple pointeur vers un commit. Pas d'objet tag créé.</p>
                <pre class="bg-gray-800 text-green-400 p-2 rounded text-xs overflow-x-auto">
$ git tag v1.0.0
# Crée juste une référence dans .git/refs/tags/</pre>
            </div>
            <div class="bg-yellow-50 p-4 rounded">
                <h5 class="font-bold text-yellow-900 mb-2">🏷️ Tag annoté (recommandé)</h5>
                <p class="text-sm text-yellow-800 mb-2">Objet complet avec message, auteur, date et signature possible.</p>
                <pre class="bg-gray-800 text-green-400 p-2 rounded text-xs overflow-x-auto">
$ git tag -a v1.0.0 -m "Release stable 1.0"
# Crée un objet tag + une référence</pre>
            </div>
        </div>

        <div class="mt-4 bg-blue-50 p-4 rounded border-l-4 border-blue-500">
            <p class="text-sm text-blue-800"><strong>✅ Bonne pratique :</strong> Utilisez toujours des tags annotés pour les releases. Ils peuvent être signés avec GPG et contiennent des métadonnées traçables.</p>
        </div>
    </div>
</section>

<!-- ========== CHAPITRE 2 : LE DOSSIER .GIT ========== -->
<section id="dossier-git" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 2 : Le dossier .git (Index et Références)</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">2.1 Anatomie du dossier .git</h4>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto mb-4">
.git/
├── HEAD              # Pointeur vers la branche/commit actuel
├── config            # Configuration locale du dépôt
├── description       # Description (utilisé par GitWeb)
├── index             # La staging area (zone de préparation)
├── hooks/            # Scripts automatiques (pre-commit, etc.)
├── info/
│   └── exclude       # Patterns à ignorer (local, sans .gitignore)
├── objects/          # Base de données des objets Git
│   ├── pack/         # Objets compressés (packfiles)
│   └── [xx]/[...]    # Objets individuels (2 premiers chars = dossier)
├── refs/
│   ├── heads/        # Branches locales
│   ├── tags/         # Tags
│   └── remotes/      # Branches distantes (origin/main, etc.)
└── logs/             # Historique des références (reflog)</pre>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">2.2 HEAD : Le pointeur magique</h4>
        <p class="text-gray-700 mb-4">
            <code class="bg-gray-100 px-2 py-1 rounded">HEAD</code> est un pointeur symbolique qui indique où vous êtes actuellement dans l'historique.
        </p>
        
        <div class="grid md:grid-cols-2 gap-4 mb-4">
            <div class="bg-green-50 p-4 rounded">
                <h5 class="font-bold text-green-900 mb-2">État normal</h5>
                <pre class="bg-gray-800 text-green-400 p-2 rounded text-xs">
$ cat .git/HEAD
ref: refs/heads/main

# HEAD pointe vers une branche</pre>
            </div>
            <div class="bg-red-50 p-4 rounded">
                <h5 class="font-bold text-red-900 mb-2">Detached HEAD</h5>
                <pre class="bg-gray-800 text-green-400 p-2 rounded text-xs">
$ cat .git/HEAD
a1b2c3d4e5f6g7h8i9j0k1l2m3n4o5p

# HEAD pointe directement vers un commit</pre>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">2.3 L'Index (Staging Area)</h4>
        <p class="text-gray-700 mb-4">
            L'index est un fichier binaire (<code>.git/index</code>) qui représente le prochain commit que vous allez créer. C'est une "zone de préparation" entre votre working directory et l'historique.
        </p>
        
        <div class="bg-blue-50 p-4 rounded border-l-4 border-blue-500 mb-4">
            <p class="text-sm text-blue-800"><strong>💡 Les 3 états d'un fichier :</strong></p>
            <ol class="list-decimal ml-4 text-sm text-blue-800 mt-2 space-y-1">
                <li><strong>Working Directory</strong> : Vos fichiers modifiés localement</li>
                <li><strong>Staging Area (Index)</strong> : Modifications prêtes pour le prochain commit</li>
                <li><strong>Repository</strong> : L'historique des commits (.git/objects)</li>
            </ol>
        </div>

        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto">
# Voir le contenu de l'index
$ git ls-files -s
100644 e69de29bb2d1d6434b8b29ae775ad8c2e48c5391 0	README.md
100644 8baef1b4abc74f56a91f1e8a9875c5e2e7b09c73 0	src/app.js

# Format: mode | hash du blob | stage | chemin</pre>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h4 class="text-xl font-bold text-gray-800 mb-4">2.4 Les Références (refs)</h4>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto mb-4">
# Voir toutes les références
$ git show-ref
a1b2c3d4... refs/heads/main
e5f6g7h8... refs/heads/feature/login
i9j0k1l2... refs/remotes/origin/main
m3n4o5p6... refs/tags/v1.0.0

# Une branche = un fichier contenant un hash de commit
$ cat .git/refs/heads/main
a1b2c3d4e5f6g7h8i9j0k1l2m3n4o5p6q7r8s9t0</pre>

        <div class="bg-yellow-50 p-4 rounded border-l-4 border-yellow-500">
            <p class="text-sm text-yellow-800"><strong>⚡ Pourquoi les branches sont légères dans Git :</strong> Une branche n'est qu'un fichier texte de 41 octets (40 caractères hex + newline) pointant vers un commit. Créer ou supprimer une branche est instantané !</p>
        </div>
    </div>
</section>

<!-- ========== CHAPITRE 3 : HACHAGE & INTÉGRITÉ ========== -->
<section id="hachage-integrite" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 3 : Hachage & Intégrité (SHA-1/SHA-256)</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">3.1 Le rôle du SHA-1</h4>
        <p class="text-gray-700 mb-4">
            Chaque objet Git est identifié par un hash SHA-1 de 160 bits (40 caractères hex), calculé à partir de son contenu + type + taille.
        </p>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto mb-4">
# Comment Git calcule le hash d'un blob
$ echo -n "blob 13\0Hello World!\n" | sha1sum
8ab686eafeb1f44702738c8b0f24f2567c36da6d

# Équivalent avec git hash-object
$ echo "Hello World!" | git hash-object --stdin
8ab686eafeb1f44702738c8b0f24f2567c36da6d</pre>

        <div class="grid md:grid-cols-2 gap-4">
            <div class="bg-green-50 p-4 rounded">
                <h5 class="font-bold text-green-900 mb-2">✅ Garanties d'intégrité</h5>
                <ul class="list-disc ml-4 text-sm text-green-800 space-y-1">
                    <li>Toute modification change le hash</li>
                    <li>Impossible de falsifier l'historique sans recalculer tous les hashs suivants</li>
                    <li>Vérification automatique à chaque clone/fetch</li>
                </ul>
            </div>
            <div class="bg-orange-50 p-4 rounded">
                <h5 class="font-bold text-orange-900 mb-2">⚠️ Collision théorique</h5>
                <p class="text-sm text-orange-800">Avec 2^160 possibilités, la probabilité de collision est astronomiquement faible. Mais des attaques de collision SHA-1 existent (SHAttered, 2017).</p>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">3.2 Transition vers SHA-256</h4>
        <p class="text-gray-700 mb-4">
            Git prépare une transition vers SHA-256 pour renforcer la sécurité cryptographique. Depuis Git 2.29 (2020), le support expérimental est disponible.
        </p>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto mb-4">
# Créer un nouveau dépôt avec SHA-256 (expérimental)
$ git init --object-format=sha256

# Vérifier le format d'objet
$ git config core.repositoryFormatVersion</pre>

        <div class="bg-purple-50 p-4 rounded border-l-4 border-purple-500">
            <p class="text-sm text-purple-800"><strong>🔮 Avenir :</strong> SHA-256 offre 256 bits (vs 160 pour SHA-1), rendant les attaques par collision pratiquement impossibles avec la technologie actuelle. La migration complète sera progressive pour assurer la compatibilité.</p>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h4 class="text-xl font-bold text-gray-800 mb-4">3.3 Vérification de l'intégrité</h4>
        
        <pre class="bg-gray-800 text-green-400 p-4 rounded text-sm overflow-x-auto mb-4">
# Vérifier l'intégrité complète du dépôt
$ git fsck
Checking object directories: 100% (256/256), done.
Checking objects: 100% (1234/1234), done.

# Vérifier avec plus de détails
$ git fsck --full --strict

# Vérifier la connectivité des références
$ git fsck --connectivity-only</pre>

        <div class="bg-red-50 p-4 rounded border-l-4 border-red-500">
            <p class="text-sm text-red-800"><strong>🚨 Si fsck détecte des erreurs :</strong> Des objets corrompus ou manquants peuvent indiquer un problème de disque, une interruption pendant une opération, ou une manipulation malveillante. Consultez le chapitre sur le Disaster Recovery.</p>
        </div>
    </div>
</section>
