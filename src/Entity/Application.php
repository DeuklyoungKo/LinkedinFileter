<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ApplicationRepository")
 */
class Application
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Job", inversedBy="applications")
     */
    private $job;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $comment;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $state;

    public function __construct()
    {
        $this->job = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Job[]
     */
    public function getJob(): Collection
    {
        return $this->job;
    }

    public function addJob(Job $job): self
    {
        if (!$this->job->contains($job)) {
            $this->job[] = $job;
        }

        return $this;
    }

    public function removeJob(Job $job): self
    {
        if ($this->job->contains($job)) {
            $this->job->removeElement($job);
        }

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }
}
