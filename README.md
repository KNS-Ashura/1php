# 2025-PHP-Docker

# Projet PHP Simple avec Docker

Ce guide vous permet de créer un environnement de développement PHP très simple avec MySQL et phpMyAdmin en utilisant Docker. Aucune connaissance préalable de Docker n'est nécessaire.

## Prérequis

- [Docker Desktop](https://www.docker.com/products/docker-desktop/) installé sur votre ordinateur
- Aucune autre installation (PHP, MySQL, etc.) n'est nécessaire !

## Création du projet

### Étape 1 : Créer la structure du projet

1. Créez un nouveau dossier pour votre projet (par exemple "mon-projet-php")
2. Ouvrez ce dossier

### Étape 2 : Créer les fichiers nécessaires

Dans ce dossier, créez les 3 fichiers suivants :

1. **Dockerfile** - Contient les instructions pour créer l'environnement PHP
2. **docker-compose.yml** - Configure les services (PHP, MySQL, phpMyAdmin)
3. **index.php** - Exemple de page PHP

Le contenu de chaque fichier est fourni ci-dessous.

### Étape 3 : Démarrer les conteneurs Docker

Ouvrez un terminal (invite de commandes) dans le dossier de votre projet et exécutez :

```bash
docker-compose up -d --build
```

Cette commande va :
- Télécharger les images nécessaires
- Construire l'environnement PHP
- Démarrer tous les services en arrière-plan

La première exécution peut prendre plusieurs minutes car Docker doit télécharger toutes les images.

### Étape 4 : Accéder à votre site

Une fois les conteneurs démarrés, vous pouvez accéder à :
- Votre application PHP : http://localhost
- phpMyAdmin : http://localhost:8080 (utilisateur: `root`, mot de passe: `root`)

## Autres commandes utiles

- **Arrêter les conteneurs** : `docker-compose down`
- **Voir les logs** : `docker-compose logs`
- **Redémarrer les conteneurs** : `docker-compose restart`
- **Reconstruire et redémarrer** : `docker-compose up -d --build`

## Structure des fichiers

Voici la structure de fichiers minimale pour démarrer :

```
mon-projet-php/
├── Dockerfile
├── docker-compose.yml
└── index.php
```

Tous les fichiers PHP que vous ajouterez dans ce dossier seront disponibles sur votre serveur web.

## Développement

Pour modifier vos fichiers PHP, il suffit de les éditer avec votre éditeur de code préféré. Les modifications sont immédiatement disponibles, sans avoir besoin de redémarrer les conteneurs.

## Résolution des problèmes courants

### Erreur "port already in use" (port déjà utilisé)
Si vous voyez une erreur indiquant que le port 80 ou 8080 est déjà utilisé, modifiez le premier numéro dans docker-compose.yml :
```
ports:
  - "8000:80"  # Changez 80 en 8000 (ou un autre port)
```

### Les modifications ne sont pas visibles
Essayez de vider le cache de votre navigateur ou d'utiliser le mode navigation privée.

### La connexion à la base de données échoue
Vérifiez que les identifiants dans index.php correspondent à ceux définis dans docker-compose.yml.