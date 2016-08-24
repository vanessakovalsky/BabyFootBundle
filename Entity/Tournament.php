<?php

namespace BabyFootBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Tournament
 *
 * @ORM\Table(name="tournament")
 * @ORM\Entity(repositoryClass="BabyFootBundle\Repository\TournamentRepository")
 */
class Tournament
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
     * @var \DateTime
     *
     * @ORM\Column(name="begining_date", type="datetime")
     */
    private $beginingDate;
    
    /**
     * @ORM\ManyToMany(targetEntity="Team")
     */
    private $teams;

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
     * Set beginingDate
     *
     * @param \DateTime $beginingDate
     *
     * @return Tournament
     */
    public function setBeginingDate($beginingDate)
    {
        $this->beginingDate = $beginingDate;

        return $this;
    }

    /**
     * Get beginingDate
     *
     * @return \DateTime
     */
    public function getBeginingDate()
    {
        return $this->beginingDate;
    }
   
    public function __construct()
    {
        $this->teams = new ArrayCollection();
    }


    /**
     * Add team
     *
     * @param \BabyFootBundle\Entity\Team $team
     *
     * @return Tournament
     */
    public function addTeam(\BabyFootBundle\Entity\Team $team)
    {
        $this->teams[] = $team;

        return $this;
    }

    /**
     * Remove team
     *
     * @param \BabyFootBundle\Entity\Team $team
     */
    public function removeTeam(\BabyFootBundle\Entity\Team $team)
    {
        $this->teams->removeElement($team);
    }

    /**
     * Get teams
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTeams()
    {
        return $this->teams;
    }
    /**
     * Convert object to string
     */
     public function __toString()
    {
  return 'toto';  
//    return $this->getTeams()->getValues()->getName();
    }
}
