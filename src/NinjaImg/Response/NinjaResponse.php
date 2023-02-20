<?php

namespace NinjaImg\Response;

use Pecee\Http\HttpResponse;

class NinjaResponse
{

    protected string $domain;
    protected array $response;
    protected HttpResponse $httpResponse;

    public function __construct($domain, array $response)
    {
        $this->domain = $domain;
        $this->response = $response;
    }

    /**
     * Get the absolute url without scheme - most compatible.
     *
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->response['url'];
    }

    /**
     * Get the full absolute url.
     *
     * @return string
     */
    public function getUrlAbsolute(): string
    {
        return sprintf('https://%s%s', $this->domain, $this->getUrlRelative());
    }

    /**
     * @return string|null
     */
    public function getUrlRelative(): ?string
    {
        return $this->response['url_relative'];
    }

    /**
     * Get domain
     *
     * @return string
     */
    public function getDomain(): string
    {
        return $this->response['domain'];
    }

    /**
     * Get information about the file
     *
     * @return FileDetails
     */
    public function getFileDetails(): FileDetails
    {
        return new FileDetails($this->response['file_details']);
    }

    /**
     * Get response array
     * @return array
     */
    public function toArray(): array
    {
        return [
            'url' => $this->getUrl(),
            'url_absolute' => $this->getUrlAbsolute(),
            'url_relative' => $this->getUrlRelative(),
            'file_details' => $this->getFileDetails()->toArray(),
        ];
    }

    /**
     * Get http response
     *
     * @return HttpResponse
     */
    public function getHttpResponse(): HttpResponse
    {
        return $this->httpResponse;
    }

    /**
     * Set raw http response
     *
     * @param HttpResponse $response
     * @return static $this
     */
    public function setHttpResponse(HttpResponse $response): self
    {
        $this->httpResponse = $response;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string)$this->getUrl();
    }

}