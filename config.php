<?php
// Configuration générale du cours
define('COURSE_TITLE', 'Master Class Git : Architecture, Stratégie et Survie');
define('COURSE_AUTHOR', 'F. Rahmouni Oussama');
define('COURSE_LAST_UPDATE', 'Janvier 2026');

// Structure du cours pour générer le sommaire dynamiquement
$course_parts = [
    "Partie 1 : Introduction et Fondamentaux (Vulgarisé)" => [
        ['id' => 'probleme-solution', 'title' => "Chapitre 1 : Le problème (Pourquoi Git ?)"],
        ['id' => 'vcs-definition', 'title' => "Chapitre 2 : Git, c'est quoi ? (Définitions simples)"],
        ['id' => 'installation-ecosysteme', 'title' => "Chapitre 3 : Installation et les Géants (GitHub, GitLab...)"]
    ],
    "Partie 2 : Initialisation et Fonctionnement (Vulgarisé)" => [
        ['id' => 'git-init', 'title' => "Chapitre 1 : Créer son premier dépôt (git init)"],
        ['id' => 'comment-ca-marche', 'title' => "Chapitre 2 : Comment ça marche ? (La boîte noire .git)"],
        ['id' => 'integrite-simplifiee', 'title' => "Chapitre 3 : Pourquoi Git ne perd rien (Intégrité)"]
    ],
    "Partie 3 : Les Bases du Travail (Add, Commit, Ignore)" => [
        ['id' => 'concepts-etats', 'title' => "Chapitre 1 : Concepts & États (Untracked, Staged...)"],
        ['id' => 'add-gitignore', 'title' => "Chapitre 2 : Ajouter (Add) et Ignorer (.gitignore)"],
        ['id' => 'status-commit', 'title' => "Chapitre 3 : Vérifier (Status) et Valider (Commit)"]
    ],
    "Partie 4 : Exploration et Voyage (Log, Diff, Checkout)" => [
        ['id' => 'git-log', 'title' => "Chapitre 1 : Lire l'histoire (git log)"],
        ['id' => 'git-diff-detail', 'title' => "Chapitre 2 : Inspecter les changements (git diff)"],
        ['id' => 'git-checkout', 'title' => "Chapitre 3 : Voyager dans le temps (git checkout)"]
    ],
    "Partie 5 : Annuler et Réparer (Revert, Reset, Restore)" => [
        ['id' => 'git-amend', 'title' => "Chapitre 1 : Oups ! Petite correction (git commit --amend)"],
        ['id' => 'git-revert', 'title' => "Chapitre 2 : Annuler proprement (git revert)"],
        ['id' => 'git-reset', 'title' => "Chapitre 3 : La chirurgie de l'historique (git reset)"],
        ['id' => 'git-restore', 'title' => "Chapitre 4 : Restaurer sans danger (git restore)"]
    ],
    "Partie 6 : Travailler en Parallèle (Théorie, Commandes & Pratique)" => [
        ['id' => 'theorie-branches', 'title' => "Chapitre 1 : Comprendre les Branches & Ungit"],
        ['id' => 'commandes-base', 'title' => "Chapitre 2 : Les Commandes Essentielles (Switch, Merge)"],
        ['id' => 'projet-start', 'title' => "Chapitre 3 : 🏆 Projet 'TechStore' : Pratique & Conflits"],
        ['id' => 'master-stash', 'title' => "Chapitre 4 : La Maîtrise du Stash (Expert)"]
    ],
    "Partie 7 : Collaboration Expert & Conflits Avancés" => [
        ['id' => 'bare-remote', 'title' => "Chapitre 1 : Architecture Serveur (Bare & Remotes)"],
        ['id' => 'push-pull-rebase', 'title' => "Chapitre 2 : Synchro & Rebase (Push, Pull --rebase)"],
        ['id' => 'advanced-conflicts', 'title' => "Chapitre 3 : Gestion de Conflits Expert (Ours, Theirs, Rere)"]
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
