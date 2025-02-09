# Cahier des charges – Projet Stunning

## 1. Présentation du projet
Stunning est une plateforme en ligne permettant aux utilisateurs de partager, explorer, et organiser des projets web.  
Le fonctionnement du site s'apparente à des plateformes comme Behance, mais dédiée aux projets web. Les utilisateurs peuvent y publier des projets, les organiser en groupes, inviter d'autres membres à y participer, et interagir via des commentaires.  
Le site offre une partie publique pour tous les visiteurs et une partie privée accessible uniquement aux membres du projet.

## 2. Objectifs du projet
- **Avoir un projet propre, au code soigné et scalable**
- Permettre aux utilisateurs de créer un compte et gérer leurs informations personnelles.
- Publier des projets web (visibles au public ou en mode privé pour les membres).
- Organiser les projets dans des groupes personnels, et y inviter des utilisateurs.
- Permettre aux utilisateurs de rechercher des projets et des utilisateurs.
- Ajouter des commentaires et interagir avec d'autres utilisateurs.
- Gérer les informations du site via un backend robuste.

## 3. Technologies utilisées
- **Backend** : Symfony.
- **Frontend** : Twig.
- **Conteneurisation** : Docker.
- **Base de données** : PostgreSQL.

## 4. Parties du site
1. **Page d'accueil (publique) (/ | /search)** :
   - Liste des projets publics avec option de recherche de projets et d'utilisateurs.
   
2. **Page de profil utilisateur (/profile/{id})** :
   - Affichage des informations de l'utilisateur, et de ses projets au travers des différents groupes qu'il a pu créé.

3. **Page de personnalisation du profil (/profile/settings)** :
   - Personnalisation des informations de son profil utiisateur.

4. **Page de projet (/project/{id})** :
   - Affichage des informations principales du projet.
   - Possibilité d'afficher la partie publique du projet, ou la partie privée (pour les membres du projet).
   - Description, et liste des membres du projets, des technologies utilisées, des tags associés, des liens et des commentaires.

5. **Inscription/Connexion (/login | /register | /forgot | /reset/{token})** :
   - Système d'authentification (avec mot de passe crypté) et gestion des rôles (administrateur, membre).

6. **Backend poussé (/admin/*)** :
   - Backend robuste permettant de gérer une grande majorité des fonctionnalités administratives et utilisateur.
   Cela inclut la gestion des projets, des utilisateurs et des technologies applicables aux projets.