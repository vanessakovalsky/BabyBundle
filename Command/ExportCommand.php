<?php

namespace BabyBundle\Command;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Question\Question;

class ExportCommand extends ContainerAwareCommand{
  public function configure(){
    $this
      ->setName('app:export-csv')
      ->setDescription('Exporter en CSV les données')
      ->setHelp('Ma super commande pour faire un batch qui tournera par cron toutes les nuits pour exporter mon fichier et le déposer sur le serveur que tu veux en FTP ????????')
      ->addArgument('filename', InputArgument::REQUIRED, 'Le nom du fichier exporté');
      //->addArgument('path', InputArgument::REQUIRED, 'Le chemin du fichier');
  }

  public function execute(InputInterface $input, OutputInterface $output){
    $style = new OutputFormatterStyle( 'white', 'magenta', array('blink','reverse'));
    $output->getFormatter()->setStyle('jb', $style);
    $output->writeln([
      '<jb>Export du fichier</jb>',
      ]
    );
    $helper = $this->getHelper('question');
    $question = new Question('Merci d\'indiquer le chemin pour enregistrer le fichier : ', 'var');
    $path = $helper->ask($input, $output, $question);

    $array_data= array(
      '1' => array('dupont', 'jean'),
      '2' => array('madame', 'vincent'),
    );
    //$path = $input->getArgument('path');
    $filename = $input->getArgument('filename');
    $exportManager = $this->getContainer()->get('baby.exportcsv');
    $file = $exportManager->saveCSV($array_data, $path, $filename);
    $progress = new ProgressBar($output, 5000);
    $progress->start();
    $compteur = 0;
    while($compteur++ < 5000){
      $progress->advance();
    }
    $progress->finish();
    $output->writeln('export terminé, regarder dans '.$path.' :)');
  }
}
