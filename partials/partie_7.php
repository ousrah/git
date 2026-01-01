<!-- =================================================================== -->
<!-- PARTIE 7 : COLLABORATION EXPERT & CONFLITS -->
<!-- =================================================================== -->
<h2 class="text-3xl font-bold text-gray-800 border-b-2 border-gray-200 pb-2 mb-6">Partie 7 : Collaboration Expert & Conflits</h2>

<!-- ========== CHAPITRE 1 : BARE & REMOTES ========== -->
<section id="bare-remote" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 1 : Architecture Serveur (Bare & Remotes)</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">1.1 Qu'est-ce qu'un serveur Git ? (Bare Repo)</h4>
        <p class="text-gray-700 mb-4">
            Avant de parler de GitHub ou GitLab, comprenez ceci : pour qu'un dépôt serve de "Serveur Central" où tout le monde pousse son code, il <strong>ne doit pas avoir de dossier de travail (Working Directory)</strong>.
        </p>
        <p class="text-gray-700 mb-4">
            Pourquoi ? Si je pousse mon code sur un serveur qui a des fichiers ouverts, je risque de corrompre le travail en cours sur le serveur.
            C'est pour cela qu'on utilise <code>--bare</code>.
        </p>
        
        <div class="bg-gray-800 text-gray-300 p-4 rounded text-sm font-mono mb-4">
            <p class="text-gray-500"># Créer un dépôt "Nu" (Juste la base de données Git, pas de fichiers visibles)</p>
            <p>$ git init --bare mon-projet-serveur.git</p>
        </div>
        
        <div class="bg-blue-50 p-4 rounded border-l-4 border-blue-500">
            <p class="text-blue-900 font-bold">Le Secret :</p>
            <p class="text-sm text-blue-800">GitHub, GitLab ou Bitbucket ne sont rien d'autres que des collections de dépôts "Bare" avec une interface web par dessus.</p>
        </div>
    </div>
</section>

<!-- ========== CHAPITRE 2 : FLOW AVANCE REBASE ========== -->
<section id="push-pull-rebase" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 2 : Synchro & Rebase</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">2.1 Pull vs Fetch</h4>
        <p class="text-gray-700 mb-4">
            La commande <code>git pull</code> est magique, parfois trop. Il est crucial de savoir ce qu'elle fait réellement.
        </p>
        <ul class="list-disc ml-6 text-gray-700 space-y-2 mb-4">
            <li><strong>git fetch</strong> : Va chercher les infos sur le serveur (met à jour <code>origin/main</code>) mais <strong>NE TOUCHE PAS</strong> à vos fichiers de travail. C'est sans danger.</li>
            <li><strong>git merge</strong> : Fusionne <code>origin/main</code> dans votre branche actuelle.</li>
        </ul>
        <div class="bg-yellow-100 p-2 rounded text-center font-bold text-yellow-800 border border-yellow-300">
            git pull = git fetch + git merge
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">2.2 L'élégance du Rebase</h4>
        <p class="text-gray-700 mb-4">
            Imaginez : Vous avez fait 3 commits en local. Pendant ce temps, un collègue a poussé 2 commits sur le serveur.
            Si vous faites un <code>git pull</code> (donc un merge), Git va créer un "Commit de Fusion" moche qui entremêle tout.
        </p>
        <p class="text-gray-700 mb-4">
            <strong>La solution propre : Le Rebase.</strong>
            Git va :
            1. Mettre vos 3 commits de côté (dans une poche temporaire).
            2. Mettre à jour votre projet avec le code du serveur.
            3. Ré-appliquer vos 3 commits <strong>par dessus</strong> le nouveau code.
        </p>
        
        <div class="bg-gray-800 text-gray-300 p-4 rounded text-sm font-mono mb-4">
            <p class="text-gray-500"># Je récupère le travail des autres et je me place À LA SUITE</p>
            <p>$ git pull --rebase origin main</p>
        </div>
        
        <p class="text-sm text-green-600 font-bold">Résultat : Un historique parfaitement linéaire, comme si vous aviez commencé à travailler après vos collègues.</p>
    </div>
</section>

<!-- ========== CHAPITRE 3 : CONFLITS EXPERT ========== -->
<section id="advanced-conflicts" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-purple-800">Chapitre 3 : Gestion de Conflits Expert</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">3.1 Choisir son Camp (Ours vs Theirs)</h4>
        <p class="text-gray-700 mb-4">
            Parfois, vous ne voulez pas déchiffrer les chevrons <code>&lt;&lt;&lt;</code> et <code>&gt;&gt;&gt;</code>. Vous savez que vous voulez juste "MA version" ou "LEUR version".
        </p>
        
        <div class="grid md:grid-cols-2 gap-6">
            <div class="bg-blue-50 p-4 rounded">
                <h5 class="font-bold text-blue-900 mb-2">Gardez NOTRE version</h5>
                <p class="text-xs text-gray-600 mb-2">J'écrase ce qui vient d'arriver.</p>
                <code class="bg-white px-2 py-1 rounded border text-xs block mb-1">$ git checkout --ours fichier.css</code>
                <code class="bg-white px-2 py-1 rounded border text-xs block">$ git add fichier.css</code>
            </div>
            
            <div class="bg-indigo-50 p-4 rounded">
                <h5 class="font-bold text-indigo-900 mb-2">Prendre LEUR version</h5>
                <p class="text-xs text-gray-600 mb-2">J'accepte leur code à 100%.</p>
                <code class="bg-white px-2 py-1 rounded border text-xs block mb-1">$ git checkout --theirs fichier.css</code>
                <code class="bg-white px-2 py-1 rounded border text-xs block">$ git add fichier.css</code>
            </div>
        </div>
    </div>

    <div class="bg-purple-50 p-6 rounded-lg border border-purple-200">
        <h4 class="text-xl font-bold text-purple-900 mb-4">3.2 Git Rerere (Reuse Recorded Resolution)</h4>
        <p class="text-purple-800 mb-4">
            C'est le super-pouvoir caché de Git. Si vous résolvez un conflit complexe lors d'un gros merge, et que vous devez refaire ce merge plus tard (ex: lors d'un rebase annulé), Rerere s'en souvient.
        </p>
        <p class="text-purple-800 mb-4 text-sm">
            Il enregistre votre résolution manuelle ("empreinte digitale du conflit") et l'applique <strong>automatiquement</strong> la prochaine fois qu'il voit exactement le même conflit.
        </p>
        
        <div class="bg-gray-800 text-white p-4 rounded text-xs font-mono">
            <p class="text-gray-500"># Activer le super-pouvoir</p>
            <p>$ git config --global rerere.enabled true</p>
        </div>
        <p class="text-xs text-purple-700 mt-2">Désormais, Git vous dira : <em>"Resolved 'index.html' using previous resolution."</em></p>
    </div>
</section>
