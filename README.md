# Projet Gestion de Plannings pour une Formation

Ce projet vise à créer un site web permettant de gérer les plannings au sein d'une formation. Le site s'adresse à trois acteurs principaux : les étudiants, les enseignants et les administrateurs.

## Objectifs

### Pour les Étudiants

1. **Voir la liste des cours de la formation :**
   - Afficher les cours disponibles dans la formation.

2. **Gestion des inscriptions :**
   - Inscription dans un cours.
   - Désinscription d'un cours.
   - Liste des cours auxquels l'étudiant est inscrit.
   - Rechercher un cours dans la liste des cours de la formation.

3. **Affichage du planning personnalisé :**
   - Planning intégral.
   - Planning par cours.
   - Planning par semaine.

### Pour les Enseignants

1. **Voir la liste des cours dont on est responsable :**
   - Afficher les cours pour lesquels l'enseignant est responsable.

2. **Voir le planning personnalisé :**
   - Planning intégral.
   - Planning par cours.
   - Planning par semaine.

3. **Gestion du planning :**
   - Création d'une nouvelle séance de cours.
   - Mise à jour d'une séance de cours.
   - Suppression d'une séance de cours.
   - Utiliser 2 vues différentes pour les opérations ci-dessus (par cours et par semaine).

### Pour l'Utilisateur (Étudiant ou Enseignant)

1. **Gestion du compte :**
   - Création du compte.
   - Changement de son mot de passe.
   - Modification du nom/prénom.

### Pour l'Administrateur

1. **Gestion des utilisateurs :**
   - Liste intégrale.
   - Filtrer par type (étudiant/enseignant).
   - Recherche par nom/prénom/login.
   - Acceptation (ou refus) d'un utilisateur qui a été auto-créé.
   - Association d'un enseignant à un cours.
   - Création d'un utilisateur.
   - Modification d'un utilisateur (y compris le type).
   - Suppression d'un utilisateur.

2. **Gestion des cours :**
   - Liste.
   - Recherche par intitulé.
   - Création d'un cours.
   - Modification d'un cours.
   - Suppression d'un cours.
   - Association d'un enseignant à un cours.
   - Liste des cours par enseignant.

3. **Gestion des formations :**
   - Liste.
   - Ajout d'une formation.
   - Modification d'une formation.
   - Suppression d'une formation.

4. **Gestion des plannings :**
   - Toutes les opérations du point 2.3, mais pour n'importe quel enseignant.

## Instructions d'Exécution des Tâches

Il est impératif de suivre l'ordre d'exécution des tâches pour assurer une mise en place correcte du projet. Les étapes clés sont les suivantes :

1. **Configuration de l'Environnement :**
   - Assurez-vous d'avoir PHP installé sur votre serveur.
   - Installez Composer (https://getcomposer.org/) pour gérer les dépendances PHP.
   - Configurez une base de données MySQL.

2. **Clonage du Projet :**
   ```bash
   git clone https://github.com/votre-utilisateur/gestion-plannings.git
   cd gestion-plannings
   ```

3. **Installation des Dépendances :**
   ```bash
   composer install
   ```

4. **Configuration de l'Environnement Laravel :**
   - Copiez le fichier `.env.example` en tant que `.env` et configurez les paramètres de la base de données.

5. **Génération de la Clé d'Application Laravel :**
   ```bash
   php artisan key:generate
   ```

6. **Exécution des Migrations et des Seeders :**
   ```bash
   php artisan migrate --seed
   ```

7. **Lancement du Serveur de Développement :**
   ```bash
   php artisan serve
   ```

8. **Accès au Site :**
   - Ouvrez votre navigateur et accédez à http://localhost:8000 (ou le port spécifié).

9. **Utilisation du Compte Administrateur :**
   - Connectez-vous avec les identifiants administrateur (admin:admin) pré-créés dans la base de données.
