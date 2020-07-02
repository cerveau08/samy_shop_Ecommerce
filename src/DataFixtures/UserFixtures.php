<?php

namespace App\DataFixtures;

use App\Entity\Profil;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserFixtures extends Fixture
{
  
    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    
    public function load(ObjectManager $manager)
    {
        $roleadminsysteme=new Profil();
        $roleadminsysteme->setLibele('Admin_Systeme');
        $manager->persist($roleadminsysteme);
        
        $roleadmin=new Profil();
        $roleadmin->setLibele('Admin');
        $manager->persist($roleadmin);
        
        $roleuser=new Profil();
        $roleuser->setLibele('User');
        $manager->persist($roleuser);
        
        $adminsysteme = new User();
        $password = $this->encoder->encodePassword($adminsysteme, 'admin');
        $adminsysteme->setUsername('malick')
             ->setPassword($password)
             ->setPrenom('Malick')
             ->setNom('Coly')
             ->setTelephone('784059330')
             ->setAdresse('Parcelles Assainies, Unite 19, Villa 107')
             ->setEmail('malickcoly342@gmail.com')
             ->setIsActive(true)
             ->setProfil($roleadminsysteme);
        $manager->persist($adminsysteme);

        $manager->flush();
}  
}
