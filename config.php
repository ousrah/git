<?php
// Configuration générale du cours
define('COURSE_TITLE', 'Master Class Git : Architecture, Stratégie et Survie');
define('COURSE_AUTHOR', 'F. Rahmouni Oussama');
define('COURSE_LAST_UPDATE', 'Janvier 2026');

// Structure du cours pour générer le sommaire dynamiquement
$course_parts = [
    "Partie 1 : Introduction et Fondamentaux" => [
        ['id' => 'vcs-philosophie', 'title' => "Chapitre 1 : VCS & Philosophie (Centralisé vs Distribué)"],
        ['id' => 'installation-config', 'title' => "Chapitre 2 : Installation & Configuration"]
    ],
    "Partie 2 : Architecture Interne (L'âme de Git)" => [
        ['id' => 'objets-git', 'title' => "Chapitre 1 : Les Objets Git (Blobs, Trees, Commits, Tags)"],
        ['id' => 'dossier-git', 'title' => "Chapitre 2 : Le dossier .git (Index et Références)"],
        ['id' => 'hachage-integrite', 'title' => "Chapitre 3 : Hachage & Intégrité (SHA-1/SHA-256)"]
    ],
    "Partie 3 : Flux Local et Analyse de Différences" => [
        ['id' => 'cycle-vie', 'title' => "Chapitre 1 : Cycle de vie des fichiers"],
        ['id' => 'maitrise-diff', 'title' => "Chapitre 2 : Maîtrise de git diff"],
        ['id' => 'patchs', 'title' => "Chapitre 3 : Patchs (git apply, git format-patch)"]
    ],
    "Partie 4 : Navigation, Branches et États Complexes" => [
        ['id' => 'branches', 'title' => "Chapitre 1 : Les Branches (Création, Fusion, Suppression)"],
        ['id' => 'detached-head', 'title' => "Chapitre 2 : L'état Detached HEAD"],
        ['id' => 'cherry-pick', 'title' => "Chapitre 3 : Le Cherry-pick"],
        ['id' => 'tags-semver', 'title' => "Chapitre 4 : Versioning (Tags et SemVer)"]
    ],
    "Partie 5 : Collaboration et Sécurité" => [
        ['id' => 'protocoles-remotes', 'title' => "Chapitre 1 : Protocoles & Remotes (SSH vs HTTPS)"],
        ['id' => 'force-push', 'title' => "Chapitre 2 : Le Force Push"],
        ['id' => 'securite-secrets', 'title' => "Chapitre 3 : Sécurité des secrets"],
        ['id' => 'performance-clone', 'title' => "Chapitre 4 : Performance (shallow & partial clone)"]
    ],
    "Partie 6 : La Boîte à Outils Sauvetage" => [
        ['id' => 'annulation', 'title' => "Chapitre 1 : Annulation (amend, reset, revert, restore)"],
        ['id' => 'stash', 'title' => "Chapitre 2 : Le Stash"],
        ['id' => 'reflog', 'title' => "Chapitre 3 : Le Reflog"]
    ],
    "Partie 7 : Conflits et Maintenance Avancée" => [
        ['id' => 'strategies-merge', 'title' => "Chapitre 1 : Stratégies de Merge"],
        ['id' => 'conflits-rebase', 'title' => "Chapitre 2 : Conflits de Rebase"],
        ['id' => 'rerere', 'title' => "Chapitre 3 : Git Rerere"],
        ['id' => 'maintenance', 'title' => "Chapitre 4 : Maintenance (clean, gc)"]
    ],
    "Partie 8 : Investigation et Debugging" => [
        ['id' => 'git-blame', 'title' => "Chapitre 1 : Git Blame"],
        ['id' => 'git-bisect', 'title' => "Chapitre 2 : Git Bisect"],
        ['id' => 'git-grep', 'title' => "Chapitre 3 : Git Grep"]
    ],
    "Partie 9 : Architecture de Projet et Industrialisation" => [
        ['id' => 'submodules-subtrees', 'title' => "Chapitre 1 : Submodules vs Subtrees"],
        ['id' => 'workflows', 'title' => "Chapitre 2 : Workflows Industriels"],
        ['id' => 'mono-multi-repo', 'title' => "Chapitre 3 : Mono-repo vs Multi-repo"],
        ['id' => 'outils-pro', 'title' => "Chapitre 4 : Outils Pro (worktrees, archive, notes)"]
    ],
    "Partie 10 : Cas Réels et Disaster Recovery" => [
        ['id' => 'repo-en-feu', 'title' => "Chapitre 1 : Scénario Repo en feu"],
        ['id' => 'nettoyage-historique', 'title' => "Chapitre 2 : Nettoyage d'historique"],
        ['id' => 'hooks', 'title' => "Chapitre 3 : Automatisation (Hooks)"],
        ['id' => 'signatures-gpg', 'title' => "Chapitre 4 : Signatures GPG"]
    ]
];
?>
