<?php

namespace App\Entity;

use App\lib\ConvertDateFromAgo;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\JobRepository")
 */
class Job
{
    use TimestampableEntity;

    const JOB_LIST_FILTER_LOCATION = ['Berlin','Munich','Cologne','Frankfurt'];
    const JOB_APPLY_STATE = ['notApply','trying','pending','failed','interviewCall','secondInterview','skillInterview'];
    const JOB_SOURCE = ['Linkedin','Xing','indeed'];

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $company;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $location;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=400, nullable=true)
     */
    private $link;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank()
     */
    private $publishedAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     */
    private $jobId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $applyState = "notApply";

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $applyAt;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $etc;


    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $source;



    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(string $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getpublishedAt(): ?\DateTimeInterface
    {
        return $this->publishedAt;
    }

    public function setpublishedAt(\DateTimeInterface $publishedAt): self
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    public function setpublishedatAfterCheckAgo($publishedAt){
        if (strpos($publishedAt,'ago')) {
            $convertDateFrmAgo = new ConvertDateFromAgo();
            $this->setpublishedAt($convertDateFrmAgo->convertDate($publishedAt));
        }else if (strpos($publishedAt,'Just now') ) {
            $this->setpublishedAt(date("Y-m-d H:i:s"));
        }else{
            $this->setpublishedAt($publishedAt);
        }
    }

    public function getJobId(): ?string
    {
        return $this->jobId;
    }

    public function setJobId(?int $jobId): self
    {
        $this->jobId = $jobId;

        return $this;
    }

    public function getApplyState(): ?string
    {
        return $this->applyState;
    }

    public function setApplyState(?string $applyState): self
    {
        $this->applyState = $applyState;

        return $this;
    }

    public function getApplyAt(): ?\DateTimeInterface
    {
        return $this->applyAt;
    }

    public function setApplyAt(?\DateTimeInterface $applyAt): self
    {
        $this->applyAt = $applyAt;

        return $this;
    }

    public function getEtc(): ?string
    {
        return $this->etc;
    }

    public function setEtc(?string $etc): self
    {
        $this->etc = $etc;

        return $this;
    }

    public function getSource(): ?string
    {
        return $this->source;
    }

    public function setSource(?string $source): self
    {
        $this->source = $source;

        return $this;
    }

}