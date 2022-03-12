<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields = {"Email"},message ="L'email que vous avez indiqué est déja utilisé !")
 */
class User implements UserInterface
{
     /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Assert\PositiveOrZero
     */
    private $CIN;


    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\Length(
     *      min = 2,
     *      max = 10,
     *      minMessage = "Votre Nom doit être au moins {{ limit }} characters long",
     *      maxMessage = "Votre Nom ne peut pas dépasser {{ limit }} characters"
     * )
     */
    private $UserName;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\NotBlank
     * @Assert\Positive
     * @Assert\Length(
     *      min = 4,
     *      max = 8,
     *      minMessage = "Votre Numero doit être au moins {{ limit }} characters long",
     *      maxMessage = "Votre Numero ne peut pas dépasser {{ limit }} characters"
     * )
     */
    private $Numero;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(message = "The email '{{ value }}' is not a valid email.",  )
     */
    private $Email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Adresse;
    
    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min = "8", minMessage="Votre mot de passe doit faire minimum 8 carractéres")
     */
    private $Password;

    /**
     *  @Assert\EqualTo(propertyPath="Password", message="Vous n'avez pas tapé le méme mot de passe")
     */
    public $confirm_password;

    public function __toString()
    {
        return (string) $this->CIN;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCIN(): ?int
    {
        return $this->CIN;
    }

    public function setCIN(int $CIN): self
    {
        $this->CIN = $CIN;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }


    public function getNumero(): ?int
    {
        return $this->Numero;
    }

    public function setNumero(?int $Numero): self
    {
        $this->Numero = $Numero;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(?string $Adresse): self
    {
        $this->Adresse = $Adresse;

        return $this;
    }

    /**
     * Get the value of Password
     */ 
    public function getPassword()
    {
        return $this->Password;
    }

    /**
     * Set the value of Password
     *
     * @return  self
     */ 
    public function setPassword($Password)
    {
        $this->Password = $Password;

        return $this;
    }

    /**
     * Get min = 2,
     */ 
    public function getUserName()
    {
        return $this->UserName;
    }

    /**
     * Set min = 2,
     *
     * @return  self
     */ 
    public function setUserName($UserName)
    {
        $this->UserName = $UserName;

        return $this;
    }

    public function eraseCredentials() {
        
    }
     public function getSalt() {
        
    }

    public function getRoles() {
        return['ROLE_USER'];
    }

    /**
     * @ORM\OneToMany(targetEntity=Reclamation::class, mappedBy="Client")
     */
    private $reclamations;

    /**
     * @ORM\OneToMany(targetEntity=PostLike::class, mappedBy="Client")
     */
    private $Likes;

    /**
     * @ORM\OneToMany(targetEntity=Post::class, mappedBy="Client")
     */
    private $posts;

    /**
     * @ORM\OneToMany(targetEntity=Commentaire::class, mappedBy="Client")
     */
    private $commentaires;

    public function __construct()
    {
        $this->reclamations = new ArrayCollection();
        $this->Likes = new ArrayCollection();
        $this->posts = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
    }

    /**
     * @return Collection<int, Reclamation>
     */
    public function getReclamations(): Collection
    {
        return $this->reclamations;
    }

    public function addReclamation(Reclamation $reclamation): self
    {
        if (!$this->reclamations->contains($reclamation)) {
            $this->reclamations[] = $reclamation;
            $reclamation->setClient($this);
        }

        return $this;
    }

    public function removeReclamation(Reclamation $reclamation): self
    {
        if ($this->reclamations->removeElement($reclamation)) {
            // set the owning side to null (unless already changed)
            if ($reclamation->getClient() === $this) {
                $reclamation->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PostLike>
     */
    public function getLikes(): Collection
    {
        return $this->Likes;
    }

    public function addLike(PostLike $like): self
    {
        if (!$this->Likes->contains($like)) {
            $this->Likes[] = $like;
            $like->setClient($this);
        }

        return $this;
    }

    public function removeLike(PostLike $like): self
    {
        if ($this->Likes->removeElement($like)) {
            // set the owning side to null (unless already changed)
            if ($like->getClient() === $this) {
                $like->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Post>
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(Post $post): self
    {
        if (!$this->posts->contains($post)) {
            $this->posts[] = $post;
            $post->setClient($this);
        }

        return $this;
    }

    public function removePost(Post $post): self
    {
        if ($this->posts->removeElement($post)) {
            // set the owning side to null (unless already changed)
            if ($post->getClient() === $this) {
                $post->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Commentaire[]
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setClient($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getClient() === $this) {
                $commentaire->setClient(null);
            }
        }

        return $this;
    }
}


