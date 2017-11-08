<?php

namespace Kreait\Firebase\Exception;

use GuzzleHttp\Exception\RequestException;
use Kreait\Firebase\Exception\Auth\CredentialsMismatch;
use Kreait\Firebase\Exception\Auth\EmailExists;
use Kreait\Firebase\Exception\Auth\EmailNotFound;
use Kreait\Firebase\Exception\Auth\InvalidCustomToken;
use Kreait\Firebase\Exception\Auth\InvalidPassword;
use Kreait\Firebase\Exception\Auth\MissingPassword;
use Kreait\Firebase\Exception\Auth\OperationNotAllowed;
use Kreait\Firebase\Exception\Auth\UserDisabled;
use Kreait\Firebase\Exception\Auth\WeakPassword;
use Kreait\Firebase\Util\JSON;

class AuthException extends \RuntimeException implements FirebaseException
{
    public static $errors = [
        CredentialsMismatch::IDENTIFER => CredentialsMismatch::class,
        EmailExists::IDENTIFIER => EmailExists::class,
        EmailNotFound::IDENTIFIER => EmailNotFound::class,
        InvalidCustomToken::IDENTIFER => InvalidCustomToken::class,
        InvalidPassword::IDENTIFIER => InvalidPassword::class,
        MissingPassword::IDENTIFIER => MissingPassword::class,
        OperationNotAllowed::IDENTIFER => OperationNotAllowed::class,
        UserDisabled::IDENTIFER => UserDisabled::class,
        WeakPassword::IDENTIFIER => WeakPassword::class,
    ];

    /**
     * @param RequestException $e
     *
     * @return self
     */
    public static function fromRequestException(RequestException $e): self
    {
        $message = $e->getMessage();

        if (!($response = $e->getResponse())) {
            return new static($message, $e->getCode(), $e);
        }

        try {
            $errors = JSON::decode((string) $response->getBody(), true);
        } catch (\InvalidArgumentException $jsonDecodeException) {
            return new static('Invalid JSON: The API returned an invalid JSON string.', $e->getCode(), $e);
        }

        $message = $errors['error']['message'] ?? $message;

        $candidates = array_filter(array_map(function ($key, $class) use ($message, $e) {
            return false !== stripos($message, $key)
                ? new $class($e->getCode(), $e)
                : null;
        }, array_keys(self::$errors), self::$errors));

        $fallback = new static(sprintf('Unknown error: "%s"', $message), $e->getCode(), $e);

        return array_shift($candidates) ?? $fallback;
    }
}
