# Système de Gestion des Ressources Humaines (GRH)

## Description

Ce projet est une application web complète de gestion des ressources humaines développée dans le cadre d'un projet de fin d'études (PFE). Le système GRH permet de gérer efficacement tous les aspects de la gestion du personnel d'une entreprise, incluant le recrutement, les contrats, les congés, les formations, les promotions et bien plus encore.

## Technologies Utilisées

### Backend
- **PHP** 8.2+
- **Laravel** 11.0
- **MySQL/MariaDB** - Base de données relationnelle
- **Laravel Livewire** 3.4 - Pour les interactions en temps réel
- **DomPDF** - Génération de documents PDF
- **PHPWord** - Génération de documents Word

### Frontend
- **Vue.js** 3.4
- **Bootstrap** - Framework CSS
- **Bootstrap Icons** - Icônes
- **FullCalendar** - Gestion du calendrier
- **Vite** - Build tool moderne

### Outils de Développement
- **Composer** - Gestionnaire de dépendances PHP
- **NPM** - Gestionnaire de paquets Node.js
- **Laravel Pint** - Formatage de code PHP
- **PHPUnit** - Tests unitaires

## Fonctionnalités Principales

### Gestion des Employés
- Inscription et authentification des employés
- Gestion des profils personnels
- Suivi des informations personnelles
- Gestion des fiches employés

### Gestion du Recrutement
- Publication d'offres d'emploi
- Gestion des candidatures
- Offres de stage
- Suivi des demandes de stage
- Gestion des stagiaires

### Gestion Administrative
- Gestion des contrats (types, création, suivi)
- Gestion des départements
- Gestion des postes
- Suivi des tâches

### Gestion des Congés
- Demandes de congés
- Validation/Rejet des demandes
- Types de congés (payés, maladie, etc.)
- Calendrier des absences

### Gestion des Formations
- Demandes de formation
- Suivi des formations des employés
- Gestion du catalogue de formations

### Gestion des Promotions
- Demandes de promotion
- Liste des employés éligibles
- Suivi des promotions accordées

### Gestion RH (Responsable RH)
- Tableau de bord RH complet
- Vue d'ensemble sur tous les employés
- Gestion centralisée des demandes
- Génération de rapports

### Fonctionnalités Additionnelles
- Système d'annonces
- Génération de documents (PDF, Word)
- Gestion des avantages sociaux
- Calendrier des événements

## Prérequis

Avant de commencer, assurez-vous d'avoir installé les éléments suivants sur votre système :

- **PHP** >= 8.2
  - Extensions PHP requises : PDO, mbstring, openssl, tokenizer, XML, ctype, JSON, BCMath, fileinfo
- **Composer** >= 2.0
- **Node.js** >= 18.x et **NPM** >= 9.x
- **MySQL** >= 8.0 ou **MariaDB** >= 10.4
- **Git**
- Un serveur web (Apache, Nginx) ou utiliser le serveur intégré de Laravel

## Installation

### 1. Cloner le Projet

```bash
git clone https://github.com/Asenn2/GRH.git
cd GRH
```

### 2. Accéder au Répertoire du Projet Laravel

```bash
cd ProjetWebPFE
```

### 3. Installer les Dépendances PHP

```bash
composer install
```

### 4. Installer les Dépendances Node.js

```bash
npm install
```

### 5. Configuration de l'Environnement

Copier le fichier de configuration d'exemple :

```bash
cp .env.example .env
```

Générer une clé d'application :

```bash
php artisan key:generate
```

### 6. Configuration de la Base de Données

Ouvrir le fichier `.env` et configurer les paramètres de connexion à la base de données :

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=grh
DB_USERNAME=root
DB_PASSWORD=votre_mot_de_passe
```

### 7. Créer la Base de Données

Créer une base de données MySQL nommée `grh` :

```bash
mysql -u root -p
```

```sql
CREATE DATABASE grh CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

Ou importer directement le fichier SQL fourni à la racine du projet :

```bash
mysql -u root -p grh < ../grh.sql
```

### 8. Exécuter les Migrations (Optionnel)

Si vous n'avez pas importé le fichier SQL :

```bash
php artisan migrate
```

### 9. Créer les Liens de Stockage

```bash
php artisan storage:link
```

### 10. Compiler les Assets Frontend

Pour le développement :

```bash
npm run dev
```

Pour la production :

```bash
npm run build
```

## Démarrage de l'Application

