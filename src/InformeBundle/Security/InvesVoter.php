<?php
namespace InformeBundle\Security;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;
use InformeBundle\Entity\Investigacion;
use InformeBundle\Entity\Estudiantes;
use InformeBundle\Entity\Plan;
use InformeBundle\Entity\Salidas;
use InformeBundle\Entity\Proyectos;
use InformeBundle\Entity\Eventos;
use InformeBundle\Entity\Cursos;
use InformeBundle\Entity\Posdoc;
use InformeBundle\Entity\User;
use InformeBundle\Entity\Tecnico;
use InformeBundle\Entity\Informe;
use InformeBundle\Entity\Otros;



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
        if (!$subject instanceof Investigacion &&
            !$subject instanceof Estudiantes &&
            !$subject instanceof Otros &&
            !$subject instanceof Cursos &&
            !$subject instanceof Eventos &&
            !$subject instanceof Proyectos &&
            !$subject instanceof Salidas &&
            !$subject instanceof Posdoc &&
            !$subject instanceof Tecnico &&
            !$subject instanceof Informe &&
            !$subject instanceof Plan

        ) {
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
        if ($post instanceof Plan) {
            if ($user->getAcademico() === $post->getAcademico() ){
                return true;
            }

            if ( $user->getAcademico() === $post->getInforme()->getAcademico() ){
                return true;
            }

        }



        //  if they can edit, they can view
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

        if ($post instanceof Plan){
            if ($user->getAcademico() === $post->getAcademico() ){
                return true;
            }

        }

        if ( $user->getAcademico() === $post->getInforme()->getAcademico() ){
            if ( $user->getAcademico() === $post->getInforme()->getAcademico() ){
                return true;
            }
        }




    }


}