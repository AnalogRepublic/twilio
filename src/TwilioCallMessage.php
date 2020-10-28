<?php

namespace NotificationChannels\Twilio;

use NotificationChannels\Twilio\Exceptions\InvalidConfigException;
use Twilio\TwiML\VoiceResponse;

class TwilioCallMessage extends TwilioMessage
{
    const STATUS_CANCELED = 'canceled';
    const STATUS_COMPLETED = 'completed';

    public const TYPE_URL = 'url';
    public const TYPE_TWIML = 'twiml';

    /**
     * @var int
     */
    public $contentType = null;

    /**
     * @var null|string
     */
    public $method = null;

    /**
     * @var null|string
     */
    public $status = null;

    /**
     * @var null|string
     */
    public $fallbackUrl = null;

    /**
     * @var null|string
     */
    public $fallbackMethod = null;

    /**
     * Set the message url.
     *
     * @param  string $url
     * @return $this
     */
    public function url($url)
    {
        $this->contentType(self::TYPE_URL);
        $this->content = $url;

        return $this;
    }

    /**
     * Set the message twiml.
     *
     * @param  string $twiml
     * @return $this
     */
    public function twiml(VoiceResponse $response): self
    {
        $this->contentType(self::TYPE_TWIML);
        $this->content = (string) $response;

        return $this;
    }

    protected function contentType(string $contentType)
    {
        if (
            ! is_null($this->contentType)
            && $contentType !== $this->contentType
        ) {
            InvalidConfigException::multipleContentTypes();
        }

        $this->contentType = $contentType;
    }

    /**
     * Set the message url request method.
     *
     * @param  string $method
     * @return $this
     */
    public function method($method)
    {
        $this->method = $method;

        return $this;
    }

    /**
     * Set the status for the current calls.
     *
     * @param  string $status
     * @return $this
     */
    public function status($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Set the fallback url.
     *
     * @param string $fallbackUrl
     * @return $this
     */
    public function fallbackUrl($fallbackUrl)
    {
        $this->fallbackUrl = $fallbackUrl;

        return $this;
    }

    /**
     * Set the fallback url request method.
     *
     * @param string $fallbackMethod
     * @return $this
     */
    public function fallbackMethod($fallbackMethod)
    {
        $this->fallbackMethod = $fallbackMethod;

        return $this;
    }
}
