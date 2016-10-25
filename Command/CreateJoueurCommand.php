<?php

namespace BabyBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Question\Question;

class CreateJoueurCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        //Nom de la commande
        $this->setName('app:create-joueur');
        //Description de la commande
        $this->setDescription('Création d\'une entité joueur');
        //Explication de la commande
        $this->setHelp('Cette commande vous permet de créer directement une entité joueur');
        //Ajout d'option d'entrée dans la commande
        $this->addArgument('username', InputArgument::REQUIRED, 'le nom du joueur');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
      //Affiche un simple message;
      $output->writeln('<bg=red>Message dans la console</>');
      //Message sur plusieurs lignes
      $output->writeln(array('Création d un joueur','Deuxième ligne de la création'));

      //Demande de confirmation
      $helper = $this->getHelper('question');
      $question = new ConfirmationQuestion('Continuer la création ?', false);

      if (!$helper->ask($input, $output, $question)) {
          return;
      }

      $question2 = new Question('Merci d\'entrer le nom du bundle', 'BabyBundle');
      //On rajoute une validation sur la réponse
      $question2->setValidator(function ($answer) {
              if ('Bundle' !== substr($answer, -6)) {
                  throw new \RuntimeException(
                      'Le nom du bundle doit être préfixé par \'Bundle\''
                  );
              }
              return $answer;
          });

      $bundle = $helper->ask($input, $output, $question2);

      //Accès au services du container
      $joueurManager = $this->getContainer()->get('baby.logger');
      $joueurManager->writeLog('Le joueur'.$input->getArgument('username'). 'a bien été créé');
      
      $output->writeln('Le joueur '.$input->getArgument('username'). ' a bien été créé');

    }
}
