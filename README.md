# Task Manager - Backend (Laravel API)

## 📌 Description

Ce projet est une API REST en Laravel pour la gestion des tâches. Il permet :
    - L'authentification des utilisateurs (Sanctum)
    - La gestion des tâches (CRUD)

## 🛠️ Installation

1. Cloner le projet :
   git clone https://github.com/jeffred1253/backend-tasks.git
   cd task-manager-laravel
2. Installer les dépendances :
    composer install
3. Configurer l'environnement :
    cp .env.example .env
    php artisan key:generate
4. Configurer la base de données dans .env puis exécuter :
    php artisan migrate
5. Lancer le serveur :
    php artisan serve

## 📡 Endpoints de l'API

    POST    /api/login : Connexion
    POST    /api/register : Inscription
    POST    /api/logout : Déconnection
    GET     /api/user : Utilisateur connecté
    POST    /api/addTask : Ajout d'une tâche
    POST    /api/updateTask/{taskId} : Mise à jour de la tâche dont l'id est "taskId"
    GET     /api/myTasks : Liste des tâches de l'utilisateur connecté
    DELETE  /api/remove/{taskId} : Suppression de la tâche avec l'id "taskId"
    GET     /api/stats : Liste des valeurs de statistique des tâches de l'utilisateur connecté