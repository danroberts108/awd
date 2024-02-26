<?php

namespace App\Security;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;

class APIKeyAuthenticator extends AbstractAuthenticator
{
    public function __construct(private EntityManagerInterface $entityManager, private AuthenticationUtils $authenticationUtils)
    {
    }

    public function supports(Request $request): ?bool
    {
        return $request->headers->has('X-AUTH-TOKEN');
    }

    public function authenticate(Request $request): Passport
    {
        $apiToken = $request->headers->get('X-AUTH-TOKEN');
        if (null == $apiToken) {
            throw new CustomUserMessageAuthenticationException('No API Token provided.');
        }

        // TODO: Implement user finding by api key

        $userid = null;

        return new SelfValidatingPassport(new UserBadge($userid));
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        $data = [
            'message' => strtr($exception->getMessageKey(), $exception->getMessageData())
        ];

        return new JsonResponse($data, Response::HTTP_UNAUTHORIZED);
    }

    //    public function start(Request $request, AuthenticationException $authException = null): Response
    //    {
    //        /*
    //         * If you would like this class to control what happens when an anonymous user accesses a
    //         * protected page (e.g. redirect to /login), uncomment this method and make this class
    //         * implement Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface.
    //         *
    //         * For more details, see https://symfony.com/doc/current/security/experimental_authenticators.html#configuring-the-authentication-entry-point
    //         */
    //    }
}
