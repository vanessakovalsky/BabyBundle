<?php

namespace BabyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tournoi
 *
 * @ORM\Table(name="tournoi")
 * @ORM\Entity(repositoryClass="BabyBundle\Repository\TournoiRepository")
 */
class Tournoi
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_tournoi", type="datetime")
     */
    private $dateTournoi;

    /**
     * @var int
     *
     * @ORM\Column(name="nombre_equipes", type="integer")
     */
    private $nombreEquipes;

   /**
    * @ORM\ManyToMany(targetEntity="BabyBundle\Entity\Team")
    *
    */
    private $tournamentTeams;

    /**
     * @ORM\OneToMany(targetEntity="BabyBundle\Entity\Game", mappedBy="tournament")
     *
     */ 
    private $games;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Tournoi
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set dateTournoi
     *
     * @param \DateTime $dateTournoi
     *
     * @return Tournoi
     */
    public function setDateTournoi($dateTournoi)
    {
        $this->dateTournoi = $dateTournoi;

        return $this;
    }

    /**
     * Get dateTournoi
     *
     * @return \DateTime
     */
    public function getDateTournoi()
    {
        return $this->dateTournoi;
    }

    /**
     * Set nombreEquipes
     *
     * @param integer $nombreEquipes
     *
     * @return Tournoi
     */
    public function setNombreEquipes($nombreEquipes)
    {
        $this->nombreEquipes = $nombreEquipes;

        return $this;
    }

    /**
     * Get nombreEquipes
     *
     * @return int
     */
    public function getNombreEquipes()
    {
        return $this->nombreEquipes;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tournamentTeams = new \Doctrine\Common\Collections\ArrayCollection();
        $this->games = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add tournamentTeam
     *
     * @param \BabyBundle\Entity\Team $tournamentTeam
     *
     * @return Tournoi
     */
    public function addTournamentTeam(\BabyBundle\Entity\Team $tournamentTeam)
    {
        $this->tournamentTeams[] = $tournamentTeam;

        return $this;
    }

    /**
     * Remove tournamentTeam
     *
     * @param \BabyBundle\Entity\Team $tournamentTeam
     */
    public function removeTournamentTeam(\BabyBundle\Entity\Team $tournamentTeam)
    {
        $this->tournamentTeams->removeElement($tournamentTeam);
    }

    /**
     * Get tournamentTeams
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTournamentTeams()
    {
        return $this->tournamentTeams;
    }

    /**
     * Add game
     *
     * @param \BabyBundle\Entity\Game $game
     *
     * @return Tournoi
     */
    public function addGame(\BabyBundle\Entity\Game $game)
    {
        $this->games[] = $game;

        return $this;
    }

    /**
     * Remove game
     *
     * @param \BabyBundle\Entity\Game $game
     */
    public function removeGame(\BabyBundle\Entity\Game $game)
    {
        $this->games->removeElement($game);
    }

    /**
     * Get games
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGames()
    {
        return $this->games;
    }
	
    public function __toString()
    {
        return $this->name;
    }
}
