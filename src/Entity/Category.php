<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="\App\Entity\Idea", mappedBy="category")
     */
    private $ideas;


    public function __construct()
    {
        $this->ideas = new ArrayCollection();
    }


    /**
     * @return ArrayCollection
     */
    public function getIdeas(): ArrayCollection
    {
        return $this->ideas;
    }

    /**
     * @param ArrayCollection $ideas
     */
    public function setIdeas(ArrayCollection $ideas): void
    {
        $this->ideas = $ideas;
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
