<?php
//src/Project/SiteBundle/Entity/User.php
namespace Project\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
* @ORM\Entity(repositoryClass="Project\SiteBundle\Entity\Repository\UserRepository")
* @ORM\Table(name="user")
* @ORM\HasLifecycleCallbacks
* @UniqueEntity(
*     fields={"login"},
*     message="Логин должен быть уникальным."
* )
*/
class User
{
    /**
    * @ORM\Id
    * @ORM\Column(name="id", type="integer")
    * @ORM\GeneratedValue(strategy="AUTO")
    **/
    protected $id;
    /**
    * @ORM\Column(name="login", type="string", unique=true, nullable=false)
    **/
    protected $login;
    /**
    * @ORM\Column(name="password", type="string", nullable=false)
    **/
    protected $password;
    /**
    * @ORM\Column(name="role", type="string", nullable=false)
    **/
    protected $role;
    /**
    * @ORM\OneToMany(targetEntity="Comment", mappedBy="user")
    */
	protected $comments;
    /**
    * @ORM\OneToMany(targetEntity="TouristInTrip", mappedBy="tourist")
    */
    protected $trips;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('login', new NotBlank());
        $metadata->addPropertyConstraint('password', new NotBlank());
        $metadata->addPropertyConstraint('role', new NotBlank());
     }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->trips = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set login
     *
     * @param string $login
     *
     * @return User
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set role
     *
     * @param string $role
     *
     * @return User
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Add comment
     *
     * @param \Project\SiteBundle\Entity\Comment $comment
     *
     * @return User
     */
    public function addComment(\Project\SiteBundle\Entity\Comment $comment)
    {
        $this->comments[] = $comment;

        return $this;
    }

    /**
     * Remove comment
     *
     * @param \Project\SiteBundle\Entity\Comment $comment
     */
    public function removeComment(\Project\SiteBundle\Entity\Comment $comment)
    {
        $this->comments->removeElement($comment);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Add trip
     *
     * @param \Project\SiteBundle\Entity\TouristInTrip $trip
     *
     * @return User
     */
    public function addTrip(\Project\SiteBundle\Entity\TouristInTrip $trip)
    {
        $this->trips[] = $trip;

        return $this;
    }

    /**
     * Remove trip
     *
     * @param \Project\SiteBundle\Entity\TouristInTrip $trip
     */
    public function removeTrip(\Project\SiteBundle\Entity\TouristInTrip $trip)
    {
        $this->trips->removeElement($trip);
    }

    /**
     * Get trips
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTrips()
    {
        return $this->trips;
    }
}
