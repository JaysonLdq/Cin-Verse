<?php

namespace App\DataFixtures;

use App\Entity\Age;
use App\Entity\FilmSerie;
use App\Entity\Genre;
use App\Entity\Note;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    //propriété pour encoder le mdp 
    private $encoder;

    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager): void
    {
        //on appelle les méthodes pour générer les données
        $this->loadUsers($manager);
        $this->loadMovies($manager);
        $this->loadGenres($manager);
        $this->loadNote($manager);
        $this->loadAge($manager);
        //on exécute les requêtes
       

        $manager->flush();
    }

    /**
     * méthode pour générer des utilisateurs
     * @param ObjectManager $manager
     * @return void
     */
    public function loadUsers(ObjectManager $manager): void
    {
        //on crée un tableau avec les infos des users
        $array_user = [
            [
                'email' => 'admin@admin.com', 
                'password'=>'admin',
                'roles' => ['ROLE_ADMIN']
            
            ],
            [
                'email' => 'user@user.com',
                'password' => 'user',
                'roles' => ['ROLE_USER']
            ]
        ];

        //on va boucler sur le tableau pour créer les users
        foreach($array_user as $key => $value)
        {
            //on instancie un user
            $user = new User(); 
            $user->setEmail($value['email']);
            $user->setPassword($this->encoder->hashPassword($user, $value['password']));
            $user->setRoles($value['roles']);
            //on persiste les données
            $manager->persist($user);
        }
    }

    /**
     * Méthode pour générer des films
     * @param ObjectManager $manager
     * @return void
     */
    public function loadMovies(ObjectManager $manager): void{
        $array_movies = [
        ['title'=> 'You', 'imagePath' => 'You.png'],
        ['title'=> 'Squid Game', 'imagePath' => 'squidGame.png'],
        ['title'=> 'Men in black', 'imagePath' => 'menInBlack.png'],
        ['title'=> 'Iron Man', 'imagePath' => 'ironMan.png'],
        ['title'=> 'One piece', 'imagePath' => 'Op.png']];
        //on boucle sur le tableau pour créer les consoles
        foreach($array_movies as $key => $value){
            //on instancie une console
            $movies = new FilmSerie();
            $movies->setTitle($value['title']);
            $movies->setDescription('Synopsis : ');
            $movies->setReleaseDate(new \DateTime());
            $movies->setImagePath('imagePath');
            $movies->setDuration(120);
            $movies->setLanguage('français, anglais, espagnol, italien, allemand, chinois, japonais');
            //on persiste les données
            $manager->persist($movies);
            //on définit une référence pour pouvoir faire nos relations
            $this->addReference('movies_'.$key + 1, $movies);
        }

    }

    /**
     * Méthode pour générer les genres
     * @param ObjectManager $manager
     * @return void
     */

    public function loadGenres(ObjectManager $manager): void{
        $array_genres = ['Action', 'Aventure', 'Comédie', 'Drame', 'Fantastique', 'Horreur', 'Science-fiction', 'Thriller'];
        //on boucle sur le tableau pour créer les genres
        foreach($array_genres as $key => $value){
            //on instancie un genre
            $genre = new Genre();
            $genre->setLabel($value);
            //on persiste les données
            $manager->persist($genre);
            //on définit une référence pour pouvoir faire nos relations
            $this->addReference('genre_'.$key + 1, $genre);
        }
    }

    /**
     * méthode qui genere un nombre aléatoire entre 10 et 20
     * @return int
     */
    public function randomNote():int{
        return rand(10, 20);
    }

    /**
     * Méthode pour générer les notes
     * @param ObjectManager $manager
     * @return void
     */
    public function loadNote(ObjectManager $manager):void{
        //on va utiliser une boucle for pour générer les 14 notes
        for($i=1; $i <=5; $i++){
         //on instancie une note
         $note = new Note();
         $note->setNote($this->randomNote());
         $manager->persist($note);
         //on définit une référence pour pouvoir faire nos relations
         $this->addReference('note_'.$i, $note);
        }
     }

     public function loadAge(ObjectManager $manager):void{
        $array_age = ['Tous publics', 'Déconseillé aux moins de 10 ans', 'Déconseillé aux moins de 12 ans', 'Déconseillé aux moins de 16 ans', 'Déconseillé aux moins de 18 ans'];
        //on boucle sur le tableau pour créer les genres
        foreach($array_age as $key => $value){
            //on instancie un genre
            $age = new Age();
            $age->setLabel($value);
            //on persiste les données
            $manager->persist($age);
            //on définit une référence pour pouvoir faire nos relations
            $this->addReference('age_'.$key + 1, $age);
        }
 
    }
}