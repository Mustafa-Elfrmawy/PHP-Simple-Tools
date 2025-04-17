<?php

declare(strict_types=1);

class Curl
{
    protected $ch;
    protected $response;
    protected $header;
    protected $status;
    protected $error;

    public function __construct()
    {
        $this->ch = curl_init();
    }

    public function curl(string $method, string $url,  array $headers, array $body = null)
    {
        $options = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => true,
            CURLOPT_CUSTOMREQUEST => strtoupper($method),
        ];

        if (!empty($headers)) {
            if (array_values($headers) === $headers) {
                $options[CURLOPT_HTTPHEADER] = $headers;
            } else {
                $formattedHeaders = [];
                foreach ($headers as $key => $value) {
                    $formattedHeaders[] = "$key: $value";
                }
                $options[CURLOPT_HTTPHEADER] = $formattedHeaders;
            }
        }


        if (in_array(strtoupper($method), ['POST', 'PATCH', 'PUT']) && $body !== null) {
            if (in_array("Content-Type: application/json", $headers)) {
                if ($body !== null) {
                    $body = json_encode($body);
                }
            } else {
                if ($body !== null) {
                    $body = http_build_query($body);
                }
            }
            $options[CURLOPT_POSTFIELDS] = $body;
        }
        curl_setopt_array($this->ch, $options);

        $this->execute();


        if (curl_errno($this->ch)) {
            $this->error = curl_error($this->ch);
            curl_close($this->ch);
            return "CURL Error: " . $this->error;
        }


        if ($this->status < 200 || $this->status >= 300)  {
            curl_close($this->ch);
        return json_decode($this->response , true);
        }

        curl_close($this->ch);

        return json_decode($this->response , true);
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getHeader()
    {
        return $this->header;
    }

    private function execute()
    {
        $this->response = curl_exec($this->ch);
        if($this->response == false) {
            return $this->response;
        }
        $this->status = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);
        $header_size = curl_getinfo($this->ch, CURLINFO_HEADER_SIZE);
        $this->header = substr($this->response, 0, $header_size);
        $this->response = substr($this->response, $header_size);
    }
}
