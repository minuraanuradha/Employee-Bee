<?php

class AiService {
  private string $apiUrl;
  private string $apiKey;
  private ?string $caCert;

  public function __construct() {
    $config = require __DIR__ . '/../config/environment.php';
    // Use local AI model service URL instead of Hugging Face Space
    $this->apiUrl = 'http://localhost:7860/api/predict';
    $this->apiKey = $config['ai']['api_key'] ?? '';
    $this->caCert = $config['ai']['ca_cert'] ?? null;
  }

  /**
   * Calls the local AI model service endpoint (/api/predict/)
   * Returns ['ok'=>true,'data'=>array,'http'=>int] on success,
   * or ['ok'=>false,'error'=>string,'http'=>int,'raw'=>string(optional)] on failure
   */
  public function callAiModel(
    string $skills,
    string $education,
    string $current_role,
    float $experience_years,
    string $company_comment
  ): array {
    if (!$this->apiUrl) {
      return ['ok'=>false, 'error'=>'Missing api_url in config'];
    }

    // Payload must be {"data":[skills, education, current_role, experience_years, company_comment]}
    $payload = json_encode([
      "data" => [
        $skills,
        $education,
        $current_role,
        $experience_years,
        $company_comment
      ]
    ]);

    $headers = ['Content-Type: application/json'];
    // Only send Authorization if your Space is PRIVATE
    if (!empty($this->apiKey)) {
      $headers[] = 'Authorization: Bearer ' . $this->apiKey;
    }

    $ch = curl_init($this->apiUrl);
    $opts = [
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_POST           => true,
      CURLOPT_POSTFIELDS     => $payload,
      CURLOPT_HTTPHEADER     => $headers,
      CURLOPT_TIMEOUT        => 30,
      CURLOPT_CONNECTTIMEOUT => 10,
    ];

    // Proper SSL verification if you have a CA bundle configured
    if ($this->caCert && file_exists($this->caCert)) {
      $opts[CURLOPT_SSL_VERIFYPEER] = true;
      $opts[CURLOPT_SSL_VERIFYHOST] = 2;
      $opts[CURLOPT_CAINFO] = $this->caCert;
    } else {
      // DEV-ONLY fallback (don’t keep this in production)
      $opts[CURLOPT_SSL_VERIFYPEER] = false;
      $opts[CURLOPT_SSL_VERIFYHOST] = 0;
    }

    curl_setopt_array($ch, $opts);
    $response = curl_exec($ch);
    $http     = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $err      = curl_error($ch);
    curl_close($ch);

    if ($response === false) {
      return ['ok'=>false, 'error'=>$err ?: 'Unknown cURL error', 'http'=>$http ?? 0];
    }

    // Local AI model service returns: {"data": ["<json string>", ...]}
    $outer = json_decode($response, true);
    if (!is_array($outer) || !isset($outer['data'][0])) {
      return ['ok'=>false, 'error'=>'Unexpected response shape', 'http'=>$http, 'raw'=>$response];
    }

    $innerJson = $outer['data'][0];
    $parsed = json_decode($innerJson, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
      // If the model ever returns plain text, return as-is
      return ['ok'=>true, 'data'=>$innerJson, 'http'=>$http];
    }

    return ['ok'=>true, 'data'=>$parsed, 'http'=>$http];
  }
}
