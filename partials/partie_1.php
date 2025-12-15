<!-- =================================================================== -->
<!-- PARTIE 1 : CONCEPTS DE BASE ET DÉFINITIONS -->
<!-- =================================================================== -->
<h2 class="text-3xl font-bold text-gray-800 border-b-2 border-gray-200 pb-2 mb-6">Partie 1 : Concepts de Base et Définitions</h2>

<!-- ========== CHAPITRE 1 : INTRODUCTION ========== -->
<section id="concepts-base" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 1 : Introduction à la Gestion de Projet et MS Project</h3>
            <img src = "img/logo.webp" alt = "logo MS Project" class = "m-auto w-48 zoomable" />
  
    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">1.1 Pourquoi utiliser un logiciel de gestion de projet ?</h4>
        <p class="text-gray-700 mb-4 text-justify">
            La gestion de projet implique de jongler avec de nombreuses variables : tâches, ressources, délais, coûts. Un outil comme <strong>Microsoft Project</strong> permet de :
        </p>
        <ul class="list-disc ml-6 text-gray-700 space-y-1">
            <li><strong>Planifier</strong> efficacement les tâches et les délais.</li>
            <li><strong>Gérer les ressources</strong> (humaines, matérielles) et éviter les surcharges.</li>
            <li><strong>Suivre l'avancement</strong> en temps réel par rapport aux prévisions.</li>
            <li><strong>Analyser les coûts</strong> et maîtriser le budget.</li>
            <li><strong>Communiquer</strong> grâce à des rapports clairs.</li>
        </ul>
    </div>

    <div>
        <iframe width="944" height="531" src="https://www.youtube.com/embed/rM1nsMpaMlE" title="Comment utiliser l&#39;essentiel de MS Project" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            
</div>

</section>

<!-- ========== CHAPITRE 2 : GANTT ET PERT ========== -->
<section id="gantt-pert" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 2 : Diagramme de Gantt et PERT</h3>

    <div class="grid md:grid-cols-1 gap-8">
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <h4 class="text-xl font-bold text-gray-800 mb-2">2.1 Le Diagramme de Gantt</h4>
            
                <img src = "img/gantt.png" alt = "Menu MS Project" class = "m-auto w-full zoomable" />
  
            
            <p class="text-gray-700 mb-4">
                C'est l'outil de visualisation le plus populaire. Il représente les tâches sous forme de barres horizontales sur un calendrier.
            </p>
            <ul class="list-disc ml-6 text-gray-700 space-y-1 mb-4">
                <li><strong>Axe horizontal :</strong> Le temps (Jours, Semaines, Mois).</li>
                <li><strong>Axe vertical :</strong> La liste des tâches.</li>
                <li><strong>Barres :</strong> La longueur représente la durée de la tâche.</li>
                <li><strong>Liens :</strong> Les flèches montrent les dépendances entre les tâches.</li>
            </ul>
            <div class="bg-blue-50 p-4 rounded border-l-4 border-blue-500">
                <p class="text-sm text-blue-800"><strong>Utilité :</strong> Idéal pour visualiser le planning, l'avancement et les chevauchements de tâches.</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <h4 class="text-xl font-bold text-gray-800 mb-2">2.2 Le Diagramme de PERT (Réseau de tâches)</h4>
           
                   <img src = "img/pert7.png" alt = "Menu MS Project" class = "m-auto zoomable" />
  
            <p class="text-gray-700 mb-4">
                Le PERT (Program Evaluation and Review Technique) se concentre sur les <strong>relations logiques</strong> entre les tâches plutôt que sur le calendrier.
            </p>
            <p class="text-gray-700 mb-4">
                Il permet de mettre en évidence le <strong>Chemin Critique</strong> : la séquence de tâches qui détermine la durée totale du projet. Tout retard sur une tâche critique retarde la fin du projet.
            </p>
        </div>
    </div>
</section>

<!-- ========== CHAPITRE 3 : CALCULS DATES ========== -->
<section id="calculs-dates" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 3 : Méthodes de calcul (Dates et Marges)</h3>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">3.1 Dates au Plus Tôt et au Plus Tard</h4>
        <p class="text-gray-700 mb-4">MS Project calcule automatiquement ces dates pour chaque tâche :</p>
        <div class="grid md:grid-cols-2 gap-6">
            <div class="bg-green-50 p-4 rounded">
                <h5 class="font-bold text-green-900 border-b pb-2 mb-2">Dates au Plus Tôt (Early Dates)</h5>
                <p class="text-sm text-green-800">La date la plus proche à laquelle une tâche peut commencer (Début au plus tôt) et finir (Fin au plus tôt), compte tenu de ses prédécesseurs.</p>
            </div>
            <div class="bg-red-50 p-4 rounded">
                <h5 class="font-bold text-red-900 border-b pb-2 mb-2">Dates au Plus Tard (Late Dates)</h5>
                <p class="text-sm text-red-800">La date limite à laquelle une tâche doit commencer ou finir pour ne pas retarder la fin du projet.</p>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h4 class="text-xl font-bold text-gray-800 mb-4">3.2 La Marge (Slack / Float)</h4>
        <p class="text-gray-700 mb-4">C'est la flexibilité dont on dispose pour planifier une tâche.</p>
        <ul class="list-disc ml-6 text-gray-700 space-y-2">
            <li><strong>Marge Libre :</strong> Retard possible sans impacter le début des successeurs immédiats.</li>
            <li><strong>Marge Totale :</strong> Retard possible sans impacter la date de fin du projet.</li>
        </ul>
        <div class="mt-4 bg-yellow-50 p-3 rounded text-sm text-yellow-800 font-semibold">
            Une tâche avec une Marge Totale = 0 est une Tâche Critique.
        </div>
    </div>
</section>

<!-- ========== CHAPITRE 4 : COUTS ========== -->
<section id="gestion-couts" class="mb-16">
    <h3 class="text-2xl font-semibold mb-4 text-blue-800">Chapitre 4 : Gestion des Coûts (Concepts)</h3>
    <p class="text-gray-700 mb-4">MS Project permet de gérer trois types de coûts :</p>
    <div class="grid md:grid-cols-3 gap-4">
        <div class="bg-white p-4 rounded shadow-sm border">
            <h5 class="font-bold text-gray-800">Coûts Fixes</h5>
            <p class="text-sm text-gray-600">Montant forfaitaire pour une tâche, indépendant de la durée ou des ressources (ex: achat d'une licence logicielle).</p>
        </div>
        <div class="bg-white p-4 rounded shadow-sm border">
            <h5 class="font-bold text-gray-800">Coûts liés aux Ressources</h5>
            <p class="text-sm text-gray-600">Calculés selon un taux horaire (Travail) ou un coût unitaire (Matériel). Ex: 50 MAD/heure * 10h = 500 MAD.</p>
        </div>
        <div class="bg-white p-4 rounded shadow-sm border">
            <h5 class="font-bold text-gray-800">Coût Total</h5>
            <p class="text-sm text-gray-600">Somme des coûts fixes et des coûts des ressources affectées.</p>
        </div>
    </div>
</section>
