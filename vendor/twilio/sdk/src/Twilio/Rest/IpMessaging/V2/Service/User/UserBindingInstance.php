<?php

/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Twilio - Ip_messaging
 * This is the public Twilio REST API.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */


namespace Twilio\Rest\IpMessaging\V2\Service\User;

use Twilio\Exceptions\TwilioException;
use Twilio\InstanceResource;
use Twilio\Values;
use Twilio\Version;
use Twilio\Deserialize;


/**
 * @property string|null $sid
 * @property string|null $accountSid
 * @property string|null $serviceSid
 * @property \DateTime|null $dateCreated
 * @property \DateTime|null $dateUpdated
 * @property string|null $endpoint
 * @property string|null $identity
 * @property string|null $userSid
 * @property string|null $credentialSid
 * @property string $bindingType
 * @property string[]|null $messageTypes
 * @property string|null $url
 */
class UserBindingInstance extends InstanceResource
{
    /**
     * Initialize the UserBindingInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $serviceSid 
     * @param string $userSid 
     * @param string $sid 
     */
    public function __construct(Version $version, array $payload, string $serviceSid, string $userSid, string $sid = null)
    {
        parent::__construct($version);

        // Marshaled Properties
        $this->properties = [
            'sid' => Values::array_get($payload, 'sid'),
            'accountSid' => Values::array_get($payload, 'account_sid'),
            'serviceSid' => Values::array_get($payload, 'service_sid'),
            'dateCreated' => Deserialize::dateTime(Values::array_get($payload, 'date_created')),
            'dateUpdated' => Deserialize::dateTime(Values::array_get($payload, 'date_updated')),
            'endpoint' => Values::array_get($payload, 'endpoint'),
            'identity' => Values::array_get($payload, 'identity'),
            'userSid' => Values::array_get($payload, 'user_sid'),
            'credentialSid' => Values::array_get($payload, 'credential_sid'),
            'bindingType' => Values::array_get($payload, 'binding_type'),
            'messageTypes' => Values::array_get($payload, 'message_types'),
            'url' => Values::array_get($payload, 'url'),
        ];

        $this->solution = ['serviceSid' => $serviceSid, 'userSid' => $userSid, 'sid' => $sid ?: $this->properties['sid'], ];
    }

    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return UserBindingContext Context for this UserBindingInstance
     */
    protected function proxy(): UserBindingContext
    {
        if (!$this->context) {
            $this->context = new UserBindingContext(
                $this->version,
                $this->solution['serviceSid'],
                $this->solution['userSid'],
                $this->solution['sid']
            );
        }

        return $this->context;
    }

    /**
     * Delete the UserBindingInstance
     *
     * @return bool True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete(): bool
    {

        return $this->proxy()->delete();
    }

    /**
     * Fetch the UserBindingInstance
     *
     * @return UserBindingInstance Fetched UserBindingInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch(): UserBindingInstance
    {

        return $this->proxy()->fetch();
    }

    /**
     * Magic getter to access properties
     *
     * @param string $name Property to access
     * @return mixed The requested property
     * @throws TwilioException For unknown properties
     */
    public function __get(string $name)
    {
        if (\array_key_exists($name, $this->properties)) {
            return $this->properties[$name];
        }

        if (\property_exists($this, '_' . $name)) {
            $method = 'get' . \ucfirst($name);
            return $this->$method();
        }

        throw new TwilioException('Unknown property: ' . $name);
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string
    {
        $context = [];
        foreach ($this->solution as $key => $value) {
            $context[] = "$key=$value";
        }
        return '[Twilio.IpMessaging.V2.UserBindingInstance ' . \implode(' ', $context) . ']';
    }
}
