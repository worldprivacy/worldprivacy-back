# WorldPrivacy Back - API

L'API de WorlPrivacy est en PHP structurée selon le principe DDD (Domain Driven Design), avec PHP-FPM + Nginx et SQLite, tournant entièrement via Docker.

## Prérequis

- Docker & Docker Compose installés sur votre machine.

## ⚡ Scripts utiles

Les scripts sont à la racine du projet et permettent de gérer facilement Docker :

### ./install
Permet de build les images Docker et d'installer les dépendances
```bash
./install
```

### ./start
Démarre les containers Docker en arrière-plan.

L’API sera accessible sur : [http://localhost:8080](http://localhost:8080)
```bash
./start
```

### ./stop
Stoppe les containers Docker
```bash
./stop
```

