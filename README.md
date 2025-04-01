# Filmora – Projet Laravel

Filmora est une application web développée avec le framework Laravel. Elle permet de référencer et gérer une base de données de films avec des informations telles que le titre, le genre, l'année de sortie, etc.

Ce projet fait suite à une refonte complète de l’ancien projet Planétaria, en adaptant toute la structure pour une gestion de contenus liés au cinéma.

---

## Structure du dépôt

. ├── Filmora/ → Code source Laravel du projet └── README.md → Fichier de présentation


---

## Fonctionnalités principales

- Ajout, modification et suppression de films
- Tri par genre, année ou autres critères
- Interface d’administration
- Système de migrations et seeders
- (À venir) Galerie d'affiches et moteur de recherche

---

## Technologies utilisées

- Laravel 11.x
- PHP 8.3
- SQLite
- Blade
- Tailwind CSS (configuration de base)

---

## Installation locale

1. Se placer dans le dossier `Filmora`
2. Dupliquer le fichier `.env.example` en `.env`

Par défaut, le projet utilise SQLite. Assurez-vous que le fichier database/database.sqlite existe et que les permissions sont correctes.

3. Exécuter les commandes suivantes :

```bash
composer install
php artisan key:generate
php artisan migrate --seed
php artisan serv
```

--> lien généré en localhost

## Auteur
Projet développé par Ronan
Année : 2025
