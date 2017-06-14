<?php
namespace Project\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;

use Symfony\Component\Security\Core\User\UserInterface;

use Project\SiteBundle\Entity\Trip;

/**
*@ORM\Entity(repositoryClass="Project\SiteBundle\Entity\Repository\UserRepository")
*@ORM\Table(name="user")
*@ORM\HasLifecycleCallbacks
*@UniqueEntity(
*     fields={"username"},
*     message="Логин должен быть уникальным."
* )
*/
class User implements UserInterface
{
    /**
    *@ORM\Id
    *@ORM\Column(name="id", type="integer")
    *@ORM\GeneratedValue(strategy="AUTO")
    **/
    protected $id;

    /**
    *@ORM\Column(name="username", type="string", unique=true, nullable=false)
    **/
    protected $username;

    /**
    *@ORM\Column(name="original_password", type="string")
    **/
    protected $original_password;

    /**
    *@ORM\Column(name="password", type="string")
    **/
    protected $password;

    /**
    *@ORM\Column(name="salt", type="string")
    **/
    protected $salt;

    /**
    *@ORM\ManyToOne(targetEntity="Role")
    *@ORM\JoinColumn(name="role_id", referencedColumnName="id", nullable=false)
    **/
    protected $role;

    /**
     *@ORM\ManyToMany(targetEntity="Role")
     *@ORM\JoinTable(name="users_roles",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")}
     *)
     **/
    protected $roles;

    /**
    *@ORM\OneToMany(targetEntity="Comment", mappedBy="user")
    *@ORM\OrderBy({"created" = "DESC"})
    */
	protected $comments;

    /**
    *@ORM\OneToMany(targetEntity="TouristInTrip", mappedBy="tourist")
    */
    protected $trips;

    public function isInTrip(Trip $tr){
        foreach($this->trips as $trip){
            if($trip->getTrip()->getId()==$tr->getId()){
                return true;
            }
        }
        return false;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('username', new NotBlank());
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->roles = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set originalPassword
     *
     * @param string $originalPassword
     *
     * @return User
     */
    public function setOriginalPassword($originalPassword)
    {
        $this->original_password = $originalPassword;

        return $this;
    }

    /**
     * Get originalPassword
     *
     * @return string
     */
    public function getOriginalPassword()
    {
        return $this->original_password;
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
     * Set salt
     *
     * @param string $salt
     *
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

     /**
     * Get salt
     *
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Add role
     *
     * @param \Project\SiteBundle\Entity\Role $role
     *
     * @return User
     */
    public function addRole(\Project\SiteBundle\Entity\Role $role)
    {
        $this->roles[] = $role;

        return $this;
    }

    /**
     * Remove role
     *
     * @param \Project\SiteBundle\Entity\Role $role
     */
    public function removeRole(\Project\SiteBundle\Entity\Role $role)
    {
        $this->roles->removeElement($role);
    }

    public function getRoles()
    {
        return $this->roles->toArray();
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

    public function eraseCredentials()
    {

    }

    /**
     * Set role
     *
     * @param \Project\SiteBundle\Entity\Role $role
     *
     * @return User
     */
    public function setRole(\Project\SiteBundle\Entity\Role $role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return \Project\SiteBundle\Entity\Role
     */
    public function getRole()
    {
        return $this->role;
    }
}
