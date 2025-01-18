<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\SocialMedias;
use App\Entity\Tag;
use App\Entity\Technology;
use App\Entity\Project;
use App\Entity\ProjectPublicInformations;
use App\Entity\ProjectPrivateInformations;
use App\Entity\Media;
use App\Entity\Link;
use App\Entity\Invitation;
use App\Entity\Group;
use App\Entity\Comment;
use App\Enum\UserCountryEnum;
use App\Enum\ProjectVisibilityEnum;
use App\Enum\MediaTypeEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $usersData = [
            ['username' => 'Alice', 'email' => 'alice@example.com'],
            ['username' => 'Bob', 'email' => 'bob@example.com'],
            ['username' => 'Charlie', 'email' => 'charlie@example.com'],
            ['username' => 'Dave', 'email' => 'dave@example.com'],
            ['username' => 'Eve', 'email' => 'eve@example.com'],
            ['username' => 'Frank', 'email' => 'frank@example.com'],
            ['username' => 'Grace', 'email' => 'grace@example.com'],
            ['username' => 'Heidi', 'email' => 'heidi@example.com'],
            ['username' => 'Ivan', 'email' => 'ivan@example.com'],
            ['username' => 'Judy', 'email' => 'judy@example.com'],
        ];

        $projectsCommonData = [
            [
                'name' => 'Belanger Salach Architecture',
                'description' => 'Un studio spécialisé dans l\'architecture contemporaine, mettant en valeur des concepts innovants et des designs harmonieux adaptés aux besoins modernes.',
                'documentation' => 'Le projet repose sur un CMS customisé avec un modèle MVC pour gérer les pages et médias dynamiquement. Les images sont optimisées pour les rendus haute qualité, et un CDN est utilisé pour la gestion des assets. Le système de gestion des vidéos est intégré via un player vidéo personnalisé, garantissant un rendu rapide sur différents appareils. L\'intégration des composants repose sur des technologies modernes comme Vue.js pour le front-end et Node.js pour le back-end. Le projet utilise des services de cache pour minimiser la latence des ressources statiques.',
                'medias' => [
                    ['url' => 'https://assets.awwwards.com/awards/submissions/2024/11/672931d7c9909200298939.jpg', 'type' => MediaTypeEnum::IMAGE],
                    ['url' => 'https://assets.awwwards.com/awards/element/2024/11/67254586bcb26721635441.mp4', 'type' => MediaTypeEnum::VIDEO],
                    ['url' => 'https://assets.awwwards.com/awards/element/2024/11/6725519dc5ecf143379303.jpg', 'type' => MediaTypeEnum::IMAGE]
                ]
            ],
            [
                'name' => 'Tenzr',
                'description' => 'Un site vitrine conçu pour présenter un produit de manière claire et esthétique, avec une interface intuitive et des visuels engageants.',
                'documentation' => 'Le site utilise un framework front-end comme React pour une interface utilisateur dynamique et réactive. Les données sont gérées via une API RESTful en backend avec une base de données SQL pour les informations produits. L\'intégration des vidéos utilise des balises vidéo HTML5 pour assurer une compatibilité multiplateforme. Des techniques d\'optimisation comme le lazy loading sont utilisées pour le chargement des images et la gestion des ressources afin d\'améliorer la vitesse de chargement.',
                'medias' => [
                    ['url' => 'https://assets.awwwards.com/awards/sites_of_the_day/2022/06/tenzr-ouiwill-clean-1600.mp4', 'type' => MediaTypeEnum::VIDEO],
                    ['url' => 'https://assets.awwwards.com/awards/element/2022/06/62a73e74dc293098539272.jpg', 'type' => MediaTypeEnum::IMAGE],
                    ['url' => 'https://assets.awwwards.com/awards/element/2022/06/62a73e8d3ceec472200644.jpg', 'type' => MediaTypeEnum::IMAGE]
                ]
            ],
            [
                'name' => 'Always fresh',
                'description' => 'Un site web illustrant les compétences d\'une agence numérique, axé sur des designs frais et une expérience utilisateur fluide.',
                'documentation' => 'Le site utilise un modèle hybride de pré-rendu et de rendu dynamique, combinant un générateur statique pour les pages les plus consultées et une architecture SPA (Single Page Application) pour les pages à contenu dynamique. Les images sont stockées et livrées via un CDN avec un système de compression côté serveur. L\'interface utilisateur repose sur des composants réactifs avec des transitions CSS3 et des animations optimisées. L\'API backend est construite avec Node.js et Express, et un système de cache est mis en place pour accélérer le rendu des pages.',
                'medias' => [
                    ['url' => 'https://assets.awwwards.com/awards/element/2023/12/656dd18bc20bc599619404.jpg', 'type' => MediaTypeEnum::IMAGE],
                    ['url' => 'https://assets.awwwards.com/awards/element/2023/12/656dd18bd1393793931642.jpg', 'type' => MediaTypeEnum::IMAGE],
                    ['url' => 'https://assets.awwwards.com/awards/element/2023/12/656dd18b58348847658519.jpg', 'type' => MediaTypeEnum::IMAGE],
                    ['url' => 'https://assets.awwwards.com/awards/element/2023/12/656dd18b86865268847258.jpg', 'type' => MediaTypeEnum::IMAGE],
                    ['url' => 'https://assets.awwwards.com/awards/element/2023/12/656dd18ba38eb897872695.jpg', 'type' => MediaTypeEnum::IMAGE]
                ]
            ],
            [
                'name' => 'Born in Manchester',
                'description' => 'Un site captivant qui met en lumière des événements culturels et artistiques, avec une présentation dynamique et immersive.',
                'documentation' => 'Le projet intègre une API RESTful en back-end pour la gestion des événements et des contenus dynamiques. Les données sont stockées dans une base de données NoSQL pour une scalabilité accrue. Le front-end utilise un framework JavaScript comme Vue.js pour gérer les interactions en temps réel et les animations complexes. Un service de streaming vidéo en ligne est intégré pour la diffusion en direct des événements. Les images sont optimisées et livrées via un CDN pour garantir un temps de chargement rapide.',
                'medias' => [
                    ['url' => 'https://assets.awwwards.com/awards/element/2024/10/6705c503a627f917823243.mp4', 'type' => MediaTypeEnum::VIDEO],
                    ['url' => 'https://assets.awwwards.com/awards/element/2024/10/6705cba5c4634146094102.jpg', 'type' => MediaTypeEnum::IMAGE],
                    ['url' => 'https://assets.awwwards.com/awards/element/2024/10/6705cba5a6945459165283.jpg', 'type' => MediaTypeEnum::IMAGE],
                    ['url' => 'https://assets.awwwards.com/awards/element/2024/10/6705c9a3bb74c603669043.jpg', 'type' => MediaTypeEnum::IMAGE]
                ]
            ],
            [
                'name' => 'Muze',
                'description' => 'Une solution SaaS innovante et performante, pensée pour simplifier la gestion des projets complexes avec des outils modernes.',
                'documentation' => 'Le projet repose sur une architecture microservices, permettant une gestion efficace des tâches complexes. Les services sont développés en Node.js et exposés via des API RESTful. Le front-end est construit avec React, et le stockage des données utilisateurs est réalisé dans une base de données relationnelle SQL. Des fonctionnalités comme l\'authentification OAuth et la gestion des permissions sont intégrées pour assurer la sécurité des informations sensibles.',
                'medias' => [
                    ['url' => 'https://assets.awwwards.com/awards/element/2023/01/63bad49577b12959209354.jpg', 'type' => MediaTypeEnum::IMAGE],
                    ['url' => 'https://assets.awwwards.com/awards/element/2023/01/63bb256c632f0076708721.jpg', 'type' => MediaTypeEnum::IMAGE],
                    ['url' => 'https://assets.awwwards.com/awards/element/2023/01/63bb256c6bbf5422823964.jpg', 'type' => MediaTypeEnum::IMAGE],
                    ['url' => 'https://assets.awwwards.com/awards/element/2023/01/63bad49577b12959209354.jpg', 'type' => MediaTypeEnum::IMAGE],
                    ['url' => 'https://assets.awwwards.com/awards/element/2023/01/63bb26d75f2ce108222956.jpg', 'type' => MediaTypeEnum::IMAGE]
                ]
            ],
            [
                'name' => 'Saisei',
                'description' => 'Une célébration de l\'architecture à travers un design visuel qui allie modernité et tradition, inspiré par l\'élégance et la fonctionnalité.',
                'documentation' => 'Le projet utilise une architecture front-end basée sur un modèle de Single Page Application (SPA), avec des composants construits en Vue.js. Le back-end repose sur une API RESTful avec Node.js pour fournir les données nécessaires à la gestion des contenus architecturaux. Les images sont chargées de manière asynchrone grâce au lazy loading, et les vidéos sont optimisées pour être lues sans délais. Des tests automatisés sont utilisés pour assurer la qualité du code, et un pipeline CI/CD est mis en place pour garantir des déploiements sans erreur.',
                'medias' => [
                    ['url' => 'https://assets.awwwards.com/awards/submissions/2024/10/67022ad8214c8998490093.png', 'type' => MediaTypeEnum::IMAGE],
                    ['url' => 'https://assets.awwwards.com/awards/element/2024/10/67022d5b1c47d166077267.png', 'type' => MediaTypeEnum::IMAGE],
                    ['url' => 'https://assets.awwwards.com/awards/element/2024/10/67022d5b01649543922357.png', 'type' => MediaTypeEnum::IMAGE],
                    ['url' => 'https://assets.awwwards.com/awards/element/2024/10/67022d651411e343217790.mp4', 'type' => MediaTypeEnum::VIDEO],
                    ['url' => 'https://assets.awwwards.com/awards/element/2024/10/67022d5b14da1853306484.png', 'type' => MediaTypeEnum::IMAGE]
                ]
            ],
            [
                'name' => 'Architecture',
                'description' => 'Un site qui explore le monde architectural avec des détails soignés et une présentation qui met en avant l\'esthétique et la technique.',
                'documentation' => 'Le site présente une structure modulaire qui permet de créer facilement de nouvelles pages avec un moteur de templates backend intégré en PHP. Les données sont stockées dans une base de données MySQL et sont accessibles via une API RESTful. Des techniques avancées de mise en cache sont utilisées pour les ressources statiques et dynamiques afin d\'améliorer la vitesse de chargement. Le site utilise également des animations CSS3 et des transitions JavaScript pour offrir une expérience visuelle captivante.',
                'medias' => [
                    ['url' => 'https://assets.awwwards.com/awards/element/2024/05/663cb2ba1a0c0259007095.png', 'type' => MediaTypeEnum::IMAGE],
                    ['url' => 'https://assets.awwwards.com/awards/element/2024/05/663cb2ba532ad809189217.png', 'type' => MediaTypeEnum::IMAGE],
                    ['url' => 'https://assets.awwwards.com/awards/element/2024/05/663cb2ba63d9a153074350.png', 'type' => MediaTypeEnum::IMAGE]
                ]
            ],
            [
                'name' => 'Virtual Gallery',
                'description' => 'Une galerie virtuelle immersive qui permet de découvrir des œuvres d\'art sous un nouvel angle, avec une expérience interactive captivante.',
                'documentation' => 'Le projet repose sur une technologie de réalité virtuelle pour la visualisation immersive des œuvres d\'art, avec une intégration de WebVR pour l\'expérience en ligne. L\'utilisation de trois.js permet de gérer les scènes 3D et les interactions en temps réel. Le back-end est basé sur Node.js pour gérer les utilisateurs et les données des œuvres. Des optimisations sont mises en place pour assurer des rendus rapides, notamment la gestion des textures et des modèles 3D via WebGL.',
                'medias' => [
                    ['url' => 'https://assets.awwwards.com/awards/element/2022/08/630e063bcce78237066246.jpg', 'type' => MediaTypeEnum::IMAGE],
                    ['url' => 'https://assets.awwwards.com/awards/element/2022/08/630e0418cc1b9947267265.jpg', 'type' => MediaTypeEnum::IMAGE],
                    ['url' => 'https://assets.awwwards.com/awards/element/2022/08/630e026c72466644738016.jpg', 'type' => MediaTypeEnum::IMAGE],
                    ['url' => 'https://assets.awwwards.com/awards/element/2022/08/630e063bdd933511458141.jpg', 'type' => MediaTypeEnum::IMAGE]
                ]
            ],
            [
                'name' => 'Tara',
                'description' => 'Un site qui reflète l\'approche moderne de l\'architecture avec une mise en avant des matériaux et des détails de conception unique.',
                'documentation' => 'Le projet repose sur un modèle full-stack avec une architecture monolithique, combinant front-end (Vue.js) et back-end (Node.js/Express) en une seule application. Les images sont gérées par un CMS personnalisé, avec une gestion avancée des médias via une API. Un processus d\'optimisation des images est appliqué pour garantir une expérience utilisateur optimale sur toutes les tailles d\'écran.',
                'medias' => [
                    ['url' => 'https://assets.awwwards.com/awards/submissions/2024/02/669f220f8e1c0217000043.jpg', 'type' => MediaTypeEnum::IMAGE],
                    ['url' => 'https://assets.awwwards.com/awards/element/2024/02/669f220d6a420289214551.jpg', 'type' => MediaTypeEnum::IMAGE]
                ]
            ],
            [
                'name' => 'Pangaia',
                'description' => 'Une plateforme qui réunit innovation et mode durable, mettant en avant des solutions écologiques et des créations inspirantes.',
                'documentation' => 'Le projet Pangaia est développé avec une architecture front-end moderne utilisant React.js, permettant une interface dynamique et réactive. Le back-end repose sur un API RESTful basé sur Node.js pour la gestion des produits, des utilisateurs, et des contenus liés à la mode durable. La plateforme utilise des services cloud pour le stockage des images et des vidéos avec une gestion optimisée via un CDN pour une diffusion rapide des médias. L\'optimisation des images et des vidéos est effectuée pour garantir des temps de chargement rapides, et des stratégies de lazy loading sont appliquées pour améliorer l\'expérience utilisateur sur les pages produits et les sections de la boutique en ligne. Le site inclut également des filtres interactifs pour naviguer dans les différentes collections éco-responsables, basés sur des algorithmes de tri côté serveur.',
                'medias' => [
                    ['url' => 'https://assets.awwwards.com/awards/element/2024/11/673e071a342c4309582581.png', 'type' => MediaTypeEnum::IMAGE],
                    ['url' => 'https://assets.awwwards.com/awards/element/2024/11/673de4aab1aec357416643.mp4', 'type' => MediaTypeEnum::VIDEO],
                    ['url' => 'https://assets.awwwards.com/awards/element/2024/11/673e071a3dcb1623255984.png', 'type' => MediaTypeEnum::IMAGE],
                    ['url' => 'https://assets.awwwards.com/awards/element/2024/11/673de5cb41f93194598219.png', 'type' => MediaTypeEnum::IMAGE]
                ]
            ]            
        ];

        $tagsData = [
            "Tech",
            "Innovation",
            "StartUp",
            "WebDesign",
            "UIUX",
            "DevOps",
            "AI",
            "Ecommerce",
            "SocialNetwork",
            "SaaS",
            "Collaboration",
            "GreenTech",
            "OpenSource",
            "Productivity"
        ];

        $technologiesData = [
            ['name' => 'Symfony', 'logo' => 'tabler:brand-symfony'],
            ['name' => 'React', 'logo' => 'tabler:brand-react'],
            ['name' => 'Django', 'logo' => 'tabler:brand-django'],
            ['name' => 'Spring', 'logo' => 'tabler:brand-spring'],
            ['name' => 'ASP.NET', 'logo' => 'tabler:brand-aspnet'],
            ['name' => 'Rails', 'logo' => 'tabler:brand-rails'],
            ['name' => 'Gin', 'logo' => 'tabler:brand-gin'],
            ['name' => 'SwiftUI', 'logo' => 'tabler:brand-swiftui'],
            ['name' => 'Ktor', 'logo' => 'tabler:brand-ktor'],
            ['name' => 'Angular', 'logo' => 'tabler:brand-angular'],
            ['name' => 'PHP', 'logo' => 'tabler:brand-php'],
            ['name' => 'JavaScript', 'logo' => 'tabler:brand-javascript'],
            ['name' => 'Python', 'logo' => 'tabler:brand-python'],
            ['name' => 'Java', 'logo' => 'tabler:brand-java'],
            ['name' => 'C#', 'logo' => 'tabler:brand-csharp'],
            ['name' => 'Ruby', 'logo' => 'tabler:brand-ruby'],
            ['name' => 'Go', 'logo' => 'tabler:brand-go'],
            ['name' => 'Swift', 'logo' => 'tabler:brand-swift'],
            ['name' => 'Kotlin', 'logo' => 'tabler:brand-kotlin'],
            ['name' => 'TypeScript', 'logo' => 'tabler:brand-typescript']
        ];

        $mediasPrivateData = [
            ['url' => 'bdd-scheme.png', 'type' => MediaTypeEnum::IMAGE],
            ['url' => 'mail.png', 'type' => MediaTypeEnum::IMAGE],
            ['url' => 'roadmap.png', 'type' => MediaTypeEnum::IMAGE],
            ['url' => 'security-report.png', 'type' => MediaTypeEnum::IMAGE]
        ];

        $publicLinksData = [
            ['name' => 'Website', 'url' => 'https://example.com/'],
            ['name' => 'Github', 'url' => 'https://github.com/'],
            ['name' => 'About our team', 'url' => 'https://example.com/']
        ];
        
        $privateLinksData = [
            ['name' => 'Figma', 'url' => 'https://www.figma.com/'],
            ['name' => 'Google Doc', 'url' => 'https://docs.google.com/'],
            ['name' => 'BDD Scheme', 'url' => 'https://dbdiagram.io/'],
            ['name' => 'Passwords for the project', 'url' => 'https://www.passbolt.com/']
        ];

        $invitationsData = [
            'You are invited to join the project!',
            'Please join our project.',
            'We would love to have you on our team.',
            'Join us for an exciting project!',
        ];

        $groupsData = [
            'Personnal',
            'Courses',
            'Front-end',
            'Back-end',
            'Work'
        ];

        $commentsData = [
            'Great job !',
            'This needs more attention.',
            'Please review the code changes.',
            'The project is progressing well !',
            'We need to discuss the requirements.',
            'The deadline is approaching.',
            'Let’s schedule a meeting.',
            'The task is almost complete.',
            'We need to fix the bugs.',
            'The project is on track.'
        ];

        // Users
        $countries = UserCountryEnum::cases();
        $userInstances = [];
        foreach ($usersData as $i => $userData) {
            $user = new User();
            $user->setUsername($userData['username']);
            $user->setEmail($userData['email']);
            $user->setPlainPassword('password');
            $user->setProfilePicture('https://avatar.iran.liara.run/public/' . ($i + 1));
            $user->setBanner('https://picsum.photos/id/' . ($i + 1) . '/1920/1080');
            $user->setWebsiteLink('https://example.com/' . $userData['username']);
            $user->setCountry($countries[array_rand($countries)]);

            // SocialMedias for user
            if (rand(0, 1)) {
                $socialMedias = new SocialMedias();
                if (rand(0, 1)) $socialMedias->setXTwitter('https://twitter.com/' . $userData['username']);
                if (rand(0, 1)) $socialMedias->setInstagram('https://instagram.com/' . $userData['username']);
                if (rand(0, 1)) $socialMedias->setGithub('https://github.com/' . $userData['username']);
                if (rand(0, 1)) $socialMedias->setFigma('https://figma.com/@' . $userData['username']);
                $user->setSocialMedias($socialMedias);
                $manager->persist($socialMedias);
            }

            $manager->persist($user);
            $userInstances[] = $user;
        }

        // Tags
        $tagInstances = [];
        foreach ($tagsData as $tagData) {
            $tag = new Tag();
            $tag->setName($tagData);
            $manager->persist($tag);
            $tagInstances[] = $tag;
        }

        // Technologies
        $technologyInstances = [];
        foreach ($technologiesData as $technologyData) {
            $technology = new Technology();
            $technology->setName($technologyData['name']);
            $technology->setLogo($technologyData['logo']);
            $manager->persist($technology);
            $technologyInstances[] = $technology;
        }

        // Projects
        $projectInstances = [];
        foreach ($projectsCommonData as $projectData) {
            $project = new Project();
            $project->setName($projectData['name']);
            if (rand(0, 1)) $project->setVisibility(ProjectVisibilityEnum::PRIVATE);
            $project->setNumberOfViews(rand(0, 1000));
            $project->setLikes(rand(0, 1000));

            // Users in project
            $numberOfUsers = rand(1, 3);
            $usersInProject = array_rand($userInstances, $numberOfUsers);
            if (!is_array($usersInProject)) $usersInProject = [$usersInProject];

            foreach ($usersInProject as $userIndex) {
                $project->addUser($userInstances[$userIndex]);
            }

            // Tags in project
            $numberOfTags = rand(1, 3);
            $tagsInProject = array_rand($tagInstances, $numberOfTags);
            if (!is_array($tagsInProject)) $tagsInProject = [$tagsInProject];

            foreach ($tagsInProject as $tagIndex) {
                $project->addTag($tagInstances[$tagIndex]);
            }

            // Technologies in project
            $numberOfTechnologies = rand(1, 5);
            $technologiesInProject = array_rand($technologyInstances, $numberOfTechnologies);
            if (!is_array($technologiesInProject)) $technologiesInProject = [$technologiesInProject];

            foreach ($technologiesInProject as $technologyIndex) {
                $project->addTechnology($technologyInstances[$technologyIndex]);
            }

            // (Public Informations)
            $projectPublicInformations = new ProjectPublicInformations();
            $projectPublicInformations->setDescription($projectData['description']);
            $project->setPublicInformations($projectPublicInformations);
            $manager->persist($projectPublicInformations);

            // Medias in Project (Public Informations)
            foreach ($projectData['medias'] as $mediaData) {
                $media = new Media();
                $media->setFile($mediaData['url']);
                $media->setType($mediaData['type']);
                $media->setProjectPublicInformations($projectPublicInformations);
                $manager->persist($media);
            }

            // Links in Project (Public Informations)
            $numberOfPublicLinks = rand(1, count($publicLinksData));
            $randomPublicLinks = array_rand($publicLinksData, $numberOfPublicLinks);
            if (!is_array($randomPublicLinks)) $randomPublicLinks = [$randomPublicLinks];

            foreach ($randomPublicLinks as $linkIndex) {
                $linkData = $publicLinksData[$linkIndex];

                $link = new Link();
                $link->setName($linkData['name']);
                $link->setUrl($linkData['url']);
                $link->setProjectPublicInformations($projectPublicInformations);
                $manager->persist($link);
            }

            // (Private Informations)
            $projectPrivateInformations = new ProjectPrivateInformations();
            $projectPrivateInformations->setDocumentation($projectData['documentation']);
            $project->setPrivateInformations($projectPrivateInformations);
            $manager->persist($projectPrivateInformations);

            // Medias in Project (Private Informations)
            $numberOfPrivateMedias = rand(1, count($mediasPrivateData));
            $privateMedias = array_rand($mediasPrivateData, $numberOfPrivateMedias);
            if (!is_array($privateMedias)) $privateMedias = [$privateMedias];

            foreach ($privateMedias as $mediaIndex) {
                $mediaData = $mediasPrivateData[$mediaIndex];
                $media = new Media();
                $media->setFile($mediaData['url']);
                $media->setType($mediaData['type']);
                $media->setProjectPrivateInformations($projectPrivateInformations);
                $manager->persist($media);
            }

            // Links in Project (Private Informations)
            $numberOfPrivateLinks = rand(1, count($privateLinksData));
            $randomPrivateLinks = array_rand($privateLinksData, $numberOfPrivateLinks);
            if (!is_array($randomPrivateLinks)) $randomPrivateLinks = [$randomPrivateLinks];

            foreach ($randomPrivateLinks as $linkIndex) {
                $linkData = $privateLinksData[$linkIndex];

                $link = new Link();
                $link->setName($linkData['name']);
                $link->setUrl($linkData['url']);
                $link->setProjectPrivateInformations($projectPrivateInformations);
                $manager->persist($link);
            }

            // Invitation for the project
            if (rand(0, 1)) {
                $message = $invitationsData[array_rand($invitationsData)];
                $projectUsers = $project->getUsers()->toArray();
                $sender = $projectUsers[array_rand($projectUsers)];

                $invitation = new Invitation();
                $invitation->setMessage($message);
                $invitation->setProject($project);
                $invitation->setSender($sender);

                $numberOfReceivers = rand(1, 3);
                $receivers = array_rand($userInstances, $numberOfReceivers);
                if (!is_array($receivers)) $receivers = [$receivers];

                foreach ($receivers as $receiverIndex) {
                    $receiver = $userInstances[$receiverIndex];
                    if ($receiver !== $sender) {
                        $invitation->addReceiver($receiver);
                    }
                }

                $manager->persist($invitation);
            }

            $manager->persist($project);
            $projectInstances[] = $project;
        }

        // Associate Groups and Comments to Users
        foreach ($userInstances as $user) {
            $numberOfGroups = rand(1, 3);
            $groupsForUser = array_rand($groupsData, $numberOfGroups);
            if (!is_array($groupsForUser)) $groupsForUser = [$groupsForUser];

            // Groups
            $groupInstances = [];
            foreach ($groupsForUser as $groupIndex) {
                $group = new Group();
                $group->setName($groupsData[$groupIndex]);
                $group->setOwner($user);
                $manager->persist($group);
                $groupInstances[] = $group;
            }

            $userProjects = $user->getProjects();
            foreach ($userProjects as $project) {
                $randomGroup = $groupInstances[array_rand($groupInstances)];
                $randomGroup->addProject($project);
                $manager->persist($randomGroup);
            }

            // Comments
            $numberOfComments = rand(0, count($commentsData));
            if ($numberOfComments > 0) {
                $commentsForUser = array_rand($commentsData, $numberOfComments);
                if (!is_array($commentsForUser)) $commentsForUser = [$commentsForUser];

                foreach ($commentsForUser as $commentIndex) {
                    $comment = new Comment();
                    $comment->setContent($commentsData[$commentIndex]);
                    $comment->setAuthor($user);

                    $randomProject = $projectInstances[array_rand($projectInstances)];
                    random_int(0, 1)
                        ? $comment->setProjectPublicInformations($randomProject->getPublicInformations())
                        : $comment->setProjectPrivateInformations($randomProject->getPrivateInformations());

                    $manager->persist($comment);
                }
            }
        }

        $manager->flush();
    }
}