### Utilisation du Serveur Intégré de Laravel

Dans un terminal, démarrer le serveur PHP :

```bash
php artisan serve
```

Dans un second terminal, démarrer le serveur de développement Vite (pour le rechargement à chaud) :

```bash
npm run dev
```

L'application sera accessible à l'adresse : `http://localhost:8000`

### Utilisation avec un Serveur Web (Apache/Nginx)

Configurer votre serveur web pour pointer vers le répertoire `public/` du projet Laravel.

## Exemple d'Utilisation

### 1. Première Connexion

Après avoir installé et démarré l'application, accéder à `http://localhost:8000` pour voir la page de connexion.

### 2. Créer un Compte

- Cliquer sur le lien d'inscription (Registration)
- Remplir le formulaire avec vos informations
- Soumettre le formulaire

### 3. Se Connecter

- Utiliser vos identifiants pour vous connecter
- Selon votre rôle (Employé, RH, Admin), vous aurez accès à différentes fonctionnalités

### 4. Navigation

**Pour un Employé :**
- Consulter vos informations personnelles
- Faire une demande de congé
- Consulter les formations disponibles
- Demander une promotion
- Voir votre progression si vous êtes stagiaire

**Pour un Responsable RH :**
- Accéder au tableau de bord RH
- Gérer les employés
- Valider les demandes de congés
- Gérer les offres d'emploi et de stage
- Suivre les candidatures
- Gérer les formations et promotions
- Gérer les contrats et départements

### 5. Fonctionnalités Courantes

**Faire une Demande de Congé :**
1. Aller dans la section "Demande de Congé"
2. Sélectionner le type de congé
3. Choisir les dates de début et fin
4. Ajouter une justification
5. Soumettre la demande

**Consulter les Offres d'Emploi :**
1. Accéder à la page d'accueil publique
2. Consulter la liste des offres disponibles
3. Postuler en remplissant le formulaire

**Générer des Documents (RH) :**
- Le système permet de générer automatiquement des contrats en PDF ou Word
- Accéder aux fiches employés pour générer leurs documents

## Structure du Projet

```
GRH/
├── ProjetWebPFE/          # Application Laravel principale
│   ├── app/               # Code application
│   │   ├── Http/
│   │   │   ├── Controllers/
│   │   │   └── Middleware/
│   │   └── Models/        # Modèles Eloquent
│   ├── config/            # Fichiers de configuration
│   ├── database/          # Migrations et seeders
│   ├── public/            # Point d'entrée web
│   ├── resources/         # Vues, CSS, JS
│   │   └── views/         # Templates Blade
│   ├── routes/            # Définition des routes
│   └── storage/           # Fichiers générés
├── grh.sql                # Base de données SQL
├── PFE.mwb                # Modèle MySQL Workbench
└── README.md              # Ce fichier
```

## Structure de la Base de Données

Le système utilise une base de données relationnelle avec les principales tables :

- **employe** - Informations sur les employés
- **candidat** - Candidats aux offres d'emploi
- **candidature** - Candidatures soumises
- **stagiaire** - Informations sur les stagiaires
- **contrat** - Contrats des employés
- **conge** - Demandes de congés
- **formation** - Formations disponibles
- **demande_formation** - Demandes de formation
- **promotion** - Promotions accordées
- **demande_promotion** - Demandes de promotion
- **departement** - Départements de l'entreprise
- **poste** - Postes disponibles
- **offre_emploi** - Offres d'emploi publiées
- **stage** - Offres de stage
- **demande_stage** - Demandes de stage
- **annonce** - Annonces de l'entreprise
- **tache** - Tâches assignées

Pour visualiser le schéma complet de la base de données, ouvrir le fichier `PFE.mwb` avec MySQL Workbench.

## Rôles et Permissions

Le système implémente trois niveaux d'accès :

1. **Employé** - Accès aux fonctionnalités de base (profil, demandes de congé, formations)
2. **Responsable RH** - Accès complet à la gestion des ressources humaines
3. **Administrateur** - Accès total au système

## Tests

Pour exécuter les tests unitaires :

```bash
php artisan test
```

Ou avec PHPUnit directement :

```bash
./vendor/bin/phpunit
```


## Auteur

Développé par l'équipe du projet GRH - Asenn2

**Note :** Ce projet utilise Laravel 11 qui nécessite PHP 8.2 ou supérieur. Assurez-vous que votre environnement répond à ces exigences avant l'installation.
