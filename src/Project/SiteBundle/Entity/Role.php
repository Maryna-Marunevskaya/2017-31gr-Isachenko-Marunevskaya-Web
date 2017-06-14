<?php
namespace Project\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;

use Symfony\Component\Security\Core\Role\RoleInterface;

/**
*@ORM\Entity(repositoryClass="Project\SiteBundle\Entity\Repository\RoleRepository")
*@ORM\Table(name="role")
*@ORM\HasLifecycleCallbacks
*@UniqueEntity(
*   fields={"role"},
*   message="Название роли должно быть уникальным."
*)
*@UniqueEntity(
*   fields={"display"},
*   message="Отображаемое название роли должно быть уникальным."
*)
*/
class Role implements RoleInterface
{
    /**
    *@ORM\Id
    *@ORM\Column(name="id", type="integer")
    *@ORM\GeneratedValue(strategy="AUTO")
    **/
    protected $id;

    /**
    *@ORM\Column(name="role", type="string", nullable=false, unique=true)
    **/
    protected $role;

    /**
    *@ORM\Column(name="display", type="string", nullable=false, unique=true)
    **/
    protected $display;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('role', new NotBlank());
        $metadata->addPropertyConstraint('display', new NotBlank());
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
     * Set role
     *
     * @param string $role
     *
     * @return Role
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
     * Set display
     *
     * @param string $display
     *
     * @return Role
     */
    public function setDisplay($display)
    {
        $this->display = $display;

        return $this;
    }

    /**
     * Get display
     *
     * @return string
     */
    public function getDisplay()
    {
        return $this->display;
    }
}
