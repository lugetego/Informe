<?php
namespace InformeBundle\Security;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;
use InformeBundle\Entity\Investigacion;
use InformeBundle\Entity\Estudiantes;
use InformeBundle\Entity\Plan;
use InformeBundle\Entity\User;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;

class InvesVoter extends  Voter
{

    private $decisionManager;

    public function __construct(AccessDecisionManagerInterface $decisionManager)
    {
        $this->decisionManager = $decisionManager;
    }

    const VIEW = 'view';
    const EDIT = 'edit';


    protected function supports($attribute, $subject)
    {
        // if the attribute isn't one we support, return false
        if (!in_array($attribute, array(self::VIEW, self::EDIT))) {
            return false;
        }

        // only vote on Post objects inside this voter
        if (!$subject instanceof Investigacion && !$subject instanceof Estudiantes && !$subject instanceof Plan) {
            return false;
        }



        return true;
    }


    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {


        // ROLE_SUPER_ADMIN can do anything! The power!
        if ($this->decisionManager->decide($token, array('ROLE_SUPER_ADMIN'))) {
            return true;
        }

        $user = $token->getUser();

        if (!$user instanceof User) {
            // the user must be logged in; if not, deny access
            return false;
        }

        // you know $subject is a Post object, thanks to supports

        $post = $subject;

        switch ($attribute) {
            case self::VIEW:
                return $this->canView($post, $user);
            case self::EDIT:
                return $this->canEdit($post, $user);
        }

        throw new \LogicException('This code should not be reached!');
    }


    private function canView($post, User $user)
    {


        if ($user->getAcademico()->getId() === $post->getAcademico()->getId()) {

            return true;
        }

        // if they can edit, they can view
        if ($this->canEdit($post, $user)) {
            return true;
        }



        // the Post object could have, for example, a method isPrivate()
        // that checks a boolean $private property
       //return !$post->isPrivate();
    }

    private function canEdit( $post, User $user)
    {
        // this assumes that the data object has a getOwner() method
        // to get the entity of the user who owns this data object

        if ($user->getAcademico()->getId() === $post->getAcademico()->getId()) {

            return true;
        }


    }


}